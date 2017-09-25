#!/usr/bin/env bash

set -ex

# cd to the directory of this script
cd "$( dirname "${BASH_SOURCE[0]}" )"

docker-compose -f docker-compose.yml build