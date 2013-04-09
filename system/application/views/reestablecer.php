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
				<p><em>Nombre del proceso: REESTABLECER STATUS</em><p>
				<a href="<?=site_url()?>/main/resetStatus/<?=$idGuia?>">Reestablecer a estatus anterior</a>
			</div>
		</div>
	</div>
	
	<div class="clear"></div>
<?=$this->load->view('footer')?>
</div>
</body>
</html>
