<?php require_once("ruta_api.php")?>
<?php session_start();  if(!isset($_SESSION["usuario"])) header("Location:login.php")?>	
<html>
	<head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>
	</head>
	<body >
	<div id="container">
	<div class="modal fade" id="modal_validacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
			  
			  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">          
			    Existen elementos vacios favor de revisar!!!			
              </div>			
			  <div class="modal-footer">
                <button class="btn btn-success" v-on:click="aceptar_validacion()">Aceptar </button>
              </div>
              
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
	
	 <div class="modal fade" id="modal_operacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
			  
			  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">              
			Operacion Exitosa						
              </div>			  
			  <div class="modal-footer">
                <button class="btn btn-success" v-on:click="aceptar()">Aceptar </button>
              </div>
              
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->		
	<div class="row">
	<div class="offset-md-4 col-md-6">	
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#" onclick="redirect(1)">Inicio <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="redirect(2)">Listado</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="redirect(3)">Salir</a>
      </li>
      <li class="nav-item">
	  <!--<a class="nav-link disabled" href="#">Disabled</a>!-->
      </li>
    </ul>
  </div>
</nav>
	</div>
	</div>

	<div class="row">
	<div class="offset-md-4 col-md-6">
	<h3>Registro de Nuevo Usuario  </h3>
	<br>
	<div class="offset-md-1 col-md-11">
	<img src="imagenes/nuevo_usuario.png" class="img-responsive" style="width:25%">  </img>
	</div>
	<form class="form " >
	
	<div  class="row">
	<div class=" col-md-2">
	<label> Nombre</label>
	</div>
	<div class="col-md-4">
	<input type="text" class="form-control formulario_item" id="nombre_insert"/>
	</br>
	</div>
	<br>
	<br>
	</div>
	
	<div class="row form-group">
	<div class="col-md-2">
	<label> Apellido</label>
	</div>
	<div class="col-md-4">
	<input type="text" class="form-control formulario_item" id="apellido_insert"/>
	</div>
	</div>
	
	<div class="row form-group">
	<div class="col-md-2">
	<label> Edad</label>
	</div>
	<div class="col-md-4">
	<input type="text" class="form-control formulario_item" id="edad_insert"/>
	</div>
	</div>
	
	
	<div class="row form-group">
	<div class="col-md-2">
	<label> Estado Civil</label>
	</div>
	<div class="col-md-4">
	<select name="estado_civil" class="form-control formulario_item" style="width:99%" id="estado_civil_insert">
	<option value=0> --------------</option>
	<option value=1> Soltero </option>
	<option value=2> Casado </option>
	</select>
	</div>
	</div>
	
	<div class="row form-group">
	<div class="col-md-2">
	<label> Telefono</label>
	</div>
	<div class="col-md-4">
	<input type="text" class="form-control formulario_item" id="telefono_insert"/>
	</div>
	</div>
	
	<div class="row">
	<div class="col-md-2">
	<label> Pais</label>
	</div>
	<div class="col-md-4">
	<select name="lista_Paises" class="form-control formulario_item" style="width:99%" id="pais_insert">
	<option value=0> --------------</option>
	<option value=1> Mexico </option>
	<option value=2> Espana </option>
	<option value=3> Colombia </option>
	<option value=4> Usa </option>
	<option value=5> Otros </option>
	</select>
	<br>
	</div>
	</div>	
	<div class="row">
	<div class="col-md-2">
	<label> Ciudad</label>
	</div>
	<div class="col-md-4">
	<input type="text" class="form-control formulario_item" id="ciudad_insert"/>
	<br>	
	</div>
	</div>	
	<div class="row">
	<div class="offset-md-2 col-md-10">
	<br>
	<button  type="button" class="btn btn-lg btn-success" v-on:click="nuevo_usuario()"> Nuevo </button>
	</div>	
	</div>	
	</form>	
	</div>		
	</div>
	<footer>
	<div class="row bg-light fixed-bottom">	
	<div class="offset-md-4 col-md-6">
	<h4> COPYRIGHT LUIS CARDONA</h4>
	</div>
	</div>	
	</footer>	
