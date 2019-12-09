<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioDueno extends CI_Controller {
	function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Lima');
        $this->load->model('DuenoModel');
	}
	public function index()
	{
		$this->load->view('indexDueno');
	}
	public function barraPrincipal2(){
		$this->load->view('pantallas/barraPrincipal2.php');
	}
	public function campanaEsteril(){
		$campanas=$this->DuenoModel->mostrarCampanaEst();
		$dataPrincipal["campanas"]=$campanas;
		$this->load->view('pantallas/campanaEsteril.php',$dataPrincipal);
	}
	public function comparadorPrecio(){
		$this->load->view('pantallas/comparadorPrecio.php');
	}
}
