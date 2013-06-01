#!/bin/bash
# Moves the init files and runs the change scripts.

SILENT_MODE="n";

usage()
{
cat << EOF
This script will change to the right init file and then run the change scripts. It is for use with deployhq.com, typically run in silent mode (-s).

OPTIONS:
   -h   Show this message.
   -p   The path to the site, ie, /home/example/example.com
   -i   The PHP init/config to use, ie, production (init will be init-production.php) or example.com (init will be init-example.php). If set to "dev", "develop", or "development", no suffix will be added to the init file name. It will just be "init.php".
   -s   Execute without any confirmation. This will move the files into place and run the change scripts without a confirmation.

Usage:

   sh ./deploy_hq.sh -i production -p /home/example/example.com

EOF
}

while getopts p:i:sh optname
do
	case "${optname}"
	in
		i) PHP_INIT=${OPTARG};;
		s) SILENT_MODE="y";;
		p) SITE_PATH=${OPTARG};;
		h)
			usage
			exit 0;;
	esac
done

if [[ -z "${PHP_INIT}" ]]; then echo ; echo "Error: The PHP init/config is not set"; echo ; usage; exit 1; fi
if [[ -z "${SITE_PATH}" ]]; then echo ; echo "Error: The site path is not set"; echo ; usage; exit 1; fi

# if PHP_INIT equal development or dev, then set the init to just "init"
if [[ "${PHP_INIT}" == "development" || "${PHP_INIT}" == "dev" || "${PHP_INIT}" == "develop" ]]; then
	PHP_INIT="init";
# otherwise, add "init-" infront of PHP_INIT
else
	PHP_INIT="init-${PHP_INIT}";
fi

cd $SITE_PATH || exit 1

# only move around the config files if the one we want exists
# it will only exist if it changed and was uploaded by deploy hq
if [[ -d "application/${PHP_INIT}.php" ]]; then
	echo
	echo "-- Removing the init files we don't want, keeping ${PHP_INIT}.php";
	# only remove the init and rename the init we want if we don't want to use the init
	if [[ $PHP_INIT != "init" ]]; then
		echo "-- Removing application/init.php";
		rm -vf application/init.php || exit 1
		echo "-- Renaming application/${PHP_INIT}.php to application/init.php";
		mv -vf application/${PHP_INIT}.php application/init.php || exit 1
	fi

	echo "-- Removing the other init files (init-*)";
	rm -vf application/init-* || exit 1
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

cd .. || exit 1

echo
echo "-- Complete";

exit 0