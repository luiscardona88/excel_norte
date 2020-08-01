
<?php
	require_once("credenciales_db.php");
	class conexion
	{
	  private $host;
	  private $user; 
	  private $password; 
	  private $database;
	  private $db_conex;
	  private $query;
	   function __construct()
	   {
	   
	   try
	   {
		   $this->host=HOST;
		   $this->user=USER;
		   $this->password=PASSWORD;
		   $this->database=DATABASE;
		   
		   $this->db_conex = new mysqli($this->host,$this->user,$this->password, $this->database);
		     mysqli_set_charset($this->db_conex, "utf8");
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
		
		
		public function login($nombre,$pass)
		{
			$this->query="SELECT id FROM login WHERE nombre=? and pass=?";
			$stmt = $this->db_conex->prepare($this->query);
			$stmt->bind_param("ss", $nombre,$pass);
		    //$stmt->bind_param( "ss", $pass); 
            $stmt->execute();
			
            $stmt->bind_result($id);
			$stmt -> fetch();
			return $id;
			
		}
		public function select()
		{
			$this->query="SELECT u.*,p.nombre_pais,u.telefono as numero 
                         FROM usuario u LEFT JOIN Pais p on u.id_pais_fk=p.id_pais 
                         ";
			
			$query=$this->db_conex->query($this->query);
             $listado=array();
          while($registro=$query->fetch_assoc())

        {
             $listado[]=$registro;

             }

			 $this->cerraConexion();
			 //print_r($listado);
			 	//echo json_encode($usuarios);
				return $listado;
				
				
		}
		
		
	public function update($id_usuario_param,$nombre_param, $apellido_param,$edad_param,$estado_civil_param,$telefono_param,$pais_param, $fecha_registro_param,$ciudad_param)
		{
			//echo "el id es" . $id_usuario_param;
			//echo "el nombre es" . $nombre_param;
		$this->query="UPDATE usuario SET nombre = ?,apellido=?,edad=?,estados_civil=?,telefono=?,id_pais_fk=?,fecha_registro=?,ciudad=? WHERE id_usuario=?";
		//$this->query="UPDATE usuario SET nombre = ? WHERE id_usuario=?";
        $stmt = $this->db_conex->prepare($this->query);
        //$stmt->bind_param("si", $nombre,$id_usuario);
		$stmt->bind_param("ssiisissi", $nombre,$apellido,$edad,$estado_civil,$telefono,$pais,$fecha_registro,$ciudad,$id_usuario);
		
		$nombre=$nombre_param;		
		$apellido=$apellido_param;
		$edad=$edad_param;
		$estado_civil=$estado_civil_param;
		$telefono=$telefono_param;
		$pais=$pais_param;
		$fecha_registro=date("Y-m-d");
		$ciudad=$ciudad_param;
		$id_usuario=$id_usuario_param;
		
        $stmt->execute();
        if($stmt->affected_rows === 0)
		{
			  echo("Error description: " . $this->db_conex->error);
		}
		else
	    {
				echo 1;
				
		}
       
			$this->cerraConexion();
			
			
		}
		
		
		public function insert($nombre_param,$apellido_param,$edad_param,$estados_civil_param,$telefono_param,$id_pais_fk_param,$ciudad_param,$fecha_registro_param)
		{
			
		$this->query="INSERT usuario(nombre,apellido,edad,estados_civil,telefono,id_pais_fk,id_telefono_fk,fecha_registro,ciudad) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db_conex->prepare($this->query);
		
        $stmt->bind_param("ssiisiiss", $nombre,$apellido,$edad,$estados_civil,$telefono,$id_pais_fk,$id_telefono_fk,$fecha_registro,$ciudad);
		$nombre=$nombre_param;
		$apellido=$apellido_param;
		$edad=$edad_param;
		$estados_civil=$estados_civil_param;
		$telefono=$telefono_param;
		$id_pais_fk=$id_pais_fk_param;
		$id_telefono_fk=$telefono_param;
		$fecha_registro=date("Y-m-d");
		$ciudad=$ciudad_param;
		
        $stmt->execute();
        if($stmt->affected_rows === 0)
		{
			
			  echo("Error description: " . $this->db_conex->error);
			 
		}
		else
	    {
				echo 1;
				
		}

			$this->cerraConexion();
		}
		
		public function borrar($id)
		{
		
		$this->query="DELETE FROM usuario WHERE ID_USUARIO=?";
		
		   
			$stmt = $this->db_conex->prepare($this->query);
			 $stmt->bind_param("i", $id);
			 
			  $stmt->execute();
        if($stmt->affected_rows === 0)
		{
			
			  echo("Error description: " . $this->db_conex->error);
			 
		}
		else
	    {
				echo 1;
				
		}
			 $this->cerraConexion();
			
		}
		
		
		private function cerraConexion()
		{
		  $this->db_conex -> close();	
		}
		
		
	}
	
	?>