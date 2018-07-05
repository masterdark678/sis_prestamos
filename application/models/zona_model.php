<?php
class Zona_model extends CI_Model{
	
	public function get_zona() {
        $consulta=$this->db->get('t_zona');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
  public function get_zona_id($id_zona){
  	$this->db->select('t_zona_cobrador.id as id_zona_cobrador, t_zona_cobrador.id_sucursal as id_sucursal,t_zona_cobrador.id_cobrador as id_cobrador, t_cobrador.dni as dni_cobrador, t_sucursal.descripcion as descripcion_sucursal, t_cobrador.nombre as nombre_cobrador, t_zona.zona as zona, t_zona.direccion as direccion');
  	$this->db->join('t_cobrador', 't_zona_cobrador.id_cobrador = t_cobrador.id', 'left');
  	$this->db->join('t_sucursal', 't_zona_cobrador.id_sucursal = t_sucursal.id', 'left');
  	$this->db->join('t_zona', 't_zona_cobrador.id_zona = t_zona.id', 'left');
  	$this->db->where('t_zona_cobrador.id_zona', $id_zona);
  	$consulta=$this->db->get('t_zona_cobrador',1);
  	 if($consulta->num_rows() > 0){ 
  			return $consulta->result();
  	   }
  	

  }
    
}