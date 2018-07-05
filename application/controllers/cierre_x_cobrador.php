<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cierre_x_cobrador extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('cobrador_model');
			$this->load->model('prestamo_model');
			$this->load->model('cierre_x_cobrador_model');
			$this->load->model('gasto_model');
	}
	public function index(){
			redirect('cierre_x_cobrador/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
		$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_cierre_x_cobrador');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_subject('Cierre x cobrador');
			$crud->set_language('spanish');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('monto_cobrado','Monto Cobrado');
			$crud->display_as('monto_entregado','Monto entregado');
			$crud->display_as('fecha','Fecha');
			$crud->columns('id_cobrador','monto_cobrado','monto_entregado','fecha');
			$crud->required_fields('id_cobrador','monto_cobrado','monto_entregado','fecha');
			$crud->unset_edit();
			/*$crud->unset_delete();*/
			$output = $crud->render();
			$state = $crud->getState();
			if($state == 'add'){
			redirect('cierre_x_cobrador/add');
			}

			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
			$this->load->view('../../assets/inc/menu_superior',$data_usuario);
			$this->load->view('cierre_x_cobrador/cierre_x_cobrador',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
		
		} elseif ($data_usuario['id_nivel']==3) {
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
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

	public function add(){
		if ($this->session->userdata('logueado')) {
		$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$data = array('cobrador' =>$this->cobrador_model->get_cobrador());
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Cliente');
			$output = $crud->render();
			$this->load->view('../../assets/inc/head_common_add_modal', $output);
			$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
			$this->load->view('../../assets/inc/menu_superior',$data_usuario);
			$this->load->view('modal/modal_cobrador',$data );
			$this->load->view('cierre_x_cobrador/add',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
			}else{
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_empresa');
				$crud->set_subject('Cliente');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('error/permiso');
				$this->load->view('../../assets/inc/footer_common_add',$output);		

			}
		}else{
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
		}
	}
	
		public function add_cierre(){
				if ($this->session->userdata('logueado')) {
		$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$id_cobrador=$this->input->post('id_cobrador',TRUE);
			$fecha=date('Y-m-d');
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Cliente');
			$output = $crud->render();
			$data = array('prestamo_x_cobrador' =>$this->prestamo_model->sumar_pagos_cierre_x_cobrador($id_cobrador,$fecha),
				'gasto_x_cobrador'=>$this->gasto_model->sumar_gasto_cobrador($id_cobrador,$fecha),
				'buscar_cobros'=>$this->prestamo_model->get_pagos_x_cobrador($id_cobrador,$fecha),
				'cobrador'=>$this->cobrador_model->get_cobrador_id($id_cobrador));
			$this->load->view('../../assets/inc/head_common_add', $output);
			$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
			$this->load->view('../../assets/inc/menu_superior',$data_usuario);
			$this->load->view('cierre_x_cobrador/guardar_cierre_x_cobrador',$data);
			$this->load->view('../../assets/script/script_cierre_prestamo');
			$this->load->view('../../assets/inc/footer_common',$output);
		}else{
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_empresa');
				$crud->set_subject('Cliente');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('error/permiso');
				$this->load->view('../../assets/inc/footer_common_add',$output);		
			}
		}
	}
	public function guardar_cierre(){
		$id_cobrador=$this->input->post('txt_id_cobrador',TRUE);
		$dinero_cobrado=$this->input->post('txt_cobrado',TRUE);
		$dinero_recibido=$this->input->post('txt_dinero_recibido',TRUE);
		$dinero_total=$this->input->post('txt_dinero_total',TRUE);
		$fecha=date('Y-m-d');
		$observaciones=$this->input->post('txt_observaciones',TRUE);
		$this->cierre_x_cobrador_model->guardar_cierre_x_cobrador($id_cobrador,$dinero_cobrado,$dinero_recibido,$dinero_total,$observaciones,$fecha);
		$this->session->set_flashdata('alerta', 'Cierre Guardado Automaticamente');
		redirect('cierre_x_cobrador','refresh');
	}





/*fin del controller*/
}