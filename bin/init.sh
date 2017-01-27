#!/bin/sh
cd ..
git submodule init
git submodule update

mkdir reports
mkdir reports/published
mkdir reports/unpublished

cd reports
git init

