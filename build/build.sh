#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
mkdir -p $DIR/temp

# Build docs
mkdir -p $DIR/temp/phpdoc-cache
$DIR/../vendor/bin/phpdoc -t $DIR/../docs --cache-folder $DIR/temp/phpdoc-cache -d $DIR/../interfaces -d $DIR/../src --template="xml"
$DIR/../vendor/bin/phpdoc -t $DIR/../docs --cache-folder $DIR/temp/phpdoc-cache -d $DIR/../interfaces -d $DIR/../src --template="clean"
mkdir -p $DIR/../docs/md
$DIR/../vendor/bin/phpdocmd $DIR/../docs/structure.xml $DIR/../docs/md