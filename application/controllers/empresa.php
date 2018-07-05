<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empresa extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('empresa/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_empresa');
				$crud->set_subject('Empresa');
				$crud->set_language('spanish');
				$crud->display_as('nombre','Nombre');
				$crud->display_as('dni','DNI');
				$crud->display_as('direccion','Direccion');
				$crud->display_as('telf','Telf');
				$crud->display_as('email','Email');
				$crud->columns('nombre','dni','direccion','telf','email');
				$crud->required_fields('nombre','dni','direccion','telf','email');
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('empresa/empresa',$output );
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

}