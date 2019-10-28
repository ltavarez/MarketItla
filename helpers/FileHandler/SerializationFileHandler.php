<?php

class SerializationFileHandler implements IFileHandler{

    function CreateDirectory($path){

        if(!file_exists($path)){
            mkdir($path,0777,true);
        }

    }

    function SaveFile($directory,$filename,$value){

        $this->CreateDirectory($directory);
        $path = $directory . "/". $filename . ".txt";

        $serializeData = serialize($value);

        $file = fopen($path,"w+");
        fwrite($file,$serializeData);
        fclose($file);
    }

    function ReadFile($directory,$filename){

        $this->CreateDirectory($directory);
        $path = $directory . "/". $filename . ".txt";

        if(file_exists($path)){
            $file = fopen($path,"r");

            $contents = fread($file,filesize($path));
            fclose($file);
            return unserialize($contents);
          
        }else{
            return false;
        }      

    }

}
