#!/bin/bash
# compiles the SASS files for the project and the libraries (just in case)
compass compile . --time --environment development
compass compile html/xm/ --time --environment development
compass compile html/cl4/ --time --environment development