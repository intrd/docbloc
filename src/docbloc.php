<?php
/**
 * PHP DocBloc - Batch generate and keep updated DockBlock of your project files fetching details from composer.json and .git/HEAD. Supported formats: *.php, *.ini, *.sh, *.bat, *.md (No Composer or PEAR need to be installed to use this tool). 
 * 
* @package intrd/php-docbloc
* @version 1.0
* @tags: php, docblock, documentation, tool
* @link http://github.com/intrd/php-docbloc
* @author intrd (Danilo Salles) - http://dann.com.br
* @copyright (CC-BY-SA-4.0) 2016, intrd
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0
* Dependencies: No
*** @docbloc 1.0 */

/* Default config */
	$path=__DIR__.'/'; //current dir and upper levels
	$filetypes_regex='/^.+(.php|.sh|.ini|.bat|.md)$/i'; //regex of file search

	//PHP SCRIPT
	$php_trigger_start="/**";
	$php_doc="$php_trigger_start\n * <composer_description>\n* \n* @package <composer_name>\n* @version <git_branch_version>\n* @tags <composer_keywords>\n* @link <composer_homepage>";
	$php_doc.="<composer_authors_list>";
	$php_authors_linestart="\n* @author ";
	$php_doc.="\n* @copyright (<composer_license>) <copyright_year>, <composer_extra_copyright_author>\n* @license <composer_extra_license_title> - <composer_extra_license_url>";
	$php_doc.="<composer_deps_list>";
	$php_deps_header="\n* Dependencies: ";
	$php_deps_linestart="\n* - ";
	$php_doc.="\n*** @docbloc <docbloc_version> */";
	$php_trigger="* @docbloc";

	//md 
	$md_trigger_start='<!--';
	$md_doc="$md_trigger_start docbloc -->\n<span id='docbloc'>\n<composer_description>\n<table>\n<tr>\n<th>Package</th>\n<td><composer_name></td>\n</tr>\n<tr>\n<th>Version</th>\n<td><git_branch_version></td>\n</tr>\n<tr>\n<th>Tags</th>\n<td><composer_keywords></td>\n</tr>\n<tr>\n<th>Project URL</th>\n<td><composer_homepage></td>\n</tr>";
	$md_doc.="<composer_authors_list>";
	$md_authors_linestart="\n<tr>\n<th>Author</th>\n<td>";
	$md_doc.="</td>\n<tr>\n<th>Copyright</th>\n<td>(<composer_license>) <copyright_year>, <composer_extra_copyright_author></td>\n</tr>\n<tr>\n<th>License</th>\n<td><a href='<composer_extra_license_url>'><composer_extra_license_title></a></td>\n</tr>";
	$md_doc.="<composer_deps_list>";
	$md_deps_header="\n<tr>\n<th>Dependencies</th>\n<td>";
	$md_deps_linestart=" &#8226; ";
	$md_trigger_end="- @docbloc";
	$md_doc.="</td>\n</tr>\n</table>\n</span>\n<!-$md_trigger_end <docbloc_version> -->\n";

	//SHELL SCRIPT
	$sh_trigger_start="##";
	$sh_doc="$sh_trigger_start\n# <composer_description>\n#\n# @package <composer_name>\n# @version <git_branch_version>\n# @tags <composer_keywords>\n# @link <composer_homepage>";
	$sh_doc.="<composer_authors_list>";
	$sh_authors_linestart="\n# @author ";
	$sh_doc.="\n# @copyright (<composer_license>) <copyright_year>, <composer_extra_copyright_author>\n# @license <composer_extra_license_title> - <composer_extra_license_url>";
	$sh_doc.="<composer_deps_list>";
	$sh_deps_header="\n# Dependencies: ";
	$sh_deps_linestart="\n# - ";
	$sh_doc.="\n## @docbloc <docbloc_version>\n";
	$sh_trigger_end="# @docbloc";

	//INI
	$ini_trigger_start=";;";
	$ini_doc="$ini_trigger_start\n; <composer_description>\n;\n; @package <composer_name>\n; @version <git_branch_version>\n; @tags <composer_keywords>\n; @link <composer_homepage>";
	$ini_doc.="<composer_authors_list>";
	$ini_authors_linestart="\n; @author ";
	$ini_doc.="\n; @copyright (<composer_license>) <copyright_year>, <composer_extra_copyright_author>\n; @license <composer_extra_license_title> - <composer_extra_license_url>";
	$ini_doc.="<composer_deps_list>";
	$ini_deps_header="\n; Dependencies: ";
	$ini_deps_linestart="\n; - ";
	$ini_doc.="\n;; @docbloc <docbloc_version>\n";
	$ini_trigger_end="; @docbloc";

	//BAT
	$bat_trigger_start="REM";
	$bat_doc="$bat_trigger_start\n:: <composer_description>\n::\n:: @package <composer_name>\n:: @version <git_branch_version>\n:: @tags <composer_keywords>\n:: @link <composer_homepage>";
	$bat_doc.="<composer_authors_list>";
	$bat_authors_linestart="\n:: @author ";
	$bat_doc.="\n:: @copyright (<composer_license>) <copyright_year>, <composer_extra_copyright_author>\n:: @license <composer_extra_license_title> - <composer_extra_license_url>";
	$bat_doc.="<composer_deps_list>";
	$bat_deps_header="\n:: Dependencies: ";
	$bat_deps_linestart="\n:: - ";
	$bat_doc.="\nREM @docbloc <docbloc_version>\n";
	$bat_trigger_end="REM @docbloc";
