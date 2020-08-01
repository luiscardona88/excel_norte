
<?php
session_start();
require 'Slim/Slim.php';
require_once("usuario_controlador.php");
	
$usuario_controlador=new usuario_controlador();

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->post("/login_validar/",function() use($app,$usuario_controlador)
{
	
	$usuario = $app->request->post("usuario");
	$password=$app->request->post("password");
	
	$respuesta=$usuario_controlador->validarlogin($usuario,$password);
	if($respuesta>=1)
	{ $_SESSION["usuario"]=$respuesta;
       echo json_encode($respuesta);
	  
	}
	else
	{
		echo 0;
		}
	
	
});

$app->get("/terminar_sesion/",function() use($app,$usuario_controlador)
{
	
	unset($_SESSION["usuario"]);
	
});
$app->get("/listar/",function() use($app,$usuario_controlador)
{
	
	echo json_encode($usuario_controlador->listarUsuarios());
	
});

$app->put("/actualizar/",function() use($app,$usuario_controlador)
{
	  //print_r($app->request->getBody());
	  
	  $usuario=json_decode($app->request->getBody());
	  //print_r($usuario);
	  //echo "el usuario es".$usuario->nombre;
	  $id_usuario=$usuario->id_usuario;
	  $nombre=$usuario->nombre;
	  $apellido=$usuario->apellido;
	  $edad=$usuario->edad;
	  $estado_civil=$usuario->estado_civil;
	  $telefono=$usuario->telefono;
	  $pais=$usuario->id_pais_fk;
	  $ciudad=$usuario->ciudad;
	  $fecha_registro=date("Y-m-d");
	  
	  $usuario_controlador->actualizarUsuarios($id_usuario,$nombre, $apellido,$edad,$estado_civil,$telefono,$pais, $fecha_registro,$ciudad);
	
	//echo json_encode($db->getListado());
	
});

$app->post("/nuevo/",function() use($app,$usuario_controlador)
{
	  $usuario=json_decode($app->request->getBody());
	  
	  $nombre=$usuario->nombre;
	  $apellido=$usuario->apellido;
	  $edad=$usuario->edad;
	  $estado_civil=$usuario->estado_civil;
	  $telefono=$usuario->telefono;
	  $pais=$usuario->id_pais_fk;
	  $ciudad=$usuario->ciudad;
	  $fecha_registro=date("Y-m-d");
	  
	  $usuario_controlador->nuevoUsuarios($nombre, $apellido,$edad,$estado_civil,$telefono,$pais,$ciudad, $fecha_registro);
	   
	
});

$app->delete("/eliminar/:id",function($id) use($app,$usuario_controlador)
{
	  $usuario_controlador->borrarUsuarios($id);
	//echo json_encode($db->getListado());
	
});

$app->run();
?>