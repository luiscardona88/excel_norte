<?php require_once("ruta_api.php")?>
<?php session_start();  if(!isset($_SESSION["usuario"])) header("Location:login.php")?>
<html>
	<head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	    
   <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>	     
	</head>
	<body>
	
	<div id="container">
	<input type="hidden" name="id_temp" id="id_temp"/>
	<input type="hidden" name="id_temp_actualizar" id="id_temp_actualizar"/>
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
		<div class="modal fade" id="modal_confirm_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
			  
			  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
               
			Deseas Guardar los cambios para el usuario seleccionado?
              </div>
              
			  <div class="modal-footer">
                 <div class="modal-footer">
                <button class="btn btn-primary">Cancelar </button>
				  <button class="btn btn-success" v-on:click="confirma_actualizacion()">Aceptar </button>
              </div>
              </div>
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
	
	<div class="modal fade" id="modal_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
			  
			  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
               
			OCURRIO UN ERROR
              </div>
              
			  <div class="modal-footer">
                
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
               <button class="btn btn-success" v-on:click="aceptar_eliminacion()">Aceptar </button>
              </div>
              
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
	
	
	 <div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
		  
			  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
               
			Estas Seguro de eliminar el usuario seleccionado? 
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary">Cancelar </button>
				  <button class="btn btn-success" v-on:click="confirma_eliminacion()">Aceptar </button>
              </div>
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
	
		 <div class="modal fade" id="modal_editar_detalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
		  
			  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editar</h4>
              </div>
              <div class="modal-body">
               
			   <div class="row">
	<div class="offset-md-2 col-md-10">
	<h3>Editar Usuario  </h3>
	<br>		
	<div class="offset-md-1 col-md-11">
	<img src="imagenes/nuevo_usuario.png" class="img-responsive" style="width:25%">  </img>	
	</div>	
	<form class="form">		
	<div  class="row">
	<div class=" col-md-3">
	<label> Nombre</label>
	</div>
	<div class="col-md-7">
	<input type="text" class="form-control" id="edit_nombre"/>
	</br>
	</div>
	<br>
	</div>
	<div class="row form-group">
	<div class="col-md-3">
	<label> Edad</label>
	</div>
	<div class="col-md-7">
	<input type="text" class="form-control" id="edit_edad"/>
	</div>
	</div>
	
	<div class="row form-group">
	<div class="col-md-3">
	<label> Apellido</label>
	</div>
	<div class="col-md-7">
	<input type="text" class="form-control" id="edit_apellido"/>
	</div>
	</div>
		
	<div class="row form-group">
	<div class="col-md-3">
	<label> Est. Civil</label>
	</div>
	<div class="col-md-8">
	<select name="estado_civil" class="form-control" style="width:85%" id="edit_estado_civil">
	<option value=1> Soltero </option>
	<option value=2> Casado </option>
	</select>
	</div>
	</div>
	
	<div class="row form-group">
	
	<div class="col-md-3">
	<label> Telefono</label>
	</div>
	<div class="col-md-7">
	<input type="text" class="form-control" id="edit_telefono"/>
	</div>
	</div>
	
	<div class="row">
	
	<div class="col-md-3">
	<label> Pais</label>
	</div>
	<div class="col-md-8">
	<select name="lista_Paises" class="form-control" style="width:85%" id="edit_paises">
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
	<div class="col-md-3">
	<label> Ciudad</label>
	</div>
	<div class="col-md-7">
	<input type="text" class="form-control" id="edit_ciudad"/>
	<br>
	</div>
	</div>
	<div class="row">
	
	<div class="offset-md-2 col-md-10">
	<br>
	<button type="button" class="btn btn-lg btn-success" v-on:click="editar_usuario_db()"> Guardar Cambios </button>
	</div>
	</div>
	</form>
	</div>
	</div>
			   
              </div>
              <div class="modal-footer">
                
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
	  <!-- <a class="nav-link disabled" href="#">Disabled</a>!-->
      </li>
    </ul>
  </div>
