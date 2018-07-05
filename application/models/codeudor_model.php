<?php
class Codeudor_model extends CI_Model{
    public function guardar_codeudor($id_cliente,$dni,$nombre,$nombre_negocio,$direccion,$direccion_cobro,$telf,$email){
    	$data = array(
    		'id_cliente'=>$id_cliente,
			'dni'=>$dni,
			'nombre'=>$nombre,
			'nombre_negocio'=>$nombre_negocio,
			'direccion'=>$direccion,
			'direccion_cobro'=>$direccion_cobro,
			'telf'=>$telf,
			'email'=>$email);
    	$this->db->insert('t_co_deudor', $data);
    }

    public function get_codeudor($id_codeudor){
    	$this->db->select('t_co_deudor.id as id_codeudor, t_co_deudor.dni as dni, t_co_deudor.nombre as nombre, t_co_deudor.nombre_negocio as nombre_negocio, t_co_deudor.direccion as direccion, t_co_deudor.direccion_cobro as direccion_cobro, t_co_deudor.telf as telf, t_co_deudor.email as email, t_cliente.nombre as nombre_cliente');
    	$this->db->join('t_cliente', 't_co_deudor.id_cliente = t_cliente.id', 'left');
    	$this->db->where('t_co_deudor.id', $id_codeudor);
    	$consulta=$this->db->get('t_co_deudor',1);
    	if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
     public function actualizar_codeudor($id_codeudor,$dni,$nombre,$nombre_negocio,$direccion,$direccion_cobro,$telf,$email){
    	$data = array(
			'dni'=>$dni,
			'nombre'=>$nombre,
			'nombre_negocio'=>$nombre_negocio,
			'direccion'=>$direccion,
			'direccion_cobro'=>$direccion_cobro,
			'telf'=>$telf,
			'email'=>$email);
    	$this->db->where('id', $id_codeudor);
    	$this->db->update('t_co_deudor', $data);
    }

}