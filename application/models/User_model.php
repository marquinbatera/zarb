<?php
class User_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tb = "produto";
	}
	
	public function getGroups()
	{
		$this->db->select('*');
		$this->db->from('groups');
		return $this->db->get()->result_array();
	}

	public function getAll($tabela)
	{
		$this->db->select('*');
		$this->db->from($tabela);
		return $this->db->get()->result_array();
	}

	public function getAllWhere($condicao, $campo, $tabela)
	{
		$this->db->select('*');
		$this->db->from($tabela);
		$this->db->where($campo, $condicao);
		return $this->db->get()->result_array();
	}
	
	public function setUser($dados)
	{
		$this->db->insert( $this->tb, $dados);
		return $this->db->insert_id();
	}

	public function setAll($dados, $tabela)
	{
		$this->db->insert($tabela, $dados);
		return $this->db->insert_id();
	}
	
	public function getUserList()
	{
		$this->db->select('*');
		$this->db->from($this->tb);
		return $this->db->get()->result_array();
	}

	public function updateAllUser($id, $campo, $dados, $tabela)
	{
		$this->db->where($campo, $id);
		$this->db->update($tabela, $dados);
		// return;
	}

	public function excluirProduto($id)
	{
		$this->db->where('ID', $id);
		$this->db->delete($this->tb);
		return;
	}

	//---------------- FUNCOES EXEMPLO -----------------
	public function setProdutosRelac($data)
	{
		$this->db->insert_batch('TB_PRODUTOS_RELACIONADOS', $data);
	}

	public function getProdutoRelacionados($id_produto)
	{
		$this->db->select('*');
		$this->db->from($this->tb_relacionados);
		$this->db->join($this->tb, $this->tb_relacionados.'.id_produto_relacionado ='.$this->tb.".id_produto");
		$this->db->where($this->tb_relacionados.'.id_produto', $id_produto);
		return $this->db->get()->result_array();
	}

	public function getImagens($id)
	{
		$this->db->select('*');
		$this->db->from('TB_IMAGENS_PRODUTOS');
		$this->db->where('id_produto', $id);
		return $this->db->get()->result_array();
	}

	public function getProdutosPagination($pagina)
	{
		$pagina = ($pagina=='' or $pagina ==1 )?0:$pagina;
		$calc = ($pagina>1)?(9*($pagina-1)):($pagina);

		$this->db->select('*');
		$this->db->from($this->tb);
		$this->db->join($this->tb_cat_produtos, $this->tb_cat_produtos.'.id_produto = '.$this->tb.".id_produto", 'left');
		$this->db->where($this->tb.".status", 1);
		$this->db->limit(9, $calc);
		$this->db->order_by($this->tb.".id_produto", 'ASC');
		return $this->db->get()->result_array();
	}

	public function atualizaDestaques($id, $dados)
	{
		$this->db->where('id', $id);
		$this->db->update('TB_PRODUTOS_DESTAQUE', $dados);
		return;
	}

	public function excluirDestaques($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('TB_PRODUTOS_DESTAQUE');
		return;
	}

}