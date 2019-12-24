<!DOCTYPE html>
<html>
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
                                    <a href="<?= base_url('Customer/Add'); ?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Add Customer</a>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables" >
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile No</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(is_array($customers)){
                                                    $counter = 0;
                                                    foreach($customers as $row){
                                                ?>
                                                <tr>
                                                    <td><?= ++$counter; ?></td>
                                                    <td><?= $row['partyName']; ?></td>
                                                    <td><?= $row['phone']; ?></td>
                                                    <td><?= $row['email']; ?></td>
                                                    <td>				
                                                        <a href="<?= base_url('Customer/Edit/'.$row['partyId']); ?>" data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a href="#" onclick="doaction('Customer','Delete', <?= $row['partyId']; ?>)" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                </div>
                <!-- footer -->
                <?php $this->load->view('includes/footer'); ?>
            </div>
        </div>
        <?php $this->load->view('includes/bot-footer'); ?>
    </body>
</html>