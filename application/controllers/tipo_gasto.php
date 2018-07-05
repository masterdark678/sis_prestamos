<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tipo_gasto extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('tipo_gasto/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_tipo_gasto');
				$crud->set_subject('Tipo de Gasto');
				$crud->set_language('spanish');
				$crud->display_as('descripcion','Tipo de Gasto');
				$crud->columns('descripcion');
				$crud->required_fields('descripcion');
			/*	$crud->unset_delete();*/
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('tipo_gasto/tipo_gasto',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_tipo_gasto');
				$crud->set_subject('Tipo de Gasto');
				$crud->set_language('spanish');
				$crud->display_as('descripcion','Tipo de Gasto');
				$crud->columns('descripcion');
				$crud->required_fields('descripcion');
				$crud->unset_delete();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('tipo_gasto/tipo_gasto',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}
		
		
		
	}
}