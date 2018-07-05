<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('usuario_model');
			$this->load->helper('security');
	}

	public function index(){
		

		$this->load->view('../../assets/inc/head_common_login');
		$this->load->view('login/login');
		
	}
	public function iniciar_sesion(){
		$usuario=$this->input->post('txt_nombre_ususario',TRUE);
		$pass=$this->input->post('txt_pass',TRUE);
		$hash_pass=do_hash($pass);
		$buscar=$this->usuario_model->get_usuario_login($usuario,$hash_pass);

		if ($buscar) {
		foreach ($buscar as $key) {
			$usuario_data = array(
             'id' => $key->id,
             'id_estado_usuario'=>$key->id_estado_usuario,
             'id_nivel' => $key->id_nivel,
             'nombre' => $key->nombre,
             'logueado' => TRUE
          );
		}
		   $this->session->set_userdata($usuario_data);
		  if ($usuario_data['id_estado_usuario']==1) {
		  	 redirect('login/logueado');
		  } else {
		  	$this->session->set_flashdata('alerta', 'Usuario Inactivo');
		  	redirect('login/index','refresh');
		  }
		} else {
			$this->session->set_flashdata('alerta', 'Usuario o Clave Invalidos');
			redirect('login/index','refresh');
			
		}
	}
		public function logueado() {
			if($this->session->userdata('logueado')){
				redirect('principal','refresh');
				}else{
					redirect('login/index');
				}
  		}
  	public function cerrar_sesion() {
      $usuario_data = array(
         'logueado' => FALSE
      );
     $this->session->sess_destroy();
      redirect('login');
   }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */