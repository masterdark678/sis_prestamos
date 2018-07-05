<?php
class Documentacion_model extends CI_Model{
	
	public function get_documentacion() {
        $consulta=$this->db->get('t_documentacion_cliente');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    
}