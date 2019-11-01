<?php

class Layout{    

   private $isPage; 
   private $directory; 

function __construct($page)
   {
       $this->isPage = $page;
       $this->directory = ($this->isPage) ? "../" : "";
   }

function printFooter(){

 $footer = <<< EOF

 <footer class="pt-4 my-md-5 pt-md-5 border-top">
 <div class="row">
  
 </div>
</footer>

<script type="text/javascript" src="{$this->directory}assets\js\plugin\jquery\jquery.js"></script>
<script type="text/javascript" src="{$this->directory}assets\js\bootstrap.bundle.js"></script>
<script type="text/javascript" src="{$this->directory}assets\js\bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="{$this->directory}assets\css\bootstrap-grid.css">
<link rel="stylesheet" type="text/css" href="{$this->directory}assets\css\bootstrap-reboot.css">
<link rel="stylesheet" type="text/css" href="{$this->directory}assets\css\bootstrap.css">
<link rel="stylesheet" type="text/css" href="{$this->directory}assets\css\sticky-footer.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</body>

</html>
EOF;

    echo $footer;
}


function printHeader(){
    $header = <<< EOF
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Market</title>
    </head>
    
    <body class="d-flex flex-column h-100">
    
    <header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a class="navbar-brand mr-auto mr-lg-0" href="{$this->directory}index.php">Market Itla</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      
    </nav>
    <a class="btn btn-outline-primary" href="{$this->directory}user/login.php"><i class="fa fa-user-circle" aria-hidden="true"></i> Iniciar sección </a>
  </div>
    </header>
EOF;

    echo $header;
}


}
