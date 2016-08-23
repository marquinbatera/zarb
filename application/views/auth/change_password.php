<div id="contentWrapper">
	<!--<div class="page-title title-1">
		<div class="container">
			<div class="row">
				<div class="cell-12">
					<h1 class="fx" data-animate="fadeInLeft">Alterar <span>Senha</span></h1>
					<div class="breadcrumbs main-bg fx" data-animate="fadeInUp">
						<a href="<?php echo base_url();?>">Home</a><span class="line-separate">/</span><a href="<?php echo base_url('/painel');?>">Painel </a><span class="line-separate">/</span><a href="#">Alterar Senha</a>
					</div>
				</div>
			</div>
		</div>
	</div>-->
	
	<div class="padd-top-50">
		<div class="container">
			<div class="row">
				<?php 
					echo form_open( base_url('auth/change_password') );
					echo form_hidden('user_id', set_value('user_id'));
				?>
				<div class="cell-7 contact-form fx" data-animate="fadeInLeft" id="id_contato">
					<!--<h3 class="block-head">Dados Principais</h3>
					<mark id="message"></mark>-->
										
					<div class="form-input">
						<label id="lb_old">Old Password:<span class="red">*</span></label>
						<?php echo form_error('old','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
							  echo form_password( array('name'=>'old', 'value'=>set_value('old')) );
						?>
					</div>
					
					<div class="form-input">
						<label id="lb_new">New Password:<span class="red">*</span></label>
						<?php echo form_error('new','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
							  echo form_password( array('name'=>'new', 'value'=>set_value('new')) );
						?>
					</div>
					
					<div class="form-input">
						<label id="lb_new_confirm">Confirm your new Password:<span class="red">*</span></label>
						<?php echo form_error('new_confirm','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
							  echo form_password( array('name'=>'new_confirm', 'value'=>set_value('new_confirm')) );
						?>
					</div>
					
					<div class="form-input">
						<input type="submit" class="btn btn-large main-bg" id="btnSubmit" value="Alterar">
					</div>
				
				<?php echo form_close(); ?>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/wise/js/jquery.min.js"></script>

