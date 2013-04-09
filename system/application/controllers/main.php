<?php
class Main extends Controller {

	const ESTATUS_PROCESO_ALTA = 1;
	const ESTATUS_PROCESO_RECEPCION = 2;
	const ESTATUS_PROCESO_ENTREGA = 3;
	
	function main()
	{
		parent::Controller();	
	}
	
	function index() 
	{
		$this->load->helper('url');
		$this->load->database();
		$this->load->view('index');
	}
	
	function add()
	{
		//$this->output->set_header('Cache: No-cache');
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('date');
		$this->load->view('add');
	}
	
	
	function save()
	{
		
		$this->load->database();
		
		//+++Transactional CRUD Operations+++	
		//$this->db->trans_start();
		
		$this->createGuia();
			$guiaId = $this->db->insert_id();
		
		$this->createCaracteristicas($guiaId);
			$caracteristicasId = $this->db->insert_id();
			log_message('debug', '[NEW ID CARACTERISTICAS] ' . $caracteristicasId );
		
		
		$instructions[] = $this->input->post('instrucciones');
			if( $this->hasInstrucciones( $instructions ) ){
				
				$this->saveInstruccionesGuia( $instructions, $guiaId);
				$instruccionId = $this->db->insert_id();
			}	
			
		$clasificaciones[] = $this->input->post('clasificacion');
		
			if( $this->hasClasificaciones( $clasificaciones ) ){
				
				$this->saveClasificacionGuia( $clasificaciones, $guiaId );
					$clasificacionGuiaId = $this->db->insert_id();
					log_message('debug', '[NEW ID CLASIFICACIONGUIA] ' . $caracteristicasId );
			}
	
			
		//$this->db->trans_complete();	
		//+++Transactional CRUD Operations+++
		
		
		$this->saveSuccess();
		
	}
	
	function saveSuccess()
	{
		$this->output->set_header('Cache: No-cache');
		$this->load->helper('url');
		$this->load->view('saveSuccess');
	}
	
	function createCaracteristicas( $idGuia )
	{
		
		$data = array(	
					'piezas' 				=> $this->input->post('piezas') 				== TRUE ? $this->input->post('piezas') 					: 'NULL',
					'peso' 					=> $this->input->post('peso') 					== TRUE ? $this->input->post('peso') 					: 'NULL',
					'medidas' 				=> $this->input->post('medidas') 				== TRUE ? $this->input->post('medidas') 				: 'NULL',
					'valorAgregado' 		=> $this->input->post('valorAgregado') 			== TRUE ? $this->input->post('valorAgregado') 			: 'NULL',
					'otro' 					=> $this->input->post('otrosDetalles') 			== TRUE	? $this->input->post('otrosDetalles') 			: 'NULL', 
					'idGuia' 				=> is_int($idGuia) && $idGuia != 0    					? $idGuia	 									: 'NULL'
		);
		
		log_message('debug', '[SAVING CARACTERISTICAS]');
		$this->db->insert('Caracteristicas', $data);
	}
	
