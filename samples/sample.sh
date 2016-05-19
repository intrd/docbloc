#!/bin/bash
##
# PHP DocBloc - Generate and keep updated DocBlock of your project files fetching details from composer.json and Git. Supported formats: *.php, *.ini, *.sh, *.bat, *.md (No Composer or PEAR need to be installed to use this tool). 
#
# @package intrd/php-docbloc
# @version 1.0
# @tags php, docblock, documentation, tool
# @link http://github.com/intrd/php-docbloc
# @author intrd (Danilo Salles) - http://dann.com.br
# @copyright (CC-BY-SA-4.0) 2016, intrd
# @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0
# Dependencies: 
# - php >=5.3.0
## @docbloc 1.0

LOGFILE="LOGS/phpbloc.log"
TIMESTAMP=`date "+%Y-%m-%d_%H:%M:%S"`
touch $LOGFILE

while true
do
	echo "$TIMESTAMP STARTING...\n" >> $LOGFILE 
	php sample.php 2>&1 | tee $LOGFILE # comment
	sleep 5
done

## another sample comment untouched






