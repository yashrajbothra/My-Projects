<!DOCTYPE html>
<html>
    <head>
        <title><?= $global_data['page_title'].' | '.$global_data['company_name']; ?></title>
        <?php $this->load->view('includes/top-header'); ?>
    </head>

    <body class="gray-bg">
        <div class="loginColumns animated fadeInDown">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="font-bold">Welcome to DA Billing</h2>
                    <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p><small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small></p>
                </div>
                <div class="col-md-6">
                    <div class="ibox-content">
                        <form class="m-t" role="form" id="login_form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username or Mobile No" name="username" required="">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" required="">
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        </form>
                        <?php /*
                    <p class="m-t">
                        <small>Nova Stock Management &copy; 2018</small>
                    </p>
					*/ ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-6">
                    ©DreamAnimators
                </div>
                <div class="col-md-6 text-right">
                    <small>© 2019</small>
                </div>
            </div>
        </div>
        <?php $this->load->view('includes/bot-footer'); ?>
        <script>
            $('#login_form').submit(function(even){
                even.preventDefault();
                var l = $( '.ladda-button-demo' ).ladda();
                l.ladda( 'start' );
                $('#login_msg').html('');
                $.post('<?= base_url('Auth/login_submit'); ?>',$('#login_form').serialize(),function(res){
                    console.log(res);
                    res = JSON.parse(res);
                    if(res.status == 'success'){
                            l.ladda('stop');
                            window.location = "<?= base_url('Invoice'); ?>";
                    } else { 
                        setTimeout(function(){ 
                            l.ladda('stop');
                            $('#login_msg').html(res.msg);
                        }, 1000);
                    }
                });
            });
        </script>
    </body>
</html>