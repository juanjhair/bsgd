<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dueno extends CI_Controller {

    function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Lima');
        $this->load->model('DuenoModel');
	}
	public function index()
	{
		
    }
    public function camapana()
	{
		print_r(json_encode($this->DuenoModel->mostrarCampanaEstAll()));
    }
    public function compararProductos()
	{
        $OpcProducto = $this->input->post('txtOpcProducto');
        $dataPrincipal['productos']=$this->DuenoModel->mostrarProductosAll($OpcProducto);
        $this->load->view('indexDueno');
        $this->load->view('pantallas/comparadorPrecio.php',$dataPrincipal);
    }
    public function mostrarProductosAll(){
        $OpcProducto = $this->input->get('OpcProducto');
        print_r(json_encode($this->DuenoModel->mostrarProductosAll($OpcProducto)));
    }
	
   

}
