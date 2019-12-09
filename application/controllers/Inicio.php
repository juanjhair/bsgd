<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
		$this->load->view('indexVeterinaria');
	}
	public function barraPrincipal(){
		$this->load->view('pantallas/barraPrincipal.php');
	}
	public function barraPrincipal2(){
		$this->load->view('pantallas/barraPrincipal2.php');
	}
	public function datosSede(){
		$this->load->view('pantallas/datosSede.php');
	}
	public function promociones(){
		$this->load->view('pantallas/promociones.php');
	}
	public function campanaEsteril(){
		$this->load->view('pantallas/campanaEsteril.php');
	}
	public function productos(){
		$this->load->view('pantallas/productos.php');
	}
}
