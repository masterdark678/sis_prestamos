<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Capital extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('socio_model');
			$this->load->model('capital_model');
	}
		public function index(){
				redirect('capital/grilla');
			}
		public function grilla(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_capital');
				$crud->set_subject('Capital');
				$crud->set_language('spanish');
				$crud->display_as('capital','Capital');
				$crud->add_action('Ver Detalle Capital', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->add_action('Sumar capital', '', '','fa fa-plus',array($this,'fn_add'));
				$crud->add_action('Restar capital', '', '','fa fa-minus',array($this,'fn_resta'));
				$crud->columns('capital');
				$crud->required_fields('capital');
				/*	$crud->unset_delete();*/
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('capital/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('capital/capital',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
				
				
			} elseif ($data_usuario['id_nivel']==2) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_capital');
					$crud->set_subject('Capital');
					$crud->set_language('spanish');
					$crud->display_as('capital','Capital');
					$crud->add_action('Ver Detalle Capital', '', '','fa fa-eye',array($this,'fn_ver'));
					$crud->add_action('Sumar capital', '', '','fa fa-plus',array($this,'fn_add'));
					$crud->add_action('Restar capital', '', '','fa fa-minus',array($this,'fn_resta'));
					$crud->columns('capital');
					$crud->required_fields('capital');
					/*	$crud->unset_delete();*/
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('capital/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('capital/capital',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
				
				
			} elseif ($data_usuario['id_nivel']==3) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_capital');
					$crud->set_subject('Capital');
					$crud->set_language('spanish');
					$crud->display_as('capital','Capital');
					$crud->add_action('Ver Detalle Capital', '', '','fa fa-eye',array($this,'fn_ver'));
					$crud->add_action('Sumar capital', '', '','fa fa-plus',array($this,'fn_add'));
					$crud->add_action('Restar capital', '', '','fa fa-minus',array($this,'fn_resta'));
					$crud->columns('capital');
					$crud->required_fields('capital');
					/*	$crud->unset_delete();*/
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('capital/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('error/permiso',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
			}
				}else{
					$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
				}
			
		}
		function fn_ver($primary_key , $row){
		return site_url('capital/ver').'/'.$row->id;
		}
		function fn_add($primary_key , $row){
		return site_url('capital/add').'/'.$row->id;
		}
		function fn_resta($primary_key , $row){
		return site_url('capital/restar_capital').'/'.$row->id;
		}
		public function add(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array(
					'id_usuario' =>$this->session->userdata('id'),
					'nombre_usuario'=>$this->session->userdata('nombre'),
					'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_det_capital');
					$crud->set_subject('Capital');
					$output = $crud->render();
					$data = array(
					'socio' =>$this->socio_model->get_socio());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('capital/add',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);
					} elseif ($data_usuario['id_nivel']==2) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_det_capital');
						$crud->set_subject('Capital');
						$output = $crud->render();
						$data = array(
						'socio' =>$this->socio_model->get_socio());
						$this->load->view('../../assets/inc/head_common_add', $output);
						$this->load->view('../../assets/inc/menu_lateral_admin');
						$this->load->view('../../assets/inc/menu_superior');
						$this->load->view('capital/add',$data);
						$this->load->view('../../assets/inc/footer_common_add',$output);
					} elseif ($data_usuario['id_nivel']==3) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_det_capital');
						$crud->set_subject('Capital');
						$output = $crud->render();
						$data = array(
						'socio' =>$this->socio_model->get_socio());
						$this->load->view('../../assets/inc/head_common_add', $output);
						$this->load->view('error/permiso',$data);
						$this->load->view('../../assets/inc/footer_common_add',$output);
			}
			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
			
			}
			
		}
		public function restar_capital(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
					if ($data_usuario['id_nivel']==1) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_det_capital');
						$crud->set_subject('Capital');
						$output = $crud->render();
						$data = array(
						'socio' =>$this->socio_model->get_socio());
						$this->load->view('../../assets/inc/head_common_add', $output);
						$this->load->view('../../assets/inc/menu_lateral_admin');
						$this->load->view('../../assets/inc/menu_superior');
						$this->load->view('capital/resta',$data);
						$this->load->view('../../assets/inc/footer_common_add',$output);
					} elseif ($data_usuario['id_nivel']==2) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_det_capital');
						$crud->set_subject('Capital');
						$output = $crud->render();
						$data = array(
						'socio' =>$this->socio_model->get_socio());
						$this->load->view('../../assets/inc/head_common_add', $output);
						$this->load->view('../../assets/inc/menu_lateral_admin');
						$this->load->view('../../assets/inc/menu_superior');
						$this->load->view('capital/resta',$data);
						$this->load->view('../../assets/inc/footer_common_add',$output);
					} elseif ($data_usuario['id_nivel']==3) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_det_capital');
						$crud->set_subject('Capital');
						$output = $crud->render();
						$data = array(
						'socio' =>$this->socio_model->get_socio());
						$this->load->view('../../assets/inc/head_common_add', $output);
						$this->load->view('error/permiso',$data);
						$this->load->view('../../assets/inc/footer_common_add',$output);
				}
			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
			}
			
		}
		/**************ESTA PARTE ES EL DETALLE DE CAPITAL**********************/
		public function ver(){
			$id_capital=$this->uri->segment(3);
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1) {
					if (!$id_capital) {
						redirect('capital/grilla','refresh');
					}
			
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_det_capital');
					$crud->where('id_capital',$id_capital);
					$crud->set_subject('Detalle Capital');
					$crud->set_language('spanish');
					$crud->set_relation('id_socio','t_socio','nombre');
					$crud->display_as('id_socio','Socio');
					$crud->display_as('descripcion','Descripcion');
					$crud->display_as('capital','Capital');
					$crud->columns('id_socio','descripcion','capital');
					$crud->required_fields('id_socio','descripcion','capital');
					$crud->unset_delete();
					$crud->unset_add();
					$crud->unset_edit();
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('capital/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('capital/det_capital',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
			} elseif ($data_usuario['id_nivel']==2) {
					if (!$id_capital) {
					redirect('capital/grilla','refresh');
			}
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_det_capital');
					$crud->where('id_capital',$id_capital);
					$crud->set_subject('Detalle Capital');
					$crud->set_language('spanish');
					$crud->set_relation('id_socio','t_socio','nombre');
					$crud->display_as('id_socio','Socio');
					$crud->display_as('descripcion','Descripcion');
					$crud->display_as('capital','Capital');
					$crud->columns('id_socio','descripcion','capital');
					$crud->required_fields('id_socio','descripcion','capital');
					$crud->unset_delete();
					$crud->unset_add();
					$crud->unset_edit();
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('capital/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('capital/det_capital',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
			} elseif ($data_usuario['id_nivel']==3) {
					if (!$id_capital) {
				redirect('capital/grilla','refresh');
			}
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_det_capital');
					$crud->where('id_capital',$id_capital);
					$crud->set_subject('Detalle Capital');
					$crud->set_language('spanish');
					$crud->set_relation('id_socio','t_socio','nombre');
					$crud->display_as('id_socio','Socio');
					$crud->display_as('descripcion','Descripcion');
					$crud->display_as('capital','Capital');
					$crud->columns('id_socio','descripcion','capital');
					$crud->required_fields('id_socio','descripcion','capital');
					$crud->unset_delete();
					$crud->unset_add();
					$crud->unset_edit();
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('capital/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('error/permiso',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
			}
			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}
		}
		/*****************************************************/

		public function guardar_capital_inicial(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
					$id_socio=$this->input->post('id_socio',TRUE);
					$descripcion=$this->input->post('txt_descripcion',TRUE);
					$capital_inicial=$this->input->post('txt_capital_inicial',TRUE);
					$buscar_capital=$this->capital_model->get_capital();
					if ($buscar_capital) {
					foreach ($buscar_capital as $key) {
					$id_capital=$key->id;
					$capital_anterior=$key->capital;
					}
					$nuevo_capital=$capital_anterior+$capital_inicial;
					$this->capital_model->guardar_det_capital($id_capital,$id_socio,$descripcion,$capital_inicial);
					$this->capital_model->actualizar_capital($id_capital,$nuevo_capital);
					redirect('capital/grilla','refresh');
					}else{
					$this->capital_model->guardar_capital_inicial($capital_inicial);
					$buscar_capital=$this->capital_model->get_capital();
					foreach ($buscar_capital as $key) {
					$id_capital=$key->id;
					$capital_anterior=$key->capital;
					}
					$this->capital_model->guardar_det_capital($id_capital,$id_socio,$descripcion,$capital_inicial);
					redirect('capital/grilla','refresh');
					}
				
				} elseif ($data_usuario['id_nivel']==3) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_det_capital');
						$crud->where('id_capital',$id_capital);
						$crud->unset_delete();
						$output = $crud->render();
						$state = $crud->getState();
						$this->load->view('../../assets/inc/head_common', $output);
						$this->load->view('error/permiso',$output );
						$this->load->view('../../assets/inc/footer_common',$output);
				}
			} else {
					$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
			}
			
			
		}
		public function guardar_restar_capital(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$id_socio=$this->input->post('id_socio',TRUE);
				$descripcion=$this->input->post('txt_descripcion',TRUE);
				$capital_inicial=$this->input->post('txt_capital_inicial',TRUE);
				$buscar_capital=$this->capital_model->get_capital();
				if ($buscar_capital) {
				foreach ($buscar_capital as $key) {
				$id_capital=$key->id;
				$capital_anterior=$key->capital;
				}
				$nuevo_capital=$capital_anterior-$capital_inicial;
				$this->capital_model->guardar_det_capital($id_capital,$id_socio,$descripcion,$capital_inicial);
				$this->capital_model->actualizar_capital($id_capital,$nuevo_capital);
				redirect('capital/grilla','refresh');
				}else{
				$this->capital_model->guardar_capital_inicial($capital_inicial);
				$buscar_capital=$this->capital_model->get_capital();
				foreach ($buscar_capital as $key) {
				$id_capital=$key->id;
				$capital_anterior=$key->capital;
				}
				$this->capital_model->guardar_det_capital($id_capital,$id_socio,$descripcion,$capital_inicial);
				redirect('capital/grilla','refresh');
				}
			} elseif ($data_usuario['id_nivel']==3) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_det_capital');
					$crud->where('id_capital',$id_capital);
					$crud->unset_delete();
					$output = $crud->render();
					$state = $crud->getState();
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('error/permiso',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
			}
			} else {
					$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
			}
		}

}
