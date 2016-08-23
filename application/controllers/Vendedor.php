<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedor extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ion_auth', 'ion_auth');
		$this->load->model('ion_auth_model');
		$this->load->model('vendedor_model');
		$this->load->model('filial_model');
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

	public function newVendedor()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			if ($this->input->post()) {

				$nome       = $this->input->post('nome');
				$filial   = $this->input->post('filial');
				$telefone   = $this->input->post('telefone');

				$dados = array(
					'Nome'        => $nome,
					'id_filial'   => $filial,
					'telefone'       => $telefone,
				);

				//insere produto e retorna o id
				if ($user_id = $this->vendedor_model->setUser($dados))
				{
					
					$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('vendedor/listVendedor'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('vendedor/newVendedor'), 'refresh');
				}
			}
			$filiais = $this->filial_model->getUserList();
			$data = array(
				'view'   => 'vendedor/editVendedor',
				'title' => 'ZARB',
				'additional' => null,
				'filiais' => $filiais
				);

			$this->parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function listVendedor()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$produtos = $this->vendedor_model->getUserList();
			$data = array(
				'view'   => 'vendedor/listVendedor',
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

	public function buscaListaVendedor() {
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$vendedor = $this->vendedor_model->getListVendedor();
			$data['aaData'] = $vendedor;
			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	// public function descricao()
	// {
	// 	if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
	// 		$user_id = $this->input->post('id');

	// 		$produto = $this->user_model->getAllWhere($user_id, 'ID', 'produto');

	// 		$data['descricao'] = $produto[0];

	// 		echo json_encode($produto);
	// 	} else {
	// 		$this->session->set_flashdata('mensagem', 'Sessão expirou!');
	// 		$this->session->set_flashdata('alert', 'warning');
	// 		redirect(base_url('home/index'), 'refresh');
	// 	}
	// }

	public function removeVendedor()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$vendedor = $this->input->post('id');

			$this->vendedor_model->excluirVendedor($vendedor);

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
