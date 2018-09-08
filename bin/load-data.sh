#!/usr/bin/env bash
# bin/console doctrine:database:drop --force # if sqlite?
bin/console doctrine:query:dql "DELETE FROM App:Committee"
bin/console doctrine:query:dql "DELETE FROM App:Contribution"
bin/console doctrine:query:dql "DELETE FROM App:Expenditure"
bin/console doctrine:query:dql "DELETE FROM App:Contributor"
bin/console doctrine:schema:update --force
bin/console app:import ../data/ -v
