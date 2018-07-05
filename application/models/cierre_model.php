<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cierre_model extends CI_Model {

	public function guardar_cierre($monto,$monto_recibido,$total,$observaciones,$fecha){
			$data = array(
				'monto'=>$monto,
				'monto_recibido'=>$monto_recibido,
				'total'=>$total,
				'observaciones'=>$observaciones,
				'fecha'=>$fecha);
			$this->db->insert('t_cierre', $data);
		}	

}


/* End of file cierre_model.php */
/* Location: ./application/models/cierre_model.php */