<?php
class Cobrador_model extends CI_Model{
	
    public function get_cobrador() {
        $consulta=$this->db->get('t_cobrador');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function get_cobrador_id($id_cobrador){
    	$this->db->where('id', $id_cobrador);
    	$consulta=$this->db->get('t_cobrador');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }	
    }
    public function get_usuario_cobrador_id($id_cobrador){
        $this->db->where('id_usuario', $id_cobrador);
        $consulta=$this->db->get('t_cobrador',1);
         if($consulta->num_rows() > 0){ 
            return $consulta->result();
            }
    }
    public function actualizar_cobrador($id_cobrador,$id_usuario){
    	$data = array('id_usuario' =>$id_usuario);
    	$this->db->where('id', $id_cobrador);
    	$this->db->update('t_cobrador', $data);

    }
}