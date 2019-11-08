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

    $login = '<a class="btn btn-outline-primary" href='.$this->directory.'user/login.php><i class="fa fa-user-circle" aria-hidden="true"></i> Iniciar sección </a>';

    if(isset($_SESSION['user']) && $_SESSION['user'] != null ){
        $user = $_SESSION['user'];
        $login = '<a class="btn btn-outline-primary" href="administrator/dashboard.php"><i class="fa fa-user-circle" aria-hidden="true"></i> '.  $user->FirstName . '</a>';
    }

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
    {$login}
  </div>
    </header>
EOF;

    echo $header;
}

function printFooterAdministrator(){
    $footer = <<< EOF

  
   
   <script type="text/javascript" src="{$this->directory}assets\js\plugin\jquery\jquery.js"></script>
   <script type="text/javascript" src="{$this->directory}assets\js\bootstrap.bundle.js"></script>
   <script type="text/javascript" src="{$this->directory}assets\js\bootstrap.js"></script>
   <link rel="stylesheet" type="text/css" href="{$this->directory}assets\css\bootstrap-grid.css">
   <link rel="stylesheet" type="text/css" href="{$this->directory}assets\css\bootstrap-reboot.css">
   <link rel="stylesheet" type="text/css" href="{$this->directory}assets\css\bootstrap.css">
   <link rel="stylesheet" type="text/css" href="{$this->directory}assets\css\sticky-footer.css">
   <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
   </body>
   
   </html>
EOF;
   
       echo $footer;  
}


function printHeaderAdministrator($page){

    $directory = $page == true ? "../administrator/" : "";

    $header = <<<EOF
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Market</title>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{$directory}dashboard.php">Market Itla</a>
       
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="../user/logout.php">Cerrar Session</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                              Tienda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../user/list.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                                    <line x1="18" y1="20" x2="18" y2="10"></line>
                                    <line x1="12" y1="20" x2="12" y2="4"></line>
                                    <line x1="6" y1="20" x2="6" y2="14"></line>
                                </svg>
                                Marca
                            </a>
                        </li>                  
                    </ul>
                </div>
            </nav>
EOF;

    echo $header;
}


}
