#!/bin/bash
# clones the entire repo, moves around the init files and then moves all the files into place

GIT_REPO="git@example.com:/repo.git";
CHECKOUT_DIR="updates_temp";
SILENT_MODE="n";

usage()
{
cat << EOF
This script will retrieve the git repository on a specific branch, change to the right init.php file, then move the files into place, followed by running the change scripts.

OPTIONS:
   -h   Show this message.
   -b   The branch to use, ie, master.
   -c   The directory to check out the repo into.
   -g   The git repo path, ie, git@repo.example.com:/repo.git
   -i   The PHP init/config to use, ie, init-production.
   -s   Execute without any confirmation. This will move the files into place and run the change scripts without a confirmation.

Usage:

   sh ./update.sh -b master -g git@repo.example.com:/repo.git -i init-production

The repo can be hard coded at the top of the script thus removing the need for the -g parameter on each run. Although it can still be overridden in the parameters if needed.

Note: The server must have access to the git repos.

EOF
}

while getopts b:c:g:i:sh optname
do
	case "${optname}"
	in
		b) BRANCH=${OPTARG};;
		c) CHECKOUT_DIR=${OPTARG};;
		g) GIT_REPO=${OPTARG};;
		i) PHP_INIT=${OPTARG};;
		s) SILENT_MODE="y";;
		h)
			usage
			exit 0;;
	esac
done

if [[ -z "${BRANCH}" ]]; then echo ; echo "Error: The branch is not set"; echo ; usage; exit 1; fi
if [[ -z "${GIT_REPO}" ]]; then echo ; echo "Error: The git repo path is not set"; echo ; usage; exit 1; fi
if [[ -z "${PHP_INIT}" ]]; then echo ; echo "Error: The PHP init/config is not set"; echo ; usage; exit 1; fi

echo
echo "Checking out the repo \"${GIT_REPO}\" to branch \"${BRANCH}\" and setting the config to \"${PHP_INIT}.php\"";
echo
if [[ $SILENT_MODE != "y" ]]; then
	read -p "Continue (y/n)? ";
	if [[ "$REPLY" != "y" ]]; then
		echo "Stopping!";
		exit 1;
	fi
fi

if [[ -d "$CHECKOUT_DIR" ]]; then
	echo
	read -p "The temporary checkout dir exists (${CHECKOUT_DIR}). Delete it? (y/n)? ";
	if [[ $SILENT_MODE != "y" ]]; then
		if [[ "$REPLY" != "y" ]]; then
			echo "Stopping!";
			exit 1;
		fi
	fi

	echo "-- Removing existing $CHECKOUT_DIR/";
	rm -rf $CHECKOUT_DIR || exit 1
fi

echo
echo "-- Checking out repo and submodules";
git clone --branch $BRANCH --recursive $GIT_REPO $CHECKOUT_DIR || exit 1

# remove all the git directories
echo
echo "-- Recursively removing git directoies and files (.git, .gitignore, .gitmodules)";
rm -rf `find $CHECKOUT_DIR/ -name .git` || exit 1
rm -rf `find $CHECKOUT_DIR/ -name .gitignore` || exit 1
rm -rf `find $CHECKOUT_DIR/ -name .gitmodules` || exit 1

echo
echo "-- Removing the init files we don't want, keeping ${PHP_INIT}.php";
# only remove the init and rename the init we want if we don't want to use the init
if [[ $PHP_INIT != "init" ]]; then
	echo "-- Removing $CHECKOUT_DIR/application/init.php";
	rm -vf $CHECKOUT_DIR/application/init.php || exit 1
	echo "-- Renaming $CHECKOUT_DIR/application/${PHP_INIT}.php to $CHECKOUT_DIR/application/init.php";
	mv -vf $CHECKOUT_DIR/application/${PHP_INIT}.php $CHECKOUT_DIR/application/init.php || exit 1
fi

echo "-- Removing the other init files (init-*)";
rm -vf $CHECKOUT_DIR/application/init-* || exit 1

if [[ $SILENT_MODE != "y" ]]; then
	echo
	read -p "Copy the files into place? (y/n) ";
	if [[ "$REPLY" != "y" ]]; then
		echo "Stopped! Files are located in $CHECKOUT_DIR/";
		exit 0
	fi
fi

echo
echo "-- Moving the files into place, excluding uploads, caches, etc";
rm -rf application/ && mv $CHECKOUT_DIR/application/ application/ || exit 1
rm -rf modules/ && mv $CHECKOUT_DIR/modules/ modules/ || exit 1
rm -rf system/ && mv $CHECKOUT_DIR/system/ system/ || exit 1
rm -rf change_scripts/ && mv $CHECKOUT_DIR/change_scripts/ change_scripts/ || exit 1
rm -rf `find html/ ! -path "html/uploads" ! -path "html/"` && mv $CHECKOUT_DIR/html/* html/ && mv $CHECKOUT_DIR/html/.htaccess html/ || exit 1

cd html/ || exit 1

# just run the change scripts
if [[ $SILENT_MODE == "y" ]]; then
	echo
	echo "-- Running change scripts";
	php index.php --uri="change_script/run" || exit 1

# list the change scripts and then ask if they should be run
else
	echo
	echo "-- Listing change scripts";
	php index.php --uri="change_script/list" || exit 1

	read -p "Do you want to run the above change scripts? (y/n) ";
	if [[ "$REPLY" == "y" ]]; then
		echo
		echo "-- Running change scripts";
		php index.php --uri="change_script/run" || exit 1
	fi
fi

cd .. || exit 1

echo
echo "-- Removing temporary directories: $CHECKOUT_DIR/";
rm -rf $CHECKOUT_DIR || exit 1

echo
echo "-- Complete";

exit 0