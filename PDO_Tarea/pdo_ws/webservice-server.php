<?php

 require_once('Conexion.php');
 require_once('lib/nusoap.php'); 
 $server = new nusoap_server();

 
function insertUsuario($CORREOE, $CLAVE, $NOMBRECOMPLETO, $ID){
  global $Conexion;
  $sql_insert = "insert into tb_usuarios (ID, CORREOE, CLAVE, NOMBRECOMPLETO) values ( :ID, :CORREOE, :CLAVE, :NOMBRECOMPLETO,)";
  $stmt = $Conexion->prepare($sql_insert);
  // insert a row
  $result = $stmt->execute(array(':ID'=>$ID, ':CORREOE'=>$CORREOE, ':CLAVE'=>$CLAVE, ':NOMBRECOMPLETO'=>$NOMBRECOMPLETO));
  if($result) {
    return json_encode(array('status'=> 200, 'msg'=> 'success'));
  }
  else {
    return json_encode(array('status'=> 400, 'msg'=> 'fail'));
  }
  
  $Conexion = null;
  }
/* Fetch  data */
function fetchUsr($ID){
	global $Conexion;
	$sql = "SELECT ID, CORREOE, CLAVE, NOMBRECOMPLETO FROM tb_usuarios 
	        where ID = :ID";
  // prepare sql and bind parameters
    $stmt = $Conexion->prepare($sql);
    $stmt->bindParam(':ID', $ID);
    // insert a row
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return json_encode($data);
    $Conexion = null;
}
$server->configureWSDL('PDO SERVER', 'urn:usr');
$server->register('fetchUsr',
			array('ID' => 'xsd:string'),  //parameter
			array('data' => 'xsd:string'),  //output
			'urn:usr',   //namespace
			'urn:usr#fetchUsr' //soapaction
      );  
      $server->register('insertUsuario',
			array('ID' => 'xsd:string', 'CORREOE' => 'xsd:string', 'CLAVE' => 'xsd:string', 'NOMBRECOMPLETO' => 'xsd:string'),  //parameter
			array('data' => 'xsd:string'),  //output
			'urn:usr',   //namespace
			'urn:usr#fetchUsr' //soapaction
			);  
$server->service(file_get_contents("php://input"));

?>