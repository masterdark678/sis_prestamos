<?php

class Cierre_x_cobrador_model extends CI_Model {

		public function guardar_cierre_x_cobrador($id_cobrador,$dinero_cobrado,$dinero_recibido,$dinero_total,$observaciones,$fecha){
			$data = array('id_cobrador' =>$id_cobrador,
			'monto_cobrado'=>$dinero_cobrado,
			'monto_entregado'=>$dinero_recibido,
			 'total'=>$dinero_recibido,
			 'observaciones'=>$observaciones,
			 'fecha'=>$fecha);
			$this->db->insert('t_cierre_x_cobrador', $data);
		}
		public function get_suma_cierre_cobrador($id_cobrador,$fecha_i, $fecha_f){
			$this->db->select_sum('monto_cobrado');
			$this->db->where('id_cobrador', $id_cobrador);
			$this->db->where('fecha >=', $fecha_i);
			$this->db->where('fecha <=', $fecha_f);
			$consulta=$this->db->get('t_cierre_x_cobrador');
    	  if($consulta->num_rows() > 0){
            return $consulta->result();
        }
		}
		public function get_suma_cierre_sucursal($id_sucursal,$fecha_i, $fecha_f){
			$this->db->select_sum('t_cierre_x_cobrador.monto_cobrado');
			$this->db->join('t_cobrador', 't_cierre_x_cobrador.id_cobrador = t_cobrador.id', 'left');
			$this->db->join('t_zona_cobrador', 't_zona_cobrador.id_cobrador = t_cobrador.id', 'right');
			$this->db->join('t_sucursal', 't_zona_cobrador.id_sucursal = t_sucursal.id', 'right');
			$this->db->where('t_sucursal.id', $id_sucursal);
			$this->db->where('fecha >=', $fecha_i);
			$this->db->where('fecha <=', $fecha_f);
			$consulta=$this->db->get('t_cierre_x_cobrador');
    	  if($consulta->num_rows() > 0){
            return $consulta->result();
        }
		}
		public function get_cobradores_cierre_sucursal($id_sucursal,$fecha_i, $fecha_f){
			$this->db->select('t_cierre_x_cobrador.monto_cobrado as monto_cobrado, t_cobrador.nombre as nombre_cobrador, t_cierre_x_cobrador.fecha as fecha');
			$this->db->join('t_cobrador', 't_cierre_x_cobrador.id_cobrador = t_cobrador.id', 'left');
			$this->db->join('t_zona_cobrador', 't_zona_cobrador.id_cobrador = t_cobrador.id', 'right');
			$this->db->join('t_sucursal', 't_zona_cobrador.id_sucursal = t_sucursal.id', 'right');
			$this->db->where('t_sucursal.id', $id_sucursal);
			$this->db->where('fecha >=', $fecha_i);
			$this->db->where('fecha <=', $fecha_f);
			$consulta=$this->db->get('t_cierre_x_cobrador');
    	  if($consulta->num_rows() > 0){
            return $consulta->result();
        }
		}
		public function get_suma_cierre_todos($fecha_i, $fecha_f){
			$this->db->select_sum('monto_cobrado');
			$this->db->where('fecha >=', $fecha_i);
			$this->db->where('fecha <=', $fecha_f);
			$consulta=$this->db->get('t_cierre_x_cobrador');
    	  if($consulta->num_rows() > 0){
            return $consulta->result();
        }
		}
		public function detallado_cierre_cobrador($id_cobrador,$fecha_i, $fecha_f){
			$this->db->where('id_cobrador', $id_cobrador);
			$this->db->where('fecha >=', $fecha_i);
			$this->db->where('fecha <=', $fecha_f);
			$consulta=$this->db->get('t_cierre_x_cobrador');
    	  if($consulta->num_rows() > 0){
            return $consulta->result();
        }
		}
		public function detallado_cierre_todos($fecha_i, $fecha_f){
			$this->db->select('t_cierre_x_cobrador.monto_cobrado as monto_cobrado, t_cobrador.nombre as nombre_cobrador, t_cierre_x_cobrador.fecha as fecha');
			$this->db->join('t_cobrador', 't_cierre_x_cobrador.id_cobrador = t_cobrador.id', 'left');
			$this->db->where('fecha >=', $fecha_i);
			$this->db->where('fecha <=', $fecha_f);
			$consulta=$this->db->get('t_cierre_x_cobrador');
    	  if($consulta->num_rows() > 0){
            return $consulta->result();
        }
		}

	

}

/* End of file cierre_x_cobrador_model.php */
/* Location: ./application/models/cierre_x_cobrador_model.php */