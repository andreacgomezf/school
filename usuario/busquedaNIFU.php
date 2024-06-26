<!DOCTYPE html>
<html>
<head>
    <meta charset= "UTF-8">
	<title>Index</title>
    <link rel="stylesheet" href="./css/style.css">   
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/footers/">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
 </head>
<body>
    <center>
        
    <?php
        require_once "../utils.php";
        require_once "../conection.php";
        require_once "../conection2.php";
        require_once "../userInfoBar.php";
    

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
            $inactivo = 500;//5min en este caso.
        
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
<img src="../img/Logo.jpg" width="200px" height="200px">
<br>
    <h1 class="nametitle">Buscar alumno por código de alumno</h1>
    <BR></BR>

    <form action="" method="get">
        <label for="">Ingrese el Codigo del alumno:</label>
        <input type="text" name="busqueda">
        <br>
        <br>
        <input type="submit" name="enviar" value="Buscar">
        <br>
        <br>
    </form>

    <h3>RESULTADO DE LA BÚSQUEDA:</h3>
    <br>

    <?php
        if(isset($_GET['enviar'])){

            $busqueda = $_GET['busqueda'];

            $consulta = $con->query("SELECT * FROM alumnos WHERE codigo_estudiante LIKE '%$busqueda%'");

            while($row = $consulta->fetch_array()){
                echo 
                     '<b>PRIMER NOMBRE: </b>'.$row['nombre1_est'].' | '.
                     '<b>PRIMER APELLIDO: </b>'.$row['apellido1_est'].' | '.
                     '<b>SEGUNDO APELLIDO: </b>'.$row['apellido2_est'].' | '.
                     '<b>EDAD: </b>'.$row['edad_est'].' años.'.'<br>'.
                     '<b>TIPO DE TELEFONO: </b>'.$row['tipo_telf'].' | '.
                     '<b>TELEFONO: </b>'.$row['telf_est'].' | '.
                     '<b>DIRECCION: </b>'.$row['direccion_est'].
                     '<br>'.
                     '<br>';
            }
        }
    ?>

 </body>
