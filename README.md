<!-- docbloc -->
<span id='docbloc'>
docBloc - Generate and keep updated docBlock of your project files fetching details from composer.json and Git data. Supported filetypes: *.php, *.ini, *.sh, *.bat, *.md (No Composer or PEAR needed to use this tool). 
<table>
<tr>
<th>Package</th>
<td>intrd/docbloc</td>
</tr>
<tr>
<th>Version</th>
<td>1.1</td>
</tr>
<tr>
<th>Tags</th>
<td>docblock, documentation, tool</td>
</tr>
<tr>
<th>Project URL</th>
<td>http://github.com/intrd/docbloc</td>
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


## Composer.json sample

docBloc fetch your project details from `composer.json`. If your project still does not have one, create it following sample below and put at your project root path.

```
{
    "name": "intrd/docbloc",
    "description": "PHP docBloc - Generate and keep updated docBlock of your project files fetching details from composer.json and Git. Supported filetypes: *.php, *.ini, *.sh, *.bat, *.md (No Composer or PEAR need to be installed to use this tool).",
    "keywords": ["php","docblock","documentation","tool"],
    "homepage": "http://github.com/intrd/docbloc",
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
            "php\\":"src/"
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

Each filetype have your own trigger, put this in the header of files that you want to docBloc manage.

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

## Git details
(optional) I recommend you to control the versioning of your project by Git branch name. It's optional, but docbloc fetch version from .git/HEAD. If your project are not gitted, docbloc will not display the Version field at files. 

## Usage

Considering that you already have:
- PHP working 
- Created/edited your `composer.json`
- Filled all files w/ the correct docBloc trigger 
- (optional) a working .git/HEAD

Now go to your project root and run:
```
$ wget -O docbloc.php https://raw.githubusercontent.com/intrd/docbloc/1.1/src/docbloc.php && php docbloc.php && rm docbloc.php
```
![running-docbloc](/imgs/run.png?raw=true "running-docbloc")

It will download docbloc.php script, run and remove it.

Done,
Every time you change any project detail at `composer.json` or create a new `git branch` version, simply run docBloc again to keep all your files docbloc header updated. Yes, it works recursively on upper directory levels too.


