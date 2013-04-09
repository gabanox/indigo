<?
$query_guia = $this->db->query("SELECT		a.idGuia, 
											a.numeroDeGuia, 
											a.fecha,
											a.instruccionAdicional, 
											a.origen,
											a.destino, 
											a.remitente,
											a.referencias,
											a.consignatario,
											a.contactos,
											a.observaciones,	
											b.estatusProceso,			
											c.piezas,
											c.peso,
											c.medidas,
											c.valorAgregado,
											c.otro,
											d.nombreUsuario,
											d.correoElectronico
								 FROM       Guia a, EstatusProceso b, Caracteristicas c, Usuario d
								 WHERE 		(b.idEstatusProceso = a.idEstatusProceso) AND
											(c.idGuia = a.idGuia) AND
											(a.idUsuario = d.idUsuario) AND
											a.idGuia = '$idGuia' "	);


											foreach ($query_guia->result() as $guia){
												
												$idGuia 				= $guia->idGuia;
												$numeroDeGuia 			= $guia->numeroDeGuia;
												$fecha 					= $guia->fecha;
												$instruccionAdicional 	= $guia->instruccionAdicional;
												$origen 				= $guia->origen;
												$destino 				= $guia->destino;
												$remitente 				= $guia->remitente;
												$referencias			= $guia->referencias;
												$consignatario			= $guia->consignatario;
												$contactos 				= $guia->contactos;
												$observaciones			= $guia->observaciones;
												$estatusProces 			= $guia->estatusProceso;
												$piezas					= $guia->piezas;
												$peso 					= $guia->peso;
												$medidas 				= $guia->medidas;
												$valorAgregado 			= $guia->valorAgregado;
												$otro 					= $guia->otro;
												$nombreUsuario 			= $guia->nombreUsuario;
												$correoElectronico 	= $guia->correoElectronico;
											}

$query_entidades = $this->db->query(	"SELECT 	idEntidadFederativa, entidadFederativa 
										 FROM 		EntidadFederativa 
										 WHERE 		status = 'ACTIVO' 
										 ORDER BY 	entidadFederativa");

/* instrucciones */

$query_instrucciones = $this->db->query( 	"SELECT 	a.idInstruccion, a.instruccion 
											 FROM 		Instruccion a, InstruccionGuia b 
											 WHERE 		a.idInstruccion = b.idInstruccion AND b.idGuia = $idGuia" );

$instrucciones = $this->db->query(	"SELECT 	idInstruccion, instruccion
									 FROM 		Instruccion 
									 ORDER BY 	instruccion ASC");

$selectedInstructions = array();

foreach ($query_instrucciones->result() as $instruccion){
	array_push($selectedInstructions, $instruccion->idInstruccion );
}

/* instrucciones */

/* clasificaciones */

$query_clasificaciones = $this->db->query( 		"SELECT 	a.idClasificacion, 
															a.clasificacion 
												 FROM Clasificacion a, ClasificacionGuia b 
												 WHERE a.idClasificacion = b.idClasificacion AND b.idGuia = $idGuia" );

$clasificaciones = $this->db->query( 	"SELECT		idClasificacion, clasificacion
										 FROM		Clasificacion
										 ORDER BY   clasificacion ASC");

/* clasificaciones */

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
				<p><em>Nombre del proceso: </em><p>
				<br />
				<!-- SESSION INFORMATION -->
			
			<form id="editForm" name="editForm" method="post" action="<?=site_url()?>/main/update">
							
				<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
						<tr>
							<td>
							<!-- LOGISTICA -->
							
							<h2>Log&iacute;stica</h2>
							
									<div id="left_single_line">
										<label for="numeroDeGuia">N&uacute;mero de Gu&iacute;a:</label>
										<input type="text" id="numeroDeGuia" value="<?=$numeroDeGuia?>" name="numeroDeGuia" class="required" title="El NUMERO DE GUIA es requerido"/>
									</div>
									
									<div id="right_single_line">
										<label for="fecha">Fecha:</label>
										<input type="text" id="fecha" name="fecha" value="<?=$fecha?>" size="25" class="required" title="La FECHA es requerida"/>
									</div>
									
									<div id="left_single_line">
										<label for="origen">Origen:</label>
										<select name="origen" id="origen" class='required' title="Debe seleccionar el ORIGEN">
											<option value="">-- SELECCIONAR ORIGEN--</option>
											<? 
											foreach( $query_entidades->result() as $item ){
												echo $item->idEntidadFederativa == $origen ? 
													"<option value='$item->idEntidadFederativa' selected='selected'>$item->entidadFederativa</option>\n" : 
													"<option value='$item->idEntidadFederativa'>$item->entidadFederativa</option>\n";
											}?>
										</select> 
									</div>
									
									<div id="right_single_line">
										<label for="destino">Destino:</label>
										<select name="destino" id="destino" class="required" title="Debe seleccionar el DESTINO">
											<option value="">-- SELECCIONAR DESTINO --</option>
											<? 
											foreach( $query_entidades->result() as $item ){
												echo $item->idEntidadFederativa == $destino ? 
													"<option value='$item->idEntidadFederativa' selected='selected'>$item->entidadFederativa</option>\n" : 
													"<option value='$item->idEntidadFederativa'>$item->entidadFederativa</option>\n";
											}?>
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
										<input type="text" id="remitente" name="remitente" value="<?=$remitente?>"class="required" title="El REMITENTE es requerido" />
									</div>
									
									<div id="right_single_line">	
										<label for="referencias">Referencias:</label>
										<input type="text" id="referencias" name="referencias" value="<?=$referencias?>"/>
									</div>
									
									<br />
									<div id="left_single_line">
										<label for="consignatario">Consignatario:</label>
										<input type="text" id="consignatario" name="consignatario" value="<?=$consignatario?>"class="required" title="Debe especificar un CONSIGNATARIO"/>
									</div>
									
									<div id="right_single_line">
										<label for="contactos">Contactos:</label>
										<input type="text" id="contactos" name="contactos" value="<?=$contactos?>"/>
									</div>
									<br />
									<br />
									<br />
									
										<label for="instrucciones">Instrucciones:&nbsp;
											<select id="insrucciones" name="instrucciones[]" multiple="multiple">
												<?
												$i = 0;
												foreach( $instrucciones->result() as $item ){
													echo $item = $selectedInstructions[ $i ] ? 
														"<option value='$item->idInstruccion' selected='selected'>$item->instruccion</option>\n" :
														"<option value='$item->idInstruccion'>$item->instruccion</option>\n"; 
													$i++;
												}?>
											</select>
										</label>
										
										<label for="instruccionAdicional">Instruccion adicional:&nbsp;
											<input type="text" id="instruccionAdicional" name="instruccionAdicional" value="<?=$instruccionAdicional?>"/>
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
											
											<?foreach($clasificaciones->result() as $clasificacion){?>
											<label for="<?=$clasificacion->clasificacion?>">
												<input 	type="checkbox" 
														id="<?=$clasificacion->clasificacion?>" 
														name="clasificacion[]" 
														value="<?=$clasificacion->idClasificacion?>"
														
														<?foreach($query_clasificaciones->result() as $selected_clasificacion){
															echo $selected_clasificacion == $clasificacion ? " checked='checked'" : "";
														}?>
														/>&nbsp;
												<?=$clasificacion->clasificacion?>
											</label>
											<br />
											
											<?}?>
											
										</td>
										<td>
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
												<tr>
													<td>
														<label for="piezas">Piezas:&nbsp;
															<input type="text" id="piezas" name="piezas" value="<?=$piezas?>"/> 
														</label>
													</td>
													<td>
														<label for="peso">Peso:&nbsp;
															<input type="text" id="peso" name="peso" value="<?=$peso?>"/> 
														</label>
													</td>
												</tr>
												<tr>
													<td>
														<label for="valorAgregado">Valor Agregado:&nbsp;
															<input type="text" id="valorAgregado" name="valorAgregado" value="<?=$valorAgregado?>"/> 
														</label>
													</td>
													<td>
														<label for="medidas">Medidas:&nbsp;
															<input type="text" id="medidas" name="medidas" value="<?=$medidas?>"/> 
														</label>
													</td>
												</tr>
												<tr>
													<td colspan="3">
														<label for="otrosDetalles">Otros detalles:&nbsp;
															<input type="text" id="otrosDetalles" name="otrosDetalles" size="60" value="<?=$otro?>"/>
														</label>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											Observaciones:<br />
											<textarea rows="5" cols="80" id="observaciones" name="observaciones"><?=$observaciones?></textarea>
										</td>
									</tr>
									<tr>
										<td width="50%">
											<center><input type="submit" value="Acutalizar G&iacute;a" /></center>
										</td>
										<td>&nbsp;</td>
									</tr>
									
								</table>
							<!-- DETALLE -->
							</td>
						</tr>
				</table>
				<input type="hidden" name="idUsuario" value="1" />
				<input type="hidden" name="idGuia" value="<?=$idGuia?>" />
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
