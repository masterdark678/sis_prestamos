<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cliente extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->library('upload');
			$this->load->model('estado_cliente_model');
			$this->load->model('reputacion_model');
			$this->load->model('zona_model');
			$this->load->model('cliente_model');
			$this->load->model('cobrador_model');
			$this->load->model('documentacion_model');
	}
	public function index(){
			redirect('cliente/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_cliente');
					$crud->set_relation('id_tipo_estado_cliente','t_tipo_estado_cliente','descripcion');
					$crud->set_relation('id_reputacion','t_reputacion','descripcion');
					$crud->set_relation('id_cobrador','t_cobrador','nombre');
					$crud->set_relation('id_documentacion','t_documentacion_cliente','descripcion');
					$crud->set_subject('Cliente');
					$crud->set_language('spanish');
					$crud->display_as('id_tipo_estado_cliente','Estado');
					$crud->display_as('id_reputacion','Reputacion');
					$crud->display_as('id_cobrador','Cobrador');
					$crud->display_as('id_documentacion','Documentacion');
					$crud->display_as('dni','DNI');
					$crud->display_as('nombre','Nombre');
					$crud->display_as('nombre_negocio','Negocio');
					$crud->display_as('direccion','Direccion');
					$crud->display_as('direccion_cobro','Direccion');
					$crud->display_as('telf','Telf');
					$crud->display_as('email','Email');
					$crud->display_as('referencia_1','1 Referido');
					$crud->display_as('referencia_2','2 Referido');
					$crud->columns('dni','nombre','direccion','telf','email','id_reputacion');
					$crud->required_fields('dni','nombre','direccion','telf','email','id_cobrador','id_reputacion','id_documentacion');
					$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
					$crud->add_action('Ver Prestamos Asociados', '', '','fa fa-money',array($this,'fn_ver_prestamos'));
					$crud->add_action('Agregar Codeudor', '', '','fa fa-user',array($this,'fn_add_codeudor'));
					$crud->add_action('Cambiar Estado', '', '','fa fa-power-off',array($this,'fn_estado'));
					$crud->add_action('Cambiar Estado Documentacion', '', '','fa fa-file-text',array($this,'fn_documentacion'));
					$crud->add_action('Cambiar Cobrador', '', '','fa fa-arrows-h',array($this,'fn_cobrador'));
					$crud->add_action('Cambiar Reputacion', '', '','fa fa-star',array($this,'fn_reputacion'));
					$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'fn_editar'));
				/*	$crud->unset_delete();*/
					$crud->unset_read();
					$crud->unset_edit();
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('cliente/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',	$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',	$data_usuario);
					$this->load->view('cliente/cliente',$output );
					$this->load->view('../../assets/inc/footer_common',$output);

				} elseif ($data_usuario['id_nivel']==3) {
					$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_cliente');
					$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
					if (!$buscar_cobrador) {
						redirect('principal','refresh');
					}	
					foreach ($buscar_cobrador as $key) {
						$id_cobrador=$key->id;
					}
					$crud->where('t_cliente.id_cobrador',$id_cobrador);
					$crud->set_relation('id_tipo_estado_cliente','t_tipo_estado_cliente','descripcion');
					$crud->set_relation('id_reputacion','t_reputacion','descripcion');
					$crud->set_relation('id_cobrador','t_cobrador','nombre');
					$crud->set_relation('id_documentacion','t_documentacion_cliente','descripcion');
					$crud->set_subject('Cliente');
					$crud->set_language('spanish');
					$crud->display_as('id_tipo_estado_cliente','Estado');
					$crud->display_as('id_reputacion','Reputacion');
					$crud->display_as('id_cobrador','Cobrador');
					$crud->display_as('id_documentacion','Documentacion');
					$crud->display_as('dni','DNI');
					$crud->display_as('nombre','Nombre');
					$crud->display_as('nombre_negocio','Negocio');
					$crud->display_as('direccion','Direccion');
					$crud->display_as('direccion_cobro','Direccion');
					$crud->display_as('telf','Telf');
					$crud->display_as('email','Email');
					$crud->display_as('referencia_1','1 Referido');
					$crud->display_as('referencia_2','2 Referido');
					$crud->columns('dni','nombre','direccion','telf','email','id_cobrador','id_reputacion','id_documentacion');
					$crud->required_fields('dni','nombre','direccion','telf','email','id_cobrador','id_reputacion','id_documentacion');
					$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
					$crud->add_action('Ver Prestamos Asociados', '', '','fa fa-money',array($this,'fn_ver_prestamos'));
					$crud->add_action('Agregar Codeudor', '', '','fa fa-user',array($this,'fn_add_codeudor'));
					$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'fn_editar'));
					$crud->unset_delete();
					$crud->unset_read();
					$crud->unset_edit();
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('cliente/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_lateral_cobrador',	$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',	$data_usuario);
					$this->load->view('cliente/cliente',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
				
		}
	}
	function fn_ver($primary_key , $row){
		return site_url('cliente/ver').'/'.$row->id;
	}
	function fn_add_codeudor($primary_key , $row){
		return site_url('codeudor/add_codeudor').'/'.$row->id;
	}
	function fn_estado($primary_key , $row){
		return site_url('cliente/estado').'/'.$row->id;
	}
	function fn_cobrador($primary_key , $row){
		return site_url('cliente/cambiar_cobrador').'/'.$row->id;
	}
	function fn_reputacion($primary_key , $row){
		return site_url('cliente/cambiar_reputacion').'/'.$row->id;
	}
	function fn_editar($primary_key , $row){
		return site_url('cliente/editar').'/'.$row->id;
	}
	function fn_ver_prestamos($primary_key , $row){
		return site_url('prestamo/grilla_cliente_general').'/'.$row->id;
	}
	function fn_documentacion($primary_key , $row){
		return site_url('cliente/cambiar_documentacion').'/'.$row->id;
	}
	public function add(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
					'nombre_usuario'=>$this->session->userdata('nombre'),
					'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 ||$data_usuario['id_nivel']==2) {

					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_cliente');
					$crud->set_subject('Cliente');
					$output = $crud->render();
					$data = array('estado_cliente' =>$this->estado_cliente_model->get_estado_cliente() ,
					'reputacion'=>$this->reputacion_model->get_reputacion(),
					'cobrador'=>$this->cobrador_model->get_cobrador(),
					'documentacion'=>$this->documentacion_model->get_documentacion());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('cliente/add',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);

			} elseif ($data_usuario['id_nivel']==3) {

					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_cliente');
					$crud->set_subject('Cliente');
					$output = $crud->render();
					$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
					foreach ($buscar_cobrador as $key) {
					$id_cobrador=$key->id;
					
					}
					$data = array('estado_cliente' =>$this->estado_cliente_model->get_estado_cliente() ,
					'reputacion'=>$this->reputacion_model->get_reputacion(),
					'id_cobrador'=>$id_cobrador,
					'documentacion'=>$this->documentacion_model->get_documentacion());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('cliente/add_cliente_x_cobrador_logueado.php',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);
		} 
		} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
				}
		
	}
	

	public function guardar_cliente(){
		if ($this->session->userdata('logueado')) {
						$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
								'nombre_usuario'=>$this->session->userdata('nombre'),
								'id_nivel'=>$this->session->userdata('id_nivel'));
						if ($data_usuario['id_nivel']==1 ||$data_usuario['id_nivel']==2) {
								$id_tipo_estado_cliente=$this->input->post('txt_estado_cliente',TRUE);
		$id_reputacion='1';
		$id_cobrador=$this->input->post('id_cobrador',TRUE);
		$id_documentacion=$this->input->post('id_documentacion',TRUE);
		$dni=$this->input->post('txt_dni',TRUE);
		$nombre=$this->input->post('txt_nombre',TRUE);
		$nombre_negocio=$this->input->post('txt_nombre_negocio',TRUE);
		$direccion=$this->input->post('txt_direccion',TRUE);
		$direccion_cobro=$this->input->post('txt_direccion_cobro',TRUE);
		$telf=$this->input->post('txt_telf',TRUE);
		$email=$this->input->post('txt_email',TRUE);
		$referencia_1=$this->input->post('txt_referido_1',TRUE);
		$referencia_2=$this->input->post('txt_referido_2',TRUE);
		$adjunto='mi_archivo_1';
		if ($id_cobrador==null || $id_documentacion==null || $dni==null || $nombre==null || $nombre_negocio==null || $direccion==null || $direccion_cobro==null || $telf==null){
						$this->session->set_flashdata('alerta', 'Debe Ingresar los datos de los registros');
						redirect('cliente/grilla','refresh');
		}
			/***********adjunto***************/
			if (!empty($_FILES['mi_archivo_1']['name'])) {
						$config['upload_path'] = "./assets/img";
						$config['allowed_types'] = "*";
						$config['max_size'] = "0";
						$config['max_width'] = "0";
						$config['max_height'] = "0";
						$config['remove_spaces']=TRUE;
						$config['overwrite'] = true;
						$this->upload->initialize($config);
					if ($this->upload->do_upload('mi_archivo_1')){
					
						echo $this->upload->display_errors();
					
						$data= $this->upload->data();
						$archivo=$data['file_name'];
					
						
						}else{
						echo "llega al else";
						echo $this->upload->display_errors();
						$archivo='user.png';
						exit();

						}
				}else{
					$archivo="user.png";
				}

				
			
			/*********************************/
		$this->cliente_model->guardar_cliente($id_tipo_estado_cliente,$id_reputacion,$id_cobrador,$id_documentacion,$dni,$nombre,$nombre_negocio,$direccion,$direccion_cobro,$telf,$email,$referencia_1,$referencia_2,$archivo);
		$this->session->set_flashdata('alerta', 'Cliente Guardado Correctamente');
		redirect('cliente/grilla','refresh');
						} elseif ($data_usuario['id_nivel']==3) {
								$id_tipo_estado_cliente=$this->input->post('txt_estado_cliente',TRUE);
								$id_reputacion='1';
								$id_cobrador=$this->input->post('txt_id_cobrador',TRUE);
								$id_documentacion=$this->input->post('id_documentacion',TRUE);
								$dni=$this->input->post('txt_dni',TRUE);
								$nombre=$this->input->post('txt_nombre',TRUE);
								$nombre_negocio=$this->input->post('txt_nombre_negocio',TRUE);
								$direccion=$this->input->post('txt_direccion',TRUE);
								$direccion_cobro=$this->input->post('txt_direccion_cobro',TRUE);
								$telf=$this->input->post('txt_telf',TRUE);
								$email=$this->input->post('txt_email',TRUE);
								$referencia_1=$this->input->post('txt_referido_1',TRUE);
								$referencia_2=$this->input->post('txt_referido_2',TRUE);
								$adjunto='mi_archivo_1';
							if (!$adjunto) {
								$archivo=null;
							}
								/***********adjunto***************/
							if (!empty($_FILES['mi_archivo_1']['name'])) {
						$config['upload_path'] = "./assets/img";
						$config['allowed_types'] = "*";
						$config['max_size'] = "0";
						$config['max_width'] = "0";
						$config['max_height'] = "0";
						$config['remove_spaces']=TRUE;
						$config['overwrite'] = true;
						$this->upload->initialize($config);
					if ($this->upload->do_upload('mi_archivo_1')){
						$data= $this->upload->data();
						$archivo=$data['file_name'];
						}else{
						echo $this->upload->display_errors();
						$archivo=null;
						}
				}else{
					$archivo="user.png";
				}
								/*********************************/
								$this->cliente_model->guardar_cliente($id_tipo_estado_cliente,$id_reputacion,$id_cobrador,$id_documentacion,$dni,$nombre,$nombre_negocio,$direccion,$direccion_cobro,$telf,$email,$referencia_1,$referencia_2,$archivo);
								$this->session->set_flashdata('alerta', 'Cliente Guardado Correctamente');
								redirect('cliente/grilla','refresh');
						}
					}else {
					$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
				} 
		}
	
		public function editar(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
								'nombre_usuario'=>$this->session->userdata('nombre'),
								'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_cliente');
					$crud->set_subject('Cliente');
					$output = $crud->render();
					$id_cliente=$this->uri->segment(3);
					if ($id_cliente==null) {
					$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
					redirect('cliente/grilla','refresh');
					}
					$buscar_cliente=$this->cliente_model->get_cliente_id($id_cliente);
					if ($buscar_cliente) {
					$data = array('cliente' =>$buscar_cliente);
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('cliente/editar',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);
					}else{
					$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
					redirect('cliente/grilla','refresh');
					}
			} elseif ($data_usuario['id_nivel']==3) {

				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_cliente');
				$crud->set_subject('Cliente');
				$output = $crud->render();
				$id_cliente=$this->uri->segment(3);
		if ($id_cliente==null) {
				$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
				redirect('cliente/grilla','refresh');
		}
				$buscar_cliente=$this->cliente_model->get_cliente_id($id_cliente);
		if ($buscar_cliente) {
				$data = array('cliente' =>$buscar_cliente);
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('cliente/editar',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
		}else{
				$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
			redirect('cliente/grilla','refresh');
		}
				
				
			}
			
		} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
		}
	}

		public function actualizar_cliente(){
		if ($this->session->userdata('logueado')) {
						$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
								'nombre_usuario'=>$this->session->userdata('nombre'),
								'id_nivel'=>$this->session->userdata('id_nivel'));
						if ($data_usuario['id_nivel']==1 ||$data_usuario['id_nivel']==2) {
								$id_tipo_estado_cliente=$this->input->post('txt_estado_cliente',TRUE);
		$id_cliente=$this->input->post('txt_id_cliente',TRUE);
		$dni=$this->input->post('txt_dni',TRUE);
		$nombre=$this->input->post('txt_nombre',TRUE);
		$nombre_negocio=$this->input->post('txt_nombre_negocio',TRUE);
		$direccion=$this->input->post('txt_direccion',TRUE);
		$direccion_cobro=$this->input->post('txt_direccion_cobro',TRUE);
		$telf=$this->input->post('txt_telf',TRUE);
		$email=$this->input->post('txt_email',TRUE);
		$referencia_1=$this->input->post('txt_referido_1',TRUE);
		$referencia_2=$this->input->post('txt_referido_2',TRUE);
		$adjunto='mi_archivo_1';
		if ($dni==null || $nombre==null || $nombre_negocio==null || $direccion==null || $direccion_cobro==null || $telf==null){
						$this->session->set_flashdata('alerta', 'Debe Ingresar los datos de los registros');
						redirect('cliente/grilla','refresh');
		}
			

				
			
			/*********************************/
		$this->cliente_model->actualizar_cliente($id_cliente,$dni,$nombre,$nombre_negocio,$direccion,$direccion_cobro,$telf,$email,$referencia_1,$referencia_2);
		$this->session->set_flashdata('alerta', 'Cliente Actualizado Correctamente');
		redirect('cliente/grilla','refresh');
						} elseif ($data_usuario['id_nivel']==3) {
							$id_cliente=$this->input->post('txt_id_cliente',TRUE);
		$dni=$this->input->post('txt_dni',TRUE);
		$nombre=$this->input->post('txt_nombre',TRUE);
		$nombre_negocio=$this->input->post('txt_nombre_negocio',TRUE);
		$direccion=$this->input->post('txt_direccion',TRUE);
		$direccion_cobro=$this->input->post('txt_direccion_cobro',TRUE);
		$telf=$this->input->post('txt_telf',TRUE);
		$email=$this->input->post('txt_email',TRUE);
		$referencia_1=$this->input->post('txt_referido_1',TRUE);
		$referencia_2=$this->input->post('txt_referido_2',TRUE);
		$adjunto='mi_archivo_1';
		if ($dni==null || $nombre==null || $nombre_negocio==null || $direccion==null || $direccion_cobro==null || $telf==null){
						$this->session->set_flashdata('alerta', 'Debe Ingresar los datos de los registros');
						redirect('cliente/grilla','refresh');
		}
			/*********************************/
		$this->cliente_model->actualizar_cliente($id_cliente,$dni,$nombre,$nombre_negocio,$direccion,$direccion_cobro,$telf,$email,$referencia_1,$referencia_2);
								$this->session->set_flashdata('alerta', 'Cliente Guardado Correctamente');
								redirect('cliente/grilla','refresh');
						}
					}else {
					$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
				} 
		}

	public function ver(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
								'nombre_usuario'=>$this->session->userdata('nombre'),
								'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_cliente');
					$crud->set_subject('Cliente');
					$output = $crud->render();
					$id_cliente=$this->uri->segment(3);
					if ($id_cliente==null) {
					$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
					redirect('cliente/grilla','refresh');
					}
					$buscar_cliente=$this->cliente_model->get_cliente_id($id_cliente);
					if ($buscar_cliente) {
					$data = array('cliente' =>$buscar_cliente);
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('cliente/ver',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);
					}else{
					$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
					redirect('cliente/grilla','refresh');
					}
				
				
			} elseif ($data_usuario['id_nivel']==3) {

				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_cliente');
				$crud->set_subject('Cliente');
				$output = $crud->render();
				$id_cliente=$this->uri->segment(3);
		if ($id_cliente==null) {
				$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
				redirect('cliente/grilla','refresh');
		}
				$buscar_cliente=$this->cliente_model->get_cliente_id($id_cliente);
		if ($buscar_cliente) {
				$data = array('cliente' =>$buscar_cliente);
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('cliente/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
		}else{
				$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
			redirect('cliente/grilla','refresh');
		}
				
				
			}
			
		} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
		}
	}
	public function estado(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
								'nombre_usuario'=>$this->session->userdata('nombre'),
								'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_cliente');
			$crud->set_subject('Cliente');
		$output = $crud->render();
		$id_cliente=$this->uri->segment(3);
		if ($id_cliente==null) {
		$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
		redirect('cliente/grilla','refresh');
		}
		$buscar_cliente=$this->cliente_model->get_cliente_id($id_cliente);
		if ($buscar_cliente) {
		$data = array('cliente' =>$buscar_cliente,
			'estado_cliente'=>$this->estado_cliente_model->get_estado_cliente());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
		$this->load->view('../../assets/inc/menu_superior',$data_usuario);
		$this->load->view('cliente/estado_cliente',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
		}else{
			$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
		redirect('cliente/grilla','refresh');
		}
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_cliente');
				$crud->set_subject('Cliente');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('error/permiso');
				$this->load->view('../../assets/inc/footer_common_add',$output);
				
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
		}
		
	}

	public function cambiar_cobrador(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_cliente');
		$crud->set_subject('Cliente');
		$output = $crud->render();
		$id_cliente=$this->uri->segment(3);
		if ($id_cliente==null) {
		$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
		redirect('cliente/grilla','refresh');
		}
		$buscar_cliente=$this->cliente_model->get_cliente_id($id_cliente);
		if ($buscar_cliente) {
		$data = array(
			'cliente' =>$buscar_cliente,
			'cobrador'=>$this->cobrador_model->get_cobrador());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
		$this->load->view('../../assets/inc/menu_superior',$data_usuario);
		$this->load->view('cliente/cobrador_cliente',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
		}else{
			$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
		redirect('cliente/grilla','refresh');
		}

			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_cliente');
		$crud->set_subject('Cliente');
		$output = $crud->render();		
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('error/permiso');
		$this->load->view('../../assets/inc/footer_common_add',$output);
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
		}
		
	}
	public function cambiar_documentacion(){
	if ($this->session->userdata('logueado')) {
		$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

					if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
							$crud = new grocery_CRUD();
							$crud->set_theme('bootstrap');
							$crud->set_table('t_cliente');
							$crud->set_subject('Cliente');
							$output = $crud->render();
							$id_cliente=$this->uri->segment(3);
							if ($id_cliente==null) {
							$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
							redirect('cliente/grilla','refresh');
							}
							$buscar_cliente=$this->cliente_model->get_cliente_id($id_cliente);
							if ($buscar_cliente) {
							$data = array(
							'cliente' =>$buscar_cliente,
							'documentacion'=>$this->documentacion_model->get_documentacion());
							$this->load->view('../../assets/inc/head_common_add', $output);
							$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
							$this->load->view('../../assets/inc/menu_superior',$data_usuario);
							$this->load->view('cliente/documentacion_cliente',$data);
							$this->load->view('../../assets/inc/footer_common_add',$output);
					}else{
						$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
					redirect('cliente/grilla','refresh');
					}
						} elseif ($data_usuario['id_nivel']==3) {
								$crud = new grocery_CRUD();
								$crud->set_theme('bootstrap');
								$crud->set_table('t_cliente');
								$crud->set_subject('Cliente');
								$output = $crud->render();
								$this->load->view('../../assets/inc/head_common_add', $output);
								$this->load->view('error/permiso');
								$this->load->view('../../assets/inc/footer_common_add',$output);		
						}
				} else {
					$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
							redirect('login/index','refresh');
			}
	}
	public function cambiar_reputacion(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
						if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
							$crud = new grocery_CRUD();
							$crud->set_theme('bootstrap');
							$crud->set_table('t_cliente');
							$crud->set_subject('Cliente');
							$output = $crud->render();
							$id_cliente=$this->uri->segment(3);
							if ($id_cliente==null) {
							$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
							redirect('cliente/grilla','refresh');
							}
							$buscar_cliente=$this->cliente_model->get_cliente_id($id_cliente);
							if ($buscar_cliente) {
							$data = array('cliente' =>$buscar_cliente,
							'reputacion'=>$this->reputacion_model->get_reputacion());
							$this->load->view('../../assets/inc/head_common_add', $output);
							$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
							$this->load->view('../../assets/inc/menu_superior',$data_usuario);
							$this->load->view('cliente/reputacion_cliente',$data);
							$this->load->view('../../assets/inc/footer_common_add',$output);
							}else{
							$this->session->set_flashdata('alerta', 'Seleccione Un Registro');
							redirect('cliente/grilla','refresh');
							}
			
						} elseif ($data_usuario['id_nivel']==3) {

							$crud = new grocery_CRUD();
							$crud->set_theme('bootstrap');
							$crud->set_table('t_cliente');
							$crud->set_subject('Cliente');
							$output = $crud->render();
							$this->load->view('../../assets/inc/head_common_add', $output);
							$this->load->view('error/permiso',$data);
							$this->load->view('../../assets/inc/footer_common_add',$output);
							
						}

		} else {
					$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
							redirect('login/index','refresh');
		}
		
	}
	public function actualizar_estado_cliente(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
						if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
								$id_cliente=$this->input->post('txt_id_cliente',TRUE);
								if ($id_cliente) {
								$id_tipo_estado_cliente=$this->input->post('id_estado_cliente',TRUE);
						if ($id_cliente==null || $id_tipo_estado_cliente==null) {
										$this->session->set_flashdata('alerta', 'Debe seleccionar el estado del cliente');
										redirect('cliente/grilla','refresh');
						}
								$this->cliente_model->actualizar_estado_cliente($id_cliente, $id_tipo_estado_cliente);
								$this->session->set_flashdata('alerta', 'Estado Actualizado');
								redirect('cliente/grilla','refresh');
								}else{
								$this->session->set_flashdata('alerta', 'Seleccione un Cliente');
								redirect('cliente/grilla','refresh');
								}
								} elseif ($data_usuario['id_nivel']==3) {
										$crud = new grocery_CRUD();
										$crud->set_theme('bootstrap');
										$crud->set_table('t_cliente');
										$crud->set_subject('Cliente');
										$output = $crud->render();
										$this->load->view('../../assets/inc/head_common_add', $output);
										$this->load->view('error/permiso');
										$this->load->view('../../assets/inc/footer_common_add',$output);
								}
		} else {
							$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
							redirect('login/index','refresh');
		}
		
	}
	public function actualizar_cobrador(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
						if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
							$id_cliente=$this->input->post('txt_id_cliente',TRUE);
							if ($id_cliente) {
							$id_cobrador=$this->input->post('id_cobrador',TRUE);
							if ($id_cobrador==null) {
								$this->session->set_flashdata('alerta', 'Debe seleccionar el Cobrador');
											redirect('cliente/grilla','refresh');
							}
							$this->cliente_model->actualizar_cobrador_cliente($id_cliente, $id_cobrador);
							$this->session->set_flashdata('alerta', 'Cobrador Actualizado');
							redirect('cliente/grilla','refresh');
							}else{
							$this->session->set_flashdata('alerta', 'Seleccione un Cliente');
							redirect('cliente/grilla','refresh');
							}
						} elseif ($data_usuario['id_nivel']==3) {
								$crud = new grocery_CRUD();
								$crud->set_theme('bootstrap');
								$crud->set_table('t_cliente');
								$crud->set_subject('Cliente');
								$output = $crud->render();
								$this->load->view('../../assets/inc/head_common_add', $output);
								$this->load->view('error/permiso');
								$this->load->view('../../assets/inc/footer_common_add',$output);
			}

		} else {
					$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
							redirect('login/index','refresh');
		}
		
	}
	public function actualizar_reputacion(){
		 if ($this->session->userdata('logueado')) {
		 	$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		 		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
							
							$id_cliente=$this->input->post('txt_id_cliente',TRUE);
							if ($id_cliente) {
							$id_reputacion=$this->input->post('id_reputacion',TRUE);
					if ($id_reputacion==null) {
							$this->session->set_flashdata('alerta', 'Debe seleccionar Una reputacion');
								redirect('cliente/grilla','refresh');
							}
							$this->cliente_model->actualizar_reputacion_cliente($id_cliente, $id_reputacion);
							$this->session->set_flashdata('alerta', 'Reputacion Actualizada');
							redirect('cliente/grilla','refresh');
							}else{
							$this->session->set_flashdata('alerta', 'Seleccione un Cliente');
							redirect('cliente/grilla','refresh');
							}
						} elseif ($data_usuario['id_nivel']==3) {

								$crud = new grocery_CRUD();
								$crud->set_theme('bootstrap');
								$crud->set_table('t_cliente');
								$crud->set_subject('Cliente');
								$output = $crud->render();
								$this->load->view('../../assets/inc/head_common_add', $output);
								$this->load->view('error/permiso');
								$this->load->view('../../assets/inc/footer_common_add',$output);
						}
		 } else {
		 		$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
							redirect('login/index','refresh');
		 }
		 
	}
	public function actualizar_documentacion(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
					if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
						$id_cliente=$this->input->post('txt_id_cliente',TRUE);
						if ($id_cliente) {
						$id_documentacion=$this->input->post('id_documentacion',TRUE);
					if ($id_documentacion==null) {
						$this->session->set_flashdata('alerta', 'Debe Seleccionar una Documentacion');
						redirect('cliente/grilla','refresh');
					}
						$this->cliente_model->actualizar_documentacion_cliente($id_cliente, $id_documentacion);
						$this->session->set_flashdata('alerta', 'Documentacion Actualizada');
						redirect('cliente/grilla','refresh');
						}else{
						$this->session->set_flashdata('alerta', 'Seleccione un Cliente');
						redirect('cliente/grilla','refresh');
						}
					} elseif ($data_usuario['id_nivel']==3) {
							$crud = new grocery_CRUD();
							$crud->set_theme('bootstrap');
							$crud->set_table('t_cliente');
							$crud->set_subject('Cliente');
							$output = $crud->render();
							$this->load->view('../../assets/inc/head_common_add', $output);
							$this->load->view('error/permiso');
							$this->load->view('../../assets/inc/footer_common_add',$output);
					}
		} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
							redirect('login/index','refresh');
		}
		
	}

}


/* fin de Controller :-D*/