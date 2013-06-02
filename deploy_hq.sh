#!/bin/bash
# Runs the change scripts.

SILENT_MODE="n";

usage()
{
cat << EOF
This script will run the change scripts. It is for use with deployhq.com, typically run in silent mode (-s).

OPTIONS:
   -h   Show this message.
   -p   The path to the site, ie, /home/example/example.com
   -s   Execute without any confirmation. This will move the files into place and run the change scripts without a confirmation.

Usage:

   sh ./deploy_hq.sh -p /home/example/example.com

EOF
}

while getopts p:sh optname
do
	case "${optname}"
	in
		s) SILENT_MODE="y";;
		p) SITE_PATH=${OPTARG};;
		h)
			usage
			exit 0;;
	esac
done

if [[ -z "${SITE_PATH}" ]]; then echo ; echo "Error: The site path is not set"; echo ; usage; exit 1; fi

cd $SITE_PATH || exit 1
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

cd .. || exit 1

echo
echo "-- Complete";

exit 0