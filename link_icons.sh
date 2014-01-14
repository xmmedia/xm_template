#!/bin/bash
# setups up the compass project, including the xm library
# the SASS and CSS dirs are setup as the default dirs
# sym link the xm images & icons dirs to the "local" images:
cd html/images
ln -s ../xm/images/ xm
ln -s ../xm/images/xm_icons/ xm_icons
ln -s ../xm/images/xm_arrows/ xm_arrows
ln -s ../xm/images/xm_file_types/ xm_file_types
cd ../..