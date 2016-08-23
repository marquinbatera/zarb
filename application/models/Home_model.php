<?php
class Home_model extends CI_Model {
	private $tabela_categorias = "TB_CATEGORIAS";
	private $tabela_menu = "TB_MENUS";
	private $tabela_redes = "TB_REDES_SOCIAIS";
	private $tabela_categorias_produtos = "TB_CATEGORIAS_PRODUTOS";
	private $tabela_produtos_clientes = "TB_PRODUTOS_CLIENTES";
	private $tabela_produtos = "TB_PRODUTOS";
	private $tabela_banners = "TB_BANNERS";
	private $tabela_contatos = "TB_CADASTRO_CONTATOS";
	private $tabela_destaques = "TB_DESTAQUES";

	public function __construct()
	{
		parent::__construct();
	}

	public function getUserData($id) {
		$this->db->select('dm_user.user_imagepath, dm_userfunction.userfunction_id, dm_userfunction.userfunction_description, dm_user.user_status');
		$this->db->from('dm_user');
		$this->db->join('dm_user_userfunction', 'dm_user.user_id = dm_user_userfunction.user_id', 'inner');
		$this->db->join('dm_userfunction', 'dm_user_userfunction.userfunction_id = dm_userfunction.userfunction_id', 'inner');
		$this->db->where('dm_user.user_id', $id);
		return $this->db->get()->result_array();
	}

	public function getAllWhere($condicao, $campo, $tabela)
	{
		$this->db->select('*');
		$this->db->from($tabela);
		$this->db->where($campo, $condicao);
		return $this->db->get()->result_array();
	}

	public function getOrderList()
	{
		$query = $this->db->query("SELECT dm_order.order_id, dm_order.order_status, dm_orderstatus.order_statusname, dm_order.order_title, date_format(dm_order.order_creation, '%d/%m/%Y %r'), dm_orderstop.orderstop_address, dm_customer.customer_name, date_format(dm_orderstop.orderstop_schedulled, '%d/%m/%Y %r') as orderstop_schedulled, date_format(dm_orderstop.orderstop_schedulled, '%Y/%m/%d') as schedulled, date_format(dm_orderstop.orderstop_schedulled, '%H/%i/%s') as schedulled_hora, dm_user.user_name
							FROM dm_order
							LEFT JOIN dm_orderstop ON dm_order.order_id = dm_orderstop.order_id
							LEFT JOIN dm_customer ON dm_orderstop.customer_id = dm_customer.customer_id
							LEFT JOIN dm_userdriver ON dm_order.userdriver_id = dm_userdriver.userdriver_id
							LEFT JOIN dm_user ON dm_userdriver.user_id = dm_user.user_id
							LEFT JOIN dm_orderstatus ON dm_order.order_status = dm_orderstatus.order_status
							ORDER BY dm_order.order_creation DESC");
		return $query->result_array();
	}

	// ---------------- FUNCOES EXEMPLO -----------------
	public function getCategorias(){
		// $this->db->select('*');
		$this->db->select($this->tabela_categorias.'.desc_categoria, '.$this->tabela_categorias.'.id_categoria');
		$this->db->from($this->tabela_categorias);
		$this->db->join($this->tabela_categorias_produtos, $this->tabela_categorias_produtos.'.id_categoria = '.$this->tabela_categorias.".id_categoria", 'inner');
		$this->db->order_by($this->tabela_categorias.'.id_categoria');
		$this->db->group_by($this->tabela_categorias.'.desc_categoria, '.$this->tabela_categorias.'.id_categoria');
		return $this->db->get()->result_array();
	}

	public function getMenus(){
		$this->db->select('*');
		$this->db->from($this->tabela_menu);
		$this->db->order_by($this->tabela_menu.'.id');
		return $this->db->get()->result_array();
	}

	public function getRedes(){
		$this->db->select('*');
		$this->db->from($this->tabela_redes);
		$this->db->order_by($this->tabela_redes.'.id');
		return $this->db->get()->result_array();
	}

	public function getUltimosProdutosComprados(){
		$this->db->select($this->tabela_produtos.'.id_produto, '.$this->tabela_produtos.'.desc_produtos');
		$this->db->from($this->tabela_produtos_clientes);
		$this->db->join($this->tabela_produtos, $this->tabela_produtos.'.id_produto = '.$this->tabela_produtos_clientes.".id_produto", 'inner');
		//$this->db->order_by($this->tabela_produtos_clientes.'.id_produto_cliente','DESC');//estava dando erro, olhar melhor sobre isso
		$this->db->group_by($this->tabela_produtos.'.id_produto, '.$this->tabela_produtos.'.desc_produtos');
		$this->db->limit(5);
		return $this->db->get()->result_array();
	}

	public function getBanners(){
		$this->db->select('*');
		$this->db->from($this->tabela_banners);
		$this->db->where($this->tabela_banners.'.status', 1);
		$this->db->order_by($this->tabela_banners.'.id');
		return $this->db->get()->result_array();
	}

	public function getContatos(){
		$this->db->select('*');
		$this->db->from($this->tabela_contatos);
		return $this->db->get()->result_array();
	}

	public function getDestaques(){
		$this->db->select('*');
		$this->db->from($this->tabela_destaques);
		$this->db->where($this->tabela_destaques.'.status', 1);
		$this->db->order_by($this->tabela_destaques.'.id');
		return $this->db->get()->result_array();
	}

}