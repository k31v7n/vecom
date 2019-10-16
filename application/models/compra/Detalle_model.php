<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class 	Detalle_model extends CI_Model {

	private $detalle = null;
	private $mensaje  = "";
	
	public function __construct()
	{
		parent::__construct();
		$this->datoi   = array();
		if (isset($_SESSION['EmpresaID'])){
			$this->usuario = $_SESSION['UserID'];
			$this->empresa = $_SESSION['EmpresaID'];
		}
	}

	public function set_detalle($compra_detalle='')
	{
		$this->detalle = $this->db->where("compra_detalle", $compra_detalle)
								  ->get("compra_detalle")
								  ->row();
	}

	public function get_detalle()
	{
		return $this->detalle;
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

	public function get_detalles_compra($compra='')
	{
		return $this->db->select("a.*, b.codigo AS codigo_producto, b.nombre AS producto_nombre")
						->from("compra_detalle a")
						->join("producto b", "b.producto = a.producto", "LEFT")
						->where("a.compra", $compra)
						->where("a.anulado", 0)
						->get()
						->result();
	}

	public function guardar($args)
	{
		$this->limpiar_dato_insert();
		if (elemento($args, "precio")) {
			$this->set_dato_insert("precio", $args["precio"]);
		}

		if (elemento($args, "cantidad")) {
			$this->set_dato_insert("cantidad", $args["cantidad"]);
		}

		if (elemento($args, "total")) {
			$this->set_dato_insert("total", $args["total"]);
		}

		if (elemento($args, "anulado")) {
			$this->set_dato_insert("anulado", $args["anulado"]);
		}

		if (elemento($args, "compra")) {
			$this->set_dato_insert("compra", $args["compra"]);
		}

		if (elemento($args, "producto")) {
			$this->set_dato_insert("producto", $args["producto"]);
		}

		if ($this->detalle) {
	    	$this->db->where("compra_detalle", $this->detalle->compra_detalle);
    		if ($this->db->update("compra_detalle", $this->datoi)) {

    			$this->set_mensaje("Se actualizó correctamente el detalle de compra.");
    			$this->set_detalle($this->detalle->compra_detalle);
    			return $this->detalle->compra_detalle;

    		}else{
    			$this->set_mensaje("No se pudo actualizar el detalle de la compra.");
    		}

	    }else{
    		if ($this->db->insert("compra_detalle", $this->datoi)) {

    			$ide = $this->db->insert_id();
    			$this->set_mensaje("Se guardó correctamente el detalle de la compra.");
    			$this->set_detalle($ide);
    			return $ide;

    		}else{
    			$this->set_mensaje("No se pudo guardar el detalle de la compra.");
    		}
	    }
	    
	    return false;
	}
	
}
?>