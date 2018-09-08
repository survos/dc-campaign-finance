#!/usr/bin/env bash
bin/console doctrine:database:drop --force # if sqlite?
bin/console doctrine:schema:update --force
bin/console app:import ../data/ -v
