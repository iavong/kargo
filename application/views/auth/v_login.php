<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Login</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/images/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/images/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/images/favicon.ico">


    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="<?= base_url('login'); ?>">
                    <img src="<?= base_url('assets/images/logo/logo2.ico'); ?>" width="150">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <!-- <li><a href="register.html">Register</a></li> -->
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?= base_url(); ?>assets/images/logo/logo2.png" alt="LOGO" class="col-12">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login</h2>
                        </div>

                        <!-- Form login -->
                        <?php echo form_open('login'); ?>

                        <!-- load flash -->
                        <?php $this->load->view('partials/_flash.php'); ?>

                        <div class="input-group custom">
                            <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="**********" required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>
                        <div class="row pb-30">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- <div class="forgot-password"><a href="forgot-password.html">Forgot Password</a></div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                        <!-- penutup form -->


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="<?= base_url('assets/vendors/scripts/core.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/script.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/process.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/scripts/layout-settings.js') ?>"></script>
    <script>
        $('input:text').focus(
            function() {
                $(this).val('');
            });
        $('input:password').focus(
            function() {
                $(this).val('');
            });
    </script>
</body>

</html>