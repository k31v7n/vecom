<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clasificacion_model extends CI_Model {

	private $registro = null;
	private $mensaje  = "";
	public  $limite   = 20;
	public function __construct()
	{
		parent::__construct();
		$this->datoi   = array();
		if (isset($_SESSION['EmpresaID'])){
			$this->usuario = $_SESSION['UserID'];
			$this->empresa = $_SESSION['EmpresaID'];
		}
	}

	public function get_limite()
	{
		return $this->limite;
	}

	public function set_registro($clasificacion='')
	{
		$this->registro = $this->db->where("proveedor_clasificacion", $clasificacion)
								  ->get("proveedor_clasificacion")
								  ->row();
	}

	public function get_registro()
	{
		return $this->registro;
	}

	private function set_mensaje($valor='')
	{
		$this->mensaje=$valor;
	}

	public function get_mensaje()
	{
		return $this->mensaje;
	}

	private function set_dato_insert($indice='', $valor='')
	{
		$this->datoi[$indice] = $valor;
	}

	private function limpiar_dato_insert()
	{
		$this->datoi=array();
	}

	public function get_clasificaciones()
	{
		return $this->db->get("proveedor_clasificacion")->result();
	}

	public function guardar($args=array())
	{
		$this->limpiar_dato_insert();

		if (elemento($args, "nombre")) {
			$this->set_dato_insert("nombre", $args["nombre"]);
		}

		if ($this->registro) {

			$this->db->where("proveedor_clasificacion", $this->registro->proveedor_clasificacion);
			if ($this->db->update("proveedor_clasificacion", $this->datoi)) {

				$this->set_mensaje("Se actualizó correctamente la clasificación.");
				$this->set_registro($this->registro->proveedor_clasificacion);

				return $this->registro->proveedor_clasificacion;
			}else{
				$this->set_mensaje("No se pudo actualizar la clasificación.");
			}

		}else{

			if ($this->db->insert("proveedor_clasificacion", $this->datoi)) {
				$ide = $this->db->insert_id();
				$this->set_mensaje("Se guardó correctamente la clasificación.");
				$this->set_registro($ide);

				return $ide;
			}else{
				$this->set_mensaje("No se pudo guardar la clasificación.");
			}

		}

		return false;
		
	}

	
}
?>