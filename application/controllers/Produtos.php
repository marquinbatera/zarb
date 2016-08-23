<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ion_auth', 'ion_auth');
		$this->load->model('ion_auth_model');
		$this->load->model('user_model');
	}

	public function index()
	{

		if ($this->ion_auth->logged_in())
		{
			$userId = $this->ion_auth->user()->row();
			$data = array(
				'view'   => 'index/index',
				'title' => 'OTL Software',
				'message' => "olá mundo!!",
				'userId' => $userId,
				'additional' => null,
				);

			$this->parser->parse('layoutPrincipal', $data);
		}else{
			$data = array(
				'view'   => 'login/signin',
				'title' => 'ZARB',
				'message' => null,
				'additional' => null,
				);

			$this->parser->parse('layoutDelivery', $data);
		}

	}

	public function newProdutos()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			if ($this->input->post()) {

				$nome       = $this->input->post('nome');
				$descricao   = $this->input->post('descricao');
				$preco   = $this->input->post('preco');


				$dados = array(
					'Nome'        => $nome,
					'Descricao'   => $descricao,
					'Preco'       => $preco,
				);

				//insere produto e retorna o id
				if ($user_id = $this->user_model->setUser($dados))
				{
					
					$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('produtos/listProdutos'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('produtos/newProdutos'), 'refresh');
				}
			}

			$data = array(
				'view'   => 'produtos/editProdutos',
				'title' => 'ZARB',
				'additional' => null,
				);

			$this->parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function listProdutos()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$produtos = $this->user_model->getUserList();
			$data = array(
				'view'   => 'produtos/listProdutos',
				'title' => 'ZARB',
				'message' => null,
				'additional' => null,
				'produtos' => $produtos
				);

			$this->parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function buscaListaProdutos() {
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$produtos = $this->user_model->getUserList();
			$data['aaData'] = $produtos;
			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function descricao()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$user_id = $this->input->post('id');

			$produto = $this->user_model->getAllWhere($user_id, 'ID', 'produto');

			$data['descricao'] = $produto[0];

			echo json_encode($produto);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function removeProduto()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$user_id = $this->input->post('id');

			$this->user_model->excluirProduto($user_id);

			$data['mensagem'] = 'Exclusão realizada com sucesso!';
			$data['alert']    = 'success';

			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}
}
