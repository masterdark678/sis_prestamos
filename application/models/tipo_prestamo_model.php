<?php
class Tipo_prestamo_model extends CI_Model{
    public function get_tipo_prestamo() {
        $consulta=$this->db->get('t_tipo_prestamo');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
}