<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VeterinariaModel extends CI_Model {
	public function __construct() {
		parent::__construct();
    }
    
    public function registrarSede($data){
        
        $array_veterinaria=array(
            'NOM_VET'=>$data['veterinaria'],
            'RUC_EMP'=>$data['ruc']);
        $this->db->insert('veterinaria', $array_veterinaria);
        $id_resultado_veterinaria=$this->db->insert_id();
        
        $array_sede=array(
            'ID_VETERINARIA'=>'1',
            'NOM_SEDE'=>$data['sede'],
            'LATITUD'=>$data['latitud'],
            'LONGITUD'=>$data['longitud'],
            'TE_SEDE'=>$data['telefono'],
            'ES_ATENCION'=>$data['estado'],
            'DIRECCION'=>$data['ubicacion']);
        $this->db->insert('sede', $array_sede);
        $id_resultado_sede=$this->db->insert_id();
        
        return "registrado correctamente";
    }
    public function registrarCampana($data){
        
        $array_promociones=array(
            'ID_SEDE'=>'1',
            'NO_PROMOCION'=>$data['NombreCampa'],
            'ID_SERVICIO'=>'1',
            'PR_OFERTA'=>$data['Precio'],
            'FE_INICIO'=>$data['PerIni'],
            'FE_FIN'=>$data['PerFin'],
            'ID_VETERINARIA'=>'1');
        $this->db->insert('promociones', $array_promociones);
        $id_resultado_promociones=$this->db->insert_id();
        
        return "registrado correctamente";
    }
    public function mostrarCampana(){
        
        $this->db->select('*');
        $this->db->from('promociones');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function registrarProducto($data){
        $array_productos=array(
            'ID_SEDE'=>'1',
            'NO_PRODUCTO'=>$data['NombreProducto'],
            'PR_PRODUCTO'=>$data['Precio'],
            'STOCK'=>$data['Cantidad'],
            'ID_VETERINARIA'=>'1');
        $this->db->insert('producto_sd', $array_productos);
        $id_resultado_productos=$this->db->insert_id();
        
        return "registrado correctamente";
    }
    public function mostrarproductos(){
        
        $this->db->select('*');
        $this->db->from('producto_sd');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function registrarServicio($data){
        $array_servicio=array(
            'ID_SEDE'=>'1',
            'PR_SERVICIO'=>$data['Precio'],
            'NO_SERVICIO'=>$data['NombreServicio'],
            'ID_VETERINARIA'=>'1');
        $this->db->insert('servicio_sd', $array_servicio);
        $id_resultado_servicio=$this->db->insert_id();
        
        return "registrado correctamente";
    }
    public function mostrarservicios(){
        
        $this->db->select('*');
        $this->db->from('servicio_sd');
        $query = $this->db->get();
        return $query->result_array();
    }

}
?>