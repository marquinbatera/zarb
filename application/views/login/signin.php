    <div class="sign-in">
        <div class="container">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
              	<div class="row">
               	  <div class="col-md-12">
                        <!-- <img src="<?php echo base_url(); ?>assets/img/logo-client.jpg" alt="" class="logo-client"/> -->
                    <?php if(!empty($_SESSION['mensagem'])){ ?>
                          <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?> alert-dismissible classe_alerta" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><?php echo $this->session->flashdata('mensagem'); ?></strong>
                          </div>
                    <?php } ?>
                        <div class="well">
                        <h3 class="form-signin-heading">Sign in</h3>
                        <form class="form-signin" action="<?php echo base_url('auth/login');?>" method="POST">
                          <div class="form-group">
                            <?php 
                              echo form_error('identity','<div class="alert alert-danger classe_alerta" role="alert"><i class="fa fa-times"></i></a>', '</div>');
                              echo form_input( array( 'name' => 'identity', 'id' => 'identity', 'value'=>set_value('identity'), 'class' => 'form-control', 'placeholder' => 'Enter your email address', 'required'=>'', 'autofocus'=>'' ) ); 
                            ?>
                          </div>
                          <div class="form-group">
                            <?php 
                              echo form_error('password','<div class="alert alert-danger classe_alerta" role="alert"><i class="fa fa-times"></i></a>', '</div>');
                              echo form_input( array( 'name' => 'password', 'id' => 'password', 'value'=>set_value('password'), 'class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password', 'required'=>'', 'autofocus'=>'' ) ); 
                            ?>
                          </div>
                          <div class="form-group no-margin">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                          </div>
                        </form>
                        </div>
                    <p class="text-center"><a href="javascript:">Esqueceu a senha?</a>  <!--|  <a href="<?php echo base_url('home/recuperaConta'); ?>">Request an account</a>--></p>
                    <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="copyright">© Copyright 2016 - ZARB</p>
                    </div>
                </div>
              </div>
              
          </div>
        </div> <!-- /container -->
    </div>
