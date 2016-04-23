#!/bin/sh

#delete files in cache which last access is longer than 60 minutes ago 
#do this as a crone job 
find ../cache -maxdepth 1 -type f -amin +60 -delete
