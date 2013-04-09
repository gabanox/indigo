<?

$query = $this->db->query( 	"SELECT a.idGuia, 
									a.numeroDeGuia, 
									a.fecha, 
									a.instruccionAdicional, 
									a.remitente, 
									a.consignatario, 
									b.codigo as origen, 
									b.codigo as destino, 
									c.estatusProceso 
							FROM 	Guia a, EntidadFederativa b, EstatusProceso c
							WHERE 	(a.origen = b.idEntidadFederativa) AND
									(a.idEstatusProceso  = c.idEstatusProceso)" );

$numRows =  $query->num_rows();
?>

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
				<p>Bienvenido: Gabriel Ramirez [Operador]</p>	
			
				<img src="system/application/images/add.png" border="0">&nbsp;
				<a href="<?=site_url()?>/main/add/">Agregar nuevo</a>
				
				<table id="hor-zebra" width="100%" >
				    <thead>
				    	<tr align="center">
				        	<th scope="col">#</th>
				        	<th scope="col">Acci&oacute;n</th>
				            <th scope="col">No de Gu&iacute;a</th>
				            <th scope="col">Remitente</th>
				            <th scope="col">Origen / Destino</th>
				            <th scope="col">Estatus</th>
				        </tr>
				    </thead>
				    <tbody>
				    
				    <?if( $numRows > 0 ){?>
				    
					    <?foreach( $query->result() as $row ){?>
					    	<tr <?=$row->idGuia % 2 ? "class='odd'" : ""?>>
					        	<td><?=$row->idGuia?></td>
					        	<td>
					        		<a href="<?=site_url()?>/main/edit/<?=$row->idGuia?>"><img src="system/application/images/note_edit.png" border="0" title="EDITAR"/></a>&nbsp;
					        		<a href="<?=site_url()?>/main/delete/<?=$row->idGuia?>"><img src="system/application/images/note_delete.png" border="0" title="ELIMINAR"/></a>&nbsp;
					        		<a href="<?=site_url()?>/main/status/<?=$row->idGuia?>"><img src="system/application/images/package_go.png" border="0" title="CAMBIAR STATUS"/></a>&nbsp;
					        		
					        	</td>
					        	<td><span style="text-transform: uppercase"><?=$row->numeroDeGuia?></span></td>
					        	<td><?=$row->remitente?></td>
					        	<td><?=$row->origen?> / <?=$row->destino?></td>
					        	<td>
					        	
						        	<?if($row->estatusProceso == 'ALTA'){?>
						        	
						        	<img src='system/application/images/accept.png' />ALTA&nbsp;
						        	<img src='system/application/images/cross.png' />RECEPCI&Oacute;N&nbsp;
						        	<img src='system/application/images/cross.png' />ENTREGA&nbsp;
						        	
						        	<?}else if($row->estatusProceso == 'RECEPCION'){?>
						        	
						        	<img src='system/application/images/accept.png' />ALTA&nbsp;
						        	<img src='system/application/images/accept.png' />RECEPCI&Oacute;N&nbsp;
						        	<img src='system/application/images/cross.png' />ENTREGA&nbsp;
						        	
						        	<?}else if($row->estatusProceso == 'ENTREGA'){?>
						        	
						        	<img src='system/application/images/accept.png' />ALTA&nbsp;
						        	<img src='system/application/images/accept.png' />RECEPCI&Oacute;N&nbsp;
						        	<img src='system/application/images/accept.png' />ENTREGA&nbsp;
						        	
						        	<?}?>
					        	</td>
					        </tr>
				        <?}?>
			       <?}else {?>
			       			<tr>
			       				<td colspan="7"><p>No Existen registros en la base de datos!</h1></p>
			       			</tr>
			       <?}?>
				    </tbody>
				</table>
			
			</div>
		</div>
		<div id="rightContent">
		
		</div>
		<div class="clear"></div>
	</div>
<?=$this->load->view('footer')?>
</div>
</body>
</html>
