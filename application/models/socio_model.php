<?php
class Socio_model extends CI_Model{
	
    public function get_socio() {
        $consulta=$this->db->get('t_socio');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function get_socio_id($id_socio){
    	$this->db->where('id', $id_socio);
    	$consulta=$this->db->get('t_socio');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }	
    }
    public function actualizar_socio($id_socio,$id_usuario){
    	$data = array('id_usuario' =>$id_usuario);
    	$this->db->where('id', $id_socio);
    	$this->db->update('t_socio', $data);
    }
}