/* End of config */

//Variables to be extracted..
$vars["composer_description"]="";
$vars["composer_name"]="";
$vars["git_branch_version"]="";
$vars["composer_keywords"]="";
$vars["composer_homepage"]="";
$vars["composer_authors_list"]="";
$vars["composer_license"]="";
$vars["composer_copyright_year"]="";
$vars["composer_extra_copyright_author"]="";
$vars["composer_extra_license_title"]="";
$vars["composer_extra_license_url"]="";
$vars["composer_deps_list"]="";
$vars["docbloc_version"]="";

/* Extracting/formating composer.json data */
$composer = json_decode(file_get_contents('composer.json'));
$composer->keywords=implode(", ",$composer->keywords);
$vars["composer_keywords"]=$composer->keywords;
$vars["composer_description"]=$composer->description;
$vars["composer_name"]=$composer->name;
$vars["composer_homepage"]=$composer->homepage;
$vars["composer_license"]=$composer->license;
$vars["copyright_year"]=date("Y");
$vars["composer_extra_copyright_author"]=$composer->extra->copyright_author;
$vars["composer_extra_license_title"]=$composer->extra->license_title;
$vars["composer_extra_license_url"]=$composer->extra->license_url;
foreach($composer->authors as $author){
	if (isset($author->homepage)) {
		$vars["composer_authors_list"][]=$author->name." - ".$author->homepage;
	}else if (isset($author->email)){
		$vars["composer_authors_list"][]=$author->name." - ".$author->email;
	}
}
$vars["composer_authors_list"]=implode("<authors_linestart>",$vars["composer_authors_list"]);
if (count($vars["composer_authors_list"])==1){
	$vars["composer_authors_list"]="<authors_linestart>".$vars["composer_authors_list"];
}
if (isset($composer->require)){
	$vars["composer_deps_list"]="<deps_header>";
	foreach($composer->require as $dep=>$vers){
		$composer_deps_listarray[]="<deps_linestart>".$dep." ".$vers;
	}
	$vars["composer_deps_list"].=implode("",$composer_deps_listarray);
}else{
	$vars["composer_deps_list"]="<deps_header>No";
}


/* Extracting/formating .git/HEAD data */
$git_branch_version="";
if(file_exists('.git/HEAD')){
	$stringfromfile = file('.git/HEAD', FILE_USE_INCLUDE_PATH);
	$firstLine = $stringfromfile[0]; 
	$explodedstring = explode("/", $firstLine, 3); 
	$git_branch_version = trim($explodedstring[2]);
	$vars["git_branch_version"]=$git_branch_version;
}

/* Starting DocBloc... */
$filepath="docbloc.php";
$file = file_get_contents($filepath);
foreach (token_get_all($file) as $token ) {
    if ($token[0] != T_DOC_COMMENT) {
        continue;
    }
   $docbloc_version=explode("@version",$token[1]);
   $docbloc_version=explode("*",$docbloc_version[1]);
   $docbloc_version=trim($docbloc_version[0]);
   $vars["docbloc_version"]=$docbloc_version;
   $docbloc_author=explode("@author",$token[1]);
   $docbloc_author=explode("*",$docbloc_author[1]);
   $docbloc_author=trim($docbloc_author[0]);
   $docbloc_author_nickname=strtok($docbloc_author, " ");
   break;
}
if (!isset($docbloc_author_nickname) or !isset($docbloc_version) 
	or $docbloc_version<1 or $docbloc_author_nickname!="intrd") 
	die("\r\n*** docbloc.php file changed, please re-download.");
echo "# PHP DocBloc $docbloc_version (by $docbloc_author_nickname)\n"; 
echo " ** starting..\n";

if (!file_exists("composer.json")) 
	die(" ** ./composer.json file not found, aborting...\n");

/* Recursively list all matched files */
$directory = new RecursiveDirectoryIterator($path);
$iterator = new RecursiveIteratorIterator($directory);
$regex = new RegexIterator($iterator, $filetypes_regex, RecursiveRegexIterator::GET_MATCH);
$exclude="docbloc.php";
foreach($regex as $filepath => $regex){
	if (strpos($filepath,$exclude)===false) $files[]=$filepath;
}

