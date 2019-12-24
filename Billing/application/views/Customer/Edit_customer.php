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
                                        <input type="hidden" id="C_ID" name="C_ID" value="<?= $customers->partyId; ?>">
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>Customer Name <span class="text-danger">*</span></label>
                                                <input value="<?= $customers->partyName; ?>" type="text" class="form-control form-control-sm hindi" id="C_Name" name="C_Name" placeholder="Enter Customer Name" required>
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>Mobile No.</label>
                                                <input value="<?= $customers->phone; ?>" type="number"  class="form-control form-control-sm" id="C_MobileNo" name="C_MobileNo" placeholder="Enter Mobile Number">
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>Email</label>
                                                <input value="<?= $customers->email; ?>" type="email" class="form-control form-control-sm" id="C_Email" name="C_Email" placeholder="Enter Email">
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>City</label>
                                                <input type="text" name="OD_City" value="<?= $customers->city; ?>" class="form-control form-control-sm" placeholder="Enter City">
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md">
                                                <label>Address</label>
                                                <textarea class="form-control" id="C_Address" name="C_Address" placeholder="Enter Address" ><?= $customers->address; ?></textarea>
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm float-right">
                                                <button type="submit" class="ladda-button btn btn-primary float-right no-margin" data-style="expand-right">Update</button>
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
                event.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Do you want to update the Customer details?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, update it!",
                    cancelButtonText: "Cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm){		
                        var formData = new FormData($('#form')[0]);				
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Customer/update_submit'); ?>",
                            data: formData,
                            async: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log(response);
                                res = JSON.parse(response);
                                if(res.status == 'success'){
                                    swal({
                                        title: "Updated!",
                                        text: res.msg,
                                        type: "success",
                                        timer: 500,
                                        showConfirmButton: false
                                    }, function(){
                                        window.location = "<?= base_url('Customer'); ?>";
                                    });
                                } else {
                                    swal("Error!", res.msg, "error");
                                }
                            },
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