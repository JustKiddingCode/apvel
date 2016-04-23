#!/bin/sh
cd ../
touch reports/$1.template.md
touch reports/$1.email
touch reports/published/$1.resolutions.txt
touch reports/$1.invitations.txt
mkdir reports/published/$1
mkdir reports/unpublished/$1
