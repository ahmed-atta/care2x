<?
//path relative to this file location
//you can use absolute path either
$path="docs";
require ("FileSearcher.php");

//create the class with doc and htm filter
$files= new FileSearcher("doc htm");

//search recursively on $path for doc and htm
$filelist=$files->GetFiles($path, true);

//$filelist is an unidimensional array containign the path to the files
/*
something like
$filelist[0]="docs/1.doc"
$filelist[1]="docs/2.doc"
$filelist[2]="docs/usage.doc"
$filelist[3]="docs/allok.doc"
*/
?>