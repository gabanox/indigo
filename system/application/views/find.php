<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<base href="<?=base_url();?>" />
<link href="system/application/libraries/css/default.css" rel="stylesheet" type="text/css" />
<script src="system/application/libraries/js/jquery-1.4.4.js"></script>
<script src="system/application/libraries/js/jquery.validate.js"></script>
<script src="system/application/libraries/js/jquery.metadata.js"></script>
<script src="system/application/libraries/js/additional-methods.js"></script>
<script src="system/application/libraries/js/jquery.validate.pack.js"></script>
<script src="system/application/libraries/js/jquery.confirm.js"></script>
<script type="text/javascript">
$(document).ready( function(){

	/* form validation */

	$("#result").hide();
    $("input[type='text']:first", document.forms[0]).focus();	
	
 	var container = $('div.container');
 	
    var validator = $("#findForm").validate({
        errorContainer: container,
        errorLabelContainer: $("ol", container),
        wrapper: 'li',
        meta: "validate"
    });

    $("#search").click( function(){
        
    	var numeroGuia = $("#numeroGuia").val();

    	$("#loadimg").ajaxStart(function() {
    		$(this).show();
    	});
    	$("#loadimg").ajaxStop(function() {
    		$(this).hide();
    	});
    		
    	$.ajax({
  		  url: "<?=site_url()?>/find/findGuia/" + numeroGuia,
  		  type: 'GET',
  		  dataType: 'text/html',
  		  success: function(data) {
	
    		var obj = jQuery.parseJSON(data);
    		
    		var response = createLayout(obj);
    		
  		    $("#result").html(response);
    		$("#result").show();
    		
  		  }
  		});
  		

     });

    function createLayout(obj)
    {
    	var response = "";

        	response += "<p>N&uacute;mero de Guia : <b>" + obj.numeroDeGuia + "</b></p>";
        	response += "<p>Fecha : <b>" + obj.fecha + "</b></p>";
        	response += "<p>instruccionAdicional : <b>" + obj.instruccionAdicional + "</b></p>";
        	response += "<p>Consignatario : <b>" + obj.consignatario + "</b></p>";
        	response += "<p>Origen : <b>" + obj.origen + "</b></p>";
        	response += "<p>Destino : <b>" + obj.destino + "</b></p>";
        	response += "<p>Estatus de Env&iacute;o : <b>" + obj.estatusProceso + "</b></p>";

        return response;
    }

});

</script>
<style type="text/css">
.cmxform fieldset p.error label { color: red; }
div.container {
    background-color: #FEF1EC;
    border: 1px solid #CD0A0A;
	color: #CD0A0A;
    margin: 5px;
    padding: 5px;
}
div.container ol li {
    list-style-type: disc;
    margin-left: 20px;
}
div.container { display: none }
.container label.error {
    display: inline;
}
form.cmxform label.error {
    display: block;
    margin-left: 1em;
    width: auto;
}

p {
	font-size: 15px;
}
</style>
</head>
<body>

	<br />
	<br />
	<br />
	
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
		<tr>
			<td colspan="2">
				<!-- ERROR CONTAINER -->
				<div class="container">
					    <h4>Hay m&uacute;ltiples errores en el fomulario favor de revisar.</h4>
					    <ol></ol>
				</div>
				<!-- ERROR CONTAINER -->
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<form id="findForm" name="findForm">
					Ingrese su n&uacute;mero de Gu&iacute;a:
					<input type="text" id="numeroGuia" name="numeroGuia" size="10" class="required" title="El campo de b&uacute;squeda no puede estar vac&iacute;o"/>&nbsp;
					<input type="button" id="search" value="Buscar Guia" />&nbsp;
					<img id="loadimg" style="display:none;" src="system/application/images/loading.gif" />
				</form> 
			</td>
		</tr>
	</table>
	<br />
	<hr />
	
	<br />	
	
		<table width="100%" align="center" border="0">
			<tr align="left">
				<td width="20%">&nbsp;</td>
				<td>
					<div id="result">				
						
				    </div>
		       </td>
		       <td width="20%">&nbsp;</td>
			</tr>
		</table>
</body>
</html>