<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penalidad extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('penalidad/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_penalidad');
				$crud->set_subject('Penalidad');
				$crud->set_language('spanish');
				$crud->display_as('descripcion','penalidad');
				$crud->display_as('numero_dias_atraso','Dias de Atraso');
				$crud->columns('descripcion','numero_dias_atraso');
				$crud->required_fields('descripcion','numero_dias_atraso');
				/*$crud->unset_delete();*/
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('penalidad/penalidad',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			} elseif ($data_usuario['id_nivel']==3) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_penalidad');
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