<!DOCTYPE html>
<html>
    <?php
    $counter = 0;
    ?>
    <head>
        <title><?= $global_data['page_title'].' | '.$global_data['company_name']; ?></title>
        <?php $this->load->view('includes/top-header'); ?>
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view('includes/left-menu'); ?>
            <div id="page-wrapper" class="gray-bg">
                <?php $this->load->view('includes/top-navbar'); ?>
                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $global_data['page_title']; ?></h5>
                                    <a href="<?= base_url('Product/Add'); ?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Add Product</a>
                                </div>
                                <div class="ibox-content table-responsive">
                                    <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
                                    <table class="table table-striped table-hover footable table-pad-min" data-page-size="8" data-filter=#filter>
                                        <thead>
                                            <tr>
                                                <th data-toggle="true">S.No.</th>
                                                <th>Product Name</th>
                                                <th>Product Rate</th>
                                                <th>Product Size</th>
                                                <th data-hide="all">Specifications</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(is_array($products)){
                                                foreach($products as $product){
                                            ?>
                                            <tr>
                                                <td><?= ++$counter; ?></td>
                                                <td><?= $product['productName']; ?></td>
                                                <td><?= number_format($product['productRate'],2); ?></td>
                                                <td><?= $product['size']; ?></td>
                                                <td><?= $product['description']; ?></td>
                                                <td><?= ($product['isActive'] == 1 ? '<span class="label label-primary">Active</span>' : '<span class="label label-warning">Inactive</span>'); ?></td>
                                                <td>
                                                    <a href="<?= base_url('Product/Edit/'.$product['productId']); ?>" data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                                                    <?php if($product['isActive'] == 1){ ?>
                                                    <a href="#" onclick="doaction('Product','Disable', <?= $product['productId']; ?>)" data-toggle="tooltip" data-placement="top" data-original-title="Disable" class="btn btn-warning btn-xs"><i class="fa fa-toggle-on"></i></a>
                                                    <?php } else { ?>
                                                    <a href="#" onclick="doaction('Product','Enable', <?= $product['productId']; ?>)" data-toggle="tooltip" data-placement="top" data-original-title="Enable" class="btn btn-warning btn-xs"><i class="fa fa-toggle-off"></i></a>
                                                    <?php } ?>
                                                    <a href="#" onclick="doaction('Product','Delete', <?= $product['productId']; ?>)" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer -->
                <?php $this->load->view('includes/footer'); ?>
            </div>
        </div>
        <?php $this->load->view('includes/bot-footer'); ?>
    </body>
</html>