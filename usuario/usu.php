<!DOCTYPE html>
<html>
<head>
    <meta charset= "UTF-8">
	<title>Bienvenido</title>
    <link rel="stylesheet" href="../css/style.css">   
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/footers/">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
 </head>
<body>
    <center>
        
    <?php
        require_once "../utils.php";
        require_once "../userInfoBar.php";
        require_once "../conection.php";
        require_once "../conection2.php";
    

        SafeStart();
        $anticsrf =random_int(501, 9999999);
        $_SESSION['anticsrf'] = $anticsrf;

        if(isset($_SESSION['loged_user'])){
            loguedUser($_SESSION['loged_user']);
        }else{
            header('location: index.php');
        }


        if(isset($_SESSION['tiempo']) ) {

            //Tiempo en segundos para dar vida a la sesión.
            $inactivo = 300;//5min en este caso.
        
            //Calculamos tiempo de vida inactivo.
            $vida_session = time() - $_SESSION['tiempo'];
        
                //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
                if($vida_session > $inactivo)
                {
                    //Removemos sesión.
                    session_unset();
                    //Destruimos sesión.
                    session_destroy();              
                    //Redirigimos pagina.
                    header("Location:../index.php");
        
                    exit();
                }
          } else {
            //Activamos sesion tiempo.
            $_SESSION['tiempo'] = time();
        }
    
    require './narbarusu.php';

    ?>
<br>
    <img src="../img/Bienvenida.jpg" alt="" width="1450px" height="320px">

    <footer class="text-center text-white fixed-bottom" style="background-color: #2A2F40;">
  <div class="container p-3"></div>
  <div class="container p-3">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h6 class="text-uppercase">CONTÁCTENOS:</h5>

        <h6>
          DIRECCIÓN: Cra. 2 Este #70-20, Bogotá.          
    </h5>
        <br>
        <h6>
          TELÉFONO: (60)357-89-78
    </h6>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Información:</h5>

        <ul class="list-unstyled mb-0">
          <li>
            <a href="#!" class="text-white" style="text-decoration:none">¿Quienes somos?</a>
          </li>
          <li>
            <a href="#!" class="text-white" style="text-decoration:none">Misión</a>
          </li>
          <li>
            <a href="#!" class="text-white" style="text-decoration:none">Visión</a>
          </li>
        </ul>
      </div>


  </div>
  <div class="text-center p-3" style="background-color: #2A2F40;">
    © 2022 Copyright: School Omega
  </div>

</footer> 