</nav>
	</div>
	</div>

	<div class="row">
	<div class="offset-md-4 col-md-6">
	<h3>Listado de Usuarios  </h3>
	<br>
	<div class="offset-md-1 col-md-11">
	<img src="imagenes/editar_usuario.jpg" class="img-responsive" style="width:25%">  </img>
	</div>
	<table class="table table-striped" border=1 id="tabla_usuarios">
	<thead>
	<tr>
	<th> Id </th>
	<th> Nombre </th>
	<th> Apellido </th>
	<th> Edad </th>
	<th> Estado Civil </th>
	<th> Telefono </th>
	<th> Pais </th>
	<th> Ciudad </th>
	
	<th> Accion </th>
	<th> Accion </th>
	</tr>
	</thead>
	
	<tbody>
	
	<!--{{ resultados}}!-->
	
	<tr v-for="usuario in this.resultados" v-bind:id="usuario.id_usuario">
	<td>{{usuario.id_usuario}}</td>
	<td>{{usuario.nombre}}</td>
	<td>{{usuario.apellido}}</td>
	<td>{{usuario.edad}}</td>
	<td>{{(usuario.estados_civil)==1 ?"Soltero":"Casado"}}</td>
	<td>{{usuario.telefono}}</td>
	<td>{{usuario.nombre_pais}}</td>
	<td>{{usuario.ciudad}}</td>
	<td style="display:none">{{usuario.estados_civil}}</td>
	<td style="display:none">{{usuario.id_pais_fk}}</td>
     <td><button v-on:click="editar_usuario_detalles(usuario.id_usuario)"class="btn btn-primary" style="font-size:14px">Editar <i class="fa fa-pencil"></i></button></td>
	<td><button class="btn btn-danger" style="font-size:14px" v-on:click="eliminar_usuarios(usuario.id_usuario)">Eliminar <i class="fa fa-remove"></i></button></td>
	</tr>
	</tbody>
	</table>
	</div>
	</div>
	</div>
	</div>
	<footer>
	<div class="row bg-light fixed-bottom">
	<div class="offset-md-4 col-md-6">
	<h4> COPYRIGHT LUIS CARDONA</h4>
	</div>
	</div>
	</footer>
	</body>
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
                url:   '<?php echo ruta_api?>terminar_sesion/', //finalizamos sesion
                type:  'get', //método de envio
                beforeSend: function () {
				
                },
                success:  function (response) { 
                       
					 window.location.href="login.php";
                }
				
			 })
		}
		
	}
	
