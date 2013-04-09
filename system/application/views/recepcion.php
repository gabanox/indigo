<html>
<?=$this->load->view('head')?>
<body>
<div id="outer">
	<?=$this->load->view('header')?>
	<?=$this->load->view('menu')?>
	<div id="content">
		<div id="leftContent">
		</div>
			
		<div id="primaryContentContainer">
			<div id="primaryContent">
			
				<!-- ERROR CONTAINER -->
				<div class="container">
					    <h4>Hay m&uacute;ltiples errores en el fomulario favor de revisar.</h4>
					    <ol></ol>
				</div>
				<!-- ERROR CONTAINER -->
				<p><em>Nombre del proceso: RECEPCI&Oacute;N</em><p>
				<form name="recepcionForm" id="recepcionForm" method="post" action="<?=site_url()?>/main/recepcion/">
				
					<table width="50%" border="0" cellpadding="0" cellspacing="5" align="center">
						<tr>
							<td colspan="2">Nombre de quien recoge:&nbsp;<input type="text" id="nombreRecoge" name="nombreRecoge" class="required" title="Debe especificar el nombre de quien recoge"/></td>
						</tr>
						<tr>
							<td>Feha:&nbsp;*(AAAA-MM-DD)<input type="text" id="fecha" name="fecha" class="required" title="Debe especificar la fecha en la que se recoge el paquete"/></td>
						</tr>
						<tr>
							<td>Hora:&nbsp;<input type="text" id="hora" name="hora" class="required" title="Debe especificar la hora en la que se recoge el paquete"/></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Ingresar Pick-Up del paquete" />
							</td>
						</tr>
					</table>
					<input type="hidden" name="idGuia" value="<?=$idGuia?>" />
					<input type="hidden" name="idEstatusProceso" value="2" />
				</form>
	 
			</div>
		</div>
	</div>
	
	<div class="clear"></div>
<?=$this->load->view('footer')?>
</div>
</body>
</html>
