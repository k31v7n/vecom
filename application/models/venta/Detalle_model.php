<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalle_model extends CI_Model {

	private $detalle = NULL;
	private $mensaje = '';
	private $moneda_empresa = 0;
	public function __construct()
	{
		parent::__construct();
		$this->datoi=array();
	}

	private function set_dato_insert($indice='', $valor='')
	{
		$this->datoi[$indice] = $valor;
	}

	private function limpiar_dato_insert()
	{
		$this->datoi=array();
	}

	public function set_mensaje($valor='')
	{
		$this->mensaje = $valor;
	}

	public function get_mensaje()
	{
		return $this->mensaje;
	}

	public function set_moneda_empresa($valor='')
	{
		$this->moneda_empresa = $valor;
	}

	public function set_detalle($id='')
	{
		$this->detalle = $this->db->where("venta_detalle", $id)
								  ->get("venta_detalle")
								  ->row();
	}

	public function get_detalle()
	{
		return $this->detalle;
	}

	public function guardar_detalle($args=array())
	{
		if (elemento($args, 'cantidad')) {
			$this->set_dato_insert("cantidad", $args['cantidad']);
		}

		if (elemento($args, 'precio')) {
			$this->set_dato_insert("precio", $args['precio']);
		}

		if (elemento($args, 'total')) {
			$this->set_dato_insert("total", $args['total']);
		}

		if (elemento($args, 'anulado')) {
			$this->set_dato_insert("anulado", $args['anulado']);
		}else{
			$this->set_dato_insert("anulado", "0");
		}

		if (elemento($args, 'venta')) {
			$this->set_dato_insert("venta", $args['venta']);
		}

		if (elemento($args, 'producto')) {
			$this->set_dato_insert("producto", $args['producto']);
		}

		if ($this->detalle):

			$this->db->where("venta_detalle", $this->detalle->venta_detalle);

			if ($this->db->update("venta_detalle", $this->datoi)) {
				$this->set_mensaje("Se actulizó corretamente el detalle de la venta.");
				$this->set_detalle($this->detalle->venta_detalle);
				return true;

			}else{
				$this->set_mensaje("No se actulizó el detalle de la venta.");
			}

		else:

			if ($this->db->insert("venta_detalle", $this->datoi)) {
				$this->set_mensaje("Se agregó corretamente el detalle de la venta.");
				$this->set_detalle($this->db->insert_id());
				return true;

			}else{
				$this->set_mensaje("No se pudo agregar el detalle de la venta.");
			}

		endif;

		return false;
	}

	public function get_detalles($venta='')
	{
		return $this->db->select("
							a.*,
							b.codigo,
							b.nombre,
							c.nombre as nombre_unidad,
							c.codigo as codigo_unidad,
							e.codigo as codigo_moneda
							")
						->from("venta_detalle a")
						->join("producto b", "b.producto = a.producto", "left")
						->join("unidad_medida c", "c.unidad_medida = b.unidad_medida", "left")
						->join("venta d", "d.venta = a.venta", "left")
						->join("moneda e", "e.moneda = ifNULL(d.moneda, {$this->moneda_empresa})", "left")
						->where('a.anulado', 0)
						->where('a.venta', $venta)
						->get()
						->result();
	}

	public function comprobar_producto($args=array())
	{
		if (elemento($args, "venta")) {
			$this->db->where("venta", $args["venta"]);
		}

		if (elemento($args, "producto")) {
			$this->db->where("producto", $args["producto"]);
		}

		if (elemento($args, "precio")) {
			$this->db->where("precio", $args["precio"]);
		}

		return $this->db->get("venta_detalle")->row();
	}

}
?>