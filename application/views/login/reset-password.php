
  	<div class="sign-in">
        <div class="container">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
              	<div class="row">
               	  <div class="col-md-12">
                        <img src="<?php echo base_url();?>assets/img/logo-client.png" alt="" class="logo-client"/>
                        <?php if(!empty($_SESSION['mensagem'])){ ?>
                          <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?> alert-dismissible classe_alerta" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><?php echo $this->session->flashdata('mensagem'); ?></strong>
                          </div>
                        <?php } ?>
                        <div class="well">
                            <h3 class="form-signin-heading">Password Reset</h3>
                            <p>Enter the email address associated with your account, then click Reset button below. We'll send you a link to a page where you can easily create a new password.</p>
                          <form class="form-signin" action="<?php echo base_url('auth/forgot_password');?>" method="post">
                            <div class="form-group">
                                <!-- <input type="email" class="form-control" placeholder="Email or mobile phone number" required autofocus> -->
                                <?php 
                                  echo form_error('email','<div class="box error-box fx" data-animate="fadeInLeft">
                                                 <a class="close-box" href="#"><i class="fa fa-times"></i></a>', '</div>');
                                
                                  echo form_input( array( 'name' => 'email', 'id' => 'email', 'value'=>set_value('email'), 'class' => 'form-control', 'placeholder' => 'Email' ) ); 
                                ?>
                            </div>
                            <div class="form-group no-margin">
                                  <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
                            </div>
                            </form>
                            
                       </div>
                       <p class="text-center"><a href="<?php echo base_url('home/index'); ?>">Sign In</a> <!-- |  <a href="#">Request account</a>--></p>
                          <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="copyright">© Copyrright 2016 - OTL Software</p>
                    </div>
                </div>
              </div>
          </div>
        </div> <!-- /container -->
    </div>
