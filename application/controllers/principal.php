<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('cliente_model');
			$this->load->model('caja_model');
			$this->load->model('prestamo_model');
			$this->load->model('gasto_model');
			$this->load->model('cobrador_model');
	}

	public function index(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$fecha=date('Y-m-d');
			if ($data_usuario['id_nivel']==1 || $data_usuario['id_nivel']==2) {
				$data_panel = array('cliente_registrados' =>$this->cliente_model->contar_cliente(),
				'dinero_capital'=>$this->caja_model->suma_capital_todos(),
				'dinero_x_recolectar'=>$this->prestamo_model->suma_dinero_recoger($fecha),
				'dinero_recogido'=>$this->prestamo_model->suma_dinero_recogido($fecha),
				'prestamos_x_aprobar'=>$this->prestamo_model->prestamos_x_aprobar(),
				'prestamos_atrasados'=>$this->prestamo_model->contar_atrasos($fecha));

				$mes=date('m');
				$ano=date('Y');
				$fecha_i= date('Y-m-d', mktime(0,0,0, $mes, 1, $ano));
				$fecha_f=date('Y-m-d', mktime(0,0,0, $mes+1, 0, $ano));
				/**********************gastos*******************************************/
				$sumar_pagos=$this->prestamo_model->sumar_pagos_entre_fechas($fecha_i, $fecha_f);

				if ($sumar_pagos) {
					foreach ($sumar_pagos as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data1[] = $fecha;
						$series_data2[] =(real)$key->total;
					}
						$this->view_data['series_data1']=json_encode($series_data1);
						$this->view_data['series_data2']=json_encode($series_data2);
				} else {
					$series_data1[] =0;
					$series_data2[] =0;
					$this->view_data['series_data1']=json_encode($series_data1);
					$this->view_data['series_data2']=json_encode($series_data2);
				}
				/***************************************************************************/
				/*************************sumar gastos**************************************/
				$sumar_gastos=$this->gasto_model->sumar_gasto_entre_fechas($fecha_i, $fecha_f);
				if ($sumar_gastos) {
					foreach ($sumar_gastos as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data3[] = $fecha;
						$series_data4[] =(real)$key->total;
					}
						$this->view_data['series_data3']=json_encode($series_data3);
						$this->view_data['series_data4']=json_encode($series_data4);
				} else {
					$series_data3[] =0;
					$series_data4[] =0;
					$this->view_data['series_data3']=json_encode($series_data3);
					$this->view_data['series_data4']=json_encode($series_data4);
				}
					/*************************Contar Prestamos aprobados*************************/
			$contar_prestamos_aprobados=$this->prestamo_model->contar_prestamos($fecha_i, $fecha_f);
				if ($contar_prestamos_aprobados) {
					foreach ($contar_prestamos_aprobados as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data5[] = $fecha;
						$series_data6[] =(real)$key->total;
					}
						$this->view_data['series_data5']=json_encode($series_data5);
						$this->view_data['series_data6']=json_encode($series_data6);
				} else {
					$series_data5[] =0;
					$series_data6[] =0;
					$this->view_data['series_data5']=json_encode($series_data5);
					$this->view_data['series_data6']=json_encode($series_data6);
				}


				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_nivel');
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common',$output);
				$this->load->view('../../assets/script/script_grafico_data',$this->view_data);
				$this->load->view('../../assets/inc/menu_lateral_admin',$data_usuario);
				$this->load->view('../../assets/inc/menu_superior',$data_usuario);
				$this->load->view('../../assets/inc/central',$data_panel);
				$this->load->view('../../assets/inc/footer_common');	
			/****************************************************************/
			/****************************************************************/
			} elseif ($data_usuario['id_nivel']==3) {
				$buscar_cobrador=$this->cobrador_model->get_usuario_cobrador_id($data_usuario['id_usuario']);
				foreach ($buscar_cobrador as $key) {
					$id_cobrador=$key->id;
				}
				$dinero_recogido=$this->prestamo_model->suma_dinero_recogido_cobrador($fecha,$id_cobrador);
				$gasto_generados=$this->gasto_model->sumar_gasto_cobrador($id_cobrador, $fecha);
				if ($dinero_recogido) {
					foreach ($dinero_recogido as $key) {
					$dinero_1=$key->monto;
						}
				}else{
					$dinero_1=0;
				}
				if ($gasto_generados) {
						foreach ($gasto_generados as $key) {
					$gasto_1=$key->total;
						}	
				}else{
					$gasto_1=0;
				}
				$dinero_entregar=$dinero_1-$gasto_1;
			$data_panel = array(
			'cliente_registrados' =>$this->cliente_model->contar_cliente_x_cobrador($id_cobrador),
			'dinero_x_recolectar'=>$this->prestamo_model->suma_dinero_recoger_cobrador($fecha,$id_cobrador),
			'dinero_recogido'=>$this->prestamo_model->suma_dinero_recogido_cobrador($fecha,$id_cobrador),
			'prestamos_atrasados'=>$this->prestamo_model->contar_atrasos_cobrador($fecha,$id_cobrador),
			'dinero_entregar'=>$dinero_entregar);
				$mes=date('m');
				$ano=date('Y');
				$fecha_i= date('Y-m-d', mktime(0,0,0, $mes, 1, $ano));
				$fecha_f=date('Y-m-d', mktime(0,0,0, $mes+1, 0, $ano));
				/**********************gastos*******************************************/
				$sumar_pagos=$this->prestamo_model->sumar_pagos_entre_fechas_cobrador($id_cobrador, $fecha_i, $fecha_f);


				if ($sumar_pagos) {
					foreach ($sumar_pagos as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data1[] = $fecha;
						$series_data2[] =(real)$key->total;
					}
						$this->view_data['series_data1']=json_encode($series_data1);
						$this->view_data['series_data2']=json_encode($series_data2);
				} else {
					$series_data1[] =0;
					$series_data2[] =0;
					$this->view_data['series_data1']=json_encode($series_data1);
					$this->view_data['series_data2']=json_encode($series_data2);
				}
				/***************************************************************************/
				/*************************sumar gastos**************************************/
				$sumar_gastos=$this->gasto_model->sumar_gasto_entre_fechas_cobrador($id_cobrador,$fecha_i, $fecha_f);
				if ($sumar_gastos) {
					foreach ($sumar_gastos as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data3[] = $fecha;
						$series_data4[] =(real)$key->total;
					}
						$this->view_data['series_data3']=json_encode($series_data3);
						$this->view_data['series_data4']=json_encode($series_data4);
				} else {
					$series_data3[] =0;
					$series_data4[] =0;
					$this->view_data['series_data3']=json_encode($series_data3);
					$this->view_data['series_data4']=json_encode($series_data4);
				}
					/*************************Contar Prestamos aprobados*************************/
		/*	$contar_prestamos_aprobados=$this->prestamo_model->contar_prestamos($fecha_i, $fecha_f);
				if ($contar_prestamos_aprobados) {
					foreach ($contar_prestamos_aprobados as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data5[] = $fecha;
						$series_data6[] =(real)$key->total;
					}
						$this->view_data['series_data5']=json_encode($series_data5);
						$this->view_data['series_data6']=json_encode($series_data6);
				} else {
					$series_data5[] =0;
					$series_data6[] =0;
					$this->view_data['series_data5']=json_encode($series_data5);
					$this->view_data['series_data6']=json_encode($series_data6);
				}*/

					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_nivel');
					$crud->set_subject('Bodega');
					$crud->set_language('spanish');
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common',$output);
					$this->load->view('../../assets/script/script_grafico_data_cobrador',$this->view_data);
					$this->load->view('../../assets/inc/menu_lateral_cobrador',$data_usuario);
					$this->load->view('../../assets/inc/menu_superior',$data_usuario);
					$this->load->view('../../assets/inc/central_cobrador',$data_panel);
					$this->load->view('../../assets/inc/footer_common');	
			}
		} else {
			$this->session->set_flashdata('alerta', 'Debe Iniciar Sesion');
			redirect('login/index','refresh');
		}
	}
}