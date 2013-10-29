#!/bin/bash
# compiles the SASS files for the project and the libraries (just in case)
cd html/xm/ && compass compile . --time --environment development && cd ../..
compass compile . --time --environment development