<link href="<?php echo base_url()?>assets/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" />


<?php
	// cadastrar / editar
	//valida opcoes de display do endereco
	if($action == 'cadastrar')
	{
		$form = "create_user";
		$acao = "action_create";
	}
	else
	{
		$form = "edit_client/".$this->session->userdata('user_id');
		$acao = "action_edit";
	}
?>

<!-- Content Start -->
<div id="contentWrapper">
	<div class="page-title title-1">
		<div class="container">
			<div class="row">
				<div class="cell-12">
					<h1 class="fx" data-animate="fadeInLeft"><?php echo ($action == 'cadastrar' ? 'Cadastrar' : 'Editar')?> <span>Dados</span></h1>
					<div class="breadcrumbs main-bg fx" data-animate="fadeInUp">
						<?php if( $action == 'cadastrar' ) { ?>
							<a href="<?php echo base_url();?>">Home</a><span class="line-separate">/</span><a href="#">Cadastro Cliente </a>
						<?php } else { ?>
							<a href="<?php echo base_url();?>">Home</a><span class="line-separate">/</span><a href="<?php echo base_url('/painel');?>">Painel </a><span class="line-separate">/</span><a href="#">Editar Dados </a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="padd-top-50">
		<div class="container">
			<div class="row">
				<?php echo form_open( base_url("auth/".$form) );?>
				<?php
					echo form_hidden('id_logradouro', set_value('id_logradouro'));
					echo form_hidden('id_user_endereco', set_value('id_user_endereco'));
					echo form_hidden('acao', $acao);
					//se origem form indica que ele veio sem o parametro de email da tela de login/cadastro
					echo form_hidden('origem', 'form');
				?>
				<div class="cell-7 contact-form fx" data-animate="fadeInLeft" id="id_contato">
					<h3 class="block-head">Dados Principais</h3>
					<mark id="message"></mark>
					<div class="form-input">
						<label>Tipo cadastro <span class="red">*</span></label>
						<?php echo form_error('tipo_cliente','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
						?>
						
						<div class="form-box">
						<?php
							echo form_radio('tipo_cliente', 'PF', set_radio('tipo_cliente', 'PF',TRUE) ).
														"<span>Pessoa F&iacute;sica</span>";
							echo form_radio('tipo_cliente', 'PJ', set_radio('tipo_cliente', 'PJ') ).
														"<span>Pessoa Jur&iacute;dica</span>";
						?>
						</div>
					</div>
					
					<div class="form-input">
						<label id="lb_nome_rz_social">Nome Completo<span class="red">*</span></label>
						<?php echo form_error('username','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>'); 
							  echo form_input( array('name'=>'username', 'value'=>set_value('username')) ); 
						?>

					</div>
					
					<div class="form-input">
						<label id="lb_cpf_cnpj">CPF <span class="red">*</span></label>
						<?php echo form_error('cpf_cnpj','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>'); 
							  echo form_input( array('name'=>'cpf_cnpj', 'value'=>set_value('cpf_cnpj')) ); 
						?>
					</div>
					
					<div class="form-radio PJ">
						<label>Informa&ccedil;&otilde;es tribut&aacute;rias<span class="red">*</span></label>
						<?php
						echo form_radio('informacao_tributaria', 'C', set_radio('informacao_tributaria', 'C', TRUE) ).form_label('Contribuinte ICMS ', 'lb_info_trib');
						echo form_radio('informacao_tributaria', 'N', set_radio('informacao_tributaria', 'N') ).form_label('N&atilde;o Contribuinte ', 'lb_info_trib');
						echo form_radio('informacao_tributaria', 'I', set_radio('informacao_tributaria', 'I') ).form_label('Isento de Inscri&ccedil;&atilde;o Estadual', 'lb_info_trib');
						?>
					</div>
					
					<div class="form-input PJ">
						<label>Inscri&ccedil;&atilde;o estadual<span class="red">*</span></label>
						<?php echo form_error('inscricao_estadual','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
							  echo form_input( array('name'=>'inscricao_estadual', 'value'=>set_value('inscricao_estadual'), 'class'=>'PJ') ); 
						?>
					</div>
					
					<div class="form-input PF">
						<label>Data de nascimento<span class="red">*</span></label>
						<?php echo form_error('data_nascimento','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
							  echo form_input( array('name'=>'data_nascimento', 'maxlength'=>'10', 'value'=>set_value('data_nascimento'), 'class'=>'PF', 'style' => 'width:90%') ); 
						?>
					</div>
					
					<div class="form-input PF">
						<label>Sexo<span class="red">*</span></label>
						<div class="form-box">
							<?php
							echo form_radio( 'sexo', 'M', set_radio('sexo', 'M', TRUE) )."<span>Masculino</span>";
							echo form_radio( 'sexo', 'F', set_radio('sexo', 'F') )."<span>Feminino</span>";
							?>
						</div>
					</div>
				</div>
				
				<div class="cell-7 contact-form fx" data-animate="fadeInLeft" id="id_contato">
					<h3 class="block-head">Contato</h3>
					<mark id="message"></mark>
					
					<div class="form-input">
						<label>Telefone<span class="red">*</span></label>
						<?php echo form_error('phone','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>'); 
							  echo form_input( array('name'=>'phone', 'value'=>set_value('phone')) ); 
						?>
					</div>
					
					<div class="form-input">
						<label>Telefone Celular</label>
						<?php echo form_input( array('name'=>'telefone_celular', 'value'=>set_value('telefone_celular')) ); ?>
					</div>
					
					<div class="form-input">
						<label>Email<span class="red">*</span></label>
						<?php echo form_error('email','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>'); 
							  echo form_input( array('name'=>'email', 'value'=>set_value('email')) ); 
						?>
					</div>

					
					<?php
					//a opcao de senha so deve aparecer quando a acao for de cadastro!
					if( $action == 'cadastrar' ) { ?>
						<div class="form-input">
							<label>Senha<span class="red">*</span></label>
							<?php echo form_error('password','<div class="box error-box fx" data-animate="fadeInLeft">
														   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
								  echo form_password( array('name'=>'password', 'value'=>set_value('password')) ); 
							?>
						</div>
						
						<div class="form-input">
							<label>Confirma&ccedil;&atilde;o senha<span class="red">*</span></label>
							<?php echo form_error('password_confirm','<div class="box error-box fx" data-animate="fadeInLeft">
																   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
								  echo form_password( array('name'=>'password_confirm', 'value'=>set_value('password_confirm')) ); 
							?>
						</div>
					<?php } ?>
				
				</div>
					
				<div class="cell-7 contact-form fx" data-animate="fadeInLeft" id="id_endereco">
					<h3 class="block-head">Endere&ccedil;o</h3>
					<mark id="message"></mark>
					
					<div class="form-input">
						<div class="box info-box fx" data-animate="fadeInLeft" id="info_cep" style="display:none;">
							<h3>CEP nao encontrado</h3>
							<p>Realize uma nova pesquisa, ou insira os valores para cadastro de um novo endereco</p>
						</div>
						
						<label>CEP<span class="red">*</span></label>
						<?php echo form_error('cep','<div class="box error-box fx" data-animate="fadeInLeft">
															   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
							  echo form_input( array('name'=>'cep', 'id'=>'cep', 'maxlength'=>'9', 'style' => 'width:90%', 'value'=>set_value('cep')) )." ";
						?>
						
						<button type="button" class="btn btn-default btn-lg" id="btn_cep">
						  <span class='fa fa-search'></span>
						</button>
					</div>
					
					<div class="form-input endereco">
						<label>Estado<span class="red">*</span></label>
						<?php echo form_dropdown('estado', $estados, ($this->input->post('estado') ? $this->input->post('estado') : '0') ); ?>
					</div>
					
					<div class="form-input endereco">
						<label>Cidade<span class="red">*</span></label>
						<?php echo form_input( array('name'=>'cidade', 'value'=>set_value('cidade')) ); ?>
					</div>
					
					<div class="form-input endereco">
						<label>Bairro<span class="red">*</span></label>
						<?php echo form_input( array('name'=>'bairro', 'value'=>set_value('bairro')) ); ?>
					</div>
					
					<div class="form-input endereco">
						<label>Logradouro<span class="red">*</span></label>
						<?php echo form_input( array('name'=>'logradouro', 'value'=>set_value('logradouro')) ); ?>
					</div>
					
					<div class="form-input endereco" style="float:left;width:50%;">
						<div class="cell-6 fx" style="padding-left:0;float:left;width:100%">
							<label>N&uacute;mero<span class="red">*</span></label>
						</div>

						<div class="cell-12 fx" style="padding-left:0;float:left;">
							<?php echo form_input( array('name'=>'numero', 'value'=>set_value('numero')) ); ?>
						</div>
					</div>

					<div class="form-input endereco" style="float:left;width:50%;">
						<div class="cell-6 fx" style="float:left;width:100%;">
							<label>Complemento</label>
						</div>

						<div class="cell-12 fx" style="padding-right:0;float:left;">
							<?php echo form_input( array('name'=>'complemento', 'value'=>set_value('complemento')) ); ?>
						</div>
					</div>

					<div class="form-input endereco">
						<label>Refer&ecirc;ncia</label>
						<?php echo form_input( array('name'=>'referencia', 'value'=>set_value('referencia')) ); ?>
					</div>
						
					<div class="form-input">
						<input type="submit" class="btn btn-large main-bg" id="btnSubmit" value="Salvar">
					</div>
				</div>
				<?php echo form_close(); ?>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/wise/js/jquery.min.js"></script>

<script>
$(function()
{
	//http://jsfiddle.net/d29m6enx/2/
	//mascara com o padrao de nove digitos quando digitado
	var maskPhone = function (val) {
		  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
		},
		options = {onKeyPress: function(val, e, field, options) {
		        field.mask(maskPhone.apply({}, arguments), options);
		    }
	};

	$('[name=phone]').mask(maskPhone, options);
	$('[name=telefone_celular]').mask(maskPhone, options);
	$('[name=cep]').mask("00000-000");

	function validaData(campo,valor) {
		var date=valor;
		var ardt=new Array;
		var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
		ardt=date.split("/");
		erro=false;
		if ( date.search(ExpReg)==-1){
			erro = true;
		}
		else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30)) {
			erro = true;
		} else if ( ardt[1]==2) {
			if ((ardt[0]>28)&&((ardt[2]%4)!=0))
				erro = true;
			if ((ardt[0]>29)&&((ardt[2]%4)==0))
				erro = true;
		}
		
		var dtNasc  = new Date(ardt[2], ardt[1], ardt[0]);
		var ageDate = new Date( Date.now() - dtNasc.getTime() );
		if( Math.abs(ageDate.getUTCFullYear() - 1970) > 150)
			erro = true;
		
		if (erro) {
			alert("" + valor + " não é uma data válida!!!");
			$("[name="+campo+"]").val("");
			return false;
		}
		return true;
	}

	var options =  {
		onComplete: function(data) {
			validaData('data_nascimento', data);
		}
	};

	$("[name=data_nascimento]").mask('00/00/0000', options);
	$("[name=data_nascimento]").datepicker({
		showOn: "button",
		buttonImage: "<?php echo base_url()?>assets/jquery-ui-1.11.4.custom/images/calendar.gif",
		buttonImageOnly: true,
		buttonText: "Select date",
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy',
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		nextText: 'Próximo',
		prevText: 'Anterior'
	});

	function setPJ()
	{
		var lb_nome_rz_social = $('[id=lb_nome_rz_social]').html();
		var lb_cpf_cnpj = $('[id=lb_cpf_cnpj]').html();
		
		lb_nome_rz_social = lb_nome_rz_social.replace('Nome Completo', 'Razao Social');
		$('[id=lb_nome_rz_social]').html(lb_nome_rz_social);
		
		lb_cpf_cnpj = lb_cpf_cnpj.replace('CPF', 'CNPJ');
		$('[id=lb_cpf_cnpj]').html(lb_cpf_cnpj);
		
		$("[name=cpf_cnpj]").mask("00.000.000/0000-00");
		
		$(".PF").hide();
		$(".PJ").show();
	}

	function setPF()
	{
		var lb_nome_rz_social = $('[id=lb_nome_rz_social]').html();
		var lb_cpf_cnpj = $('[id=lb_cpf_cnpj]').html();
		
		lb_nome_rz_social = lb_nome_rz_social.replace('Razao Social', 'Nome Completo');
		$('[id=lb_nome_rz_social]').html(lb_nome_rz_social);
		
		lb_cpf_cnpj = lb_cpf_cnpj.replace('CNPJ', 'CPF');
		$('[id=lb_cpf_cnpj]').html(lb_cpf_cnpj);
		
		$("[name=cpf_cnpj]").mask("000.000.000-00");
		
		$(".PJ").hide();
		$(".PF").show();
	}
	
	function clearEndereco()
	{
		$("[name=logradouro]").removeAttr('disabled');
		$("[name=bairro]").removeAttr('disabled');
		$("[name=cidade]").removeAttr('disabled');
		$("[name=estado]").removeAttr('disabled');
		
		$("[name=logradouro]").val('');
		$("[name=id_logradouro]").val('');
		$("[name=bairro]").val('');
		$("[name=cidade]").val('');
		$("[name=estado] option[value=0]").attr('selected', 'selected');
	}
	
	//--------- fim funcoes --------
	
	//rever este ponto
	var tpCliente = "<?php echo $this->input->post('tipo_cliente')?>";
	if(tpCliente === 'PJ')
	{
		setPJ();
	}
	else
	{
		setPF();
	}
	
	//qndo a acao do form for edit, nao deve se ocultar a parte de endereco
	var acao = $("[name=acao]").val();
	if( acao == "action_create" ) 
	{
		$(".endereco").hide();
	}
	else
	{
		$(".endereco").show();
	}

	$("[name=tipo_cliente]").click(function(){
		$(".error-box").hide();
		var p = $(this).val();
		if(p === 'PJ'){
			setPJ();
		}else{
			setPF();
		}
	});
	
	$("#cep").focus(function(){
		clearEndereco();
	});
	
	$("#btn_cep").click(function(){
		var cep = $('[name=cep]').val();
		if (cep)
		{
			$.ajax({
					type: "POST",
					url: "<?php echo base_url("endereco/getEndereco")?>",
					data: {'cep':cep.replace("-", "")},
					dataType: "json",
					success: function( data )
					{				
						if (data.status_code === '200')
						{
							data = data[0];
							$("[name=logradouro]").val(data.logradouro);
							$("[name=id_logradouro]").val(data.id_logradouro);
							$("[name=bairro]").val(data.bairro);
							$("[name=cidade]").val(data.cidade);
							$("[name=estado] option[value="+data.id_estado+"]").attr('selected', 'selected');
							
							$("[name=logradouro]").attr('disabled', 'disabled');
							$("[name=bairro]").attr('disabled', 'disabled');
							$("[name=cidade]").attr('disabled', 'disabled');
							$("[name=estado]").attr('disabled', 'disabled');
							//$("input").removeAttr('disabled');
						}
						else
						{
							clearEndereco();
							$("#info_cep").show(300).delay(5000).hide(300);
						}

						$(".endereco").show();
					}
				});
		}else{
			alert('preencha o cep');
		}
	});
	
	$("#btnSubmit").click(function(){
		$("[name=data_nascimento]").removeAttr('disabled');
	});
	
	
});
</script>
<!-- Content End -->