	function createGuia()
	{
		
		$data = array(
					'numeroDeGuia' 			=> $this->input->post('numeroDeGuia') 			== TRUE ? $this->input->post('numeroDeGuia') 			: 'NULL',
					'fecha' 				=> $this->input->post('fecha') 					== TRUE ? $this->input->post('fecha') 					: 'NULL',
					'instruccionAdicional' 	=> $this->input->post('instruccionAdicional') 	== TRUE ? $this->input->post('instruccionAdicional') 	: 'NULL',
					'origen'	 			=> $this->input->post('origen') 				== TRUE ? $this->input->post('origen') 					: 'NULL',
					'destino' 				=> $this->input->post('destino') 				== TRUE ? $this->input->post('destino')					: 'NULL',
					'remitente' 			=> $this->input->post('remitente') 				== TRUE ? $this->input->post('remitente') 				: 'NULL',
					'referencias' 			=> $this->input->post('referencias') 			== TRUE ? $this->input->post('referencias') 			: 'NULL',
					'consignatario' 		=> $this->input->post('consignatario') 			== TRUE ? $this->input->post('consignatario') 			: 'NULL',
					'contactos' 			=> $this->input->post('contactos') 				== TRUE ? $this->input->post('contactos') 				: 'NULL',
					'observaciones' 		=> $this->input->post('observaciones') 			== TRUE ? $this->input->post('observaciones') 			: 'NULL',
//					'idUsuario' 			=> $this->input->post('idUsuario')	 			== TRUE ? $this->input->post('idUsuario')	 			: 'NULL',
					'referencias' 			=> $this->input->post('referencias') 			== TRUE ? $this->input->post('referencias') 			: 'NULL',
					'idEstatusProceso' 		=> $this->input->post('idEstatusProceso')		== TRUE ? $this->input->post('idEstatusProceso')	 	: 'NULL'
					
		);
		$this->db->_compile_select(); 
		$this->db->insert('Guia', $data);
		log_message('debug', 'EXECUTING QUERY :' . $this->db->last_query() );
		log_message('debug', '[CREATING GUIA WITH numeroDeGuia] ' . $data['numeroDeGuia'] );
	}
	
	function saveClasificacionGuia( $clasificaciones, $guiaId )
	{
		foreach( $clasificaciones[0] as $key => $value ){
			
			$this->db->set( 'idGuia', $guiaId );
			$this->db->set( 'idClasificacion', $value );
			 
			log_message('debug', '[SAVING CLASIFICACION GUIA WITH ] [idClasificacion] ' . $value . " [idGuia] " . $guiaId );
			$this->db->insert('ClasificacionGuia'); 
		}
	}
	
	function saveInstruccionesGuia( $instrucciones, $guiaId ) 
	{
		foreach ($instrucciones[0] as $key => $value) {
			
			$this->db->set( 'idGuia', $guiaId );
			$this->db->set( 'idInstruccion', $value );
			
			log_message('debug', '[SAVING INSTRUCCIONESGUIA WITH ] [idInstruccion] ' . $value . " [idGuia] " . $guiaId );
			$this->db->insert('InstruccionGuia');
		}
	}
	
	function getEntidadFederativaById( $id ) //deprecated
	{
		$query = $this->db->get_where('EntidadFederativa', array('idEntidadFederativa' => $id ) );
		$row = 'NULL';
		
			foreach( $query->result() as $item ){
				$row = $item->entidadFederativa;
			}
		return $row;
	}
	
	function getNextId( $tableName, $field )
	{
		log_message('debug', '[NETX ID PARAMS ] tableName: [' . $tableName . '] field: [' . $field . ']' );
		$this->db->select_max( $field );
		$nextId = null;
		
		$query = $this->db->get( $tableName );
		
			foreach( $query->result() as $item ){
				$nextId == NULL ? $nextId++ : $item->$field;	
			}
			
		log_message('debug', '[NEXT ID FOR: ' . $tableName . '] ' . $nextId );
		return $nextId;
	}
	
	function edit( $id ) 
	{
		$data = array('idGuia' => $id );
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('date');
		$this->load->view('edit', $data);		
	}
	
	function delete( $id )
	{
		$this->load->database();
		log_message('debug', '[DELETE FROM GUIA WITH ID ] ' . $id );
		$this->db->delete('Guia', array('idGuia' => $id));
		
		$this->deleteSuccess();
	}
	
	function deleteInstruccionesForGuia( $id )
	{
		$this->load->database();
		log_message('debug', '[DELETE INSTRUCCION GUIA WITH ID GUIA] ' . $id );
		$this->db->delete('InstruccionGuia', array('idGuia' => $id));
	}
	
	function deleteClasificacionesForGuia( $id )
	{
		$this->load->database();
		log_message('debug', '[DELETE CLASIFICACION GUIA WITH ID GUIA] ' . $id );
		$this->db->delete('ClasificacionGuia', array('idGuia' => $id));
	}
	
	function deleteSuccess()
	{
		$this->output->set_header('Cache: No-cache');
		$this->load->helper('url');
		$this->load->view('deleteSuccess');	
	}
	
