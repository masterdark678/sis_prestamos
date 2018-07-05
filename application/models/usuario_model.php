<?php
class Usuario_model extends CI_Model{
	
	public function get_usuario() {
        $consulta=$this->db->get('t_usuario');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function get_max_usuario() {
        $this->db->select_max('id');
        $consulta=$this->db->get('t_usuario');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function get_usuario_login($usuario, $pass){
        $this->db->where('login', $usuario);
        $this->db->where('clave', $pass);
        $consulta=$this->db->get('t_usuario',1);
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }   
    }
    public function guardar_usuario($id_estado_usuario,$id_nivel,$nombre,$login,$clave_2){
    	$data = array(
   	'id_estado_usuario'=>$id_estado_usuario,
    'id_nivel'=>$id_nivel,
    'nombre'=>$nombre,
    'login'=>$login,
    'clave'=>$clave_2);
    	$this->db->insert('t_usuario',$data);

    }
    public function actualizar_usuario($id_usuario,$id_estado_usuario,$id_nivel,$nombre,$login,$clave_2){
        $data = array(
    'id_estado_usuario'=>$id_estado_usuario,
    'id_nivel'=>$id_nivel,
    'nombre'=>$nombre,
    'login'=>$login,
    'clave'=>$clave_2);

        $this->db->where('id', $id_usuario);
        $this->db->update('t_usuario',$data);

    }
    
    public function get_usuario_id($id_usuario) {
    		$this->db->select('t_usuario.id as id_usuario, t_usuario.nombre as nombre_usuario, t_usuario.login as login_usuario, t_usuario.clave as clave_usuario, t_estado_usuario.descripcion as estado_usuario, t_nivel.descripcion as nivel_usuario');
    		$this->db->join('t_nivel', 't_usuario.id_nivel = t_nivel.id', 'left');
    		$this->db->join('t_estado_usuario', 't_usuario.id_estado_usuario = t_estado_usuario.id', 'left');
    		$this->db->where('t_usuario.id', $id_usuario);
        $consulta=$this->db->get('t_usuario');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
    public function actualizar_estado_usuario($id_estado_usuario,$id_usuario){
        $data = array('id_estado_usuario' =>$id_estado_usuario);
        $this->db->where('id', $id_usuario);
        $this->db->update('t_usuario', $data);
    }

    
}