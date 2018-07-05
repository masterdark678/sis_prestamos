<?php
class Caja_model extends CI_Model{
	
	public function get_sucursal_id($id_caja) {
        $this->db->select('t_caja.id as id_caja, t_caja.id_sucursal as id_sucursal, t_caja.total_caja, t_sucursal.descripcion as descripcion_sucursal, t_sucursal.direccion as direccion_sucursal');
        $this->db->where('t_caja.id', $id_caja);
        $this->db->join('t_sucursal', 't_caja.id_sucursal = t_sucursal.id', 'left');
        $consulta=$this->db->get('t_caja',1);
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function get_det_sucursal($id_caja){
    	$this->db->select('t_det_caja.monto as monto, t_tipo_caja.descripcion as descripcion_tipo_ingreso, t_det_caja.fecha as fecha_det_caja');
    	$this->db->where('t_det_caja.id_caja', $id_caja);
    	$this->db->join('t_tipo_caja', 't_det_caja.id_tipo_ingreso = t_tipo_caja.id', 'left');
    	$consulta=$this->db->get('t_det_caja');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function guardar_det_caja($id_caja, $id_tipo_ingreso, $monto_aprobado, $fecha){
    	$data = array('id_caja' =>$id_caja,
    	'id_tipo_ingreso'=>$id_tipo_ingreso,
    	'monto'=>$monto_aprobado,
        'fecha'=>$fecha);
    	$this->db->insert('t_det_caja', $data);
    }
    public function actualizar_caja($id_caja,$monto_sucursal){
    	$data = array('total_caja' =>$monto_sucursal);
    	$this->db->where('id', $id_caja);
    	$this->db->update('t_caja', $data);
    }
    public function suma_capital_todos(){
         $this->db->select_sum('total_caja');
         $consulta=$this->db->get('t_caja');
          if($consulta->num_rows() > 0){ 
            return $consulta->result();
        }
    }
    
}