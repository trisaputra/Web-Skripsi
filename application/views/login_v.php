<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login | Aplikasi Emergency Call Kasus Kekerasan Pada Perempuan dan Anak Berbasis Android.</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?= base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= base_url() ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= base_url() ?>assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
        <link rel="shortcut icon" href="<?= base_url() ?>assets/global/img/logo_surabaya.png" /> 
        <style type="text/css">
            .jw-slideshow {
                margin: auto;
                width: 768px;
                height: 2000px;
                background: #000;
                opacity: 0.7;
                color: #fff;
                padding: 26px;
                font-weight: bold;
                font-size: 2em;
            }
            .jw-slideshow h1 {
                text-align: center;
            }
            .jw-slideshow p {
                padding: 100px;
                background: #aaa;
                color: #000;
            }
        </style>
    </head>
    <body class="login" style="background-repeat: no-repeat; background-size: 100% 120%; background-image: url('<?= base_url() ?>assets/global/img/background_1.jpg');">
        <div id="panel">
            <div class="logo" style="margin-top: 10px">
                <center>
                    <img src="<?= base_url() ?>assets/global/img/logo_surabaya.png" style="width: 100px" /><br>
                    <span style="padding-left: 10px; color: black; font-size: 20px; font-weight: bold">Aplikasi Emergency Call<br>Kasus Kekerasan Pada Perempuan dan Anak<br>Berbasis Android</span>
                </center>
            </div>
            <div class="content">
                <form class="login-form" action="#" method="post" id="form-login">
                    <h3 class="form-title" style="text-align: center; color: black"><b>Login</b></h3>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span> Enter any username and password. </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Username</label>
                        <div class="input-icon">
                            <i class="fa fa-user"></i>
                            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username" /> </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <div class="input-icon">
                            <i class="fa fa-lock"></i>
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="passwd" id="passwd" /> </div>
                    </div>
                    <div class="form-actions">
                        <label class="checkbox">
                        </label>
                        <button type="submit" class="btn green pull-right" style="color: black"><i class="fa fa-sign-in"></i> Login </button>
                    </div>
                </form>
            </div>
            <div class="copyright" style="color: black"> 2020 &copy; Aplikasi Emergency Call<br>Kasus Kekerasan Pada Perempuan dan Anak<br>Berbasis Android. </div>
            <br><br>
        </div>
        <script src="<?= base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap-toastr/toastr.min.js"></script> 
        <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function () {
                var Login = function () {
                    var handleLogin = function () {
                        $('#form-login').validate({
                            errorElement: 'span', //default input error message container
                            errorClass: 'help-block', // default input error message class
                            focusInvalid: false, // do not focus the last invalid input
                            rules: {
                                username: {
                                    required: true
                                },
                                password: {
                                    required: true
                                }
                            },
                            messages: {
                                username: {
                                    required: "<b>Username Harus diisi.</b>"
                                },
                                password: {
                                    required: "<b>Password Harus diisi.</b>"
                                }
                            },
                            highlight: function (element) { // hightlight error inputs
                                $(element)
                                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                            },
                            success: function (label) {
                                label.closest('.form-group').removeClass('has-error');
                                label.remove();
                            },
                            errorPlacement: function (error, element) {
                                error.insertAfter(element.closest('.input-icon'));
                            },
                            submitHandler: function (form) {
                                $.blockUI();
                                $.ajax({
                                    method: 'POST',
                                    dataType: 'json',
                                    url: '<?= site_url() ?>login/do_login',
                                    data: $('#form-login').serializeArray(),
                                    success: function (data) {
                                        $.unblockUI();
                                        if (data.success === true) {
                                            window.location.href = "<?= site_url() ?>" + data.page;
                                        } else {
                                            toastr.error("Username atau Password salah")
                                        }
                                    },
                                    fail: function (e) {
                                        $.unblockUI();
                                        toastr.error(e);
                                    }
                                });
                            }
                        });
                    };
                    return {
                        //main function to initiate the module
                        init: function () {
                            handleLogin();
                        }
                    };
                }();
                Login.init();
            });
        </script>
    </body>

</html>
