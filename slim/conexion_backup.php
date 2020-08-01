<?php
	
	class conexion
	{
	  private $host;
	  private$user; 
	  private $password; 
	  private $database;
	  private $db_conex;
	   function __construct()
	   {
	   
	   try
	   {
		   $this->host="localhost";
		   $this->user="root";
		   $this->password="";
		   $this->database="Prueba_dicka";
		   
		   $this->db_conex = new mysqli($this->host,$this->user,$this->password, $this->database);
		   
		    if ($this->db_conex -> connect_errno) {
             echo "Error al intentar establecer conexion" . $this->db_conex -> connect_error;
              exit();
}
		   
	   }
	   catch(Exception $ex)
	   {
		   echo $ex->getMessage();
		   
		}
		  }
		
		
		
		public function listarEmpleados()
		{
			
			$query=$this->db_conex->query("SELECT * FROM usuario");
             $usuarios=array();
          while($registro=$query->fetch_assoc())

        {
             $usuarios[]=$registro;

             }
			 $this->cerraConexion();
			 	//echo json_encode($usuarios);
				return $usuarios;
				
				
		}
		
		
	public function actualizarEmpleado()
		{
			
		
        $stmt = $this->db_conex->prepare("UPDATE usuario SET nombre = ? WHERE id_usuario=?");
        $stmt->bind_param("si", $nombre,$id);
		$nombre="LUISXxxx";
		$id="1";
		
        $stmt->execute();
        if($stmt->affected_rows === 0)
		{
			  echo("Error description: " . $this->db_conex->error);
		}
		else
	    {
				echo "OK";
				
		}

			$this->cerraConexion();
		}
		
		
		public function nuevoEmpleado()
		{
			
		
        $stmt = $this->db_conex->prepare("INSERT usuario(nombre,apellido,edad,estados_civil,telefono,id_pais_fk,id_telefono_fk,fecha_registro) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssiisiis", $nombre,$apellido,$edad,$estados_civil,$telefono,$id_pais_fk,$id_telefono_fk,$fecha_registro);
		$nombre="LUISPUTO";
		$apellido="1";
		$edad="1";
		$estados_civil="1";
		$telefono="1";
		$id_pais_fk="1";
		$id_telefono_fk="1";
		$fecha_registro=date("Y-m-d");
		
		
        $stmt->execute();
        if($stmt->affected_rows === 0)
		{
			
			  echo("Error description: " . $this->db_conex->error);
			 
		}
		else
	    {
				echo "OK";
				
		}

			$this->cerraConexion();
		}
		
		public function eliminarEmpleado()
		{
		
		   $id=1;
			$stmt = $this->db_conex->prepare("DELETE FROM usuario WHERE ID_USUARIO=?");
			 $stmt->bind_param("i", $id);
			 
			  $stmt->execute();
        if($stmt->affected_rows === 0)
		{
			
			  echo("Error description: " . $this->db_conex->error);
			 
		}
		else
	    {
				echo "OK";
				
		}
			 
			
		}
		
		
		private function cerraConexion()
		{
		  $this->db_conex -> close();	
		}
		
		
	}
	
	?>