var objeto= new Vue(
{
	
	
el:"#container",

data:{
	nombre:"",
	edit_id:"",
	edit_nombre:"",
	edit_edad:"",
	edit_apellido:"",
	edit_estado_civil:"",
	edit_paises:"",
	edit_tel:"",
	edit_ciudad:"",
	edit_fk_estado_civil:"",
	edit_fk_pais:"",
	
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
},

methods:
{
aceptar_eliminacion:function()
{
	$("#modal_operacion").modal("hide");
}
,
aceptar_validacion:function()
{
	$("#modal_validacion").modal("hide");
	
}
,
valida_elementos:function()
{
	
	var nombre_valida=$("#edit_nombre").val();
	var apellido_valida=$("#edit_apellido").val();
	var edad_valida=$("#edit_edad").val();
	var estado_civil_valida=$("#edit_estado_civil").val();//combo;
	var telefono_valida=$("#edit_telefono").val();
	var pais_valida=$("#edit_paises").val(); //combo;
	var ciudad_valida=$("#edit_ciudad").val();
	
	
	if(nombre_valida=="" || apellido_valida=="" ||  edad_valida=="" || telefono_valida=="" || ciudad_valida=="")
	{
	    $("#modal_editar_detalles").modal("hide");
		$("#modal_validacion").modal();
			return false;
	}
	else if(estado_civil_valida<=0 || pais_valida<=0)
	{
	     $("#modal_editar_detalles").modal("hide");
		$("#modal_validacion").modal();
			return false;
	}
				
}
,

editar_usuario_db:function()
{
	// aqui se manda ala base de datos al final !!!
	
	if(this.valida_elementos()==false)
	{
		$("#modal_validacion").modal();
			return false;
	}
	//this.edit_id=$.trim($("#" + id).find("td").eq(0).html());
	this.edit_nombre=$.trim($("#edit_nombre").val());
	this.edit_apellido=$("#edit_apellido").val();
	this.edit_edad=$("#edit_edad").val();
	
	
	this.edit_estado_civil=$("#edit_estado_civil").val();
	this.edit_paises=$("#edit_paises").val();
	this.edit_tel=$("#edit_telefono").val();
	this.edit_ciudad=$("#edit_ciudad").val();
	this.edit_fk_estado_civil=$("#edit_estado_civil").val();
	this.edit_fk_pais=$("#edit_paises").val();
	
	$("#modal_editar_detalles").modal('hide');
	$("#modal_confirm_edit").modal();
	
}
,
editar_usuario_detalles:function(id)
{
	
	this.edit_id=$.trim($("#" + id).find("td").eq(0).html());
	this.edit_nombre=$.trim($("#" + id).find("td").eq(1).html());
	this.edit_apellido=$.trim($("#" + id).find("td").eq(2).html());
	this.edit_edad=$.trim($("#" + id).find("td").eq(3).html());
	this.edit_estado_civil=$.trim($("#" + id).find("td").eq(3).html());
	this.edit_paises=$.trim($("#" + id).find("td").eq(4).html());
	this.edit_tel=$.trim($("#" + id).find("td").eq(5).html());
	this.edit_ciudad=$.trim($("#" + id).find("td").eq(7).html());
	this.edit_fk_estado_civil=$.trim($("#" + id).find("td").eq(8).html());
	this.edit_fk_pais=$.trim($("#" + id).find("td").eq(9).html());
	//alert("el id a editar es" + edit_id);
	$("#id_temp_actualizar").val(this.edit_id);
	$("#edit_nombre").val(this.edit_nombre);
	$("#edit_apellido").val(this.edit_apellido);
	$("#edit_edad").val(this.edit_edad);
	
	$("#edit_estado_civil").val(this.edit_fk_estado_civil);
	
	$("#edit_telefono").val(this.edit_tel);
	$("#edit_paises").val(this.edit_fk_pais);
	$("#edit_ciudad").val(this.edit_ciudad);
	
	//let id_usuario=$("#" + id).html();
	//alert("el valor recuperado es" + id_usuario);
	//alert("El id a editar es" + id);
	$("#modal_editar_detalles").modal();
}
,

confirma_actualizacion:function()
{
	$("#modal_confirm_edit").modal("hide");
	
	/*
	this.edit_id=$.trim($("#" + id).find("td").eq(0).html());
	this.edit_nombre=$.trim($("#" + id).find("td").eq(1).html());
	this.edit_apellido=$.trim($("#" + id).find("td").eq(2).html());
	this.edit_estado_civil=$.trim($("#" + id).find("td").eq(3).html());
	this.edit_paises=$.trim($("#" + id).find("td").eq(4).html());
	this.edit_tel=$.trim($("#" + id).find("td").eq(5).html());
	this.edit_ciudad=$.trim($("#" + id).find("td").eq(7).html());
	this.edit_fk_estado_civil=$.trim($("#" + id).find("td").eq(8).html());
	this.edit_fk_pais=$.trim($("#" + id).find("td").eq(9).html());
	*/
	
	
	let objeto_json= {"ciudad":this.edit_ciudad,"id_usuario":this.edit_id,"nombre":this.edit_nombre,"apellido":this.edit_apellido,"edad":this.edit_edad,"estado_civil":this.edit_fk_estado_civil,"id_pais_fk":this.edit_fk_pais,"telefono":this.edit_tel,"id_telefono_fk":this.edit_tel}
    let json=JSON.stringify(objeto_json);
	this.$http.put('<?php echo ruta_api?>actualizar/',json).then(function (response) {
	this.resultado_peticion=response.body;
	
	if(this.resultado_peticion>=1)
	{
		$("#modal_operacion").modal();
		this.listar_usuarios();
	}
	else
	{
	    $("#modal_error").modal();
		
	}
	
      })
}
,
confirma_eliminacion:function()
{
	
	$("#modal_eliminar").modal("hide");
var getIdTemp=$("#id_temp").val();
//alert("confirmado el id a eliminar es" +  getIdTemp);	
this.$http.delete('<?php echo ruta_api?>eliminar/' + getIdTemp).then(function (response) {
	this.resultado_peticion=response.body;
	
	
	if(this.resultado_peticion==1)
	{
		$("#modal_operacion").modal();
		this.listar_usuarios();
	}
	else
	{
	    $("#modal_error").modal();
		
	}
	
      })
}
,
eliminar_usuarios:function(id)
{
	
	$("#id_temp").val(id);
	$("#modal_eliminar").modal();
	
}
,

listar_usuarios:function()
{
	
	this.$http.get('<?php echo ruta_api?>listar/').then(function (response) {
                 //this.notas=respuesta.body
				  this.resultados=response.data;
          })
	
},
agregar_usuarios:function()
{
	
	
},



},

beforeCreate:function()
{
	
this.$http.get('<?php echo ruta_api?>listar').then(function (response) {
                 //this.notas=respuesta.body
				  this.resultados=response.data;
          })

}
})

	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>!-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	</html>