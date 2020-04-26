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
                                    <a href="<?= base_url('Unit/Add'); ?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Add Unit</a>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables" >
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Unit Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(is_array($unit)){
                                                    $counter = 0;
                                                    foreach($unit as $row){
                                                ?>
                                                <tr>
                                                    <td><?= ++$counter; ?></td>
                                                    <td><?= $row['unitName']; ?></td>
                                                    <td><?= ($row['isActive'] == 1 ? '<span class="label label-primary">Active</span>' : '<span class="label label-warning">Inactive</span>'); ?></td>
                                                    <td>
                                                        <a href="<?= base_url('Unit/Edit/'.$row['unitId']); ?>" data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="btn btn-success btn-xs no-margins"><i class="fa fa-pencil-square-o"></i></a>
                                                        <?php if($row['isActive'] == 1){ ?>
                                                        <a href="#" onclick="doaction('Unit','Disable', <?= $row['unitId']; ?>)" data-toggle="tooltip" data-placement="top" data-original-title="Disable" class="btn btn-warning btn-xs no-margins"><i class="fa fa-toggle-on"></i></a>
                                                        <?php } else { ?>
                                                        <a href="#" onclick="doaction('Unit','Enable', <?= $row['unitId']; ?>)" data-toggle="tooltip" data-placement="top" data-original-title="Enable" class="btn btn-warning btn-xs no-margins"><i class="fa fa-toggle-off"></i></a>
                                                        <?php } ?>
                                                        <a href="#" onclick="doaction('Unit','Delete', <?= $row['unitId']; ?>)" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="btn btn-danger btn-xs no-margins"><i class="fa fa-trash"></i></a>
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