<?php
class Gasto_model extends CI_Model{
    public function get_max_gasto() {
        $this->db->select_max('id');
        $consulta=$this->db->get('t_gasto');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function guardar_gasto($total,$fecha){
    	$data = array('total' =>$total,
    	'fecha'=>$fecha);
    	$this->db->insert('t_gasto', $data);
    }
    public function guardar_det_gasto($id_gasto,$id_tipo_gasto,$descripcion,$cantidad,$total){
    	$data = array(
    	'id_gasto' =>$id_gasto,
    	'id_tipo_gasto'=>$id_tipo_gasto,
    	'descripcion'=>$descripcion,
    	'cantidad'=>$cantidad,
    	'monto'=>$total);
    	$this->db->insert('t_det_gasto', $data);
    }
    public function get_det_gasto($id_gasto) {
    	$this->db->select('t_det_gasto.id as id_det_gasto, t_tipo_gasto.descripcion as tipo_gasto, t_det_gasto.descripcion as descripcion, t_det_gasto.cantidad as cantidad, t_det_gasto.monto as monto');
    	$this->db->join('t_tipo_gasto', 't_det_gasto.id_tipo_gasto = t_tipo_gasto.id', 'left');
      $this->db->where('id_gasto', $id_gasto);
      $consulta=$this->db->get('t_det_gasto');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function eliminar_det_gasto($id_det_gasto){
    	$this->db->where('id', $id_det_gasto);
    	$this->db->delete('t_det_gasto');
    }
    public function eliminar_gasto($id_gasto){
    	$this->db->where('id', $id_gasto);
    	$this->db->delete('t_gasto');
    }
    public function actualizar_gasto($id_gasto,$id_cobrador,$fecha,$total){
        $data = array('id_cobrador'=>$id_cobrador,
        'fecha' =>$fecha,
        'total'=>$total);
        $this->db->where('id', $id_gasto);
        $this->db->update('t_gasto', $data);
    }
    public function eliminar_gasto_total_0(){
    $this->db->where('total','0');
    $this->db->delete('t_gasto');
    }
    public function get_gasto_id($id_gasto){
        $this->db->where('id', $id_gasto);
        $consulta=$this->db->get('t_gasto',1);
         if($consulta->num_rows() > 0){ 
            return $consulta->result();
            }
    }
    public function sumar_gasto_entre_fechas($fecha_i, $fecha_f){
            $this->db->select('fecha as fecha, sum(total) as total');
            $this->db->group_by('fecha');
      $this->db->where('fecha >=',$fecha_i);
      $this->db->where('fecha <=',$fecha_f);
      $consulta=$this->db->get('t_gasto');
      if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
     public function sumar_gasto_entre_fechas_cobrador($id_cobrador,$fecha_i, $fecha_f){
      $this->db->select('fecha as fecha, sum(total) as total');
      $this->db->group_by('fecha');
      $this->db->where('id_cobrador', $id_cobrador);
      $this->db->where('fecha >=',$fecha_i);
      $this->db->where('fecha <=',$fecha_f);
      $consulta=$this->db->get('t_gasto');
      if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
     public function sumar_gasto_cobrador($id_cobrador, $fecha){
        $this->db->select('fecha, sum(total) as total');
        $this->db->where('id_cobrador', $id_cobrador);
        $this->db->where('fecha ',$fecha);
        $consulta=$this->db->get('t_gasto');
          if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
}




