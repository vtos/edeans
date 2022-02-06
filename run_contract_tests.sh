#!/usr/bin/env sh

set -e

# Migrations up
vendor/bin/doctrine-migrations migrate --no-interaction

vendor/bin/phpunit --testdox --testsuite contract

#Migrations down
vendor/bin/doctrine-migrations migrate first --no-interaction
