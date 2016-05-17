<?php
/**
 * PHP DocBloc - Batch generate and keep updated DockBlock of your project files fetching details from composer.json and .git/HEAD. Supported formats: *.php, *.ini, *.sh, *.bat, *.md (No Composer or PEAR need to be installed to use this tool).
* 
* @package intrd/php-docbloc
* @version 
* @tags php, docblock, documentation, tool
* @link http://github.com/intrd/php-docbloc
* @author intrd (Danilo Salles) - http://dann.com.br
* @copyright (CC-BY-SA-4.0) 2016, intrd
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0
* Dependencies: 
* - php >=5.3.0
*** @docbloc 1.0 */

require __DIR__ . '/vendor/autoload.php';
use php\sample as s;

s::helloSample();
echo "Hello World!";




