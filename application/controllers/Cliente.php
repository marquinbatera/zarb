<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ion_auth', 'ion_auth');
		$this->load->model('ion_auth_model');
		$this->load->model('cliente_model');
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

	public function newCliente()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			if ($this->input->post()) {

				$nome       = $this->input->post('nome');
				$endereco   = $this->input->post('endereco');
				$telefone   = $this->input->post('telefone');

				print_r('aqui');
				$dados = array(
					'nome'       => $nome,
					'endereco'   => $endereco,
					'telefone'   => $telefone,
				);

				//insere produto e retorna o id
				if ($cliente_id = $this->cliente_model->setUser($dados))
				{

					$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('cliente/listClientes'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('cliente/newCliente'), 'refresh');
				}
			}

			$data = array(
				'view'   => 'clientes/editClientes',
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

	public function listClientes()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$clientes = $this->cliente_model->getUserList();
			$data = array(
				'view'   => 'clientes/listClientes',
				'title' => 'ZARB',
				'message' => null,
				'additional' => null,
				'clientes' => $clientes
				);

			$this->parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}

	public function buscaListaCliente() {
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$clientes = $this->cliente_model->getUserList();
			$data['aaData'] = $clientes;
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

	public function removeCliente()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$user_id = $this->input->post('id');

			$this->cliente_model->excluirCliente($user_id);

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
