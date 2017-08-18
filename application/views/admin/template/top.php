<nav id="main-navigasi" class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="<?= base_url('deadmin'); ?>"><?php echo ($this->session->userdata()['user'])? $this->session->userdata()['user']['admin_username'] : "DEV"; ?></a> </div>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i> </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?= base_url('admin/user'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a> </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> </li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url('admin/login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
            </ul>
        </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li> <a href="javascript:;"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a> </li>

                <?php 
                    foreach($this->session->userdata()['user']['access_menu'] as $row => $value ) {
                        if(isset($value['child'])){
                ?>
                            <li> <a href="#"><i class="fa fa-cog fa-fw"></i> <?= $value['section_name'] ?><span class="fa arrow"></span></a>
                            <?php 
                                if(!empty($value['child'])) {
                            ?>
                                    <ul class="nav nav-second-level">
                                    <?php 
                                        foreach($value['child'] as $row_child => $value_child) {
                                    ?>
                                            <li> <a href="<?php echo base_url(), 'admin/' .strtolower($value_child['section_name']); ?>"><?= $value_child['section_name']; ?></a> </li>
                                    <?php
                                        }
                                    ?>
                                    </ul>
                            <?php 
                                }
                            ?>
                            </li>
                <?php 
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>