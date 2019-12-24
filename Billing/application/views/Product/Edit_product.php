<!DOCTYPE html>
<html>
    <?php
    // print_r1($product);
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
                                        <input type="hidden" id="PD_ID" name="PD_ID" value="<?= $product->productId; ?>">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Product Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm hindi" name="PD_Name" id="PD_Name" placeholder="Enter Product Name" value="<?= $product->productName; ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Product Rate <span class="text-danger">*</span></label>
                                                <input type="number" min="0" step="0.01" class="form-control form-control-sm" name="PD_Rate" id="PD_Rate" placeholder="Enter Product Rate" value="<?= $product->productRate; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Product Size</label>
                                                <input type="text" min="0" step="0.01" class="form-control form-control-sm" name="PD_Size" id="PD_Size" value="<?= $product->size; ?>" placeholder="Enter Product Size">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Product Unit <span class="text-danger">*</span></label>
                                                <select class="form-control form-control-sm chosen-select" data-placeholder="Choose a Product Unit..." name="U_ID" id="U_ID" required>
                                                    <option></option>
                                                    <?php 
                                                    if(is_array($unit)){
                                                        foreach($unit as $unit){
                                                    ?>
                                                    <option value="<?= $unit['unitId']; ?>" <?= ($unit['unitId'] == $product->unitId ? 'selected' : ''); ?>><?= $unit['unitName']; ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label>Product Specification</label>
                                                <input type="hidden" value="<?php echo htmlentities($product->description);?>" id="PD_Specification1"/> 
                                                <input type="text" class="summernote" name="PD_Specification" id="PD_Specification">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm float-right">
                                                <button class="btn btn-primary float-right dim" type="submit">Update</button>
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
            $(document).ready(function(){
                var PD_Specification = $('#PD_Specification1').val();
                $('#PD_Specification').summernote("code", PD_Specification);
            });

            $("#form").submit(function(event){
                event.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Do you want to update this product?",
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
                        var PD_Specification = $('#PD_Specification').summernote('code');
                        formData.append('PD_Specification',PD_Specification);					
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Product/update_submit'); ?>",
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
                                        window.location = "<?= base_url('Product'); ?>";
                                    });
                                    else {
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