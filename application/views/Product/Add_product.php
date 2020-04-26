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
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Product Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm hindi" name="PD_Name" id="PD_Name" placeholder="Enter Product Name" required>
                                            </div>						
                                            <div class="col-md-6 mb-3">
                                                <label>Product Rate <span class="text-danger">*</span></label>
                                                <input type="number" min="0" step="0.01" class="form-control form-control-sm" name="PD_Rate" id="PD_Rate" placeholder="Enter Product Rate" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Product Size</label>
                                                <input type="text" class="form-control form-control-sm" id="PD_Size" name="PD_Size" placeholder="Enter Product Size">
                                                <span class="help-block m-b-none text-danger"></span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Product Unit <span class="text-danger">*</span></label>
                                                <select class="form-control form-control-sm chosen-select" data-placeholder="Choose a Product Unit..." name="U_ID" id="U_ID" required>
                                                    <option value="" disabled selected></option>
                                                    <?php 
                                                    if(is_array($unit)){
                                                        foreach($unit as $unit){
                                                    ?>
                                                    <option value="<?= $unit['unitId']; ?>"><?= $unit['unitName']; ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label>Product Specification</label>
                                                <input type="text" class="summernote hindi" name="PD_Specification" id="PD_Specification">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm float-right">
                                                <button class="btn btn-primary float-right dim" type="submit">Add</button>
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
                /*
		var	PD_category_arr = [];
		$.get("<?= base_url('Products/get_category'); ?>", function(data, status){
			data = JSON.parse(data);
			$.each(data, function(key,value) {
				PD_category_arr.push(value);
			});
			$('.PD_category_name').typeahead({
				source: PD_category_arr
			});
		});
		*/
            });

            $("#form").submit(function(event){
                event.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Do you want to add this product?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, add it!",
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
                            url: "<?= base_url('Product/form_submit'); ?>",
                            data: formData,
                            async: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log(response);
                                res = JSON.parse(response);
                                if(res.status == 'success'){
                                    swal({
                                        title: "Save!",
                                        text: res.msg,
                                        type: "success",
                                        timer: 500,
                                        showConfirmButton: false
                                    }, function(){
                                        window.location = "<?= base_url('Product'); ?>";
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