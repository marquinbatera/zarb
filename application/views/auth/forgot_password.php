<!-- Content Start -->
<div id="contentWrapper">
	<div class="page-title title-1">
		<div class="container">
			<div class="row">
				<div class="cell-12">
					<h1 class="fx" data-animate="fadeInLeft">Recuperar <span>Senha</span></h1>
					<div class="breadcrumbs main-bg fx" data-animate="fadeInUp">
						<a href="<?php echo base_url();?>">Home</a><span class="line-separate">/</span><a href="#">Password Recover</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="padd-top-50">
		<div class="container">
			<div class="row">
				<?php if(!empty($_SESSION['message'])){ ?>
					<div class="box info-box fx" data-animate="fadeInLeft" style="color: #000000 !important;">
						<a class="close-box" href="#"><i class="fa fa-times"></i></a>
						<?php echo $_SESSION['message'];?>
					</div>
				<?php } ?>
				
				<div class="cell-7 contact-form fx" data-animate="fadeInLeft">
				<?php echo form_open(base_url("auth/forgot_password"));?>
					
					<h3 class="block-head"><?php echo lang('forgot_password_heading');?></h3>
					<p> <?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?> </p>
					<mark id="message"></mark>
					
					<div class="form-input">
						<label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label>
						<?php 
							echo form_error('email','<div class="box error-box fx" data-animate="fadeInLeft">
													   <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
						
							echo form_input( array( 'name' => 'email', 'id' => 'email', 'value'=>set_value('email') ) ); 
						?>
					</div>

					<div class="form-input">
						<input type="submit" class="btn btn-large main-bg" id="btnSubmit" value="Password Recover">
					</div>
				
				<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>