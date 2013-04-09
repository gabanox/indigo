<?=$this->load->view('admin_head')?>
<html>
<body>
<br />
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="20%" align="left">
			<!-- menu -->
			
			<h3>Catalogos del sistema</h3>
			<br />
			<a href="<?=site_url()?>/main/">Volver al sistema</a>
			<!-- menu -->
			</td>
			<td width="80%">
			
				<table width="100%" border="0">
					<tr>
						<td><a href="<?=site_url()?>/usuario/admin">Usuarios</a></td>
						<td><a href="<?=site_url()?>/instruccion/admin">Instrucciones</a></td>
						<td><a href="<?=site_url()?>/entidadFederativa/admin">Entidades Federativas</a></td>
					</tr>
					<tr>
						<td><a href="<?=site_url()?>/clasificacion/admin">Clasificacion</a></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>
</body>
</html>