<?php
class Estado_cliente_model extends CI_Model{
    public function get_estado_cliente() {
        $consulta=$this->db->get('t_tipo_estado_cliente');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
}