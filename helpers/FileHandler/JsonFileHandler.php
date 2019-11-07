<?php

class JsonFileHandler implements IFileHandler{

    function CreateDirectory($path){

        if(!file_exists($path)){
            mkdir($path,0777,true);
        }

    }

    function SaveFile($directory,$filename,$value){

        $this->CreateDirectory($directory);
        $path = $directory . "/". $filename . ".json";

        $serializeData = json_encode($value);

        $file = fopen($path,"w+");
        fwrite($file,$serializeData);
        fclose($file);
    }

    function ReadFile($directory,$filename){

        $this->CreateDirectory($directory);
        $path = $directory . "/". $filename . ".json";

        if(file_exists($path)){
            $file = fopen($path,"r");

            $contents = fread($file,filesize($path));
            fclose($file);
            return json_decode($contents);
          
        }else{
            return false;
        }      

    }

    function ReadConfiguration($directory,$filename){
        
        $path = $directory . "/". $filename . ".json";

        if(file_exists($path)){
            $file = fopen($path,"r");

            $contents = fread($file,filesize($path));
            fclose($file);
            return json_decode($contents);
          
        }else{
            return false;
        }      

    }
}

?>