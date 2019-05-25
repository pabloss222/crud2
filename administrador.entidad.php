<?php
class Administrador
{
	private $id;
	private $nombre;
	private $login;
	private $clave;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>