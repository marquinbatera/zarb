<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url();?>assets/img/favicon/manifest.json">
    <meta name="msapplication-TileImage" content="<?php echo base_url();?>assets/img/favicon/ms-icon-144x144.png">
    <title>{title}</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/dateTimePicker/moment-with-locales.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dateTimePicker/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/main.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/funcoesAdmin.js"></script>

     <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_SERVER['KEY_GOOGLE_MAPS']; ?>&libraries=places"></script>

    <script>
      window.BASE_URL = "<?php echo base_url('') ?>";
    </script>
  
  </head>
  <body>

  <input  type="hidden" value="<?php echo base_url('') ?>">
  
  <!-- Início Menu Principal -->
  <button type="button" class="navbar-toggle navbar-toggle--htla">
  <span></span>
  </button>
  <div class="menu side-left">
    <div class="top-menu">
        <h4>ZARB<span>solution</span></h4>
    </div>
    <div class="overlflow">
        <ul class="menu-list" id="menu-accordion" role="tablist" aria-multiselectable="true">
            <?php if($this->ion_auth->is_admin()){ ?>
            <li class="panel">
                <a href="">
                    <i class="icon icon-config"></i>Produtos
                </a>
                <ul id="menu-configuration" class="submenu">
                    <li><a href="<?php echo base_url('produtos/newProdutos') ?>"><i class="glyphicon glyphicon-menu-right"></i>Cadastro</a></li>
                    <li><a href="<?php echo base_url('produtos/listProdutos') ?>"><i class="glyphicon glyphicon-menu-right"></i>Lista de Produtos</a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="">
                    <i class="icon icon-config"></i>Clientes
                </a>
                <ul id="menu-configuration" class="submenu">
                    <li><a href="<?php echo base_url('cliente/newCliente') ?>"><i class="glyphicon glyphicon-menu-right"></i>Cadastro</a></li>
                    <li><a href="<?php echo base_url('cliente/listClientes') ?>"><i class="glyphicon glyphicon-menu-right"></i>Lista de Clientes</a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="">
                    <i class="icon icon-config"></i>Vendedores
                </a>
                <ul id="menu-configuration" class="submenu">
                    <li><a href="<?php echo base_url('vendedor/newVendedor') ?>"><i class="glyphicon glyphicon-menu-right"></i>Cadastro</a></li>
                    <li><a href="<?php echo base_url('vendedor/listVendedor') ?>"><i class="glyphicon glyphicon-menu-right"></i>Lista de Vendedores</a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="">
                    <i class="icon icon-config"></i>Filiais
                </a>
                <ul id="menu-configuration" class="submenu">
                    <li><a href="<?php echo base_url('filial/newFilial') ?>"><i class="glyphicon glyphicon-menu-right"></i>Cadastro</a></li>
                    <li><a href="<?php echo base_url('filial/listFilial') ?>"><i class="glyphicon glyphicon-menu-right"></i>Lista de Filiais</a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="">
                    <i class="icon icon-config"></i>Vendas
                </a>
                <ul id="menu-configuration" class="submenu">
                    <li><a href="<?php echo base_url('vendas/newVenda') ?>"><i class="glyphicon glyphicon-menu-right"></i>Cadastro</a></li>
                    <li><a href="<?php echo base_url('vendas/listVendas') ?>"><i class="glyphicon glyphicon-menu-right"></i>Relatório</a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>   
     </div>
  </div>
<div class="mask"></div>
<!-- Fim Menu Principal -->
<!-- Início Cabeçalho -->
<header>
	<div class="logo">
    <a href="<?php echo base_url('produtos/listProdutos') ?>">
    	<span>Delivery Mates</span>
        <!-- <img src="<?php echo base_url('/assets/img/logo-client.jpg');?>" alt="" class="logo-client"/> -->
    </a>
    </div>
    <div class="options pull-right">

       <ul class="menu-user pull-left">
       		<li>
            	<div class="btn-group">
                  <button type="button" class="btn-photo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo base_url('/assets/img/perfil/User_Circle.png');?>"/>
                  </button>
                  <div class="dropdown-menu dropdown-op dropdown-menu-right">
                  	<div class="container-box">
                        <div class="thumb-user pull-left">
                            <img src="<?php echo base_url('/assets/img/perfil/User_Circle.png');?>"/>
                        </div>
                        <div class="desc-user pull-left">
                        	<p><strong><?php echo $this->ion_auth->user()->row()->username; ?></strong></p>
							             <p><?php echo $this->ion_auth->user()->row()->email; ?></p>
                          <!-- <p class="text-gray">Dispatcher</p> -->
                          <p class="text-gray"><?php echo $this->session->userdata('function'); ?></p>
                        </div>
                    </div>
                    <div class="footer-user">
                            <a href="<?php echo base_url('auth/Logout') ?>" class="btn btn-default pull-right" type="submit">Sair</a>
                    </div>
                  </div>
                </div>
            </li>
       </ul>
    </div>
  </header>
  <div class="shadow"></div>
  <!-- Fim Cabeçalho -->
  <!-- Início Breadcrumb -->
  <div class="content-subheader">
        <div id="breadcrumb" class="bread pull-left">
            
        </div> 
        <div id="contentSubheaderRight" class="pull-right">
        	
        </div>
    </div>
  <!-- Início Conteúdo -->
  <div class="content">
  	<?php $this->load->view($view); ?>
  </div>
  
    <!-- Modal Messages-->
    <div class="modal fade" id="messages" tabindex="-1" role="dialog" aria-labelledby="Messages">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Messages Flow</h3>
          </div>
          <div class="modal-body" id="modalMessages">
            <div class="loading">
              <div class="cp-loading">
                <div class="l-sim"></div>
                <p>Data loading...</p>
              </div>
            </div>
            <div class="content-chat"></div>
          </div>
          <div class="modal-footer">
            <div class="row">
                <div class="col-xs-10">
                    <textarea id="txtAreaMessageDriver" class="form-control" rows="2" placeholder="You Message" autofocus></textarea>
                </div>
                <div class="col-xs-2">
                    <button id="btnSendMessage" type="submit" class="btn btn-primary btn-block" style="height: 54px;">Send</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- Fim Conteúdo -->
  </body>
</html>
