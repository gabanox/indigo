<?php
class Authentication extends Controller {
	
	
	function index()
	{
		parent::Controller();
		$this->showLogin();
	}
	
	function showLogin()
	{
		$this->load->helper('url');
		//$this->load->view('login');
		$this->load->view('administrative');
	}
	
	function authenticate()
	{
		$this->load->database();
		$user = $this->input->post('u');
		$pass = $this->input->post('p');
		
		$query = $this->db->query(	"select count(1) as total 
									from Usuario
									where nombreUsuario ='$user' and
									password ='$pass' " );
		$authenticated = false;
		$this->load->helper('url');
		
		foreach( $query->result() as $item ){
			$item->total > 0 ? $authenticated = true : "";
		}
		
		//if($authenticated){
			$this->load->view('administrative');
		//}else {
			//$this->load->view('administrative');
		//}
	}
	
}
?>