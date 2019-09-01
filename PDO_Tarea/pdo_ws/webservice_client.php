<?php

	require_once('lib/nusoap.php');
	$error  = '';
	$result = array();
	$response = '';
	$wsdl = "http://localhost/PDO_Tarea/pdo_ws/webservice-server.php?wsdl";
	if(isset($_POST['sub'])){
		$ID = trim($_POST['ID']);
		if(!$ID){
			$error = 'ID EN BLANCO.';
		}

		if(!$error){
			//create client object
			$client = new nusoap_client($wsdl, true);
			$err = $client->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
	
			    exit();
			}
			 try {
				$result = $client->call('fetchUsr', array($ID));
				$result = json_decode($result);
			  }catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}
	}	

		


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CLIENTE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2></h2>
  
  <br />       
  <div class='row'>
  	<form class="form-inline" method = 'post' name='form1'>
  		<?php if($error) { ?> 
	    	<div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp;<?php echo $error; ?> 
	        </div>
		<?php } ?>
	    <div class="form-group">
	      <label for="email">ID:</label>
	      <input type="text" class="form-control" name="ID" id="ID" placeholder="Buscar por ID" required>
	    </div>
	    <button type="submit" name='sub' class="btn btn-default">Solicitar</button>
    </form>
   </div>
   <br />

   <h2>Informacion de Usuarios</h2>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>CORREO</th>
        <th>CLAVE</th>
        <th>NOMBRE</th>       
      </tr>
    </thead>
    <tbody>
    <?php if($result){ ?>
      	
		      <tr>
		        <td><?php echo $result->ID; ?></td>
		        <td><?php echo $result->CORREOE; ?></td>
		        <td><?php echo $result->CLAVE; ?></td>
		        <td><?php echo $result->NOMBRECOMPLETO; ?></td>	

		      </tr>
      <?php 
  		}else{ ?>
  			<tr>
		        <td colspan='5'></td>
		      </tr>
  		<?php } ?>
    </tbody>
  </table>
	<div class='row'>


