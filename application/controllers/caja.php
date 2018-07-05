<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Caja extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('sucursal_model');
			$this->load->model('caja_model');
			$this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('caja/grilla');
	}
	public function grilla(){
		
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_caja');
				$crud->set_relation('id_sucursal','t_sucursal','descripcion');
				$crud->set_subject('Caja a Sucursal');
				$crud->set_language('spanish');
				$crud->display_as('id_sucursal','Sucursal');
				$crud->display_as('total_caja','Dinero');
				$crud->columns('id_sucursal','total_caja');
				$crud->required_fields('id_sucursal','total_caja');
				$crud->add_action('Ver Movimientos de Sucursal', 'fa fa-credit-card', '', '',array($this,'fn_ver_sucursal'));
			if ($data_usuario['id_nivel']==1) {
				$crud->unset_delete();
				$crud->unset_edit();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('caja/caja',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			} elseif ($data_usuario['id_nivel']==2) {
				$crud->unset_delete();
				$crud->unset_edit();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('caja/caja',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			} elseif ($data_usuario['id_nivel']==3) {
				$crud->unset_delete();
				$crud->unset_edit();
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
	public function fn_ver_sucursal($primary_key , $row){
		return site_url('caja/ver_mov_sucursal').'/'.$row->id;
	}
	public function ver_mov_sucursal(){

		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));

			$id_caja=$this->uri->segment(3);
			$buscar=$this->caja_model->get_sucursal_id($id_caja);
		if ($buscar) {
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_caja');
			$crud->set_subject('Caja');
			$output = $crud->render();
			$data = array('sucursal' =>$this->caja_model->get_sucursal_id($id_caja),
			'det_sucursal'=>$this->caja_model->get_det_sucursal($id_caja));
		} else {
			$this->session->set_flashdata('alerta', 'Registro no encontrado');
			redirect('caja/grilla','refresh');
		}
			if ($data_usuario['id_nivel']==1) {
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('caja/det_sucursal',$data);
				$this->load->view('../../assets/inc/footer_common',$output);
			} elseif ($data_usuario['id_nivel']==2) {
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('caja/det_sucursal',$data);
				$this->load->view('../../assets/inc/footer_common',$output);
			} elseif ($data_usuario['id_nivel']==3) {
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('error/permiso',$data);
				$this->load->view('../../assets/inc/footer_common',$output);
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
			
		}
	}
		public function imprimir_det_sucursal(){
			$id_caja=$this->input->post('txt_id_caja',TRUE);
			$buscar=$this->caja_model->get_sucursal_id($id_caja);
		if ($buscar) {
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_caja');
			$crud->set_subject('Caja');
			$output = $crud->render();
			$data = array('sucursal' =>$this->caja_model->get_sucursal_id($id_caja),
			'det_sucursal'=>$this->caja_model->get_det_sucursal($id_caja));
			$this->load->view('../../assets/inc/head_common',$output);
			$this->load->view('caja/imprimir_det_sucursal',$data);
			#toma lo que se muestra en pantalla
        $html = $this->output->get_output();
        # lo pasa a pdf
       $this->dompdf->load_html($html);
       $this->dompdf->render();
       $this->dompdf->stream("mov_sucursal.pdf",array('Attachment'=>0));
		} else {
			$this->session->set_flashdata('alerta', 'Registro no encontrado');
			redirect('caja/grilla','refresh');
		}

		}
		
	


}