	function update()
	{
		$id = $this->input->post('idGuia');
		
		$this->updateGuia( $id );
		log_message('debug', '[UPDATE GUIA WITH ID] ' . $id );
		
		$this->updateCaracteristicas( $id );
		log_message('debug', '[UPDATE GUIA WITH ID] ' . $id );
		
		$instrucciones[] = $this->input->post('instrucciones');
		$clasificaciones[] = $this->input->post('clasificacion');
		
		if( $this->hasInstrucciones( $instrucciones ) ){
			$this->deleteInstruccionesForGuia( $id );
			$this->saveInstruccionesGuia( $instrucciones, $id);
		}
			
		if( $this->hasClasificaciones( $clasificaciones ) ){
			$this->deleteClasificacionesForGuia( $id );
			$this->saveClasificacionGuia( $clasificaciones, $id );
		}
			
		$this->load->helper('url');
		$this->load->view('updateSuccess');
		
	}
	
	function updateGuia( $id )
	{
		$this->load->database();
		$data = array(
					'numeroDeGuia' 			=> $this->input->post('numeroDeGuia') 			== TRUE ? $this->input->post('numeroDeGuia') 			: 'NULL', 
					'fecha' 				=> $this->input->post('fecha') 					== TRUE ? $this->input->post('fecha') 					: 'NULL', 
					'origen' 				=> $this->input->post('origen') 				== TRUE ? $this->input->post('origen') 					: 'NULL', 
					'destino' 				=> $this->input->post('destino') 				== TRUE ? $this->input->post('destino') 				: 'NULL', 
					'remitente' 			=> $this->input->post('remitente') 				== TRUE ? $this->input->post('remitente') 				: 'NULL', 
					'referencias' 			=> $this->input->post('referencias') 			== TRUE ? $this->input->post('referencias') 			: 'NULL', 
					'consignatario' 		=> $this->input->post('consignatario') 			== TRUE ? $this->input->post('consignatario') 			: 'NULL', 
					'contactos' 			=> $this->input->post('contactos') 				== TRUE ? $this->input->post('contactos') 				: 'NULL', 
					'instruccionAdicional' 	=> $this->input->post('instruccionAdicional') 	== TRUE ? $this->input->post('instruccionAdicional') 	: 'NULL', 
					'observaciones' 		=> $this->input->post('observaciones') 			== TRUE ? $this->input->post('observaciones') 			: 'NULL', 
					'origen' 				=> $this->input->post('origen') 				== TRUE ? $this->input->post('origen') 					: 'NULL' 
		);
		
		$this->db->where('idGuia', $id );
		$this->db->update('Guia', $data); 
	}
	
	function updateCaracteristicas( $id )
	{
		$this->load->database();
		$data = array(
				'piezas' 			=> $this->input->post('piezas') 		== TRUE ? $this->input->post('piezas') 			: 'NULL',
				'peso' 				=> $this->input->post('peso') 			== TRUE ? $this->input->post('peso') 			: 'NULL',
				'medidas' 			=> $this->input->post('medidas') 		== TRUE ? $this->input->post('medidas') 		: 'NULL',
				'valorAgregado' 	=> $this->input->post('valorAgregado') 	== TRUE ? $this->input->post('valorAgregado') 	: 'NULL',
				'otro' 				=> $this->input->post('otrosDetalles') 	== TRUE ? $this->input->post('otrosDetalles') 	: 'NULL'
		);
		
		$this->db->where('idGuia', $id );
		$this->db->update('Caracteristicas', $data);
		
	}
	
	function status( $idGuia )
	{
		$this->load->database();
		$this->load->helper('url');
		
		$status = null;
		
		$query = $this->db->query( "SELECT idEstatusProceso FROM Guia where idGuia =$idGuia" );
		foreach( $query->result() as $sts ){
			 $status = $sts->idEstatusProceso;
		}
		
		$data = array('idGuia' => $idGuia);
		
		if($status == 1){ //alta 
			
			$this->load->view('recepcion', $data);
		}else if( $status == 2){ //recepcion
			
			$this->load->view('entrega', $data);
		}else if( $status == 3){ //entrega
			$this->load->view('reestablecer', $data);
		}
		
	}
	
