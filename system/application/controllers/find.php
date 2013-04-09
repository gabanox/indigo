<?php
class Find extends Controller {
	
	function main()
	{
		parent::Controller();
	}
	
	function index()
	{
		$this->load->helper('url');
		$this->load->view('find');
	}
	
	function findGuia( $numeroGuia )
	{
		$this->load->helper('url');
		$this->load->database();
		
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
									(a.idEstatusProceso  = c.idEstatusProceso) AND
									(a.numeroDeGuia = '$numeroGuia' )" );
		
		$guia = array();
		foreach( $query->result() as $row ){
			
			$guia['numeroDeGuia'] 			= $row->numeroDeGuia;
			$guia['fecha']					= $row->fecha;
			$guia['instruccionAdicional'] 	= $row->instruccionAdicional;
			$guia['remitente'] 				= $row->remitente;
			$guia['consignatario'] 			= $row->consignatario;
			$guia['origen'] 				= $row->origen;
			$guia['destino'] 				= $row->destino;
			$guia['estatusProceso'] 		= $row->estatusProceso;
		}
		//ojo descomentar :P
		for($i=0;$i<10000000;$i++);
		
		echo json_encode($guia);
	}
	
}
?>