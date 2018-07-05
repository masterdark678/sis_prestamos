<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cierre extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('prestamo_model');
			$this->load->model('cierre_model');
	}
	public function index(){
			redirect('cierre/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
		$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_cierre');
			$crud->set_subject('Cierre');
			$crud->set_language('spanish');
			$crud->display_as('monto','Monto');
			$crud->display_as('observaciones','Observaciones');
			$crud->display_as('fecha','Fecha');
			$crud->columns('monto','observaciones','fecha');
			$crud->required_fields('monto','observaciones','fecha');
			$crud->unset_edit();
			/*$crud->unset_delete();*/
			$output = $crud->render();
			$state = $crud->getState();
			if($state == 'add'){
			redirect('cierre/add_cierre');
			}
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
			$this->load->view('../../assets/inc/menu_superior',$data_usuario);
			$this->load->view('cierre/cierre',$output );
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
	public function add_cierre(){
			if ($this->session->userdata('logueado')) {
		$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Cliente');
			$output = $crud->render();
			$fecha=date('Y-m-d');
			$data = array('suma_pagos' =>$this->prestamo_model->sumar_pagos_por_fecha($fecha));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
			$this->load->view('../../assets/inc/menu_superior',$data_usuario);
			$this->load->view('cierre/add_cierre',$data );
			$this->load->view('../../assets/script/script_cierre_prestamo');
			$this->load->view('../../assets/inc/footer_common',$output);
			}else{
			$this->load->view('../../assets/inc/head_common_add', $output);
			$this->load->view('error/permiso');
			$this->load->view('../../assets/inc/footer_common_add',$output);		
			}
		}else{
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');

		}
	}
	public function guardar_cierre(){
		$monto=$this->input->post('txt_cobrado',TRUE);
		$monto_recibido=$this->input->post('txt_dinero_recibido',TRUE);
		$total=$this->input->post('txt_dinero_total',TRUE);
		$observaciones=$this->input->post('txt_observaciones',TRUE);
		$fecha=date('Y-m-d');
		$this->cierre_model->guardar_cierre($monto,$monto_recibido,$total,$observaciones,$fecha);
		$this->session->set_flashdata('alerta', 'Cierre Guardado');
		redirect('cierre/grilla','refresh');
	}


}