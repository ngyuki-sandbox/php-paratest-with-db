#!/bin/bash

cd -- "$(dirname -- "$(readlink -f -- "$0")")/.."

cat database/*.sql | mysql -v "$MYSQL_DATABASE"
