<html>
<head>
<?=$this->load->view('admin_head')?>
</head>

<body>
<br />
<center><h1>Panel de Administraci&oacute;n</h1></center>
<br />
<br />
<br />
	<form action="authenticate/" method="post">
					
		<table width="50" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>Usuario:</td>
				<td>
					<input type="text" id="user" name="u" />
				</td>
			</tr>
			<tr>
				<td>Contrase&ntilde;a:</td>
				<td>
					<input type="password" id="password" name="p" />
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" value="Ingresar" /></td>
			</tr>
		</table>
					
	</form>
	<?=$this->load->view('footer')?>
</body>
</html>

