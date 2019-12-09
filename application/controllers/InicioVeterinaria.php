<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioVeterinaria extends CI_Controller {
	
	function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Lima');
        $this->load->model('VeterinariaModel');
	}
	public function index()
	{
		$this->load->view('indexVeterinaria');
	}
	public function barraPrincipal(){
		$this->load->view('pantallas/barraPrincipal.php');
	}
	public function datosSede(){
		$this->load->view('pantallas/datosSede.php');
	}
	public function promociones(){
		
		$campanas=$this->VeterinariaModel->mostrarCampana();
		$dataPrincipal["campanas"]=$campanas;
		$this->load->view('pantallas/promociones.php',$dataPrincipal);
	}
	public function productos(){
		$productos=$this->VeterinariaModel->mostrarproductos();
		$dataPrincipal["productos"]=$productos;
		$this->load->view('pantallas/productos.php',$dataPrincipal);
	}
	public function servicios(){
		$servicios=$this->VeterinariaModel->mostrarservicios();
		$dataPrincipal["servicios"]=$servicios;
		$this->load->view('pantallas/servicios.php',$dataPrincipal);
	}
}
