<?php
class Pintor
{
	private $nombre;
	private $ciudad;
	private $pais;
	private $fecha_nacimiento;
	private $fecha_muerte;
	private $foto;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}