<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-responsive img-square" src="<?= base_url('/public/img/daLogo.png'); ?>" width="75px"/>
                    </span>
                </div>
                <div class="logo-element">
                    <img alt="image" class="img-responsive img-square" src="<?= base_url('/public/img/daLogo.png'); ?>" width="50px" />
                </div>
            </li>
            <li class="<?= active_link_function('Invoice/index'); ?>">
                <a href="<?= base_url('index.php'); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Add Invoice</span></a>
            </li>
            <li class="<?= active_link_controller('Customer'); ?> <?= active_link_controller('Unit'); ?> <?= active_link_controller('Product'); ?>">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Master</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?= active_link_controller('Customer'); ?>"><a href="<?= base_url('Customer'); ?>">Customer</a></li>
                    <li class="<?= active_link_controller('Product'); ?> "><a href="<?= base_url('Product'); ?>">Products</a></li>
                    <li class="<?= active_link_controller('Unit'); ?>"><a href="<?= base_url('Unit'); ?>">Units</a></li>
                </ul>
            </li>
            <li class="<?= active_link_function('Invoice/View_List'); ?><?= active_link_function('Invoice/Edit/:id'); ?>">
                <a href="<?= base_url('Invoice/View_List'); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Saved Invoice</span></a>
            </li>
        </ul>
    </div>
</nav>