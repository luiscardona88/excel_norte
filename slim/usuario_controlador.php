<?php
	require_once("conexion.php");
	class usuario_controlador
	{
	 private $conex;
	   function __construct()
	   {
	   $this->conex= new Conexion();
	 
		   
	   }
	   
	   public function validarlogin($usuario,$pass)
	   {
		     return $this->conex->login($usuario,$pass);
		  }
	   public function listarUsuarios()
	   {
	   //print_r($this->conex->select());
		   return $this->conex->select();
		   
		}
	   
	   public function actualizarUsuarios($id_usuario,$nombre, $apellido,$edad,$estado_civil,$telefono,$pais, $fecha_registro,$ciudad)
	   {
		   
		    $this->conex->update($id_usuario,$nombre, $apellido,$edad,$estado_civil,$telefono,$pais, $fecha_registro,$ciudad);
		}
		
		 public function nuevoUsuarios($nombre,$apellido,$edad,$estados_civil,$telefono,$id_pais_fk,$ciudad,$fecha_registro)
	   {
		   $this->conex->insert($nombre,$apellido,$edad,$estados_civil,$telefono,$id_pais_fk,$ciudad,$fecha_registro);
		   
		}
		
		
		 public function borrarUsuarios($id)
	   {
		   $this->conex->borrar($id);
		   
		}
		
	}
	
	
	
	?>