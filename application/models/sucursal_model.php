<?php
class Sucursal_model extends CI_Model{
	
	public function buscar_sucursal($id_sucursal) {
        $this->db->select('t_sucursal.id as id_sucursal, t_sucursal.descripcion as descripcion, t_sucursal.direccion as direccion');
        $this->db->where('t_sucursal.id', $id_sucursal);
       $consulta= $this->db->get('t_sucursal',1);
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
   public function get_sucursal(){
   	$consulta=$this->db->get('t_sucursal');
    	  if($consulta->num_rows() > 0){
            return $consulta->result();
        }
   }

    
}