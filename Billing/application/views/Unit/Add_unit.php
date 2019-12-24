<!DOCTYPE html>
<html>
    <?php
    $counter = 0;
    ?>
    <head>
        <title>Add Unit</title>
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
                                    <h5>Add Unit</h5>
                                </div>
                                <div class="ibox-content">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label>Unit <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm hindi" id="U_Name" name="U_Name" placeholder="Enter Unit Name" required>
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm float-right">
                                                <button type="submit" class="ladda-button btn btn-primary float-right dim" data-style="expand-right">Add</button>
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
                    text: "Do you want to add this unit?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, add it!",
                    cancelButtonText: "Cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm){
                        $.post('<?= base_url('Unit/form_submit'); ?>',$('#form').serialize(),function(response){
                            console.log(response);
                            l.ladda('stop');
                            res = JSON.parse(response);
                            if(res.status == 'success'){
                                swal({
                                    title: "Save!",
                                    text: res.msg,
                                    type: "success",
                                    timer: 500,
                                    showConfirmButton: false
                                }, function(){
                                    window.location = "<?= base_url('Unit'); ?>";
                                });
                            }
                            else {
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