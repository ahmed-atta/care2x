<?php

class FileSearcher{
    var $filter;
    var $filesFound;
    var $recursive;
	var $path;
	var $types;
	function FileSearcher($types=""){
        if($types==""){
            $this->filter="";
        }else{
            $this->filter=explode(" ",$types);
        }
    }
    function Searched($filename){
        if($this->filter==""){
            return true;
        }else{
            for($i=0;$i<count($this->filter);$i++){
    			$pos=strpos($filename, $this->filter[$i], strlen($filename)-3);
    			if ($pos === false){//file is not a searched one
    				//
    			}else{
    				$this->types[count($this->types)+1]=$this->filter[$i];
    				return true;
                }
            }
            return false;
        }
    }

    function ListFiles($path) {
        if ($handle = opendir($path)) {
            /* This is the correct way to loop over the directory. */
            $i=0;
            while (false !== ($file = readdir($handle))) {
                 if($file == "."){
                 //skip
                 }
                 elseif($file == ".."){
                 //skip
                 }
                 elseif($file == ".."){

                 }else{
                      if (is_dir($path."/".$file)){
                          if($recursive=true){
                              $this->ListFiles($path."/".$file);
                          }
                      }else{
                         $file=strtolower($file);
                         if ($this->Searched($file)==false){//this file type is not searched so ignore it

                         }else{
						  $this->filesFound[count($this->filesFound)+1]=$path."/".$file;

						 }
                      }
                 }
            }
        }
            closedir($handle);
    }

	function GetFiles($path,$recursive){
		$this->recursive=$recursive;
		$this->path=$path;
		$this->ListFiles($this->path);
		return $this->filesFound;
	}
	function GetFileType($index){
		return $this->types[$index];
	}
    function DeleteDirs($dirname)
    { // recursive function to delete all subdirectories and contents:
      if(is_dir($dirname))$dir_handle=opendir($dirname);
      while($file=readdir($dir_handle))
      {
        if($file!="." && $file!="..")
        {
          if(!is_dir($dirname."/".$file))unlink ($dirname."/".$file);
          else DeleteDirs($dirname."/".$file);
        }
      }
      closedir($dir_handle);
      rmdir($dirname);
      return true;
    }
}

?>