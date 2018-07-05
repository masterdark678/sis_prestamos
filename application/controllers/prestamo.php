<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Prestamo extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('cliente_model');
			$this->load->model('tipo_prestamo_model');
			$this->load->model('metodo_pago_model');
			$this->load->model('porcentaje_model');
			$this->load->model('prestamo_model');
			$this->load->model('caja_model');
			$this->load->model('cobrador_model');
			$this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('prestamo/grilla');
	}


/**********************grilla cliente general *******************************/
	public function grilla_cliente_general(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$id_cliente=$this->uri->segment(3);
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_cliente',$id_cliente);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamo x cliente');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','Cobro');
			$crud->columns('id_cliente','id_tipo_prestamo','id_estado_prestamo','monto_prestado','monto_aprobado','interes','total_prestado','total_debe');
			$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gcg'));
			/*	$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
			*/
				$crud->unset_read();
				$crud->unset_edit();
				/*$crud->unset_delete();*/

				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

		
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gcg'));
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_read();
				$crud->unset_delete();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}	
	}
	/**************************************************/





/*****************************************************/
	public function grilla(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamo');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->columns('id_cliente','id_tipo_prestamo','id_estado_prestamo','monto_prestado','monto_aprobado','interes','total_prestado','total_debe');
			$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');


			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			
				$crud->add_action('Aprobar/Rechazar Prestamo', '', '','fa fa-credit-card',array($this,'fn_aceptar_rechazar_prestamo'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo'));
				$crud->unset_edit();
				$crud->unset_read();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo'));
				$crud->unset_edit();

				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('error/permiso',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}	
	}
	/**************************************************/

	
	/*******************prestamos x cobrador aprobados****************************************/
	public function grilla_cobrador_estado_prestamo_aprobado(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
			if (!$buscar_cobrador) {
			redirect('principal','refresh');
			}	
			foreach ($buscar_cobrador as $key) {
				$id_cobrador=$key->id;
			}
			$estado_prestamo=2;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->where('t_prestamo.id_cobrador',$id_cobrador);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Aprobados');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','M. postulado');
			$crud->display_as('monto_aprobado','M. aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','M. X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P Cobro');
			$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');
			$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','interes','total_prestado','total_debe','fecha_prox_cobro');
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gcopa'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_read();
				$output = $crud->render();
				$state = $crud->getState();
			
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gcopa'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_read();
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}

		
	}


	/*******************prestamos todos x cobrado****************************************/
	public function grilla_todos_x_cobrado(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$fecha=date('Y-m-d');
			$estado_prestamo=2;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->where('fecha_ultimo_cobro ',$fecha);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Cobrados Hoy');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');
			$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','interes','total_prestado','total_debe');


			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_read();
				$crud->unset_edit();
				$crud->unset_add();
				/*$crud->unset_delete();*/
				$output = $crud->render();
				$state = $crud->getState();
			
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
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

	/*******************prestamos todos x cobrado****************************************/
	public function grilla_prestamo_cobrador_cobrado(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
			if (!$buscar_cobrador) {
			redirect('principal','refresh');
			}
			foreach ($buscar_cobrador as $key) {
			$id_cobrador=$key->id;
			}
			$fecha=date('Y-m-d');
			$estado_prestamo=2;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->where('fecha_ultimo_cobro ',$fecha);
			$crud->where('t_prestamo.id_cobrador',$id_cobrador);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Cobrados Hoy');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','M. postulado');
			$crud->display_as('monto_aprobado','M. aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','M. x cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P Cobro');
			$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');
			$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','interes','total_prestado','total_debe','fecha_prox_cobro');
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
					$crud->unset_read();
				$crud->unset_edit();
				$crud->unset_add();
				$output = $crud->render();
				$state = $crud->getState();
			
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}	
	}

	

	/*******************prestamos todos x cobrar****************************************/
	public function grilla_todos_x_cobrar(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$fecha=date('Y-m-d');
			$estado_prestamo=2;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->where('fecha_prox_cobro',$fecha);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos x Cobrar');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','M. postulado');
			$crud->display_as('monto_aprobado','M. aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','M. x cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');
			$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','interes','total_prestado','total_debe','fecha_prox_cobro');
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_read();
				$crud->unset_edit();
				$crud->unset_add();
				$output = $crud->render();
				$state = $crud->getState();
			
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
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
	function fecha_format($value, $row){
			return date('d-m-y', strtotime($value));
			}
	/*******************cobrador prestamo x cobrar****************************************/
	public function grilla_cobrador_prestamo_x_cobrar(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
			if (!$buscar_cobrador) {
			redirect('principal','refresh');
			}	
			foreach ($buscar_cobrador as $key) {
				$id_cobrador=$key->id;
			}
			$fecha=date('Y-m-d');
			$estado_prestamo=2;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->where('t_prestamo.id_cobrador',$id_cobrador);
			$crud->where('fecha_prox_cobro',$fecha);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos x Cobrar');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','M postulado');
			$crud->display_as('monto_aprobado','M aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			$crud->columns('id_cliente','monto_x_cuotas','total_debe','fecha_prox_cobro');
			$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','interes','total_prestado','total_debe','fecha_prox_cobro');
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_read();
				$output = $crud->render();
				$state = $crud->getState();
			
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_add();
				$crud->unset_read();
				$crud->unset_edit();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}	
	}

