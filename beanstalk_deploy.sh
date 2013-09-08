#!/bin/bash
# Moves the init.php into place and runs the change scripts.

SILENT_MODE="n";

usage()
{
cat << EOF
This script will move the config (init.php) into place and run the change scripts. It is for use with Beanstalk, typically run in silent mode (-s).

OPTIONS:
	-h   Show this message.
	-c   The configuration to move to /application/init.php from application/config/inits/<config>.php
	-s   Execute without any confirmation. This will config move the file into place and run the change scripts without a confirmation.

Usage:

	sh ./beanstalk_deploy.sh -s -c init-production

EOF
}

while getopts c:sh optname
do
	case "${optname}"
	in
		s) SILENT_MODE="y";;
		c) CONFIG="application/config/inits/$OPTARG.php";;
		h)
			usage
			exit 0;;
	esac
done

if [[ -e "${CONFIG}" ]]; then
	echo
	echo "-- Copying config into place";
	cp ${CONFIG} application/init.php || exit 1
fi

cd html/ || exit 1

# just run the change scripts
if [[ $SILENT_MODE == "y" ]]; then
	echo
	echo "-- Running change scripts";
	php index.php --task="change:script:run" || exit 1

# list the change scripts and then ask if they should be run
else
	echo
	echo "-- Listing change scripts";
	php index.php --task="change:script:list" || exit 1

	read -p "Do you want to run the above change scripts? (y/n) ";
	if [[ "$REPLY" == "y" ]]; then
		echo
		echo "-- Running change scripts";
		php index.php --task="change:script:run" || exit 1
	fi
fi

echo
echo "-- Complete";

exit 0