<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// $this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url', 'form', 'language'));
		$this->load->helper('cookie');
		$this->load->library('session');

		// $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	// redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->_render_page('auth/index', $this->data);
		}
	}

	// log the user in
	function login()
	{
		$this->data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required', array( 'required' => 'Informe o %s.' ));
		$this->form_validation->set_rules('password', 'Password', 'required', array( 'required' => 'Informe a %s.' ));
		
		$message = null;
		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');
			$user = $this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember);
			if ($user)
			{
				$message = '';
				redirect(base_url('home/index'), 'refresh');
			}
			else
			{
				// if the login was un-successful redirect them back to the login page
				$this->session->set_flashdata('mensagem', 'Email ou senha incorretos!');
				$this->session->set_flashdata('alert', 'danger');
				//redirect(base_url(), 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
				redirect(base_url('home/index'), 'refresh');
			}
		}
		
		$data = array(
			'view'   => 'login/signin',
			'title' => 'OTL Software',
			// 'message' => $message,
			'additional' => null
			);
		
		$this->load->helper('form');
		$this->parser->parse('layoutDelivery', $data);
	}
	
	function loginPanel($viewRedirect = 'auth/login')
	{
		//passado o 'hifen' para quebrar os valores no str
		$viewRedirect = str_replace('-', '/', $viewRedirect);
		
		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		$message = null;
		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful redirect them back to the home page
				//$this->session->set_flashdata('message', $this->ion_auth->messages());
				$message = '';
				//se nao houver nenhum item no carrinho, o mesmo e direcionado para o painel principal.
				//caso contrario o mesmo e direcionado para dar sequencia a compra no carrinho
				if( $this->cart->total_items() <= 0 )
					redirect(base_url('painel'), 'refresh');
			}
			else
			{
				// if the login was un-successful redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				//redirect(base_url(), 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		
		$data = array(
			'view'   => $viewRedirect,
			'title' => 'RCSPREV - Seja bem vindo',
			'message' => $message,
			'additional' => null
			);
		
		$this->load->helper('form');
		$this->parser->parse('layout', $data);
	}

	function loginAdmin($viewRedirect = 'admin/login')
	{
		//passado o 'hifen' para quebrar os valores no str
		$viewRedirect = str_replace('-', '/', $viewRedirect);
		
		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		$message = null;
		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful redirect them back to the home page
				//$this->session->set_flashdata('message', $this->ion_auth->messages());
				$message = '';
				//redirecionar para o painel
				if($this->ion_auth->is_admin()){
					redirect(base_url('admin/index'), 'refresh');
				}else{
					$this->session->set_flashdata('message', utf8_encode('You are not an Administrator'));
					$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				}
			}
			else
			{
				// if the login was un-successful redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				//redirect(base_url(), 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		
		$data = array(
			'view'   => $viewRedirect,
			'title' => 'RCSPREV - Seja bem vindo',
			'message' => $message,
			'additional' => null
			);
		
		$this->load->helper('form');
		$this->parser->parse('layout', $data);
	}

	// log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect(base_url('home/index'), 'refresh');
	}

	// change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required', 
			array( 'required' => $this->auxRequired2 )
			);

		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]',
			array(
				'required' => $this->auxRequired2,
				'min_length' => 'Informe uma senha com o minimo de '.$this->config->item('min_password_length', 'ion_auth') .' caracteres.',
				'max_length' => 'Informe uma senha com o maximo de '.$this->config->item('max_password_length', 'ion_auth') .' caracteres.',
				'matches' => 'Senhas n&atilde;o conferem.'
				));

		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required',
			array( 'required' => $this->auxRequired2 )
			);

		if (!$this->ion_auth->logged_in())
		{
			redirect(base_url('auth/loginPanel'), 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form set the flash data error message if there is one
			$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->session->set_flashdata('message', $message);
			redirect(base_url('painel/index/change_password'));
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				//$this->logout();
				redirect(base_url('home'), 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				//redirect('auth/change_password', 'refresh');
				redirect(base_url('home'), 'refresh');
			}
		}
	}

	// forgot password
	function forgot_password()
	{
		// setting validation rules by checking wheather identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email',
												array('required'=>'Favor informar um email.',
													  'valid_email'=>'Este email n&atilde;o &eacute; v&aacute;lido.')
												);
		}

		$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');

		if ($this->form_validation->run() == false)
		{

			
			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			// $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			//$this->_render_page('auth/forgot_password', $this->data);
			// $this->session->set_flashdata('message', $this->ion_auth->errors());
				
			// $data = array(
			// 	'view'   => "auth/forgot_password",
			// 	'title' => 'RCSPREV - Seja bem vindo',
			// 	'identity_label' => $this->data['identity_label']
			// 	);
			
			// $this->load->helper('form');
			// $this->parser->parse('layout', $data);

			
		
			$this->session->set_flashdata('mensagem', 'Email not Registered, look for the Administrator');
			$this->session->set_flashdata('alert', 'danger');
			redirect(base_url('home/esqueciSenha'), 'refresh');
			return;
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('email'))->users()->row();

			if(empty($identity)) {

				if($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				// $this->session->set_flashdata('message', $this->ion_auth->errors());
				//redirect("auth/forgot_password", 'refresh');
				// $data = array(
				// 	'view'   => "login/reset-password",
				// 	'title' => 'OTL - Seja bem vindo',
				// 	'identity_label' => $this->data['identity_label']
				// 	);
				
				// $this->load->helper('form');
				// $this->parser->parse('layoutDelivery', $data);
				$this->session->set_flashdata('mensagem', 'Email not Registered, look for the Administrator');
				$this->session->set_flashdata('alert', 'danger');
				redirect(base_url('home/esqueciSenha'), 'refresh');
				return;
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
			}
			// $data = array(
			// 		'view'   => "login/reset-password",
			// 		'title' => 'OTL - Seja bem vindo',
			// 		'identity_label' => $this->data['identity_label']
			// 		);
				
			// $this->load->helper('form');
			// $this->parser->parse('layoutDelivery', $data);
			$this->session->set_flashdata('mensagem', 'Email for Password Recovery sent Successfully');
			$this->session->set_flashdata('alert', 'success');
			redirect(base_url('home/esqueciSenha'), 'refresh');
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			if($this->input->post()){
			// if the code is valid then display the password reset form

				$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
				$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

				if ($this->form_validation->run() == false)
				{
					// display the form

					// set the flash data error message if there is one
					$this->data['_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('_message');

					$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
					$this->data['new_password'] = array(
						'name' => 'new',
						'id'   => 'new',
						'type' => 'password',
						'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
						);
					$this->data['new_password_confirm'] = array(
						'name'    => 'new_confirm',
						'id'      => 'new_confirm',
						'type'    => 'password',
						'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
						);
					$this->data['user_id'] = array(
						'name'  => 'user_id',
						'id'    => 'user_id',
						'type'  => 'hidden',
						'value' => $user->id,
						);
					$this->data['csrf'] = $this->_get_csrf_nonce();
					$this->data['code'] = $code;

					// render
					//$this->_render_page('auth/reset_password', $this->data);
					$this->session->set_flashdata('mensagem', 'Passwords do not match!');
					$this->session->set_flashdata('alert', 'danger');
					$this->data['view'] = 'auth/reset_password';
					$this->data['title'] = 'OTL - Seja bem vindo';
					
					$this->load->helper('form');
					$this->parser->parse('layoutDelivery', $this->data);
					return;
				}
				else
				{
					// do we have a valid request?
					if (/*$this->_valid_csrf_nonce() === FALSE ||*/ $user->id != $this->input->post('user_id'))
					{

						// something fishy might be up
						$this->ion_auth->clear_forgotten_password_code($code);

						show_error($this->lang->line('error_csrf'));

					}
					else
					{
						// finally change the password
						$identity = $user->{$this->config->item('identity', 'ion_auth')};

						$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

						if ($change)
						{
							// if the password was successfully changed
							$this->session->set_flashdata('message', $this->ion_auth->messages());
							//redirect(base_url("painel"), 'refresh');
							$this->ion_auth->login($identity, $this->input->post('new'), false);
	        				redirect(base_url('/home'), 'refresh');
						}
						else
						{
							// $this->session->set_flashdata('_message', $this->ion_auth->errors());
							// $this->session->set_flashdata('mensagem', 'Email diferente 22!');
							// $this->session->set_flashdata('alert', 'danger');
							redirect(base_url('auth/forgot_password') . $code, 'refresh');
						}
					}
				}
			}else{
				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
					);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
					);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
					);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				//$this->_render_page('auth/reset_password', $this->data);
				$this->data['view'] = 'auth/reset_password';
				$this->data['title'] = 'OTL - Seja bem vindo';
				
				$this->load->helper('form');
				$this->parser->parse('layoutDelivery', $this->data);
				return;
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			// $this->session->set_flashdata('_message', $this->ion_auth->errors());
			// $this->session->set_flashdata('mensagem', 'Email diferente 33!');
			// $this->session->set_flashdata('alert', 'danger');
			redirect(base_url("auth/forgot_password"), 'refresh');
		}
	}


	// activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	// deactivate the user
	function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	private function userActionCommom($validPass=1)
	{//realiza acoes comuns para cadastro e edicao de usuarios
		//$validPass ==> qndo create o valor eh um, qndo eh edit o valor eh zero
		$identity = null;
		$email = null;
		$additional_data = null;

		$tables = $this->config->item('tables','ion_auth');
		$identity_column = $this->config->item('identity','ion_auth');
		$this->data['identity_column'] = $identity_column;

		if ($this->input->post() && $this->input->post('origem') == 'form')
		{//so entra nessa condicional se for uma requisicao do tipo $_POST e de origem direta do formulario
			$this->validaComuns($identity_column, $tables, $validPass);
			if($this->input->post('tipo_cliente') == 'PF')
			{
				$this->validaPF();
			}
			else
			{
				$this->validaPJ();
			}
		}

		if( $this->form_validation->run() == true )
		{
			//parte de enderecos
			$auxIdLog = $this->input->post('id_logradouro');
			
			if( $validPass == 0)
			{//se for edit
				$idUserEndereco = $this->input->post('id_user_endereco');
				$idLogradouro = null;
				if( empty($auxIdLog) )
				{
					$idCidade = $this->setCidade();
					$idBairro = $this->setBairro($idCidade);
					$idLogradouro = $this->setLogradouro($idBairro);
				}
				$this->updtEnderecoCliente($idUserEndereco, $idLogradouro);
			}
			elseif( !empty($auxIdLog) && $validPass == 1)
			{//valida se o logradouro nao esta vazio e se eh do tipo create
			 //se atender as condicoes, significa que o cep foi encontrado e os valores ja estao setados
				$idUserEndereco = $this->setEnderecoCliente();
			}
			else
			{//qndo nao atende as condicoes, significa que o valor nao foi encontrado na base de cep
			 //os valores sao entao inseridos na base
				$idCidade = $this->setCidade();
				$idBairro = $this->setBairro($idCidade);
				$idLogradouro = $this->setLogradouro($idBairro);
				$idUserEndereco = $this->setEnderecoCliente($idLogradouro);
			}

			$email    = strtolower($this->input->post('email'));
			$identity = ($identity_column==='email') ? $email : $this->input->post('identity');
			

			$additional_data = array(
				'tipo_cliente' => $this->input->post('tipo_cliente'),
				'username' => $this->input->post('username'),
				'cpf_cnpj' => $this->input->post('cpf_cnpj'),
				'informacao_tributaria' => $this->input->post('informacao_tributaria'),
				'inscricao_estadual' => $this->input->post('inscricao_estadual'),
				'data_nascimento' => $this->convertDate( $this->input->post('data_nascimento') ),
				'sexo' => $this->input->post('sexo'),
				'phone' => $this->input->post('phone'),
				'telefone_celular' => $this->input->post('telefone_celular'),
				'id_user_endereco' => $idUserEndereco
				);
		}


		return array(
			'identity'=>$identity,
			'email'=>$email,
			'additional_data'=>$additional_data,
			);

	}

	// create a new user
	function create_user()
	{
        //$this->data['title'] = "Create User";

        /*$tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;*/

        if ($this->input->post() && $this->input->post('origem') == 'form')
        {
        	$res = $this->userActionCommom(1);
        	$email = $res['email'];
        	$identity = $res['identity'];
        	$additional_data = $res['additional_data'];
        	$password = $this->input->post('password');
        }

        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
        	$this->session->set_flashdata('message', $this->ion_auth->messages());
        	$this->ion_auth->login($identity, $password, false);

        	redirect(base_url('/painel'), 'refresh');
        }
        else
        {            
        	$message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        	$e = new Endereco();
        	$estados = $e->getEstados();

        	$data = array(
        		'view'    => 'auth/form_user',
        		'title'   => 'RCSPREV - Seja bem vindo',
        		'message' => $message,
        		'estados' => $estados,
        		'action'  => 'cadastrar'
        		);
        	
        	$this->load->helper('form');
        	$this->parser->parse('layout', $data);
        }
    }

	// edit a edit_client
    function edit_client($id=null)
    {
    	if( $id == null )
    		$id = $_SESSION['user_id'];
    	
		//se nao tiver logado ou se o mesmo nao for o proprio usuario logado redireciona
    	if (!$this->ion_auth->logged_in())
    		redirect(base_url('auth/loginPanel'), 'refresh');
    	if (!($this->ion_auth->user()->row()->id == $id))
    		redirect(base_url('/painel'), 'refresh');
    	
    	$user = $this->ion_auth->user($id)->row();

    	if( $this->input->post() && $this->input->post('origem') == 'form' )
    	{
    		$res = $this->userActionCommom(0);
    		$email = $res['email'];
    		$identity = $res['identity'];
    		$additional_data = $res['additional_data'];
    	}

    	if( $this->form_validation->run() == true && $this->ion_auth->update($user->id, $additional_data) )
    	{
    		$this->session->set_flashdata('message', 'Dados alterados com sucesso!');
    		redirect(base_url('/painel'), 'refresh');
    	}
    	else
    	{
    		$dados = $this->ion_auth->getDadosEditCliente($id);
    		if($dados)
    		{
    			foreach ($dados[0] as $key => $value) {
    				if($key == 'data_nascimento')
    				{
    					$value = $this->convertDateToScreen($value);
    				}
    				$_POST[$key] = $value;
    			}
    		}
    		
    		$message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
    		
    		$e = new Endereco();
    		$estados = $e->getEstados();
    		
    		$data = array(
    			'view'    => 'auth/form_user',
    			'title'   => 'RCSPREV - Seja bem vindo',
    			'message' => $message,
    			'estados' => $estados,
    			'action'  => 'editar'
    			);
    		
    		$this->load->helper('form');
    		$this->parser->parse('layout', $data);
    	}
    }

    function create_admin()
	{
        //$this->data['title'] = "Create User";

        /*$tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;*/

        if ($this->input->post() && $this->input->post('origem') == 'form')
        {
        	$res = $this->userActionCommom(1);
        	$email = $res['email'];
        	$identity = $res['identity'];
        	$additional_data = $res['additional_data'];
        	$password = $this->input->post('password');
        }

         $group[] = 1;
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data, $group))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
        	$this->session->set_flashdata('message', $this->ion_auth->messages());
        	$this->ion_auth->login($identity, $password, false);

        	redirect(base_url('/admin'), 'refresh');
        }
        else
        {            
        	$message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        	$e = new Endereco();
        	$estados = $e->getEstados();

        	$data = array(
        		'view'    => 'admin/create',
        		'title'   => 'RCSPREV - Seja bem vindo',
        		'message' => $message,
        		'estados' => $estados,
        		'action'  => 'cadastrar'
        		);
        	
        	$this->load->helper('form');
        	$this->parser->parse('layout', $data);
        }
    }

    // edit a edit_client
    function edit_admin($id=null)
    {
    	if( $id == null )
    		$id = $_SESSION['user_id'];
    	
		//se nao tiver logado ou se o mesmo nao for o proprio usuario logado redireciona
    	if (!$this->ion_auth->logged_in())
    		redirect(base_url('auth/loginAdmin'), 'refresh');
    	// if (!($this->ion_auth->user()->row()->id == $id))
    	// 	redirect(base_url('/admin'), 'refresh');
    	
    	$user = $this->ion_auth->user($id)->row();

    	if( $this->input->post() && $this->input->post('origem') == 'form' )
    	{
    		$res = $this->userActionCommom(0);
    		$email = $res['email'];
    		$identity = $res['identity'];
    		$additional_data = $res['additional_data'];
    	}

    	if( $this->form_validation->run() == true && $this->ion_auth->update($user->id, $additional_data) )
    	{
    		$this->session->set_flashdata('message', 'Dados alterados com sucesso!');
    		redirect(base_url('/admin/edit'), 'refresh');
    	}
    	else
    	{
    		$dados = $this->ion_auth->getDadosEditCliente($id);
    		if($dados)
    		{
    			foreach ($dados[0] as $key => $value) {
    				if($key == 'data_nascimento')
    				{
    					$value = $this->convertDateToScreen($value);
    				}
    				$_POST[$key] = $value;
    			}
    		}
    		
    		$message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
    		
    		$e = new Endereco();
    		$estados = $e->getEstados();
    		
    		$data = array(
    			'view'    => 'admin/create',
    			'title'   => 'RCSPREV - Seja bem vindo',
    			'message' => $message,
    			'estados' => $estados,
    			'id' => $id,
    			'action'  => 'editar'
    			);
    		
    		$this->load->helper('form');
    		$this->parser->parse('layout', $data);
    	}
    }

	// edit a user
    function edit_user($id)
    {
    	$this->data['title'] = "Edit User";

    	if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
    	{
    		redirect('auth', 'refresh');
    	}

    	$user = $this->ion_auth->user($id)->row();
    	$groups=$this->ion_auth->groups()->result_array();
    	$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
    	$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
    	$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
    	$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
    	$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

    	if (isset($_POST) && !empty($_POST))
    	{
			// do we have a valid request?
    		if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
    		{
    			show_error($this->lang->line('error_csrf'));
    		}

			// update the password if it was posted
    		if ($this->input->post('password'))
    		{
    			$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
    			$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
    		}

    		if ($this->form_validation->run() === TRUE)
    		{
    			$data = array(
    				'first_name' => $this->input->post('first_name'),
    				'last_name'  => $this->input->post('last_name'),
    				'company'    => $this->input->post('company'),
    				'phone'      => $this->input->post('phone'),
    				);

				// update the password if it was posted
    			if ($this->input->post('password'))
    			{
    				$data['password'] = $this->input->post('password');
    			}



				// Only allow updating groups if user is admin
    			if ($this->ion_auth->is_admin())
    			{
					//Update the groups user belongs to
    				$groupData = $this->input->post('groups');

    				if (isset($groupData) && !empty($groupData)) {

    					$this->ion_auth->remove_from_group('', $id);

    					foreach ($groupData as $grp) {
    						$this->ion_auth->add_to_group($grp, $id);
    					}

    				}
    			}

			// check to see if we are updating the user
    			if($this->ion_auth->update($user->id, $data))
    			{
			    	// redirect them back to the admin page if admin, or to the base url if non admin
    				$this->session->set_flashdata('message', $this->ion_auth->messages() );
    				if ($this->ion_auth->is_admin())
    				{
    					redirect('auth', 'refresh');
    				}
    				else
    				{
    					redirect('/', 'refresh');
    				}

    			}
    			else
    			{
			    	// redirect them back to the admin page if admin, or to the base url if non admin
    				$this->session->set_flashdata('message', $this->ion_auth->errors() );
    				if ($this->ion_auth->is_admin())
    				{
    					redirect('auth', 'refresh');
    				}
    				else
    				{
    					redirect('/', 'refresh');
    				}

    			}

    		}
    	}

		// display the edit user form
    	$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
    	$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
    	$this->data['user'] = $user;
    	$this->data['groups'] = $groups;
    	$this->data['currentGroups'] = $currentGroups;

    	$this->data['first_name'] = array(
    		'name'  => 'first_name',
    		'id'    => 'first_name',
    		'type'  => 'text',
    		'value' => $this->form_validation->set_value('first_name', $user->first_name),
    		);
    	$this->data['last_name'] = array(
    		'name'  => 'last_name',
    		'id'    => 'last_name',
    		'type'  => 'text',
    		'value' => $this->form_validation->set_value('last_name', $user->last_name),
    		);
    	$this->data['company'] = array(
    		'name'  => 'company',
    		'id'    => 'company',
    		'type'  => 'text',
    		'value' => $this->form_validation->set_value('company', $user->company),
    		);
    	$this->data['phone'] = array(
    		'name'  => 'phone',
    		'id'    => 'phone',
    		'type'  => 'text',
    		'value' => $this->form_validation->set_value('phone', $user->phone),
    		);
    	$this->data['password'] = array(
    		'name' => 'password',
    		'id'   => 'password',
    		'type' => 'password'
    		);
    	$this->data['password_confirm'] = array(
    		'name' => 'password_confirm',
    		'id'   => 'password_confirm',
    		'type' => 'password'
    		);

    	$this->_render_page('auth/edit_user', $this->data);
    }

	// create a new group
    function create_group()
    {
    	$this->data['title'] = $this->lang->line('create_group_title');

    	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
    	{
    		redirect('auth', 'refresh');
    	}

		// validate form input
    	$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

    	if ($this->form_validation->run() == TRUE)
    	{
    		$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
    		if($new_group_id)
    		{
				// check to see if we are creating the group
				// redirect them back to the admin page
    			$this->session->set_flashdata('message', $this->ion_auth->messages());
    			redirect("auth", 'refresh');
    		}
    	}
    	else
    	{
			// display the create group form
			// set the flash data error message if there is one
    		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

    		$this->data['group_name'] = array(
    			'name'  => 'group_name',
    			'id'    => 'group_name',
    			'type'  => 'text',
    			'value' => $this->form_validation->set_value('group_name'),
    			);
    		$this->data['description'] = array(
    			'name'  => 'description',
    			'id'    => 'description',
    			'type'  => 'text',
    			'value' => $this->form_validation->set_value('description'),
    			);

    		$this->_render_page('auth/create_group', $this->data);
    	}
    }

	// edit a group
    function edit_group($id)
    {
		// bail if no group id given
    	if(!$id || empty($id))
    	{
    		redirect('auth', 'refresh');
    	}

    	$this->data['title'] = $this->lang->line('edit_group_title');

    	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
    	{
    		redirect('auth', 'refresh');
    	}

    	$group = $this->ion_auth->group($id)->row();

		// validate form input
    	$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

    	if (isset($_POST) && !empty($_POST))
    	{
    		if ($this->form_validation->run() === TRUE)
    		{
    			$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

    			if($group_update)
    			{
    				$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
    			}
    			else
    			{
    				$this->session->set_flashdata('message', $this->ion_auth->errors());
    			}
    			redirect("auth", 'refresh');
    		}
    	}

		// set the flash data error message if there is one
    	$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
    	$this->data['group'] = $group;

    	$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

    	$this->data['group_name'] = array(
    		'name'    => 'group_name',
    		'id'      => 'group_name',
    		'type'    => 'text',
    		'value'   => $this->form_validation->set_value('group_name', $group->name),
    		$readonly => $readonly,
    		);
    	$this->data['group_description'] = array(
    		'name'  => 'group_description',
    		'id'    => 'group_description',
    		'type'  => 'text',
    		'value' => $this->form_validation->set_value('group_description', $group->description),
    		);

    	$this->_render_page('auth/edit_group', $this->data);
    }


    function _get_csrf_nonce()
    {
    	$this->load->helper('string');
    	$key   = random_string('alnum', 8);
    	$value = random_string('alnum', 20);
    	$this->session->set_flashdata('csrfkey', $key);
    	$this->session->set_flashdata('csrfvalue', $value);

    	return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
    	if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
    		$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
	
	private function validaComuns($identity_column, $tables, $validPass=1)
	{
		//valida os campos comuns entre PF e PJ no formulario
		//|is_unique[users.username]
		// validate form input
        //no caso de edit nao validar a senha
		if($validPass == 1)
		{
			if($identity_column!=='email')
			{
				$this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
	            //$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
				$this->form_validation->set_rules('email', 'email', 'required|valid_email',
					array(
						'required' => $this->auxRequired,
						'valid_email' => 'Email Invalido.'
						));
			}
			else
			{
	            //$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
				$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[' . $tables['users'] . '.email]',
					array(
						'required' => $this->auxRequired,
						'valid_email' => 'Email Invalido.'
						));
			}
			$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]',
				array(
					'required' => $this->auxRequired2
					));
			$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required',
				array(
					'required' => $this->auxRequired2
					));
		}

		$this->form_validation->set_rules('phone', 'telefone', 'trim|required',
			array(
				'required' => $this->auxRequired
				));
        //$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');

		
		$this->form_validation->set_rules('tipo_cliente', 'tipo cliente', 'required');
		$this->form_validation->set_rules('cep', 'CEP', 'required|exact_length[9]', 
			array(
				'required' => $this->auxRequired,
				'exact_length' => 'Informe um CEP com o 9 caracteres.'
				));
	}
	
	public function valida_cpf_cnpj($str)
	{
		// Cria um objeto sobre a classe
		$cpf_cnpj = new ValidaCPFCNPJ($str);

		if( $this->input->post('tipo_cliente') == 'PF' && $cpf_cnpj->valida_cpf())
		{
			return TRUE;
		}
		else if( $this->input->post('tipo_cliente') == 'PJ' && $cpf_cnpj->valida_cnpj())
		{
			return TRUE;
		}
		else
		{
			$field = ( $this->input->post('tipo_cliente') == 'PF' ? 'CPF' : 'CNPJ' );
			$this->form_validation->set_message('valida_cpf_cnpj', $field.' Inv&aacute;lido');
			return FALSE;
		}
	}

	private function validaPF()
	{//valida os campos de PF
		$this->form_validation->set_rules('username', 'nome', 'required|min_length[5]|max_length[250]',
			array(
				'required' => $this->auxRequired,
				'min_length' => 'Informe um nome com o minimo de 5 caracteres.',
				'max_length' => 'Informe um nome com o maximo de 250 caracteres.'
				));
		
		$this->form_validation->set_rules('cpf_cnpj', 'CPF', 'required|min_length[11]|max_length[20]|callback_valida_cpf_cnpj',
			array(
				'required' => $this->auxRequired,
				'min_length' => 'Informe um CPF com o minimo de 11 caracteres.',
				'max_length' => 'Informe um CPF com o maximo de 20 caracteres.'
				));
		
		$this->form_validation->set_rules('data_nascimento', 'data de Nascimento', 'required',
			array('required' => $this->auxRequired2)
			);
		
		$this->form_validation->set_rules('sexo', 'sexo', 'required', array('required' => $this->auxRequired) );
	}
	
	private function validaPJ()
	{//valida os campos de PJ		
		$this->form_validation->set_rules('username', 'raz&atilde;o social', 'required|min_length[5]|max_length[250]',
			array(
				'required' => $this->auxRequired2,
				'min_length' => 'Informe uma raz�o social com o minimo de 5 caracteres.',
				'max_length' => 'Informe uma raz�o social com o maximo de 250 caracteres.',
				));
		
		$this->form_validation->set_rules('cpf_cnpj', 'CNPJ', 'required|min_length[11]|max_length[20]|callback_valida_cpf_cnpj',
			array(
				'required' => $this->auxRequired,
				'min_length' => 'Informe um CNPJ com o minimo de 11 caracteres.',
				'max_length' => 'Informe um CNPJ com o maximo de 20 caracteres.'
				));
		
		$this->form_validation->set_rules('informacao_tributaria', 'informa&ccedil;&otilde;es tribut&aacute;ria', 'required',
			array(
				'required' => $this->auxRequired2
				));
		
		$this->form_validation->set_rules('inscricao_estadual', 'inscri&ccedil;&atilde;o estadual', 'required|exact_length[12]|integer',
			array(
				'required' => $this->auxRequired2,
				'exact_length' => 'Informe uma inscri&ccedil;&atilde;o estadual com 12 caracteres.',
				'integer' => 'inscri&ccedil;&atilde;o estadual deve ser numerico.'
				));
	}
	
	private function setValuesEnderecoCliente($idLogradouro = null)
	{
		$this->load->model('enderecocliente_model','enderecocliente_model');
		
		$idLogradouro = (empty($idLogradouro) ? $this->input->post('id_logradouro') : $idLogradouro);
		$this->enderecocliente_model->numero = $this->input->post('numero');
		$this->enderecocliente_model->complemento = $this->input->post('complemento');
		$this->enderecocliente_model->referencia = $this->input->post('referencia');
		$this->enderecocliente_model->id_logradouro = $idLogradouro;
	}
	
	private function setEnderecoCliente($idLogradouro = null)
	{
		$this->load->model('enderecocliente_model','enderecocliente_model');
		$this->setValuesEnderecoCliente($idLogradouro);
		return $this->enderecocliente_model->setEnderecoCliente();
	}
	
	private function updtEnderecoCliente($idUserEndereco = null, $idLogradouro = null)
	{
		$this->load->model('enderecocliente_model','enderecocliente_model');
		$this->setValuesEnderecoCliente($idLogradouro);
		$this->enderecocliente_model->updtEnderecoCliente($idUserEndereco);
	}
	
	private function setCidade()
	{
		$this->load->model('cidade_model','cidade_model');
		$this->cidade_model->id_estado = $this->input->post('estado');
		$this->cidade_model->cidade = $this->input->post('cidade');
		return $this->cidade_model->setCidade();
	}
	
	private function setBairro($idCidade)
	{
		$this->load->model('bairro_model','bairro_model');
		$this->bairro_model->id_cidade = $idCidade;
		$this->bairro_model->bairro = $this->input->post('bairro');
		return $this->bairro_model->setBairro();
	}
	
	private function setLogradouro($idBairro)
	{
		$this->load->model('logradouro_model','logradouro_model');
		$this->logradouro_model->id_bairro = $idBairro;
		$this->logradouro_model->logradouro = $this->input->post('logradouro');
		$this->logradouro_model->cep = str_replace( '-', '', $this->input->post('cep') );
		return $this->logradouro_model->setLogradouro();
	}
	
	private function convertDate($date)
	{
		$date = strtotime($date." 00:00:01");
		return date('Y-m-d H:i:s', $date);
	}
	
	private function convertDateToScreen($date)
	{//converte data do banco para a tela
		$date = new DateTime($date);
		return $date->format('d/m/Y');
		
	}

}