<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="#">
                    <img src="<?php echo base_url(); ?>vendors/images/logo.png" alt="" width="60%" />
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">

                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To Intranet</h2>
                        </div>

                        <form method="POST" action="<?php echo base_url('C_Login'); ?>">
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" id="username_login" name="username_login" placeholder="Username" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <?php echo form_error('username_login', '<div class="text-small text-danger"></div>') ?>

                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" id="password_login" name="password_login" placeholder="Password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <?php echo form_error('password_login', '<div class="text-small text-danger"></div>') ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>