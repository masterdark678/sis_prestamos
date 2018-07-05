<?php
class Tipo_gasto_model extends CI_Model{
	
    public function get_tipo_gasto() {
        $consulta=$this->db->get('t_tipo_gasto');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
}