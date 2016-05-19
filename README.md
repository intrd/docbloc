<!-- docbloc -->
<span id='docbloc'>
PHP DocBloc - Generate and keep updated DocBlock of your project files fetching details from composer.json and Git. Supported formats: *.php, *.ini, *.sh, *.bat, *.md (No Composer or PEAR need to be installed to use this tool). 
<table>
<tr>
<th>Package</th>
<td>intrd/php-docbloc</td>
</tr>
<tr>
<th>Version</th>
<td>1.0</td>
</tr>
<tr>
<th>Tags</th>
<td>php, docblock, documentation, tool</td>
</tr>
<tr>
<th>Project URL</th>
<td>http://github.com/intrd/php-docbloc</td>
</tr>
<tr>
<th>Author</th>
<td>intrd (Danilo Salles) - http://dann.com.br</td>
<tr>
<th>Copyright</th>
<td>(CC-BY-SA-4.0) 2016, intrd</td>
</tr>
<tr>
<th>License</th>
<td><a href='http://creativecommons.org/licenses/by-sa/4.0'>Creative Commons Attribution-ShareAlike 4.0</a></td>
</tr>
<tr>
<th>Dependencies</th>
<td> &#8226; php >=5.3.0</td>
</tr>
</table>
</span>
<!-- @docbloc 1.0 -->

![php-auto-docbloc](/imgs/php-auto-docbloc.gif?raw=true "php-auto-docbloc")

Installation
============

System requiriments & dependencies

```
$ sudo apt-get update & apt-get upgrade
$ sudo apt-get install git php-curl php-cli
```
## Composer.json sample

DocBloc fetch your project details from `composer.json`. If your project still does not have one, create it following sample below and put at your project root path.

```
{
    "name": "intrd/php-docbloc",
    "description": "PHP DocBloc - Generate and keep updated DocBlock of your project files fetching details from composer.json and Git. Supported formats: *.php, *.ini, *.sh, *.bat, *.md (No Composer or PEAR need to be installed to use this tool).",
    "keywords": ["php","docblock","documentation","tool"],
    "homepage": "http://github.com/intrd/php-docbloc",
    "authors": [
            {
                "name": "intrd (Danilo Salles)",
                "email": "x@dann.com.br",
                "homepage": "http://dann.com.br",
                "role": "Developer"
            }
        ],
    "license": "CC-BY-SA-4.0",
    "require": {
        "php": ">=5.3.0"
    },
    "autoload": {
        "psr-4": {
            "telegram\\":"src/"
        }
    },
    "extra": {
        "author_twitter":"intrd",
        "copyright_author":"intrd",
        "license_title":"Creative Commons Attribution-ShareAlike 4.0",
        "license_url":"http://creativecommons.org/licenses/by-sa/4.0"
    }
}
```

## Docbloc triggers

Each file format have your own trigger, put this at file headers that you want to DocBloc start managment.

PHP - Script
```
/** @docbloc **/
```
INI - Configuration file
```
;; @docbloc ;;
```
SH - Shell script
```
## @docbloc ##
```
BAT - Batch script
```
REM @docbloc REM
```
MD - Markdown files like README.md
```
<!-- @docbloc -->
```
## Usage

Considering that you already have:
- PHP working 
- Created/edited your `composer.json`
- Filled all files w/ the correct DocBloc trigger 
- (optional) You are controlling the versioning of your project by Git branch name. It's optional, but docbloc fetch version from .git/HEAD. If your project are not gitted, docbloc will not display the Version field at files. 

Now go to your project root and run:
```
$ wget -O docbloc.php https://raw.githubusercontent.com/intrd/php-docbloc/1.0/src/docbloc.php && php docbloc.php && rm docbloc.php
```
Done,
Every time you change any project detail at `composer.json` or create a new `git branch` version, simply run DocBloc again to keep all your files docbloc header updated. Yes, it works recursively on upper directory levels too.


