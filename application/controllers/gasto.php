<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gasto extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('tipo_gasto_model');
			$this->load->model('gasto_model');
			$this->load->library('dompdf_gen');
			$this->load->model('cobrador_model');

	}
	public function index(){
			redirect('gasto/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$this->gasto_model->eliminar_gasto_total_0();
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_gasto');
				$crud->set_relation('id_cobrador','t_cobrador','nombre');
				$crud->set_subject('Gasto');
				$crud->set_language('spanish');
				$crud->display_as('id_cobrador','Cobrador');
				$crud->display_as('total','Total');
				$crud->display_as('fecha','Fecha');
				$crud->columns('id_cobrador','total','fecha');
				$crud->required_fields('total','fecha');
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->unset_read();
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('gasto/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('gasto/gasto',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
	
			} elseif ($data_usuario['id_nivel']==3) {
					$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
					if (!$buscar_cobrador) {
					redirect('principal','refresh');
					}	
					foreach ($buscar_cobrador as $key) {
					$id_cobrador=$key->id;
					}
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_gasto');
				$crud->set_relation('id_cobrador','t_cobrador','nombre');
				$crud->where('id_cobrador',$id_cobrador);
				$crud->set_subject('Gasto');
				$crud->set_language('spanish');
				$crud->display_as('id_cobrador','Cobrador');
				$crud->display_as('total','Total');
				$crud->display_as('fecha','Fecha');
				$crud->columns('id_cobrador','total','fecha');
				$crud->required_fields('total','fecha');
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->unset_read();
				$crud->unset_delete();
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('gasto/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('gasto/gasto',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}
		
	}
	function fn_ver($primary_key , $row){
		return site_url('gasto/ver_det_gasto').'/'.$row->id;
	}
	public function add(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_gasto');
				$crud->set_subject('Gasto');
				$output = $crud->render();
				$total="0";
				$fecha=date('Y-m-d');
				$this->gasto_model->guardar_gasto($total,$fecha);
				$data = array('tipo_gasto' =>$this->tipo_gasto_model->get_tipo_gasto(),
				'ultimo_gasto'=>$this->gasto_model->get_max_gasto(),
				'cobrador'=>$this->cobrador_model->get_cobrador());
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('gasto/add_gasto',$data );
				$this->load->view('../../assets/inc/footer_common_add_gasto',$output);

			} elseif ($data_usuario['id_nivel']==3) {
					$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
					if (!$buscar_cobrador) {
					redirect('principal','refresh');
					}	
					foreach ($buscar_cobrador as $key) {
					$id_cobrador=$key->id;
					}
					$total="0";
					$fecha=date('Y-m-d');
					$this->gasto_model->guardar_gasto($total,$fecha);
					$data = array('tipo_gasto' =>$this->tipo_gasto_model->get_tipo_gasto(),
					'ultimo_gasto'=>$this->gasto_model->get_max_gasto(),
					'cobrador'=>$id_cobrador);
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_empresa');
					$crud->set_subject('Cliente');
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('gasto/add_gasto_2',$data );
					$this->load->view('../../assets/inc/footer_common_add_gasto',$output);

			}
		} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
		}
		
	}

	public function guardar_det_gasto_item(){
		if($this->input->is_ajax_request()){
			$id_gasto= $this->input->post('txt_id_gasto',TRUE);
			$id_tipo_gasto=$this->input->post('id_tipo_gasto',TRUE);
			$descripcion=$this->input->post('txt_descripcion',TRUE);
			$cantidad= $this->input->post('txt_cantidad',TRUE);
			$total=$this->input->post('txt_total',TRUE);
			$this->gasto_model->guardar_det_gasto($id_gasto,$id_tipo_gasto,$descripcion,$cantidad,$total);
		}
	}
	public function mostrar_det_gasto(){
		if($this->input->is_ajax_request()){
			$id_gasto= $this->input->post('txt_id_gasto');
			if ($datos=$this->gasto_model->get_det_gasto($id_gasto))
			{
				echo json_encode($datos);
			}else{
				$datos=null;
				echo json_encode($datos);
			}
		}
	}
	public function eliminar_det_gasto(){
	if ($this->input->is_ajax_request()) {
		$id_det_gasto = $this->input->post("id");
			$this->gasto_model->eliminar_det_gasto($id_det_gasto);
	}
	}
	public function eliminar_gasto(){
		if ($this->input->is_ajax_request()) {
			$id_gasto = $this->input->post("id");
			$this->gasto_model->eliminar_gasto($id_gasto);
		}
	}
	public function guardar_gasto(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_gasto=$this->input->post('txt_id_gasto',TRUE);
				$fecha=$this->input->post('txt_fecha',TRUE);
				$total=$this->input->post('txt_total_2',TRUE);

				
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$id_cobrador=$this->input->post('id_cobrador',TRUE);
				if ($id_gasto==null ||$fecha==null ||$total==null ||$id_cobrador==null) {
								$this->session->set_flashdata('alerta', 'Debe seleccionar los registros de gastos');
								redirect('gasto/grilla','refresh');
				}
				$this->gasto_model->actualizar_gasto($id_gasto,$id_cobrador,$fecha,$total);
				$this->session->set_flashdata('alerta', 'Gasto Guardado Correctamente');
				redirect('gasto/grilla','refresh');
			} elseif ($data_usuario['id_nivel']==3) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_empresa');
					$crud->set_subject('Cliente');
					$output = $crud->render();
					$id_gasto=$this->input->post('txt_id_gasto',TRUE);
					$fecha=$this->input->post('txt_fecha',TRUE);
					$total=$this->input->post('txt_total_2',TRUE);
					$id_cobrador=$this->input->post('txt_id_cobrador',TRUE);
					$this->gasto_model->actualizar_gasto($id_gasto,$id_cobrador,$fecha,$total);
					$this->session->set_flashdata('alerta', 'Gasto Guardado Correctamente');
					redirect('gasto/grilla','refresh');			
				}

		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
		}
		
	}
	public function ver_det_gasto(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_gasto=$this->uri->segment(3);
				if (!$id_gasto) {
					$this->session->set_flashdata('alerta', 'Seleccione un registro');
					redirect('gasto/grilla','refresh');
				} else {

					$data = array('gasto' =>$this->gasto_model->get_gasto_id($id_gasto),
					'det_gasto'=>$this->gasto_model->get_det_gasto($id_gasto));
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_gasto');
					$crud->set_subject('Gasto');
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('gasto/ver_gasto',$data );
					$this->load->view('../../assets/inc/footer_common_add_gasto',$output);

				}
				
		} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
		}
	}

	public function imprimir_gasto(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_gasto=$this->input->post('txt_id_gasto',TRUE);
				if (!$id_gasto) {
					$this->session->set_flashdata('alerta', 'Seleccione un registro');
					redirect('gasto/grilla','refresh');
				} else {

					$data = array('gasto' =>$this->gasto_model->get_gasto_id($id_gasto),
					'det_gasto'=>$this->gasto_model->get_det_gasto($id_gasto));
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_gasto');
					$crud->set_subject('Gasto');
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('gasto/imprimir_gasto',$data );
					#toma lo que se muestra en pantalla
					$html = $this->output->get_output();
					# lo pasa a pdf
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("det_caja.pdf",array('Attachment'=>0));
				}
				
		} else {
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
		}
	}

}