<?php

namespace App\Command;

use App\Entity\Committee;
use App\Entity\Contribution;
use App\Entity\Contributor;
use App\Entity\Expenditure;
use Doctrine\ORM\EntityManagerInterface;
use EasyCSV\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCommand extends Command
{
    protected static $defaultName = 'app:import';

    private $em;

    private $committees; // cache, keyed by name
    private $contributors;

    public function __construct($name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);
        $this->em = $entityManager;
        $this->committees = [];
        $this->contributors = [];
    }

    

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('data-dir', InputArgument::OPTIONAL, 'Data Directory', "")
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        foreach ([
                     'committee.csv' => Committee::class,
                     'contribution.csv' => Contribution::class,
                'expenditure.csv' => Expenditure::class,
                 ] as $csv => $class) {
            $csv = $input->getArgument('data-dir') . $csv;

            if (!file_exists($csv)) {
                throw new \Exception("Cannot open $csv");
            }
            $reader = new Reader($csv);
            $io->note(sprintf('Importing: %s (%d lines)', $csv, $reader->getLastLineNumber()));
            try {

                while ($row = $reader->getRow()) {
                    $entity = $this->importRow($row, $class, $reader->getLineNumber());
                }
            } catch (\Exception $e) {
                print $e->getMessage();
                $io->error(sprintf("Error on line %d\n", $reader->getLineNumber()) );
            }

            $this->em->flush();
        }



        $io->success('Data import complete.');
    }

    private function importRow($data, $class, $lineNumber)
    {
        // tweak anything unusual, the import the normal fields, then set any relations
        $key = null; // no lookup, only inserts
        $keyValue = $data['Committee Name'];

        switch ($class) {
            case Committee::class:
                if ($data['Election Year'] < 2016) {
                    // return null;
                }
                $key = ['committeeName' => $keyValue];
                $entity = $this->importFields($key, $data, $class);
                $this->committees[$keyValue] = $entity;
                break;
            case Expenditure::class:
                $data['Committee'] = $this->committees[$keyValue];
                unset($data['Committee Name']);
                $entity = $this->importFields($key, $data, $class);
                break;
            case Contribution::class:
                // find/create a contributor

                $uniqueKey = [
                    'name' => $data['Contributor Name'],
                    'numberAndStreet' => $data['Number and Street'],
                    'city' => $data['City']
                ];
                $keyString = join('-', array_values($uniqueKey));


                if (isset($this->contributors[$keyString])) {
                    $contributor = $this->contributors[$keyString];
                } else {
                    if (!$contributor = $this->em->getRepository(Contributor::class)->findOneBy($uniqueKey)) {
                        $contributor = (new Contributor())
                            ->setName($data['Contributor Name'])
                            ->setNumberAndStreet($data['Number and Street'])
                            ->setCity($data['City'])
                            ->setState($data['State'])
                            ->setZip($data['Zip'])
                        ;
                        $this->em->persist($contributor);
                    }
                    $this->contributors[$keyString] = $contributor;
                }
                // dump($contributor); die();


                $data['Committee'] = $this->committees[$keyValue];
                $data['Contributor'] =  $contributor;
                unset($data['Committee Name']);
                unset($data['Contributor Name']);
                $entity = $this->importFields($key, $data, $class);
                break;
        }

        return $entity;
    }

    private function importFields(?array $key, array $data, string $class) {
        $repo = $this->em->getRepository($class);
        if (empty($key) || !$entity = $repo->findOneBy($key))
        {
            $entity = new $class();
            $this->em->persist($entity);
        }

        foreach ($data as $var => $val) {
            if (preg_match('/Date/', $var)) {
                $val = new \DateTime($val);
            }
            if (preg_match('/Amount/', $var)) {
                $val = str_replace('$', '', $val);
                // $val = (floatval($val));
            }

            $method = 'set' . str_replace(' ', '', $var);
            $entity->$method($val);
        }
        return $entity;
    }
}
