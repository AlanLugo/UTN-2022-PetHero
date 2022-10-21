<?php namespace Config;
define('ROOT', dirname(__DIR__) . "/");

function js_str($s)
{
    return '"' . addcslashes($s, "\0..\37\"\\") . '"';
}

function js_array($array){
    $temp = array_map('js_str', $array);
    return '[' . implode(',', $temp) . ']';
	}
?>

<script type="text/javascript">

   	function Procesar(div,controladora_metodo,parametros){
	var form_data = new FormData();     
	form_data.append(0, '<?php echo $_SESSION['token']; ?>');
	if(parametros.length>0){			
	for (x=0;x<parametros.length;x++){
		form_data.append(x+1, parametros[x]);
	}
	}
    $.ajax({
                url: controladora_metodo, // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                beforeSend: function () {                	
				$("#"+div).html('<center><img src="../images/cargando.svg" class="img-responsive" alt="Cargando"></center>');

				},
				success:  function (response) {                     	
					$("#"+div).html(response);

				}	  

            });
}   	
    function cambiaVisibilidad_Selecciona(capa, seleccionar) {
       var div = document.getElementById(capa);
       if(div.style.display == 'block'){
           div.style.display = 'none';
           $("#"+seleccionar).focus();
       }else{
          div.style.display = 'block';
          $("#"+seleccionar).focus();
         }
    }


 </script>