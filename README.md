<!-- docbloc -->
<span id='docbloc'>
PHP DocBloc - Batch generate and keep updated DockBlock of your project files fetching details from composer.json and .git/HEAD. Supported formats: *.php, *.ini, *.sh, *.bat, *.md (No Composer or PEAR need to be installed to use this tool).
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
```
## Usage

Considering that you already have:
- PHP and Curl working 
- Created/edited your `composer.json`
- Filled all files w/ the correct DocBloc trigger 

Now run the command below at your project root:
```
$ wget -O docbloc.php https://raw.githubusercontent.com/intrd/php-docbloc/1.0/src/docbloc.php && php docbloc.php && rm docbloc.php
```
Done,
Every time you change any project detail at `composer.json` or create a new `git branch` version, simply run DocBloc again to keep all things updated.


