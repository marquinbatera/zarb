
    <div class="content-body">
    	<div class="container-fluid">
            <div class="row">
                 <div class="col-lg-2 col-md-3" >
                <ul class="content-menu">
                	<li class="<?=($this->uri->segment(2)=='listServiceProvider' || $this->uri->segment(2)=='newServiceProvider' || $this->uri->segment(2)=='editServiceProvider'?' active':'')?>"><a href="<?php echo base_url('service_provider/listServiceProvider') ?>"><i class="glyphicon glyphicon-menu-right"></i>Service Provider</a></li>
                    <li class="<?=($this->uri->segment(2)=='listCompany' || $this->uri->segment(2)=='newCompany' || $this->uri->segment(2)=='editCompany'?' active':'')?>">
                        <a href="<?php echo base_url('company/listCompany') ?>"><i class="glyphicon glyphicon-menu-right"></i>Companies</a>
                    </li>
                    <li class="<?=($this->uri->segment(2)=='listUser' || $this->uri->segment(2)=='newUser' || $this->uri->segment(2)=='editUser'?' active':'')?>"><a href="<?php echo base_url('user/listUser') ?>"><i class="glyphicon glyphicon-menu-right"></i>Users</a></li>
                    <li class="<?=($this->uri->segment(2)=='listCustomer' || $this->uri->segment(2)=='newCustomer' || $this->uri->segment(2)=='editCustomer'?' active':'')?>"><a href="<?php echo base_url('customer/listCustomer') ?>"><i class="glyphicon glyphicon-menu-right"></i>Customers</a></li>
                </ul>
            </div>
                <div class="col-lg-10 col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        
                        <!-- Início View -->
                            