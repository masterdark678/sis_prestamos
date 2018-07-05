<?php
class Porcentaje_model extends CI_Model{
    public function get_porcentaje() {
        $consulta=$this->db->get('t_porcentaje');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
}