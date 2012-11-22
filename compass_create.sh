#!/bin/bash
# setups up the compass project, including the xm and cl4 libraries
# the SASS and CSS dirs are setup as the default dirs
# sym link the cl4 images & icons dirs to the "local" images:
cd html/images
ln -s ../cl4/images/ cl4
ln -s ../cl4/images/cl4_icons/ cl4_icons
ln -s ../cl4/images/cl4_arrows/ cl4_arrows
ln -s ../cl4/images/cl4_file_types/ cl4_file_types
cd ../..
# this last line doesn't need to be run if the config is already in place
# compiling will generate all the other files
#compass create . --prepare --sass-dir html/css/sass --css-dir html/css --javascripts-dir html/js --images-dir html/images --output-style compressed --no-line-comments -I html/cl4/css/sass/ -I html/xm/css/sass/