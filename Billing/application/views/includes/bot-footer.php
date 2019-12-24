<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>		
<!-- Mainly scripts -->

<script type="text/javascript" src="<?= base_url('/public/js/pramukhime.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('/public/js/pramukhindic.js'); ?>"></script>
<script src="<?= base_url('/public/js/jquery-3.1.1.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/trans.js'); ?>"></script>
<script src="<?= base_url('/public/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?= base_url('/public/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- Custom and plugin javascript -->
<script src="<?= base_url('/public/js/inspinia.js'); ?>"></script>
<script src="<?= base_url('/public/js/plugins/pace/pace.min.js'); ?>"></script>
<!-- Ladda -->
<script src="<?= base_url('/public/js/plugins/ladda/spin.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/plugins/ladda/ladda.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/plugins/ladda/ladda.jquery.min.js'); ?>"></script>
<!-- iCheck -->
<script src="<?= base_url('/public/js/plugins/iCheck/icheck.min.js'); ?>"></script>
<!-- Data picker -->
<script src="<?= base_url('/public/js/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('/public/js/plugins/select2/select2.full.min.js'); ?>"></script>
<!-- Chosen -->
<script src="<?= base_url('/public/js/plugins/chosen/chosen.jquery.js'); ?>"></script>
<!-- Switchery -->
<script src="<?= base_url('/public/js/plugins/switchery/switchery.js'); ?>"></script>
<!-- Sweet alert -->
<script src="<?= base_url('/public/js/plugins/sweetalert/sweetalert.min.js'); ?>"></script>
<!-- DATATABLES -->
<script src="<?= base_url('/public/js/plugins/dataTables/datatables.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/plugins/dataTables/dataTables.bootstrap4.min.js'); ?>"></script>
<!-- SUMMERNOTE -->
<script src="<?= base_url('/public/js/plugins/summernote/summernote-bs4.js'); ?>"></script>
<!-- FOOTABLES -->
<script src="<?= base_url('/public/js/plugins/footable/footable.all.min.js'); ?>"></script>
<!-- Input Mask-->
<script src="<?= base_url('/public/js/plugins/jasny/jasny-bootstrap.min.js'); ?>"></script>
<!-- Tags Input -->
<script src="<?= base_url('/public/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js'); ?>"></script>
<!-- Typehead -->
<script src="<?= base_url('/public/js/plugins/typehead/bootstrap3-typeahead.min.js'); ?>"></script>
<!-- Toastr script -->
<script src="<?= base_url('/public/js/plugins/toastr/toastr.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/inspinia-custom.js'); ?>"></script>

<script>
    var pi_kb = new PramukhIndic(); 
    pramukhIME.addKeyboard(pi_kb); // Adds as an object
    $('.hindi').on('focusout', function(event){
        pramukhIME.setLanguage('english', 'pramukhime');
    });

    $('.hindi').on('focus', function(event){
        pramukhIME.addKeyboard(PramukhIndic, 'hindi');
    });
    var currentLang = pramukhIME.getLanguage();
    var settings = pramukhIME.getSettings(currentLang);
    settings[0].digitInEnglish = true;
    pramukhIME.setSettings(settings);
    var language =true;
    function doc_keyUp(e) {
        // this would test for whichever key is 40 and the ctrl key at the same time
        if (e.altKey && e.keyCode == 72 && language==true) {
            // sets laguage to hindi
            pramukhIME.enable();
            language =false;
            toast('Hindi');
        }else if (e.altKey && e.keyCode == 72 && language== false) {
            // sets laguage to hindi
            pramukhIME.disable();
            language =true;
            toast('English');
        }
    }

    function toast(text){
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            preventDuplicates: false,
            preventOpenDuplicates: false,
            timeOut: 4000
        };
        toastr.info('Your Language is Chaneged to '+text,'Congratulation!');

    }
    document.addEventListener('keyup', doc_keyUp, false);
    $(document).ready(function(){
        $('.footable').footable();
        $('.summernote').summernote({height : 250});
        Ladda.bind( '.ladda-button',{ timeout: 2000 });
        $('.dataTables').DataTable({
            pageLength: 50,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel'},
                {extend: 'pdf'},
                {extend: 'print',
                 customize: function (win){
                     $(win.document.body).addClass('white-bg');
                     $(win.document.body).css('font-size', '10px');
                     $(win.document.body).find('table')
                         .addClass('compact')
                         .css('font-size', 'inherit');
                 }
                }
            ]
        });
        $('.maxdate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format : 'dd-mm-yyyy',
            endDate: new Date()
        });
        $('.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format : 'dd-mm-yyyy'
        });
        $('.year').datepicker({
            minViewMode: 2,
            format : 'yyyy'
        });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
        $('.chosen-select').chosen({width: "100%"});
        $(".select2").select2({
            placeholder: "-Select-",
            allowClear: true
        });
        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });
    });
    function doaction(page_type,action,id){
        console.log(page_type,action,id);
        swal({
            title: action+' this '+page_type+'?',
            text: "Are you sure? Do you want to perform this action?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#ec4758',
            confirmButtonText: action,
            closeOnConfirm: false
        },
             function( confirmed ) {
            if( confirmed ){
                $.post('<?= base_url('Action/form_submit'); ?>',{'id':id, 'page_type':page_type, 'action':action},function(res){
                    console.log(res);
                    data = JSON.parse(res);
                    if(data.status == 'success'){
                        swal({
                            title: action,
                            text: page_type+' '+action+' successfully.',
                            showCancelButton: false,
                            type : 'success',
                            confirmButtonColor: '#8CD4F5',
                            confirmButtonText: 'Ok',
                            closeOnConfirm: false
                        },
                             function( confirmed ) {
                            if( confirmed ){
                                window.location.reload();
                                return true;
                            }
                        });
                    } else {
                        swal("", res , "");
                        return false;
                    }
                });
            }
        });
    }
</script>