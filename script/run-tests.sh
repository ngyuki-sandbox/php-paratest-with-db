#!/bin/sh

cd -- "$(dirname -- "$(readlink -f -- "$0")")/.."

set -eux -o pipefail

: ${PARA:=5}

cat database/*.sql | mysql -v "$MYSQL_DATABASE"

mysqldump -h "$MYSQL_HOST" "$MYSQL_DATABASE" -r dump.sql

mysql -v -e "grant all on \`${MYSQL_DATABASE}%\`.* to $MYSQL_USER@'%'"

seq "$PARA" | xargs -P0 -i mysql -v -e 'create database if not exists test{}'

seq "$PARA" | xargs -P0 -i mysql -e 'source dump.sql' 'test{}'

vendor/bin/paratest -p "$PARA"
