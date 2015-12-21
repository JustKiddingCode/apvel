#!/bin/sh
touch reports/$1.template.md
touch reports/$1.email
touch reports/published/$1.resolutions
mkdir reports/published/$1
mkdir reports/unpublished/$1