	function recepcion()
	{
		$this->load->database();
		$this->load->helper('url');
		
		$idGuia = $this->input->post('idGuia');
		$data = array(
					'nombreRecibe' 	=> $this->input->post('nombreRecoge') 	== TRUE ? $this->input->post('nombreRecoge') 	: 'NULL',
					'fecha' 		=> $this->input->post('fecha') 			== TRUE ? $this->input->post('fecha') 			: 'NULL',
					'hora' 			=> $this->input->post('hora') 			== TRUE ? $this->input->post('hora') 			: 'NULL',
					'idGuia' 		=> $this->input->post('idGuia') 		== TRUE ? $idGuia					 			: 'NULL'
		);
		
		log_message('debug', '[STATUS => RECEPCION FOR GUIA WITH ID]' . $idGuia );
		$this->db->insert('Recepcion', $data);
		$this->updateStatusGuia( self::ESTATUS_PROCESO_RECEPCION, $idGuia );
		
	}
	
	function entrega()
	{
		$this->load->database();
		$this->load->helper('url');
		
		$idGuia = $this->input->post('idGuia');
		$data = array(
					'nombreEntrega' => $this->input->post('nombreEntrega') 	== TRUE ? $this->input->post('nombreEntrega') 	: 'NULL',
					'fecha' 		=> $this->input->post('fecha') 			== TRUE ? $this->input->post('fecha') 			: 'NULL',
					'hora' 			=> $this->input->post('hora') 			== TRUE ? $this->input->post('hora') 			: 'NULL',
					'idGuia' 		=> $this->input->post('idGuia') 		== TRUE ? $idGuia					 			: 'NULL'
		);
		
		log_message('debug', '[STATUS => ENTREGA FOR GUIA WITH ID]' . $idGuia );
		$this->db->insert('Entrega', $data);
		$this->updateStatusGuia( self::ESTATUS_PROCESO_ENTREGA, $idGuia );
	}
	
	function updateStatusGuia( $status, $idGuia )
	{
		$this->load->database();
		$this->load->helper('url');
		
		$data = array('idEstatusProceso' => $status );
		
		$this->db->where('idGuia', $idGuia );
		$this->db->update('Guia', $data );
		$this->load->view('statusSuccess');
	}
	
	function resetStatus( $idGuia )
	{
		$this->load->database();
		$this->load->helper('url');
		$status = null;
		
		
		log_message('debug', '[RESET STATUS FOR GUA WITH ID] ' . $idGuia);
		$query = $this->db->query( "SELECT idEstatusProceso FROM Guia where idGuia =$idGuia" );
		foreach( $query->result() as $sts ){
			 $status = (int)$sts->idEstatusProceso;
		}
		
		$data = array('idEstatusProceso' =>  --$status );
		
		$this->db->where('idGuia', $idGuia );
		$this->db->update('Guia', $data );
		$this->load->view('statusSuccess');
		
		$this->db->delete('Recepcion', array('idGuia' => $idGuia));
		
		
	}
	//helper methods
	function hasInstrucciones( $instructions )
	{
		if( is_bool($instructions[0]) ) { //empty instructions
			
			log_message('debug', '[HAS FUNCIONES] ' . 'FALSE');
			return false;
		}else {
			return true;			
			log_message('debug', '[HAS FUNCIONES] ' . 'TRUE');
		}
	}
	
	function hasClasificaciones( $clasificaciones )
	{
		if( is_bool($clasificaciones[0]) ){ //empty clasificaciones
			log_message('debug', '[HAS CLASIFICACIONES] ' . 'FALSE');
			return false;
		}else {
			log_message('debug', '[HAS CLASIFICACIONES] ' . 'TRUE');
			return true;
		}
	}
	
	function guiaHasInstruccionGuia( $id )
	{
		
	}
	
}
?>