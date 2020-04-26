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
                                </div>
                                <div class="ibox-content">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form">
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>Customer Name <span class="text-danger">*</span></label>
                                                <input type="hidden" id="LD_Type" name="LD_Type" value="2">
                                                <input type="text" class="form-control form-control-sm hindi" id="LD_Name" name="LD_Name" placeholder="Enter Customer Name" required>
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>Mobile No.</label>
                                                <input type="number" class="form-control form-control-sm" id="LD_MobileNo" name="LD_MobileNo" placeholder="Enter Mobile Number" >
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>Email</label>
                                                <input type="email" class="form-control form-control-sm" id="LD_Email" name="LD_Email" placeholder="Enter Email">
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label for="">City</label>
                                                <input type="text" name="OD_City" class="form-control form-control-sm" placeholder="Enter City">
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>Address</label>
                                                <textarea class="form-control" id="LD_Address" name="LD_Address" placeholder="Enter Address" ></textarea>
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm float-right">
                                                <button type="submit" class="ladda-button btn btn-primary float-right no-margin" data-style="expand-right">Add</button>
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
                    text: "Do you want to add this Customer?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, add it!",
                    cancelButtonText: "Cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm){
                        $.post('<?= base_url('Customer/form_submit'); ?>',$('#form').serialize(),function(response){
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
                                    window.location = "<?= base_url('Customer'); ?>";
                                });
                            }else {
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