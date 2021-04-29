#!/bin/bash

cd -- "$(dirname -- "$(readlink -f -- "$0")")/.."

rm -v tests/*.php
seq -w 0 9 | xargs -i bash -v -c 'sed "s/\${N}/{}/" < tests/SampleTest.php.txt > tests/Sample{}Test.php'
