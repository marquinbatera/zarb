<!-- Content Start -->
<div id="contentWrapper">
				
	<div class="page-title title-1">
		<div class="container">
			<div class="row">
				<div class="cell-12">
					<h1 class="fx" data-animate="fadeInLeft">Identificação</h1>
					<div class="breadcrumbs main-bg fx" data-animate="fadeInUp">
						<a href="<?php echo base_url();?>">Home</a><span class="line-separate">/</span><a href="#">Cadastro Cliente </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="padd-top-50">
		<div class="container">
			<div class="row padd-top-25">
				
				<div class="cell-6">
					<div class="cell-12">
						<div class="cell-7 contact-form fx" data-animate="fadeInLeft" id="id_endereco">
							
							<h3 class="block-head"> <i class="fa fa-group"></i> Já tenho cadastro</h3>
							<mark id="message"></mark>
							<?php  echo form_open( base_url('/auth/loginPanel/cart-finalizar_pagamento') ); ?>
								
								<?php if(!empty($message)){ ?>
									<div class="box error-box fx" data-animate="fadeInLeft" style="color: #000000 !important;">
										<a class="close-box" href="#"><i class="fa fa-times"></i></a>
										<?php echo $message;?>
									</div>
								<?php } ?>
									
									<div class="form-input">
										<label>Email</label>
										<?php echo form_input( array( "name"=> "identity", "value"=>set_value('identity')) ); ?>
									</div>
									<div class="form-input">
										<label>Senha</label>
										<?php echo form_password( array("name"=>"password") ); ?>
									</div>
									<div class="form-input">
										<?php echo form_submit( "btn_login", "LOGIN", array("class"=>"btn btn-large main-bg") ); ?>
									</div>
									
									<div class="form-input">								
										<?php echo form_checkbox( array("name"=>"remember", "class"=>"check-box", "value"=>"1") )."Lembrar-me&nbsp;&nbsp;&nbsp;" ?>
										<a href="<?php echo base_url('auth/forgot_password');?>">Esqueceu sua senha ?</a>
									</div>
								
							
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				
				<div class="cell-6">
					<div class="cell-12">
						<div class="cell-7 contact-form fx" data-animate="fadeInLeft" id="id_endereco">
							<h3 class="block-head"><i class="fa fa-cog"></i>Não tenho cadastro</h3>
							<mark id="message"></mark>
							<?php  echo form_open( base_url('/auth/create_user') ); ?>
								
								<div class="form-input" style="padding-top:102px;">
									<?php echo form_input( array( "name"=> "email", "placeholder"=>"Informe seu email") ); ?>
								</div>
									
								<div class="form-input center">
									<?php echo form_submit( "btn_cadastrar", "CRIAR CADASTRO", array("class"=>"btn btn-large main-bg") ); ?>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/wise/js/jquery.min.js"></script>