</div>	
	</body>		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>!-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>     
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
	  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>!-->
	</html>	
	<script>	
	function redirect(pagina)
	{
		if(pagina==1)
		{
			window.location.href="index.php";
		}
		
		else if(pagina==2)
		{
			window.location.href="listado_usuarios.php";
		}
		
		else if(pagina==3)
		{
	
	       $.ajax({
                url:   '<?php echo ruta_api?>terminar_sesion/', //archivo que recibe la peticion
                type:  'get', //método de envio
                beforeSend: function () {
				
                },
                success:  function (response) { 
                       
					 window.location.href="login.php";
                }
        });		
		}
		
	}
var objeto= new Vue(
{		
el:"#container",
data:{
	nombre_insert:"",
   apellido_insert:"",
   edad_insert:"",
   estado_civil_insert:"",
   telefono_insert:"",
   pais_insert:"",
   ciudad_insert:"",
	
	resultados:{},
	opcion:"",
	resultado_peticion:""
	},
filters:{

mayuscula:function(value)
{

if(value)
{

return value.toUpperCase();

}


}

},

watch:{


nombre:function(value)
{
//alert("Cambio!!!");
//this.dameNombres();

}


}


,
created:function(){
	//this.listar_usuarios();
	//alert("OK");
},

methods:
{

aceptar_validacion:function()
{
	$("#modal_validacion").modal("hide");
},
aceptar:function()
{
	$("#modal_operacion").modal("hide");
	
}
,
valida_elementos:function()
{
	
	var nombre_valida=$("#nombre_insert").val();
	var apellido_valida=$("#apellido_insert").val();
	var edad_valida=$("#edad_insert").val();
	var estado_civil_valida=$("#estado_civil_insert").val();//combo;
	var telefono_valida=$("#telefono_insert").val();
	var pais_valida=$("#pais_insert").val(); //combo;
	var ciudad_valida=$("#ciudad_insert").val();
	
	
	if(nombre_valida=="" || apellido_valida=="" ||  edad_valida=="" || telefono_valida=="" || ciudad_valida=="")
	{
		$("#modal_validacion").modal();
			return false;
	}
	else if(estado_civil_valida<=0 || pais_valida<=0)
	{
		$("#modal_validacion").modal();
			return false;
	}
	
   /*
   $(".formulario_item").each(function(index,me)
	{
		
		if($(this).is("input") && $(me).val()=="")
		{
			
			$("#modal_validacion").modal();
			return false;
		}
		else if($(this).is("select") && ($(me).val()<=0))
		{
			
			$("#modal_validacion").modal();
			return false;
		}
		
		});
		
		*/	
}
,
nuevo_usuario:function()
{
   if(this.valida_elementos()==false)
   {
	   $("#modal_validacion").modal();
			return false;
	   
	 }
   
   this.nombre_insert=$("#nombre_insert").val();
   this.apellido_insert=$("#apellido_insert").val();
   this.edad_insert=$("#edad_insert").val();
   this.estado_civil_insert=$("#estado_civil_insert").val();
   
   this.telefono_insert=$("#telefono_insert").val();
   this.pais_insert=$("#pais_insert").val();
   this.ciudad_insert=$("#ciudad_insert").val();
	
	
	let objeto_json= {"nombre":this.nombre_insert,"apellido":this.apellido_insert,"edad":this.edad_insert,"estado_civil":this.estado_civil_insert,"id_pais_fk":this.pais_insert,"ciudad":this.ciudad_insert,"telefono":this.telefono_insert,"id_telefono_fk":this.telefono_insert};
    let json=JSON.stringify(objeto_json);
	//alert(json);
	this.$http.post('<?php echo ruta_api?>nuevo/',json).then(function (response) {
	this.resultado_peticion=response.body;
	
	if(this.resultado_peticion==1)
	{
		$("#modal_operacion").modal();
		//this.listar_usuarios();
	}
	else
	{
	    $("#modal_error").modal();
		
	}
	
      })		
}

}

})

	</script>