/* Updating your project scripts w/ new DocBlock */
foreach ($files as $filepath){
	/* Generating DocBlock */
	$filetype=pathinfo($filepath, PATHINFO_EXTENSION);
	$doc=${$filetype."_doc"};
	foreach ($vars as $key=>$var){
		$doc=str_replace("<$key>", $var, $doc);
	}
	$doc=str_replace("<authors_linestart>", ${$filetype."_authors_linestart"}, $doc);
	$doc=str_replace("<deps_header>", ${$filetype."_deps_header"}, $doc);
	$doc=str_replace("<deps_linestart>", ${$filetype."_deps_linestart"}, $doc);
	$file = file_get_contents($filepath);
	//PHP
	if ($filetype=="php"){
		foreach (token_get_all($file) as $token ) {
		    if ($token[0] != T_DOC_COMMENT) {
		        continue;
		    }
		    if (strpos($token[1],${$filetype."_trigger"})!==false){
		    	$file = str_replace($token[1], $doc, $file);
		    	echo "  > $filepath";
		    	$file = file_put_contents($filepath,$file);
		    	echo ".. docbloc updated!\n";
			}
		}
	}
	//SHELL SCRIPT
	if ($filetype=="sh"){
		if (strpos($file,${$filetype."_trigger_end"})!==false){
			$matches=preg_grep('/'.${$filetype."_trigger_start"}.'/', file($filepath));
			//var_dump($matches);
			unset($line_start);
			unset($line_end);
			foreach($matches as $key=>$lin){
				if(strpos($lin,${$filetype."_trigger_end"})!==false) $line_end=$key;
			}
			foreach($matches as $key=>$lin){
				if(strpos($lin,${$filetype."_trigger_start"})!==false and strpos($lin,${$filetype."_trigger_end"})===false and $key<=$line_end) $line_start=$key;
			}
			if(!isset($line_start)) $line_start=$line_end;
			$filecontent=file($filepath);
			$remove="";
			for ($i = $line_start; $i <= $line_end; $i++) { $remove.=$filecontent[$i]; }
			$file = str_replace($remove, $doc, $file);
			echo "  > $filepath";
			$file = file_put_contents($filepath,$file);
			echo ".. docbloc updated!\n";
		}
	}
	//INI
	if ($filetype=="ini"){
		if (strpos($file,${$filetype."_trigger_end"})!==false){
			$matches=preg_grep('/'.${$filetype."_trigger_start"}.'/', file($filepath));
			//var_dump($matches);
			unset($line_start);
			unset($line_end);
			foreach($matches as $key=>$lin){
				if(strpos($lin,${$filetype."_trigger_end"})!==false) $line_end=$key;
			}
			foreach($matches as $key=>$lin){
				if(strpos($lin,${$filetype."_trigger_start"})!==false and strpos($lin,${$filetype."_trigger_end"})===false and $key<=$line_end) $line_start=$key;
			}
			if(!isset($line_start)) $line_start=$line_end;
			$filecontent=file($filepath);
			$remove="";
			//echo $line_start."@".$line_end;
			for ($i = $line_start; $i <= $line_end; $i++) { $remove.=$filecontent[$i]; }
			$file = str_replace($remove, $doc, $file);
			echo "  > $filepath";
			$file = file_put_contents($filepath,$file);
			echo ".. docbloc updated!\n";
		}
	}
	//BAT
	if ($filetype=="bat"){
		if (strpos($file,${$filetype."_trigger_end"})!==false){
			$matches=preg_grep('/'.${$filetype."_trigger_start"}.'/', file($filepath));
			//var_dump($matches);
			unset($line_start);
			unset($line_end);
			foreach($matches as $key=>$lin){
				if(strpos($lin,${$filetype."_trigger_end"})!==false) $line_end=$key;
			}
			foreach($matches as $key=>$lin){
				if(strpos($lin,${$filetype."_trigger_start"})!==false and strpos($lin,${$filetype."_trigger_end"})===false and $key<=$line_end) $line_start=$key;
			}
			if(!isset($line_start)) $line_start=$line_end;
			$filecontent=file($filepath);
			$remove="";
			//echo $line_start."@".$line_end;
			for ($i = $line_start; $i <= $line_end; $i++) { $remove.=$filecontent[$i]; }
			$file = str_replace($remove, $doc, $file);
			echo "  > $filepath";
			$file = file_put_contents($filepath,$file);
			echo ".. docbloc updated!\n";
		}
	}
	//md
	if ($filetype=="md"){
		if (strpos($file,${$filetype."_trigger_end"})!==false){
			$matches=preg_grep('/'.${$filetype."_trigger_start"}.'/', file($filepath));
			//var_dump($matches);
			//die;
			unset($line_start);
			unset($line_end);
			foreach($matches as $key=>$lin){
				if(strpos($lin,${$filetype."_trigger_end"})!==false) $line_end=$key;
			}
			foreach($matches as $key=>$lin){
				if(strpos($lin,${$filetype."_trigger_start"})!==false and strpos($lin,${$filetype."_trigger_end"})===false and $key<=$line_end) $line_start=$key;
			}
			if(!isset($line_start)) $line_start=$line_end;
			$filecontent=file($filepath);
			$remove="";
			//echo $line_start."@".$line_end;
			for ($i = $line_start; $i <= $line_end; $i++) { $remove.=$filecontent[$i]; }
			$file = str_replace($remove, $doc, $file);
			echo "  > $filepath";
			$file = file_put_contents($filepath,$file);
			echo ".. docbloc updated!\n";
		}
	}
}
echo "# All done!\n";


?>