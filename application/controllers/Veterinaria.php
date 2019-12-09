<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Veterinaria extends CI_Controller {

    function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Lima');
        $this->load->model('VeterinariaModel');
	}
	public function index()
	{
		
	}
	public function registrarSede(){
        $veterinaria=$this->input->post('txtVeterinaria');
        $sede=$this->input->post('txtSede');
        $txtTelefono=$this->input->post('txtTelefono');
        $ubicacion=$this->input->post('txtUbicacion');
        $latitud=$this->input->post('txtDireccionlat');
        $longitud=$this->input->post('txtDireccionlng');
        $horaInicio=$this->input->post('cmbHoraIni');
        $horaFin=$this->input->post('cmbHoraFin');
        $estado="0"; //Abierto
        $ruc="12345678912"; //Ruc
        $data=array(
            'veterinaria'=>$veterinaria,
            'sede'=>$sede,
            'telefono'=>$txtTelefono,
            'ubicacion'=>$ubicacion,
            'latitud'=>$latitud,
            'longitud'=>$longitud,
            'horaInicio'=>$horaInicio,
            'horaFin'=>$horaFin,
            'estado'=>$estado,
            'ruc'=>$ruc
        );
        print_r(json_encode($this->VeterinariaModel->registrarSede($data)));
    }
    public function registrarCampana(){


        $NombreCampa=$this->input->post('txtNombreCampa');
        $Precio=$this->input->post('txtPrecio');
        $PerIni=$this->input->post('txtPerIni');
        $PerFin=$this->input->post('txtPerFin');
        
        $date_ini = DateTime::createFromFormat('d/m/Y', $PerIni); 
        $inicio=$date_ini->format('Y-m-d');

        $date_fin = DateTime::createFromFormat('d/m/Y', $PerFin); 
        $fin=$date_fin->format('Y-m-d');

        $data=array(
            'NombreCampa'=>$NombreCampa,
            'Precio'=>$Precio,
            'PerIni'=>$inicio,
            'PerFin'=>$fin,
        );
        print_r(json_encode($this->VeterinariaModel->registrarCampana($data)));
    }
    public function registrarProducto(){

        $NombreProducto=$this->input->post('txtNombreProduct');
        $Precio=$this->input->post('txtPrecio');
        $Cantidad=$this->input->post('numCantidad');

        $data=array(
            'NombreProducto'=>$NombreProducto,
            'Precio'=>$Precio,
            'Cantidad'=>$Cantidad
        );
        print_r(json_encode($this->VeterinariaModel->registrarProducto($data)));
    }
    public function registrarServicio(){

        $NombreServicio=$this->input->post('txtNombreServicio');
        $Precio=$this->input->post('txtPrecio');

        $data=array(
            'NombreServicio'=>$NombreServicio,
            'Precio'=>$Precio
        );
        print_r(json_encode($this->VeterinariaModel->registrarServicio($data)));
    }
   

}
