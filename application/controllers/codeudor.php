<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Codeudor extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('cliente_model');
			$this->load->model('codeudor_model');
	}
	public function index(){
			redirect('codeudor/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$crud->set_language('spanish');
				$crud->set_relation('id_cliente','t_cliente','nombre');
				$crud->display_as('id_cliente','Cliente');
				$crud->display_as('dni','DNI');
				$crud->display_as('nombre','Nombre');
				$crud->display_as('direccion','Direccion');
				$crud->display_as('telf','Telf');
				$crud->display_as('email','Email');
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'fn_editar'));
				$crud->columns('id_cliente','dni','nombre','direccion','telf','email');
				$crud->required_fields('id_cliente','dni','nombre','direccion','telf','email');
				/*$crud->unset_delete();*/
				$crud->unset_read();
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('codeudor/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/codeudor',$output );
				$this->load->view('../../assets/inc/footer_common',$output);			
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$crud->set_language('spanish');
				$crud->set_relation('id_cliente','t_cliente','nombre');
				$crud->display_as('id_cliente','Cliente');
				$crud->display_as('dni','DNI');
				$crud->display_as('nombre','Nombre');
				$crud->display_as('direccion','Direccion');
				$crud->display_as('telf','Telf');
				$crud->display_as('email','Email');
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->columns('id_cliente','dni','nombre','direccion','telf','email');
				$crud->required_fields('id_cliente','dni','nombre','direccion','telf','email');
				$crud->unset_delete();
				$crud->unset_read();
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					 redirect('codeudor/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/codeudor',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}
		} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
		}
	}
	function fn_ver($primary_key , $row){
		return site_url('codeudor/ver').'/'.$row->id;
	}
	function fn_editar($primary_key , $row){
		return site_url('codeudor/editar').'/'.$row->id;
	}
	public function add(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$output = $crud->render();
				$data = array('cliente' =>$this->cliente_model->get_cliente());
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/add',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$output = $crud->render();
				$data = array('cliente' =>$this->cliente_model->get_cliente());
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/add',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
					redirect('login/index','refresh');
		}
		
	}
	public function add_codeudor(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$output = $crud->render();
				$id_cliente=$this->uri->segment(3);
				if (!$id_cliente) {
				$this->session->set_flashdata('alerta', 'Seleccione un cliente');
				redirect('Cliente/grilla','refresh');
				}else{
				$buscar=$this->cliente_model->get_cliente();
				if (!$buscar) {
				$this->session->set_flashdata('alerta', 'Cliente No encontrado');
				redirect('Cliente/grilla','refresh');
				}
				}
				$data = array('cliente' =>$this->cliente_model->get_cliente_id($id_cliente));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/add_codeudor',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			
			
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$output = $crud->render();
				$id_cliente=$this->uri->segment(3);
				if (!$id_cliente) {
				$this->session->set_flashdata('alerta', 'Seleccione un cliente');
				redirect('Cliente/grilla','refresh');
				}else{
				$buscar=$this->cliente_model->get_cliente();
				if (!$buscar) {
				$this->session->set_flashdata('alerta', 'Cliente No encontrado');
				redirect('Cliente/grilla','refresh');
				}
				}
				$data = array('cliente' =>$this->cliente_model->get_cliente_id($id_cliente));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/add_codeudor',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}
		} else {
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
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$output = $crud->render();
				$id_codeudor=$this->uri->segment(3);
				if (!$id_codeudor) {
				$this->session->set_flashdata('alerta', 'Seleccione un Codeudor');
				redirect('codeudor/grilla','refresh');
				}else{
				$buscar_codeudor=$this->codeudor_model->get_codeudor($id_codeudor);
				if (!$buscar_codeudor) {
				$this->session->set_flashdata('alerta', 'Registro No encontrado');
				redirect('codeudor/grilla','refresh');
				}
				}
				$data = array('codeudor' =>$this->codeudor_model->get_codeudor($id_codeudor));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$output = $crud->render();
				$id_codeudor=$this->uri->segment(3);
				if (!$id_codeudor) {
				$this->session->set_flashdata('alerta', 'Seleccione un Codeudor');
				redirect('codeudor/grilla','refresh');
				}else{
				$buscar_codeudor=$this->codeudor_model->get_codeudor($id_codeudor);
				if (!$buscar_codeudor) {
				$this->session->set_flashdata('alerta', 'Registro No encontrado');
				redirect('codeudor/grilla','refresh');
				}
				}
				$data = array('codeudor' =>$this->codeudor_model->get_codeudor($id_codeudor));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}
		} else {
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
				$crud->set_table('t_co_deudor');
				$crud->set_subject('Codeudor');
				$output = $crud->render();
				$id_codeudor=$this->uri->segment(3);
				if (!$id_codeudor) {
				$this->session->set_flashdata('alerta', 'Seleccione un Codeudor');
				redirect('codeudor/grilla','refresh');
				}else{
				$buscar_codeudor=$this->codeudor_model->get_codeudor($id_codeudor);
				if (!$buscar_codeudor) {
				$this->session->set_flashdata('alerta', 'Registro No encontrado');
				redirect('codeudor/grilla','refresh');
				}
				}
				$data = array('codeudor' =>$this->codeudor_model->get_codeudor($id_codeudor));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('codeudor/editar',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			
			
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
	public function guardar_codeudor(){
	if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$id_cliente=$this->input->post('id_cliente',TRUE);
			$dni=$this->input->post('txt_dni',TRUE);
			$nombre=$this->input->post('txt_nombre',TRUE);
			$nombre_negocio=$this->input->post('txt_nombre_negocio',TRUE);
			$direccion=$this->input->post('txt_direccion',TRUE);
			$direccion_cobro=$this->input->post('txt_direccion_cobro',TRUE);
			$telf=$this->input->post('txt_telf',TRUE);
			$email=$this->input->post('txt_email',TRUE);
			if ($id_cliente==null ||$dni==null ||$nombre==null ||$nombre_negocio==null ||$direccion==null ||$direccion_cobro==null ||$telf==null) {
					$this->session->set_flashdata('alerta', 'Debe Ingresar todos los registros ');
					redirect('codeudor/grilla','refresh');
			}
			$this->codeudor_model->guardar_codeudor($id_cliente,$dni,$nombre,$nombre_negocio,$direccion,$direccion_cobro,$telf,$email);
			$this->session->set_flashdata('alerta', 'Codeudor Guardado Correctamente');
			redirect('codeudor/grilla','refresh');		
		
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
	public function actualizar_codeudor(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
					$id_codeudor=$this->input->post('txt_id_codeudor',TRUE);
					$dni=$this->input->post('txt_dni',TRUE);
					$nombre=$this->input->post('txt_nombre',TRUE);
					$nombre_negocio=$this->input->post('txt_nombre_negocio',TRUE);
					$direccion=$this->input->post('txt_direccion',TRUE);
					$direccion_cobro=$this->input->post('txt_direccion_cobro',TRUE);
					$telf=$this->input->post('txt_telf',TRUE);
					$email=$this->input->post('txt_email',TRUE);
			if ( $id_codeudor==null || $dni==null || $nombre==null || $nombre_negocio==null || $direccion==null || $direccion_cobro==null || $telf==null) {
							$this->session->set_flashdata('alerta', 'Debe Llenar los registros');
							redirect('codeudor/grilla','refresh');
			}
					$this->codeudor_model->actualizar_codeudor($id_codeudor,$dni,$nombre,$nombre_negocio,$direccion,$direccion_cobro,$telf,$email);
					$this->session->set_flashdata('alerta', 'Codeudor Actualizado Correctamente');
					redirect('codeudor/grilla','refresh');
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
