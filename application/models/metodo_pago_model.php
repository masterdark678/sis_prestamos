<?php
class Metodo_pago_model extends CI_Model{
    public function get_metodo_pago() {
        $consulta=$this->db->get('t_metodo_pago');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
}