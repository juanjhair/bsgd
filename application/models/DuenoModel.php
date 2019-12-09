<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DuenoModel extends CI_Model {
	public function __construct() {
		parent::__construct();
    }
    public function mostrarCampanaEst(){
        $this->db->select('*');
        $this->db->from('promociones p');
        $this->db->join('servicios s', 's.ID_SERVICIO = p.ID_SERVICIO');
        $this->db->join('veterinaria v', 'v.ID_VETERINARIA = p.ID_VETERINARIA');
        $this->db->where('p.ID_SERVICIO', '3');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function mostrarCampanaEstAll(){
        $this->db->select('*');
        $this->db->from('promociones p');
        $this->db->join('servicios s', 's.ID_SERVICIO = p.ID_SERVICIO');
        $this->db->join('veterinaria v', 'v.ID_VETERINARIA = p.ID_VETERINARIA');
        $this->db->join('sede sd', 'sd.ID_VETERINARIA = v.ID_VETERINARIA');
        $this->db->where('p.ID_SERVICIO', '3');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function mostrarProductosAll($OpcProducto){
        $this->db->select('*');
        $this->db->from('producto_sd p');
        $this->db->join('veterinaria v', 'v.ID_VETERINARIA = p.ID_VETERINARIA');
        $this->db->join('sede sd', 'sd.ID_VETERINARIA = v.ID_VETERINARIA');
        $k_OpcProducto = explode(" ",$OpcProducto);
        for($j = 0; $j < count($k_OpcProducto); $j++) {
            if(!empty($k_OpcProducto[$j])) {
                $this->db->like('NO_PRODUCTO',$k_OpcProducto[$j]);
            }
        }
        $this->db->order_by('p.PR_PRODUCTO', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


}
?>