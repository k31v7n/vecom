	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta_model extends CI_Model
{

	public 		$mensaje = '';
	protected 	$venta 	 = NULL;
	private 	$datoi 	 = array();
	public function __construct()
	{
		parent::__construct();
		if (isset($_SESSION['EmpresaID'])){
			$this->usuario = $_SESSION['UserID'];
			$this->empresa = $_SESSION['EmpresaID'];
			$this->moneda  = $_SESSION['EmpresaMone'];
		}
	}

	public function set_venta($venta='')
	{
		$this->venta = $this->get_ventas($venta);
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

	public function get_venta()
	{
		return $this->venta;
	}

	public function get_venta_estatus()
	{
		return $this->db->get("venta_estatus")
						->result();
	}

	public function get_tipo_pago()
	{
		return $this->db->get("tipo_pago")
						->result();
	}

	public function guardar($args=array())
	{
		$this->limpiar_dato_insert();
		$ret = false;

		$this->db->query("SET foreign_key_checks = 0;");

		if (elemento($args, 'cliente')) {
			$this->set_dato_insert('cliente', $args['cliente']);
		}else{
			$this->set_dato_insert('cliente', "0");
		}

	    if (elemento($args, 'concepto')) {
	    	$this->set_dato_insert('concepto', $args['concepto']);

	    }else{
	    	$this->set_dato_insert('concepto', "");

	    }

	    if (elemento($args, 'venta_estatus')) {
	    	$this->set_dato_insert('venta_estatus', $args['venta_estatus']);
	    }else{
	    	$this->set_dato_insert('venta_estatus', "1");//Estado de borrador de ventas
	    }

	    if (elemento($args, 'tipo_pago')) {
	    	$this->set_dato_insert('tipo_pago', $args['tipo_pago']);
	    }

	    if (elemento($args, 'moneda')) {
	    	$this->set_dato_insert('moneda', $args['moneda']);
	    }else{
	    	$this->set_dato_insert('moneda', $this->moneda);
	    }

	    if (elemento($args, "valor_base")) {
	    	$this->set_dato_insert("valor_base", $args["valor_base"]);
	    }

		if (elemento($args, "iva")) {
			$this->set_dato_insert("iva", $args["iva"]);
		}

		if (elemento($args, "monto")) {
			$this->set_dato_insert("monto", $args["monto"]);
		}

		if (elemento($args, "saldo")) {
			$this->set_dato_insert("saldo", $args["saldo"]);
		}

		if (empty($this->venta)) {
	    	$this->set_dato_insert('usuario', $this->usuario);
		}

	    if (empty($this->venta)) {
	    	if ($this->db->insert("venta", $this->datoi)) {
	    		$venta = $this->db->insert_id();
	    		$this->set_venta($venta);
	    		$this->set_mensaje("Se creó correctamente la venta.");
	    		$ret = $venta;
	    	}else{
	    		$this->set_mensaje("No se pudo crear la venta.");
	    	}
	    }else{
	    	$this->db->where("venta", $this->venta->venta);
	    	if ($this->db->update("venta", $this->datoi)) {
	    		$this->set_venta($this->venta->venta);
	    		$this->set_mensaje("Se actualizó correctamente la venta.");
	    		$ret = $this->venta->venta;
	    	}else{
	    		$this->set_mensaje("No se pudo actualizar la venta.");
	    	}
	    }
	    $this->db->query("SET foreign_key_checks = 1;");
	    return $ret;
	}

	public function get_ventas($args=array())
	{ 
		if (elemento($args, "lista_menu")) {
			$this->db->where("a.usuario", $this->usuario)
					 ->where("a.venta_estatus", "1");//Estado Borrador
		}

		if (!is_array($args)) {
			$this->db->where("a.venta", $args);
		}

		$tmp = $this->db->select("a.venta as venta,
								  a.fecha_sis as fecha,
								  a.cliente as cliente,
								  a.concepto as concepto,
								  a.moneda as moneda,
								  a.tipo_pago as tipo_pago,
								  a.monto as monto,
								  a.venta_estatus,
								  b.nombre as cliente_nombre,
								  b.nit as cliente_nit,
								  c.codigo as codigo_moneda,
								  c.nombre as nombre_moneda,
								  d.nombre as nombre_tipo_pago,
								  e.nombre as usuario,
								  f.nombre as estatus,
								  ")
						->from("venta a")
						->join("cliente b", "b.cliente = a.cliente", "LEFT")
						->join("moneda c", "c.moneda = a.moneda", "LEFT")
						->join("tipo_pago d", "d.tipo_pago = a.tipo_pago", "LEFT")
						->join("usuario e", "e.usuario = a.usuario", "LEFT")
						->join("venta_estatus f", "f.venta_estatus = a.venta_estatus", "LEFT")
						->get();

		if (!is_array($args)) {
			return $tmp->row();
		}

		return $tmp->result();
	}

	public function get_ventas_menu()
	{
		return $this->db->select("venta, fecha_sis, moneda")
						->from("venta")
						->where("usuario", $this->usuario)
						->where("venta_estatus", 1) // 1= Estatus Borrador
						->get()
						->result();

	}

	public function actualizar_valores()
	{
		$res = true;
		if (!empty($this->venta)) {
			$detalles = $this->db->where("venta", $this->venta->venta)
								 ->where("anulado", "0")
								 ->get("venta_detalle")
								 ->result();

			$total_g = 0;
			if (!empty($detalles)) {
				foreach ($detalles as $row) {
					$total_g += $row->total;
				}
			}
			
			$valor_base = $total_g / 1.12;
			$iva 		= $total_g - $valor_base;
			$monto 		= $saldo = $total_g;
			$res = $this->guardar([
				"valor_base" => $valor_base,
				"iva" 		 => $iva,
				"monto" 	 => $monto,
				"saldo" 	 => $saldo
			]);
		}

		return $res;

		
	}
}
?>