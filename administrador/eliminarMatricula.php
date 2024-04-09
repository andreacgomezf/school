<!DOCTYPE html>
<html>
<head>
    <meta charset= "UTF-8">
	<title>Matricula</title>
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
        require_once "../conection.php";
        require_once "../conection2.php";
        require_once "../conection3.php";
        require_once "../userInfoBar.php";

        SafeStart();
        LimpiaEntrada();
        $anticsrf =random_int(501, 9999999);
        $_SESSION['anticsrf'] = $anticsrf;
               
        if(isset($_SESSION['loged_user'])){
            loguedUser($_SESSION['loged_user']);
        }else{
            header("Location:../index.php");
        }
        
        if(isset($_SESSION['tiempo']) ) {

            //Tiempo en segundos para dar vida a la sesión.
            $inactivo = 1000;//5min en este caso.
        
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

        LimpiaEntrada();
        if (isset($_POST['btnEliminar']) ) {        
    
            #limpiamos cada uno de los datos de entrada del POST
            LimpiaEntrada();
    
            $isValidData = ValidateForm($_POST);        
            #Validamos que ningun campo este vacio
            if($isValidData){
                #Validamos si ya existe el usuario 
                $Matricula = (isset($_POST['id_alumno_x_curso ']))?$_POST['id_alumno_x_curso ']:"";
             
                $dbConnection = DBConnection();
  
                    if ($dbConnection !=NULL)
                    {
                        DeleteMatricula($dbConnection, $Matricula);
                        LimpiaEntrada();
                       echo '<h3>Docente Eliminado con exito.</h3>';
                        }
                    else {
                        echo '<h3> Algo salio mal en la BD, vuelva a intentar. </h3>'; 
                    }
                }    
            }else{
        }       
    require './navbaradmin.php';
     
    ?>
  

    <form action="" method="POST" enctype="multipart/form-data" class="formRegistro" required>
<br>
        <h2> Eliminar Matricula:</h2>
        <br>
        <label for="">Seleccione la matricula que desea eliminar:</label>
        <select name="id_alumno_x_curso " id="">
            <?php

            $con = conexion();

            $sql = 'SELECT id_alumno_x_curso , curso , docente   FROM alumno_x_curso';
            $query = mysqli_query($con,$sql);

            while($row=mysqli_fetch_array($query)){
                $idMat = $row['id_alumno_x_curso'];
                $Curso = $row['curso'];
                $Docente = $row['docente'];
                ?>
                    <option value="<?php echo $idMat ?>"><?php echo $idMat ?></option>
                <?php       
                }
            ?>      
            <br>
        <br>      
        </select>
    
        </select>

        <div class = "form-group">
		<input type="hidden"  value="<?php echo $anticsrf; ?>" class="form-control" name="anticsrf">
		</div>
        <br>
        <button type="submit" class="btn btn-danger" name="btnEliminar" value="Matricular">Eliminar</button>
        <br>

    </form>
    </center>

 </body>
