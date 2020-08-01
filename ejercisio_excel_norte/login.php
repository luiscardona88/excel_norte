<?php require_once("ruta_api.php")?>
<html>
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
	
	<div class="modal fade" id="modal_credenciales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
			  
			  <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
			   NOMBRE DE USUARIO/O CONTRASEÑA NO VALIDOS
              </div>
              
			  <div class="modal-footer">
                 <div class="modal-footer">
               
				  <button class="btn btn-success" v-on:click="confirmar()">Aceptar </button>
              </div>
              </div>
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
	
	
	<br>
	<br>
	<br>
	<div class="row">
	<div class="offset-md-2 col-md-2">
	<br>
	<br>
	<br>
	<img src="imagenes/login.png"/>
	</div>
	<div class="col-md-6">
	<br>
	<br>
	<br>
	Nombre:<input type="text" name="nombre"  id="nombre" class="form-control" style="width:50%"/>
	<br>
	Contraseña <input type="password" name="password" id="password"  class="form-control" style="width:50%"/>
	<br>
	<input type="button" name="validar" id="validar" onclick="validar()" value="Entrar" class="btn btn-primary"/>
	</div>
	</div>	
	</script>		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>	
	<script>
	
	function validar()
	{
	
	var usuario=$("#nombre").val();
	var password=$("#password").val();
	
	 $.ajax({
                data:  {"usuario":usuario,"password":password}, //datos que se envian a traves de ajax
                url:   '<?php  echo ruta_api?>login_validar/', //archivo que recibe la peticion
                type:  'post',
                beforeSend: function () {
					//$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                       // $("#resultado").html(response);
					   console.log(response);					   
					   if($.trim(response>=1))
					   {
					   //alert("si");
						   window.location.href="index.php";
						   						   
						}
						else
						{
					
							$("#modal_credenciales").modal();	
						}
                }
        });
	}
	function confirmar()
	{
	  $("#modal_credenciales").modal('hide');	
	}
	
	</script>
	</body>
	</html>