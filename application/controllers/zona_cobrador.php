<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zona_cobrador extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('zona_model');
			$this->load->model('cliente_model');
			$this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('zona_cobrador/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_zona_cobrador');
				$crud->set_subject('Zona a Cobrador');
				$crud->set_relation('id_sucursal','t_sucursal','descripcion');
				$crud->set_relation('id_zona','t_zona','Zona');
				$crud->set_relation('id_cobrador','t_cobrador','nombre');
				$crud->set_language('spanish');
				$crud->display_as('id_sucursal','Sucursal');
				$crud->display_as('id_zona','Zona');
				$crud->display_as('id_cobrador','Cobrador');
				$crud->columns('id_sucursal','id_zona','id_cobrador');
				$crud->required_fields('id_sucursal','id_zona','id_cobrador');
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->unset_read();
				/*$crud->unset_delete();*/
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('zona_cobrador/zona_cobrador',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
		
			} elseif ($data_usuario['id_nivel'] ==3) {
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
			function fn_ver($primary_key , $row){
		return site_url('zona_cobrador/ver_zona_cobrador').'/'.$row->id;
		}
		public function ver_zona_cobrador(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

			$id_zona=$this->uri->segment(3);
			$consulta=$this->zona_model->get_zona_id($id_zona);
			if (!$consulta) {
				$this->session->set_flashdata('alerta', 'Ocurrió un Error en la Consulta');
				redirect('zona_cobrador/grilla','refresh');
			}
			foreach ($consulta as $key) {
				$id_cobrador=$key->id_cobrador;
			}
			
			$data = array('zona' =>$this->zona_model->get_zona_id($id_zona),
			'cliente_cobrador'=>$this->cliente_model->get_cliente_id_cobrador($id_cobrador));
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_zona_cobrador');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('zona_cobrador/ver_zona_cobrador',$data);
				$this->load->view('../../assets/inc/footer_common',$output);
		
			}else{
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}
		}
		public function imprimir_zona_cobrador(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

			$id_zona=$this->input->post('txt_id_zona',TRUE);

			$consulta=$this->zona_model->get_zona_id($id_zona);
			if (!$consulta) {
				$this->session->set_flashdata('alerta', 'Ocurrió un Error en la Consulta');
				redirect('zona_cobrador/grilla','refresh');
			}
			foreach ($consulta as $key) {
				$id_cobrador=$key->id_cobrador;
			}
			
			$data = array('zona' =>$this->zona_model->get_zona_id($id_zona),
			'cliente_cobrador'=>$this->cliente_model->get_cliente_id_cobrador($id_cobrador));
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_zona_cobrador');
				$output = $crud->render();
				$this->load->view('zona_cobrador/imprimir_zona_cobrador',$data );
					#toma lo que se muestra en pantalla
					$html = $this->output->get_output();
					# lo pasa a pdf
				/*si quiero la hoja en horizonal*/
				/*	$this->dompdf->set_paper('letter','landscape');*/
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("hoja_de_ruta.pdf",array('Attachment'=>0));
		
			}else{
				$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
				redirect('login/index','refresh');
			}
		}


}
/*Fin del controller*/