#!/bin/bash

clear
echo Installing Grunt and its dependencies...
sudo npm install  grunt grunt-string-replace grunt-rename

echo Initialising plugin using Grunt and package.json...
sudo grunt

echo Done.
