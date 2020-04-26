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
                        <div class="col-lg-6 offset-3">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $global_data['page_title']; ?></h5>
                                </div>
                                <div class="ibox-content">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form">
                                        <input type="hidden" id="U_ID" name="U_ID" value="<?= $unit->unitId; ?>">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label>Unit <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm hindi" id="U_Name" name="U_Name" placeholder="Enter Unit Name" value="<?= $unit->unitName; ?>" required>
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm float-right">
                                                <button type="submit" class="ladda-button btn btn-primary float-right dim no-margins" data-style="expand-right">Update</button>
                                            </div>
                                        </div>
                                    </form>
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
        <script>
            $("#form").submit(function(event){
                var l = $( '.ladda-button-demo' ).ladda();
                event.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Do you want to update this unit?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, update it!",
                    cancelButtonText: "Cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm){
                        $.post('<?= base_url('Unit/update_submit'); ?>',$('#form').serialize(),function(response){
                            console.log(response);
                            l.ladda('stop');
                            res = JSON.parse(response);
                            res = JSON.parse(response);
                            if(res.status == 'success'){
                                swal({
                                    title: "Updated!",
                                    text: res.msg,
                                    type: "success",
                                    timer: 500,
                                    showConfirmButton: false
                                }, function(){
                                    window.location = "<?= base_url('Unit'); ?>";
                                });
                            } else {
                                swal("Error!", res.msg, "error");
                                $('button[type="submit"]').attr('disabled',false);
                            }
                        });	
                    } else {
                        swal.close();
                        return false;
                    }
                });
            });
        </script>
    </body>
</html>