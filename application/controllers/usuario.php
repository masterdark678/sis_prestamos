<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('nivel_model');
			$this->load->helper('security');
			$this->load->model('usuario_model');
			$this->load->model('cobrador_model');
			$this->load->model('socio_model');
			$this->load->model('estado_usuario_model');
	}
	public function index(){
			redirect('usuario/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
				$crud->set_subject('Usuario');
				$crud->set_language('spanish');
				$crud->set_relation('id_estado_usuario','t_estado_usuario','descripcion');
				$crud->set_relation('id_nivel','t_nivel','descripcion');
				$crud->display_as('id_estado_usuario','Status');
				$crud->display_as('id_nivel','Nivel');
				$crud->display_as('nombre','Nombre');
				$crud->display_as('login','Login');
				$crud->display_as('clave','Clave');
				$crud->columns('nombre','login','id_nivel','id_estado_usuario');
				$crud->required_fields('nombre','login','id_nivel','id_estado_usuario');
				$crud->add_action('Activar/Desactivar Usuario', '', '','fa fa-power-off',array($this,'fn_activar_usuario'));
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'fn_editar'));

				/*$crud->unset_delete();*/
				$crud->unset_read();
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('usuario/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('usuario/usuario',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
				
			
			} elseif ($data_usuario['id_nivel']==3) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_usuario');
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
	function fn_ver($primary_key , $row){
		return site_url('usuario/ver').'/'.$row->id;
	}
	function fn_editar($primary_key , $row){
		return site_url('usuario/editar').'/'.$row->id;
	}
	function fn_activar_usuario($primary_key , $row){
		return site_url('usuario/activar_desactivar').'/'.$row->id;
	}
	public function add(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
				$crud->set_subject('Usuario');
				$crud->set_language('spanish');
				$output = $crud->render();
				$data = array('nivel' =>$this->nivel_model->get_nivel());
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('usuario/add',$data );
				$this->load->view('../../assets/inc/footer_common_add',$output);
			
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
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
	public function activar_desactivar(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$id_usuario=$this->uri->segment(3);
				if (!$id_usuario) {
					$this->session->set_flashdata('alerta', 'Seleccione Un registro');
					redirect('usuario/grilla','refresh');
				}else{
					$buscar=$this->usuario_model->get_usuario_id($id_usuario);
					if(!$buscar){
						$this->session->set_flashdata('alerta', 'Registro No Encontrado');
						redirect('usuario/grilla','refresh');
					}
				}
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_usuario');
					$crud->set_subject('Usuario');
					$crud->set_language('spanish');
					$output = $crud->render();
					$data = array('usuario' =>$this->usuario_model->get_usuario_id($id_usuario),
					'estado_usuario' =>$this->estado_usuario_model->get_estado_usuario());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('usuario/activar_desactivar',$data );
					$this->load->view('../../assets/inc/footer_common_add',$output);				
			
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
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
	public function editar(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$id_usuario=$this->uri->segment(3);
				if (!$id_usuario) {
					$this->session->set_flashdata('alerta', 'Seleccione Un registro');
					redirect('usuario/grilla','refresh');
				}else{
					$buscar=$this->usuario_model->get_usuario_id($id_usuario);
					if(!$buscar){
						$this->session->set_flashdata('alerta', 'Registro No Encontrado');
						redirect('usuario/grilla','refresh');
					}
				}
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_usuario');
					$crud->set_subject('Usuario');
					$crud->set_language('spanish');
					$output = $crud->render();
					$data = array('usuario' =>$this->usuario_model->get_usuario_id($id_usuario),
					'nivel' =>$this->nivel_model->get_nivel());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('usuario/editar',$data );
					$this->load->view('../../assets/inc/footer_common_add',$output);				
			
			} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
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
	public function Ver(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$id_usuario=$this->uri->segment(3);
				if (!$id_usuario) {
				$this->session->set_flashdata('alerta', 'Seleccione Un registro');
				redirect('usuario/grilla','refresh');
				}else{
				$buscar=$this->usuario_model->get_usuario_id($id_usuario);
				if(!$buscar){
				$this->session->set_flashdata('alerta', 'Registro No Encontrado');
				redirect('usuario/grilla','refresh');
				}
				}
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_usuario');
			$crud->set_subject('Usuario');
			$crud->set_language('spanish');
			$output = $crud->render();
			$data = array('usuario' =>$this->usuario_model->get_usuario_id($id_usuario),
			'nivel');
			$this->load->view('../../assets/inc/head_common_add', $output);
			$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
			$this->load->view('../../assets/inc/menu_superior',$data_usuario);
			$this->load->view('usuario/ver',$data );
			$this->load->view('../../assets/inc/footer_common_add',$output);			
	
		} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
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
	public function guardar_usuario(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$id_estado_usuario=1;
			$id_nivel=$this->input->post('id_nivel',TRUE);
			$nombre=$this->input->post('txt_nombre',TRUE);
			$login=$this->input->post('txt_login',TRUE);
			$clave_2=do_hash($this->input->post('txt_clave'));
			if ($id_nivel==null ||$nombre==null ||$login==null ||$clave_2==null) {
							$this->session->set_flashdata('alerta', 'Debe seleccionar todos los registros');
							redirect('usuario/grilla','refresh');
			}
			if ($id_nivel==3) {
							$this->session->set_flashdata('alerta', 'Para Agregar un usuario Cobrador debe dirigirse a cobradores y luego crear Usuario de sistema');
							redirect('usuario/grilla','refresh');
			}
			$this->usuario_model->guardar_usuario($id_estado_usuario,$id_nivel,$nombre,$login,$clave_2);
			$this->session->set_flashdata('alerta', 'Usuario Guardado Correctamente');
			redirect('usuario/grilla','refresh');

		} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
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
	public function actualizar_usuario(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$id_estado_usuario=1;
			$id_usuario=$this->input->post('txt_id_usuario',TRUE);
			$id_nivel=$this->input->post('id_nivel',TRUE);
			$nombre=$this->input->post('txt_nombre',TRUE);
			$login=$this->input->post('txt_login',TRUE);
			$clave_2=do_hash($this->input->post('txt_clave'));
			if ($id_nivel==null ||$nombre==null ||$login==null ||$clave_2==null) {
							$this->session->set_flashdata('alerta', 'Debe seleccionar todos los registros');
							redirect('usuario/grilla','refresh');
			}
			$this->usuario_model->actualizar_usuario($id_usuario,$id_estado_usuario,$id_nivel,$nombre,$login,$clave_2);
			$this->session->set_flashdata('alerta', 'Usuario Actualizado Correctamente');
			redirect('usuario/grilla','refresh');

		} elseif ($data_usuario['id_nivel']==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
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
	public function add_usuario_cobrador(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$id_cobrador=$this->uri->segment(3);
					if (!$id_cobrador) {
					redirect('cobrador/grilla','refresh');
					}else{
					$buscar_cobrador=$this->cobrador_model->get_cobrador_id($id_cobrador);
					
					if (!$buscar_cobrador) {
					redirect('cobrador/grilla','refresh');			
					}
					}
					foreach ($buscar_cobrador as $key) {
					$id_usuario=$key->id_usuario;
					}
					if ($id_usuario) {
					$this->session->set_flashdata('alerta', 'Ya existe un Usuario de Sistema para este Cobrador');
					redirect('cobrador/grilla','refresh');
					}
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
				$crud->set_subject('Usuario');
				$crud->set_language('spanish');
				$output = $crud->render();
				$data = array('cobrador' =>$this->cobrador_model->get_cobrador_id($id_cobrador));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('usuario/add_usuario_cobrador',$data );
				$this->load->view('../../assets/inc/footer_common_add',$output);
			
			
			} elseif ($data_usuario['id_nivel']==3) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_usuario');
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
	public function add_usuario_socio(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$id_socio=$this->uri->segment(3);
				
				if (!$id_socio) {
				redirect('socio/grilla','refresh');
				}else{
				$buscar_socio=$this->socio_model->get_socio_id($id_socio);
				if (!$buscar_socio) {
				redirect('socio/grilla','refresh');			
				}
				}
				foreach ($buscar_socio as $key) {
				$id_usuario=$key->id_usuario;
				}
				if ($id_usuario) {
				$this->session->set_flashdata('alerta', 'Ya existe un Usuario de Sistema para este Socio');
				redirect('socio/grilla','refresh');
				}
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
				$crud->set_subject('Usuario');
				$crud->set_language('spanish');
				$output = $crud->render();
				$data = array('socio' =>$this->socio_model->get_socio_id($id_socio));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('usuario/add_usuario_socio',$data );
				$this->load->view('../../assets/inc/footer_common_add',$output);
		
		
		} elseif ($data_usuario['id_nivel'] ==3) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
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
	public function guardar_usuario_cobrador(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$id_estado_usuario=1;
			$id_cobrador=$this->input->post('txt_id_cobrador',TRUE);
			$id_nivel=$this->input->post('id_nivel',TRUE);
			$nombre=$this->input->post('txt_nombre',TRUE);
			$login=$this->input->post('txt_login',TRUE);
			$clave_2=do_hash($this->input->post('txt_clave'));
			if ($id_nivel==null ||$nombre==null ||$login==null ||$clave_2==null) {
						$this->session->set_flashdata('alerta', 'Debe seleccionar todos los registros');
						redirect('usuario/grilla','refresh');
				}
			$this->usuario_model->guardar_usuario($id_estado_usuario,$id_nivel,$nombre,$login,$clave_2);
			$usuario=$this->usuario_model->get_max_usuario();
			foreach ($usuario as $key) {
			$id_usuario=$key->id;
			}
			$this->cobrador_model->actualizar_cobrador($id_cobrador,$id_usuario);
			$this->session->set_flashdata('alerta', 'Usuario Guardado Correctamente');
			redirect('usuario/grilla','refresh');
		
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
	public function guardar_usuario_socio(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$id_estado_usuario=1;
			$id_socio=$this->input->post('txt_id_socio',TRUE);
			$id_nivel=$this->input->post('id_nivel',TRUE);
			$nombre=$this->input->post('txt_nombre',TRUE);
			$login=$this->input->post('txt_login',TRUE);
			$clave_2=do_hash($this->input->post('txt_clave'));
			if ($id_nivel==null ||$nombre==null ||$login==null ||$clave_2==null) {
					$this->session->set_flashdata('alerta', 'Debe seleccionar todos los registros');
					redirect('usuario/grilla','refresh');
			}
			$this->usuario_model->guardar_usuario($id_estado_usuario,$id_nivel,$nombre,$login,$clave_2);
			$usuario=$this->usuario_model->get_max_usuario();
			foreach ($usuario as $key) {
			$id_usuario=$key->id;
			}
			$this->socio_model->actualizar_socio($id_socio,$id_usuario);
			$this->session->set_flashdata('alerta', 'Usuario Guardado Correctamente');
			redirect('usuario/grilla','refresh');
			
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
	public function guardar_activar_desactivar_usuario(){
		$id_usuario=$this->input->post('txt_id_usuario',TRUE);
		$id_estado_usuario=$this->input->post('id_estado',TRUE);
			if ($id_estado_usuario==null) {
							$this->session->set_flashdata('alerta', 'Debe seleccionar todos los registros');
							redirect('usuario/grilla','refresh');
			}
		$this->usuario_model->actualizar_estado_usuario($id_estado_usuario,$id_usuario);
			$this->session->set_flashdata('alerta', 'Estado Cambiado');
			redirect('usuario/grilla','refresh');
	}
}