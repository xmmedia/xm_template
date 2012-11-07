#!/bin/bash
# setups up the compass project, including the xm and cl4 libraries
# the SASS and CSS dirs are setup as the default dirs
compass create . --prepare --sass-dir html/css/sass --css-dir html/css --javascripts-dir html/js --images-dir html/images --output-style compressed --no-line-comments -I html/cl4/css/sass/ -I html/xm/css/sass/