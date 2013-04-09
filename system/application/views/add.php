<?
$origin = $this->db->query(	"select idEntidadFederativa, entidadFederativa 
							from EntidadFederativa 
							where status = 'ACTIVO' 
							order by entidadFederativa");

$instructions = $this->db->query(	"select idInstruccion, instruccion
									from Instruccion 
									order by instruccion asc");

?>

<?=$this->load->view('head')?>
<body>

<div id="outer">

	<?=$this->load->view('header')?>
	<?=$this->load->view('menu')?>
	
	<div id="content">
	
		<div id="leftContent">&nbsp;</div>
			
		<div id="primaryContentContainer">
			
			<div id="primaryContent">
			
				<div id="content_table">
				
				<!-- ERROR CONTAINER -->
				<div class="container">
					    <h4>Hay m&uacute;ltiples errores en el fomulario favor de revisar.</h4>
					    <ol></ol>
				</div>
				<!-- ERROR CONTAINER -->
				<br />
				
				<!-- SESSION INFORMATION -->
				
				<p><em>Usuario: Gabriel Ramirez [ ADMINISTRADOR / ADMINISTRACION ]</em></p>
				<p><em>Nombre del proceso: ALTA</em><p>
				<br />
				<!-- SESSION INFORMATION -->
			
			<form id="saveForm" name=saveForm" method="post" action="<?=site_url()?>/main/save">
							
				<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
						<tr>
							<td>
							<!-- LOGISTICA -->
							
							<h2>Log&iacute;stica</h2>
							
									<div id="left_single_line">
										<label for="numeroDeGuia">N&uacute;mero de Gu&iacute;a:</label>
										<input type="text" id="numeroDeGuia" name="numeroDeGuia" class="required" title="El NUMERO DE GUIA es requerido"/>
									</div>
									
									<div id="right_single_line">
										<label for="fecha">Fecha:</label>
										<input type="text" id="fecha" name="fecha" value="<?=unix_to_human( time() )?>" size="25" class="required" title="La FECHA es requerida"/>
									</div>
									
									<div id="left_single_line">
										<label for="origen">Origen:</label>
										<select name="origen" id="origen" class='required' title="Debe seleccionar el ORIGEN">
											<option value="">-- SELECCIONAR ORIGEN--</option>
											<? 
											foreach( $origin->result() as $item )
												echo "<option value='$item->idEntidadFederativa' >$item->entidadFederativa</option>\n";
											?>
										</select> 
									</div>
									
									<div id="right_single_line">
										<label for="destino">Destino:</label>
										<select name="destino" id="destino" class="required" title="Debe seleccionar el DESTINO">
											<option value="">-- SELECCIONAR DESTINO --</option>
											<? 
											foreach( $origin->result() as $item )
												echo "<option value='$item->idEntidadFederativa'>$item->entidadFederativa</option>\n";
											?>
										</select>
									</div>
								<br />
							<!-- LOGISTICA -->
							</td>
						</tr>
						<tr>
							<td>
							<!-- ENVIO -->
							
							<h2>Env&iacute;o</h2>
							
									<div id="left_single_line">
										<label for="remitente">Remitente:</label>
										<input type="text" id="remitente" name="remitente" class="required" title="El REMITENTE es requerido" />
									</div>
									
									<div id="right_single_line">	
										<label for="referencias">Referencias:</label>
										<input type="text" id="referencias" name="referencias" />
									</div>
									
									<br />
									<div id="left_single_line">
										<label for="consignatario">Consignatario:</label>
										<input type="text" id="consignatario" name="consignatario" class="required" title="Debe especificar un CONSIGNATARIO"/>
									</div>
									
									<div id="right_single_line">
										<label for="contactos">Contactos:</label>
										<input type="text" id="contactos" name="contactos" />
									</div>
									<br />
									<br />
									<br />
									
										<label for="instrucciones">Instrucciones:&nbsp;
											<select id="insrucciones" name="instrucciones[]" multiple="multiple">
												<?
												foreach( $instructions->result() as $item )
													echo "<option value='$item->idInstruccion'>$item->instruccion</option>\n";
												?>
											</select>
										</label>
										
										<label for="instruccionAdicional">Instruccion adicional:&nbsp;
											<input type="text" id="instruccionAdicional" name="instruccionAdicional" />
										</label>
										
								<br />
							<!-- ENVIO -->
							</td>
						</tr>
						<tr>
							<td>
							<!-- DETALLE -->
							
							<h2>Detalle</h2>
							
								<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
									<tr>
										<td>
											<p><em>Generales</em></p>
											<hr />
											<label for="medicamento">
												<input type="checkbox" id="medicamento" name="clasificacion[]" value="1" />&nbsp;
												Medicamento
											</label>
											<br />
											<label for="insumos">
												<input type="checkbox" id="insumos" name="clasificacion[]" value="2" />&nbsp;
												Insumos
											</label>
											<br />
											<label for="documentos">
												<input type="checkbox" id="documentos" name="clasificacion[]" value="3" />&nbsp;
												Documentos
											</label>
											<br />
											<br />
											<p><em>Biol&oacute;gicos</em></p>
											<hr />
											<label for="ambient">
												<input type="checkbox" id="ambient" name="clasificacion[]" value="4" />&nbsp;
												Ambient
											</label>
											<br />
											<label for="frozen">
												<input type="checkbox" id="frozen" name="clasificacion[]" value="5" />&nbsp;
												Frozen
											</label>
										</td>
										<td>
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
												<tr>
													<td>
														<label for="piezas">Piezas:&nbsp;
															<input type="text" id="piezas" name="piezas" /> 
														</label>
													</td>
													<td>
														<label for="peso">Peso:&nbsp;
															<input type="text" id="peso" name="peso" /> 
														</label>
													</td>
												</tr>
												<tr>
													<td>
														<label for="valorAgregado">Valor Agregado:&nbsp;
															<input type="text" id="valorAgregado" name="valorAgregado" /> 
														</label>
													</td>
													<td>
														<label for="medidas">Medidas:&nbsp;
															<input type="text" id="medidas" name="medidas" /> 
														</label>
													</td>
												</tr>
												<tr>
													<td colspan="3">
														<label for="otrosDetalles">Otros detalles:&nbsp;
															<input type="text" id="otrosDetalles" name="otrosDetalles" size="60" />
														</label>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											Observaciones:<br />
											<textarea rows="5" cols="80" id="observaciones" name="observaciones"></textarea>
										</td>
									</tr>
									<tr>
										<td width="50%">
											<center><input type="submit" value="Guardar G&iacute;a" /></center>
										</td>
										<td>
											<input type="reset" value="Borrar el formulario" />
										</td>
									</tr>
									
								</table>
							<!-- DETALLE -->
							</td>
						</tr>
				</table>
				<input type="hidden" name="idUsuario" value="1" />
				<input type="hidden" name="idEstatusProceso" value="1" />
			</form>
				
				</div>
				<!-- CONTENT TABLE -->
				
			</div>
			<!-- PRIMARY CONTENT -->
			
		</div>
		<!-- PRIMARY CONTENT CONTAINER -->
		
		<div id="rightContent">&nbsp;</div>
		
		<div class="clear"></div>
		
	<!-- CONTENT -->
	</div>
	
	<?=$this->load->view('footer')?>
</div>
<!-- OUTER -->
</body>
</html>
