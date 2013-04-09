<?php 
class Usuario extends Controller {
	
	function Usuario()
	{
		parent::Controller();
		$this->load->scaffolding('Usuario');
	}
}

?>