/*prestamo cobrador_ atrasado*/
public function grilla_cobrador_atrasados(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
			if (!$buscar_cobrador) {
			redirect('principal','refresh');
			}	
			foreach ($buscar_cobrador as $key) {
				$id_cobrador=$key->id;
			}
			$fecha=date('Y-m-d');
			$estado_prestamo=2;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->where('fecha_ultimo_cobro <',$fecha);
			$crud->or_where('fecha_prox_cobro <',$fecha);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Atrasados');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			$crud->columns('id_cliente','total_debe','fecha_prox_cobro');
			$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','interes','total_prestado','total_debe','fecha_prox_cobro');

			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
					$crud->unset_read();
				$crud->unset_edit();
				$crud->unset_add();
				$output = $crud->render();
				$state = $crud->getState();
			
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
				}
					$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}	
	}

/*****************************/



public function grilla_todos_atrasados(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$fecha=date('Y-m-d');
			$estado_prestamo=2;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->where('fecha_ultimo_cobro <',$fecha);
			$crud->or_where('fecha_prox_cobro <',$fecha);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Atrasados');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','M. postulado');
			$crud->display_as('monto_aprobado','M. aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','M. Cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			$crud->columns('id_cliente','total_debe','fecha_prox_cobro');
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_read();
				$crud->unset_delete();				
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
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




	/*******************prestamos todos aprobados****************************************/
	public function grilla_todos_estado_prestamo_aprobado(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			
			$estado_prestamo=2;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Aprobados');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','M. postulado');
			$crud->display_as('monto_aprobado','M. aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','M. X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P.Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');

			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_read();
				$crud->unset_edit();
				$crud->unset_add();
				$output = $crud->render();
				$state = $crud->getState();
			
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {

				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gtoapro'));
				$crud->add_action('Agregar Abono', '', '','fa fa-money',array($this,'fn_agregar_abono'));
				$crud->add_action('Generar Atraso', '', '','fa fa-reply-all',array($this,'fn_generar_atraso'));
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
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

	/***************************************/

		public function grilla_cobrador_estado_prestamo_rechazados(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
			if (!$buscar_cobrador) {
			redirect('principal','refresh');
			}	
			foreach ($buscar_cobrador as $key) {
				$id_cobrador=$key->id;
			}
			$estado_prestamo=3;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('t_prestamo.id_cobrador',$id_cobrador);
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Rechazados');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

				$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->add_action('Aprobar/Rechazar Prestamo', '', '','fa fa-credit-card',array($this,'fn_aceptar_rechazar_prestamo'));
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {
				$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_delete();
				$output = $crud->render();
				
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}
		
	}

	/***************************************/

		public function grilla_todos_estado_prestamo_rechazados(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			
			$estado_prestamo=3;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Rechazados');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

				$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->add_action('Aprobar/Rechazar Prestamo', '', '','fa fa-credit-card',array($this,'fn_aceptar_rechazar_prestamo'));
				$crud->unset_add();
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {
				$crud->columns('id_cliente','id_tipo_prestamo','id_estado_prestamo','monto_prestado','interes','total_prestado');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_delete();
				$output = $crud->render();
				
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('error/permiso',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}
		
	}


	public function grilla_todos_estado_prestamo_finalizado(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			
			$estado_prestamo=5;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Finalizados');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

				$crud->columns('id_cliente','monto_aprobado','total_debe','fecha_prox_cobro');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gcopa'));
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_read();
				/*$crud->unset_delete();*/
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {
				$crud->columns('id_cliente','id_tipo_prestamo','id_estado_prestamo','monto_prestado','interes','total_prestado');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_delete();
				$output = $crud->render();
				
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('error/permiso',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}
		
	}
	/***************************************/


	public function grilla_todos_estado_prestamo_por_aprobar(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			
			$estado_prestamo=1;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Por Aprobar');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud->columns('id_cliente','id_tipo_prestamo','id_estado_prestamo','monto_prestado','interes','total_prestado');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->add_action('Aprobar/Rechazar Prestamo', '', '','fa fa-credit-card',array($this,'fn_aceptar_rechazar_prestamo'));
				$crud->unset_edit();
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {
				$crud->columns('id_cliente','id_tipo_prestamo','id_estado_prestamo','monto_prestado','interes','total_prestado');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->unset_edit();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}

		
	}
	

	/********grilla cobrador prestamo finalizado*******/

	public function grilla_cobrador_estado_prestamo_finalizado(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
			if (!$buscar_cobrador) {
			redirect('principal','refresh');
			}	
			foreach ($buscar_cobrador as $key) {
				$id_cobrador=$key->id;
			}
			$estado_prestamo=5;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('t_prestamo.id_cobrador',$id_cobrador);
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Finalizados');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P. Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));

			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
			$crud->columns('id_cliente','monto_aprobado','total_debe');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gcofi'));
				$crud->unset_add();
				$crud->unset_read();
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {
				$crud->columns('id_cliente','monto_aprobado','total_debe');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->add_action('Ver Prestamo', '', '','fa fa-eye',array($this,'fn_ver_prestamo_gcg'));
				$crud->unset_add();
				$crud->unset_read();
				$crud->unset_edit();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}
	}


	public function grilla_cobrador_estado_prestamo_por_aprobar(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
			if (!$buscar_cobrador) {
			redirect('principal','refresh');
			}	
			foreach ($buscar_cobrador as $key) {
				$id_cobrador=$key->id;
			}
			$estado_prestamo=1;
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_prestamo');
			$crud->where('t_prestamo.id_cobrador',$id_cobrador);
			$crud->where('id_estado_prestamo',$estado_prestamo);
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_cobrador','t_cobrador','nombre');
			$crud->set_relation('id_tipo_prestamo','t_tipo_prestamo','descripcion');
			$crud->set_relation('id_metodo_pago','t_metodo_pago','descripcion');
			$crud->set_relation('id_estado_prestamo','t_estado_prestamo','descripcion');
			$crud->set_subject('Prestamos Por Aprobar');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_cobrador','Cobrador');
			$crud->display_as('id_tipo_prestamo','Tipo Prestamo');
			$crud->display_as('id_metodo_pago','M. Pago');
			$crud->display_as('id_estado_prestamo','Estado');
			$crud->display_as('monto_prestado','Monto postulado');
			$crud->display_as('monto_aprobado','Monto aprobado');
			$crud->display_as('interes','Interes');
			$crud->display_as('total_prestado','Total');
			$crud->display_as('numero_cuotas','# Cuotas');
			$crud->display_as('monto_x_cuotas','Monto X cuota');
			$crud->display_as('cuotas_amortizadas','Cuotas Amortizadas');
			$crud->display_as('cuotas_debe','Cuotas Debe');
			$crud->display_as('atrasos','Atrasos');
			$crud->display_as('dias_mora','Dinero');
			$crud->display_as('penalidad','Penalidad');
			$crud->display_as('total_penalidad','Dinero');
			$crud->display_as('total_debe','T. Debe');
			$crud->display_as('fecha','Fecha Prestamo');
			$crud->display_as('fecha_prox_cobro','P Cobro');
			$crud->callback_column('fecha_prox_cobro',array($this,'fecha_format'));


			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

				$crud->columns('id_cliente','id_tipo_prestamo','id_estado_prestamo','monto_prestado','monto_aprobado','interes','total_prestado','total_debe');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->add_action('Aprobar/Rechazar Prestamo', '', '','fa fa-credit-card',array($this,'fn_aceptar_rechazar_prestamo'));
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);

			} elseif ($data_usuario['id_nivel']==3) {
				$crud->columns('id_cliente','id_tipo_prestamo','id_estado_prestamo','monto_prestado','interes','total_prestado');
				$crud->required_fields('id_cliente','id_tipo_prestamo','id_metodo_pago','id_estado_prestamo','monto_prestado','interes','total_prestado','total_debe');
				$crud->unset_edit();
				$crud->unset_delete();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
					redirect('prestamo/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/prestamo',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			
			}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}

		
	}

	/***************************************/
		function fn_aceptar_rechazar_prestamo($primary_key , $row){
		return site_url('prestamo/aceptar_rechazar_prestamo').'/'.$row->id;
	}
	function fn_ver_prestamo($primary_key , $row){
		return site_url('prestamo/ver_prestamo').'/'.$row->id;
	}
	function fn_ver_prestamo_gcg($primary_key , $row){
		return site_url('prestamo/ver_prestamo_gcg').'/'.$row->id;
	}
	function fn_ver_prestamo_gtoapro($primary_key , $row){
		return site_url('prestamo/ver_prestamo_gtoapro').'/'.$row->id;
	}
	function fn_ver_prestamo_gcofi($primary_key , $row){
		return site_url('prestamo/ver_prestamo_gcofi').'/'.$row->id;
	}
	function fn_ver_prestamo_gcopa($primary_key , $row){
		return site_url('prestamo/ver_prestamo_gcopa').'/'.$row->id;
	}
		function fn_agregar_abono($primary_key , $row){
			return site_url('prestamo/agregar_abono').'/'.$row->id;
	}
		function fn_generar_atraso($primary_key , $row){
			return site_url('prestamo/generar_atraso').'/'.$row->id;
	}
		public function add(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));

				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_prestamo');
						$crud->set_subject('Prestamo');
						$output = $crud->render();
						$data = array('cliente' =>$this->cliente_model->get_cliente_prestamo());
						$this->load->view('../../assets/inc/head_common_add_modal', $output);
						$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
						$this->load->view('../../assets/inc/menu_superior',$data_usuario);
						$this->load->view('modal/modal_prestamo',$data);
						$this->load->view('prestamo/add',$data);
						$this->load->view('../../assets/inc/footer_common_add',$output);
				
				} elseif ($data_usuario['id_nivel']==3) {
					$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
					foreach ($buscar_cobrador as $key) {
						$id_cobrador=$key->id;

					}
					 	$this->session->set_userdata($id_cobrador);
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_prestamo');
						$crud->set_subject('Prestamo');
						$output = $crud->render();
						$data = array('cliente' =>$this->cliente_model->get_cliente_prestamo_cobrador($id_cobrador));
						$this->load->view('../../assets/inc/head_common_add_modal', $output);
						$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
						$this->load->view('../../assets/inc/menu_superior',$data_usuario);
						$this->load->view('modal/modal_prestamo',$data);
						$this->load->view('prestamo/add',$data);
						$this->load->view('../../assets/inc/footer_common_add',$output);
				}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}
			
		
		}
		
			/******ver prestamo grilla cliente_cobrador_aprobado ******/
		public function ver_prestamo_gcopa(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_prestamo=$this->uri->segment(3);
			if (!$id_prestamo) {
				$this->session->set_flashdata('alerta', 'Selecione un registro');
				redirect('prestamo/grilla_cobrador_estado_prestamo_aprobado','refresh');
			}

			$data = array('prestamo' =>$this->prestamo_model->get_prestamo_id($id_prestamo),
			'det_prestamo'=>$this->prestamo_model->get_det_prestamo_id($id_prestamo),
			'suma_atraso'=>$this->prestamo_model->contar_dias_atraso($id_prestamo),
			'atraso'=>$this->prestamo_model->get_atraso_id_prestamo($id_prestamo));
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
						$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/ver_det_prestamo_gcopa',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
					} else {
						$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/ver_det_prestamo_gcopa',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
					}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}

		}

			/******ver prestamo grilla cliente general******/
		public function ver_prestamo_gcg(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_prestamo=$this->uri->segment(3);
			if (!$id_prestamo) {
				$this->session->set_flashdata('alerta', 'Selecione un registro');
				redirect('prestamo/grilla_cliente_general','refresh');
			}

			$data = array('prestamo' =>$this->prestamo_model->get_prestamo_id($id_prestamo),
			'det_prestamo'=>$this->prestamo_model->get_det_prestamo_id($id_prestamo),
			'suma_atraso'=>$this->prestamo_model->contar_dias_atraso($id_prestamo),
			'atraso'=>$this->prestamo_model->get_atraso_id_prestamo($id_prestamo));
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
					$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/ver_det_prestamo_gcg',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
					} else {
						$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/ver_det_prestamo_gcg',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
					}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}

		}

		/******ver prestamo grilla todos aprobados******/
		public function ver_prestamo_gtoapro(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_prestamo=$this->uri->segment(3);
			if (!$id_prestamo) {
				$this->session->set_flashdata('alerta', 'Selecione un registro');
				redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
			}

			$data = array('prestamo' =>$this->prestamo_model->get_prestamo_id($id_prestamo),
			'det_prestamo'=>$this->prestamo_model->get_det_prestamo_id($id_prestamo),
			'suma_atraso'=>$this->prestamo_model->contar_dias_atraso($id_prestamo),
			'atraso'=>$this->prestamo_model->get_atraso_id_prestamo($id_prestamo));
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
						$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/vet_det_prestamo_gtoapro',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
					} else {
						$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/vet_det_prestamo_gtoapro',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
					}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}

		}
		public function imprimir_ficha_prestamo(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_prestamo=$this->input->post('txt_id_prestamo',TRUE);;
			$data = array('prestamo' =>$this->prestamo_model->get_prestamo_id($id_prestamo),
			'det_prestamo'=>$this->prestamo_model->get_det_prestamo_id($id_prestamo),
			'suma_atraso'=>$this->prestamo_model->contar_dias_atraso($id_prestamo),
			'atraso'=>$this->prestamo_model->get_atraso_id_prestamo($id_prestamo));
				
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('prestamo/imprimir_prestamo',$data);
				/*si quiero la hoja en horizonal*/
					$html = $this->output->get_output();
					$this->dompdf->set_paper('letter','landscape');
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("ficha_prestamo.pdf",array('Attachment'=>0));
				

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}
		}

		/******ver prestamo grilla cobrador finalizado******/
		public function ver_prestamo_gcofi(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_prestamo=$this->uri->segment(3);
			if (!$id_prestamo) {
				$this->session->set_flashdata('alerta', 'Selecione un registro');
				redirect('prestamo/grilla_cobrador_estado_prestamo_finalizado','refresh');
			}

			$data = array('prestamo' =>$this->prestamo_model->get_prestamo_id($id_prestamo),
			'det_prestamo'=>$this->prestamo_model->get_det_prestamo_id($id_prestamo),
			'suma_atraso'=>$this->prestamo_model->contar_dias_atraso($id_prestamo),
			'atraso'=>$this->prestamo_model->get_atraso_id_prestamo($id_prestamo));
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
						$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/ver_det_prestamo_cofi',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
					} else {
					$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_prestamo');
				$crud->set_subject('Prestamo');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('prestamo/ver_det_prestamo_cofi',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
					}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}

		}
				/**************************************/
		public function add_prestamo(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));

				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

					$id_cliente=$this->input->post('id_cliente',TRUE);
					$id_cobrador=$this->session->userdata('id_cobrador');
				
					if ($id_cliente==0) {
						$this->session->set_flashdata('alerta', 'Debe Selecionar Un Cliente');
						redirect('prestamo/grilla_todos_estado_prestamo_por_aprobar','refresh');
					}
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_prestamo');
					$crud->set_subject('Prestamo');
					$output = $crud->render();
					
					$data = array(
					'cliente' =>$this->cliente_model->get_cliente_id($id_cliente),
					'prestamo'=>$this->prestamo_model->get_prestamo_id_cliente($id_cliente),
					'cobrador'=>$this->cobrador_model->get_cobrador(),
					'tipo_prestamo'=>$this->tipo_prestamo_model->get_tipo_prestamo(),
					'metodo_pago'=>$this->metodo_pago_model->get_metodo_pago());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('prestamo/add_prestamo',$data);
					$this->load->view('../../assets/script/script_calculo_prestamo');
					$this->load->view('../../assets/inc/footer_common_add',$output);
				
				} elseif ($data_usuario['id_nivel']==3) {
					$id_cliente=$this->input->post('id_cliente',TRUE);
					if ($id_cliente==0) {
									$this->session->set_flashdata('alerta', 'debe Selecionar Un Cliente');
									redirect('prestamo/grilla_cobrador_estado_prestamo_por_aprobar','refresh');
					}
					$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
					foreach ($buscar_cobrador as $key) {
						$id_cobrador=$key->id;

					}
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_prestamo');
					$crud->set_subject('Prestamo');
					$output = $crud->render();
					$data = array(
					'cliente' =>$this->cliente_model->get_cliente_id($id_cliente),
					'id_cobrador'=>$id_cobrador,
					'prestamo'=>$this->prestamo_model->get_prestamo_id_cliente($id_cliente),
					'tipo_prestamo'=>$this->tipo_prestamo_model->get_tipo_prestamo(),
					'metodo_pago'=>$this->metodo_pago_model->get_metodo_pago());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('prestamo/add_prestamo_cobrador',$data);
					$this->load->view('../../assets/script/script_calculo_prestamo');
					$this->load->view('../../assets/inc/footer_common_add',$output);
							
				}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}

		}
		public function guardar_nuevo_prestamo(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));

				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

					$id_estado_prestamo='1';
					$id_cliente=$this->input->post('txt_id_cliente',TRUE);
					$id_cobrador=$this->input->post('id_cobrador',TRUE);
					$id_tipo_prestamo=$this->input->post('id_tipo_prestamo',TRUE);
					$id_metodo_pago=$this->input->post('id_metodo_pago',TRUE);
					$porcentaje=$this->input->post('txt_porcentaje',TRUE);
					$monto_prestado=$this->input->post('txt_monto_prestado',TRUE);
					$interes=$this->input->post('txt_interes_calculados',TRUE);
					$total_prestado=$this->input->post('txt_total_prestamo',TRUE);
					$numero_cuotas=$this->input->post('txt_num_cuotas',TRUE);
					$monto_x_cuotas=ceil($this->input->post('txt_monto_x_cuota',TRUE));
					$fecha_prestamo=$this->input->post('txt_fecha_inicio_prestamo',TRUE);


			if ($id_cliente==null ||$id_cobrador==null ||$id_tipo_prestamo==null ||$id_metodo_pago==null ||$porcentaje==null ||$monto_prestado==null ||$interes==null ||$total_prestado==null ||$numero_cuotas==null ||$monto_x_cuotas==null ||$fecha_prestamo==null) {
							$this->session->set_flashdata('alerta', 'Debe Ingresar todos los Registros');
							redirect('Prestamo/grilla_todos_estado_prestamo_por_aprobar','refresh');
			}
					$this->prestamo_model->guardar_prestamo($id_estado_prestamo,$id_cobrador,$id_cliente,$id_tipo_prestamo,$id_metodo_pago,$porcentaje,$monto_prestado,$interes,$total_prestado,$numero_cuotas,$monto_x_cuotas,$fecha_prestamo);
					$this->session->set_flashdata('alerta', 'Prestamo Creado');
					redirect('prestamo/grilla_todos_estado_prestamo_por_aprobar','refresh');
				
				
				} elseif ($data_usuario['id_nivel']==3) {

					$id_estado_prestamo='1';
					$id_cliente=$this->input->post('txt_id_cliente',TRUE);
					$id_cobrador=$this->input->post('txt_id_cobrador',TRUE);
					$id_tipo_prestamo=$this->input->post('id_tipo_prestamo',TRUE);
					$id_metodo_pago=$this->input->post('id_metodo_pago',TRUE);
					$porcentaje=$this->input->post('txt_porcentaje',TRUE);
					$monto_prestado=$this->input->post('txt_monto_prestado',TRUE);
					$interes=$this->input->post('txt_interes_calculados',TRUE);
					$total_prestado=$this->input->post('txt_total_prestamo',TRUE);
					$numero_cuotas=$this->input->post('txt_num_cuotas',TRUE);
					$monto_x_cuotas=$this->input->post('txt_monto_x_cuota',TRUE);
					$fecha_prestamo=$this->input->post('txt_fecha_inicio_prestamo',TRUE);
			if ($id_cliente==null ||$id_cobrador==null ||$id_tipo_prestamo==null ||$id_metodo_pago==null ||$porcentaje==null ||$monto_prestado==null ||$interes==null ||$total_prestado==null ||$numero_cuotas==null ||$monto_x_cuotas==null ||$fecha_prestamo==null) {
							$this->session->set_flashdata('alerta', 'Debe Ingresar todos los Registros');
							redirect('Prestamo/grilla_cobrador_estado_prestamo_por_aprobar','refresh');
			}
					$this->prestamo_model->guardar_prestamo($id_estado_prestamo,$id_cobrador,$id_cliente,$id_tipo_prestamo,$id_metodo_pago,$porcentaje,$monto_prestado,$interes,$total_prestado,$numero_cuotas,$monto_x_cuotas,$fecha_prestamo);
					$this->session->set_flashdata('alerta', 'Prestamo Creado');
					redirect('prestamo/grilla_cobrador_estado_prestamo_por_aprobar','refresh');

				}


			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}


		}
		public function aceptar_rechazar_prestamo(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));

				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {

					$id_prestamo=$this->uri->segment(3);
					if (!$id_prestamo) {
						$this->session->set_flashdata('alerta', 'Seleccione un Registro');
						redirect('prestamo/grilla_general','refresh');
					}else{
						$buscar=$this->prestamo_model->get_prestamo_id($id_prestamo);
						if ($buscar) {
								foreach ($buscar as $key) {
								$id_cliente=$key->id_cliente;
							}

							$crud = new grocery_CRUD();
							$crud->set_theme('bootstrap');
							$crud->set_table('t_prestamo');
							$crud->set_subject('Prestamo');
							$output = $crud->render();
							$dinero_sucursal=$this->cliente_model->get_cliente_dinero_sucursal($id_cliente);
							foreach ($dinero_sucursal as $key) {
								$total_caja=$key->total_caja;
							}
							
							$data = array('prestamo' =>$this->prestamo_model->get_prestamo_id($id_prestamo),
							'dinero_sucursal'=>$this->cliente_model->get_cliente_dinero_sucursal($id_cliente),
							'prestamo_anterior'=>$this->prestamo_model->get_prestamo_id_cliente($id_cliente),
							'cliente'=>$this->cliente_model->get_cliente_id($id_cliente));
							$this->load->view('../../assets/inc/head_common_add', $output);
							$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
							$this->load->view('../../assets/inc/menu_superior',$data_usuario);
							$this->load->view('modal/modal_cliente',$data);
							$this->load->view('prestamo/aprobar_rechazar_prestamo',$data);
							$this->load->view('../../assets/script/script_calculo_prestamo');
							$this->load->view('../../assets/inc/footer_common_add',$output);				
					}else{
						$this->session->set_flashdata('alerta', 'Registro no encontrado');
						redirect('prestamo/grilla_general','refresh');
					}
			}
					
				} elseif ($data_usuario['id_nivel']==3) {

							$crud = new grocery_CRUD();
							$crud->set_theme('bootstrap');
							$crud->set_table('t_prestamo');
							$crud->set_subject('Prestamo');
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
		public function guardar_aprobar_rechazar_prestamo(){

			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$id_prestamo=$this->input->post('txt_id_prestamo',TRUE);
					if (!$id_prestamo) {
						$this->session->set_flashdata('alerta', 'Ha ocurrido un Error al Guardar');
						redirect('prestamo/grilla_general','refresh');
					}
						$id_estado_prestamo=$this->input->post('estado_prestamo',TRUE);
						$id_caja=$this->input->post('txt_id_caja',TRUE);
						$id_tipo_ingreso=3;
						$monto_sucursal=$this->input->post('txt_nuevo_monto_sucursal',TRUE);
						$monto_aprobado=$this->input->post('txt_monto_aprobado',TRUE);
						$porcentaje_aprobado=$this->input->post('txt_porcentaje_aprobado',TRUE);
						$interes=$this->input->post('txt_interes_calculados',TRUE);
						$total_prestado=$this->input->post('txt_total_prestamo',TRUE);
						$numero_cuotas_aprobadas=$this->input->post('txt_num_cuotas_aprobadas',TRUE);
						$monto_x_cuotas=$this->input->post('txt_monto_x_cuota',TRUE);
						$penalidad=$this->input->post('txt_penalidad',TRUE);
						$fecha_aprobacion_prestamo=$this->input->post('txt_fecha_aprobacion',TRUE);
						$fecha_prox_cobro=$this->input->post('txt_fecha_prox_pago',TRUE);
						$observaciones=$this->input->post('txt_observaciones',TRUE);
						$id_prestamo_anterior=$this->input->post('txt_id_prestamo_anterior',TRUE);
						$total_debe_anterior=$this->input->post('txt_total_debe_prestamo_anterior',TRUE);
					if ($id_estado_prestamo==null||$id_caja==null||$id_tipo_ingreso==null||$monto_sucursal==null||$monto_aprobado==null||$porcentaje_aprobado==null||$interes==null||$total_prestado==null||$numero_cuotas_aprobadas==null||$monto_x_cuotas==null||$penalidad==null||$fecha_aprobacion_prestamo==null||$fecha_prox_cobro==null||$observaciones==null) {
									$this->session->set_flashdata('alerta', 'Debe seleccionar los registros');
									redirect('prestamo/grilla_todos_estado_prestamo_por_aprobar','refresh');
					}

						$nuevo_monto=$total_prestado-$total_debe_anterior;
						
						if ($total_prestado<0) {
							$this->session->set_flashdata('alerta', 'No puede aprobar un prestamo con monto negativo');
									redirect('prestamo/grilla_todos_estado_prestamo_por_aprobar','refresh');		
						}
					if ($id_estado_prestamo==2) {
						$this->caja_model->guardar_det_caja($id_caja, $id_tipo_ingreso, $monto_aprobado, $fecha_aprobacion_prestamo);
						$this->caja_model->actualizar_caja($id_caja,$monto_sucursal);
						
						$this->prestamo_model->actualizar_estado_prestamo_aprobado($id_prestamo,$id_estado_prestamo,$total_prestado,$porcentaje_aprobado,$interes,$nuevo_monto,$numero_cuotas_aprobadas,$monto_x_cuotas,$penalidad,$fecha_aprobacion_prestamo,$fecha_prox_cobro,$observaciones);	
					
						if ($id_prestamo_anterior) {
							/*aqui toma el valor de la deuda vieja y la refinancia, ademas coloca el estado de prestamo a finalizado*/
							$id_tipo_ingreso=2;
							$estado_prestamo=5;
							$fecha_cobro=date('Y-m-d');
							$id_tipo_prestamo_2=1;
							$total_debe=0;
							/*********************************/
							$buscar=$this->prestamo_model->get_prestamo_id($id_prestamo);
								foreach ($buscar as $key) {
								$id_cliente=$key->id_cliente;
								}
							$buscar_sucursal=$this->cliente_model->get_cliente_dinero_sucursal($id_cliente);
							foreach ($buscar_sucursal as $key) {
								$id_caja=$key->id_caja;
								$total_caja=$key->total_caja;
							}
							$nuevo_total_caja=$total_caja+$total_debe_anterior;
							/*********************************/							
							$observaciones="Se a Refinanciado la Deuda en un nuevo prestamo";
							$this->prestamo_model-> guardar_abono($id_prestamo_anterior,$id_tipo_prestamo_2,$total_debe_anterior,$observaciones,$total_debe_anterior,$fecha_cobro,$fecha_cobro);
							$this->prestamo_model->actualizar_estado_prestamo($id_prestamo_anterior,$estado_prestamo,$total_debe);
							$this->caja_model->guardar_det_caja($id_caja, $id_tipo_ingreso, $total_debe_anterior, $fecha_cobro);
							$this->caja_model->actualizar_caja($id_caja,$nuevo_total_caja);

							$this->session->set_flashdata('alerta', 'Prestamo Aprobado y deuda anterior Finalizada');
							redirect('prestamo/grilla_todos_estado_prestamo_por_aprobar','refresh');
							/********************************************/	
						} 
							$this->session->set_flashdata('alerta', 'Prestamo Aprobado');
							redirect('prestamo/grilla_todos_estado_prestamo_por_aprobar','refresh');	
					}else{
						$this->prestamo_model->actualizar_prestamo_rechazado($id_prestamo,$id_estado_prestamo,$observaciones);
						$this->session->set_flashdata('alerta', 'Prestamo Rechazado');
						redirect('prestamo/grilla_todos_estado_prestamo_por_aprobar','refresh');
				}
			


				} elseif ($data_usuario['id_nivel']==3) {

					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_prestamo');
					$crud->set_subject('Prestamo');
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
		public function agregar_abono(){
			
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));

					$id_prestamo=$this->uri->segment(3);
			if (!$id_prestamo) {
					$this->session->set_flashdata('alerta', 'Seleccione un Registro');
				redirect('prestamo/grilla_cobrador_estado_prestamo_aprobado','refresh');
			} else {
				$buscar=$this->prestamo_model->get_prestamo_id($id_prestamo);
				if ($buscar) {
					foreach ($buscar as $key) {
					$id_cliente=$key->id_cliente;
					}
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_prestamo');
					$crud->set_subject('Prestamo');
					$output = $crud->render();
					$data = array('prestamo' =>$this->prestamo_model->get_prestamo_id($id_prestamo),
					'dinero_sucursal'=>$this->cliente_model->get_cliente_dinero_sucursal($id_cliente),
					'cliente'=>$this->cliente_model->get_cliente_id($id_cliente));
					if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('prestamo/agregar_abono',$data);
					$this->load->view('../../assets/script/script_calculo_prestamo');
					$this->load->view('../../assets/inc/footer_common_add',$output);		
					} else {
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('prestamo/agregar_abono',$data);
					$this->load->view('../../assets/script/script_calculo_prestamo');
					$this->load->view('../../assets/inc/footer_common_add',$output);
					}
					
				} else {
					$this->session->set_flashdata('alerta', 'Registro no encontrado');
					redirect('prestamo/grilla','refresh');
				}		
			}


			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}
		}
		public function guardar_abono(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_prestamo=$this->input->post('txt_id_prestamo',TRUE);
				$id_tipo_prestamo_2='1';
				if ($id_prestamo) {
				$id_caja=$this->input->post('txt_id_caja',TRUE);
				$id_tipo_ingreso=2;
				$monto_sucursal=$this->input->post('txt_nuevo_monto_sucursal',TRUE);
				$cuota_abonada=$this->input->post('txt_cuota_abonar',TRUE);
				$monto=$this->input->post('txt_monto_cuota',TRUE);
				$cuota_abonar=$this->input->post('txt_cuota_abonar',TRUE);
				$cuotas_amortizadas=$this->input->post('txt_nuevas_cuotas_amortizadas',TRUE);
				$cuotas_debe=$this->input->post('txt_nuevas_cuotas_debe',TRUE);
				$prox_pago=$this->input->post('txt_fecha_prox_pago',TRUE);
				$nueva_deuda=$this->input->post('txt_nueva_deuda',TRUE);
				$total_debe=($this->input->post('txt_total_abono',TRUE));
				$observaciones=$this->input->post('txt_observaciones',TRUE);
				$fecha_cobro=$this->input->post('txt_fecha_abono',TRUE);


				if ($cuota_abonar==null || $cuotas_debe==null ||$prox_pago==null || $total_debe==null || $total_debe===0 || $observaciones==null ||$fecha_cobro==null) {
					
					$this->session->set_flashdata('alerta', 'Debe seleccionar todos los registros');
							redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
				}


				$this->prestamo_model->guardar_abono($id_prestamo,$id_tipo_prestamo_2,$cuota_abonada,$observaciones,$total_debe,$fecha_cobro,$prox_pago);
				$this->caja_model->guardar_det_caja($id_caja, $id_tipo_ingreso, $total_debe, $fecha_cobro);
				$this->caja_model->actualizar_caja($id_caja,$monto_sucursal);
				$this->prestamo_model->actualizar_abono_prestamo($id_prestamo,$cuotas_amortizadas,$cuotas_debe,$fecha_cobro,$prox_pago,$nueva_deuda);
				if ($data_usuario['id_nivel']==1|| $data_usuario['id_nivel']==2) {
					if ($nueva_deuda==0) {
						$estado_prestamo=5;
						$cuotas_debe=0;
						$this->prestamo_model->actualizar_estado_prestamo_finalizado($id_prestamo,$estado_prestamo,$cuotas_debe,$nueva_deuda);
						$this->session->set_flashdata('alerta', 'Abono Agregado y Prestamo Finaliado');
						redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
					}
				$this->session->set_flashdata('alerta', 'Abono Registrado Correctamente');
				redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
				} else {
					if ($nueva_deuda==0) {
						$estado_prestamo=5;
							$cuotas_debe=0;
						$this->prestamo_model->actualizar_estado_prestamo_finalizado($id_prestamo,$estado_prestamo,$cuotas_debe,$nueva_deuda);
						$this->session->set_flashdata('alerta', 'Abono Agregado y Prestamo Finaliado');
						redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
					}
				$this->session->set_flashdata('alerta', 'Abono Registrado Correctamente');
				redirect('prestamo/grilla_cobrador_estado_prestamo_aprobado','refresh');
				}
				}else{
				$this->session->set_flashdata('alerta', 'a ocurrido un error al guardar');
				redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
				}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}


		}
		public function generar_atraso(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));

				$id_prestamo=$this->uri->segment(3);
			if (!$id_prestamo) {
					if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
						$this->session->set_flashdata('alerta', 'Seleccione un Registro');
				redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
					} else {
						$this->session->set_flashdata('alerta', 'Seleccione un Registro');
				redirect('prestamo/grilla_cobrador_estado_prestamo_aprobado','refresh');
					}
					
			} else {
				$buscar=$this->prestamo_model->get_prestamo_id($id_prestamo);
				if ($buscar) {
					foreach ($buscar as $key) {
					$id_cliente=$key->id_cliente;
					}
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_prestamo');
					$crud->set_subject('Prestamo');
					$output = $crud->render();
					$data = array('prestamo' =>$this->prestamo_model->get_prestamo_id($id_prestamo),
					'cliente'=>$this->cliente_model->get_cliente_id($id_cliente));
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('prestamo/generar_atraso',$data);
					$this->load->view('../../assets/script/script_calculo_prestamo');
					$this->load->view('../../assets/inc/footer_common_add',$output);		
				} else {
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('prestamo/generar_atraso',$data);
					$this->load->view('../../assets/script/script_calculo_prestamo');
					$this->load->view('../../assets/inc/footer_common_add',$output);		
				}
				
				} else {
					if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
						$this->session->set_flashdata('alerta', 'Registro no encontrado');
					redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
					} else {
						$this->session->set_flashdata('alerta', 'Registro no encontrado');
					redirect('prestamo/grilla_cobrador_estado_prestamo_aprobado','refresh');
					}
					
				}		
			}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}


		}
		public function guardar_generar_atraso(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_prestamo=$this->input->post('txt_id_prestamo',TRUE);
				$atraso=$this->input->post('txt_atraso',TRUE);
				$fecha=date('Y-m-d');
				$fecha_prox_cobro=$this->input->post('txt_fecha_prox_pago',TRUE);
				$observaciones=$this->input->post('txt_observaciones',TRUE);
				$dias_mora=$this->input->post('txt_dias_mora',TRUE);
				$cuotas_debe=$this->input->post('txt_cuotas_debe',TRUE);
				$penalidad=$this->input->post('txt_penalidad',TRUE);
				$suma_dias_mora=$dias_mora+1;
				if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
					if ($suma_dias_mora==$atraso) {
				$sumar_cuotas_debe=$cuotas_debe+1;
				$suma_dias_mora=0;
				$penalidad=$penalidad+1;
				if ($id_prestamo==null ||$atraso==null ||$fecha==null ||$fecha_prox_cobro==null ||$observaciones==null ||$dias_mora==null ||$cuotas_debe==null ||$penalidad==null) {
							$this->session->set_flashdata('alerta', 'debe seleciconar todos los registros');
							redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
				}
				$this->prestamo_model->actualizar_prestamo_penalidad($id_prestamo,$fecha_prox_cobro,$penalidad,	$sumar_cuotas_debe,$suma_dias_mora);
				$this->prestamo_model->guardar_atraso($id_prestamo,$fecha,$fecha_prox_cobro,$observaciones);
				$this->session->set_flashdata('alerta', 'Atraso Generado, Se ha creado una penalidad');
				redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
				} else {
				$this->prestamo_model->actualizar_prestamo_dia_mora($id_prestamo,$fecha_prox_cobro,$suma_dias_mora);
				$this->prestamo_model->guardar_atraso($id_prestamo,$fecha,$fecha_prox_cobro,$observaciones);
				$this->session->set_flashdata('alerta', 'Atraso Generado');
				redirect('prestamo/grilla_todos_estado_prestamo_aprobado','refresh');
				}
					} else {
						if ($suma_dias_mora==$atraso) {
				$sumar_cuotas_debe=$cuotas_debe+1;
				$suma_dias_mora=0;
				$penalidad=$penalidad+1;
				if ($id_prestamo==null ||$atraso==null ||$fecha==null ||$fecha_prox_cobro==null ||$observaciones==null ||$dias_mora==null ||$cuotas_debe==null ||$penalidad==null) {
							$this->session->set_flashdata('alerta', 'debe seleciconar todos los registros');
							redirect('prestamo/grilla_cobrador_estado_prestamo_aprobado','refresh');
				}
				$this->prestamo_model->actualizar_prestamo_penalidad($id_prestamo,$fecha_prox_cobro,$penalidad,	$sumar_cuotas_debe,$suma_dias_mora);
				$this->prestamo_model->guardar_atraso($id_prestamo,$fecha,$fecha_prox_cobro,$observaciones);
				$this->session->set_flashdata('alerta', 'Atraso Generado, Se ha creado una penalidad');
				redirect('prestamo/grilla_cobrador_estado_prestamo_aprobado','refresh');
				} else {
				$this->prestamo_model->actualizar_prestamo_dia_mora($id_prestamo,$fecha_prox_cobro,$suma_dias_mora);
				$this->prestamo_model->guardar_atraso($id_prestamo,$fecha,$fecha_prox_cobro,$observaciones);
				$this->session->set_flashdata('alerta', 'Atraso Generado');
				redirect('prestamo/grilla_cobrador_estado_prestamo_aprobado','refresh');
				}
					}

			} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}
		}
}
/*fin de prestamo*/