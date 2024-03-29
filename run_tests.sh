#!/usr/bin/env sh

set -e

vendor/bin/phpunit --testdox --testsuite unit
vendor/bin/phpunit --testdox --testsuite use_case

mkdir -p var/sqlite
touch -a var/sqlite/edeans_test.db

# Migrations up
vendor/bin/doctrine-migrations migrate --no-interaction

vendor/bin/phpunit --testdox --testsuite contract

#Migrations down
vendor/bin/doctrine-migrations migrate first --no-interaction
