<?php
class Reputacion_model extends CI_Model{
	
    public function get_reputacion() {
        $consulta=$this->db->get('t_reputacion');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
}