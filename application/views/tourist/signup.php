<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title;?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tourist/css/bootstrap.min.css');?>" >
        <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tourist/css/login.css');?>" >
    </head>
    <div id="particles-js"></div>
    <body class="login">
        <div class="container">
            <div class="signup-container-wrapper clearfix">
                <form action="<?php echo base_url('tourist/add');?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">First Name</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="fname" placeholder="Enter first name" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Last Name</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="lname" placeholder="Enter last name" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Nationality</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nationality" placeholder="Indonesia" required="">
                        </div>
                    </div>

                     <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Date Of Birth</label>
                        </div>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="birthday" placeholder="16/12/1971" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Place Of Birth</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="birth_place" placeholder="Indonesia" required="">
                        </div>
                    </div>

                    <div class="form-group" style="display:none;">
                        <div class="col-md-2">
                            <label for="name">Passport No</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="passport_no" value=" " placeholder="Enter passport number">
                        </div>
                    </div>

                    <div class="form-group" style="display:none;">
                        <div class="col-md-2">
                            <label for="name">Visa No</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="visa_no" value=" " placeholder="Enter visa number">
                        </div>
                    </div>

                    <div class="form-group" style="display:none;">
                        <div class="col-md-2">
                            <label for="name">Passport Validity Expires</label>
                        </div>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="passport_expire" value=" " placeholder="Enter passport validity expires">
                        </div>
                    </div>

                    <div class="form-group" style="display:none;">
                        <div class="col-md-2">
                            <label for="name">Visa Validity Expires</label>
                        </div>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="visa_expire" value=" " placeholder="Enter visa validity expires">
                        </div>
                    </div>

                    <div class="form-group" style="display:none;">
                        <div class="col-md-2">
                            <label for="name">Purpose Of Stay</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="purpose" value=" " placeholder="What's the purpose?">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Username</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="username"placeholder="Username" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label for="name">Password</label>
                        </div>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password" placeholder="Enter your password" required="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2">Image</label>
                        <div class="col-md-10">
                            <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png" id="image-input">
                            <span id="image-error" class="text-danger hidden">only png, jpg & jpeg file types are allowed</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <center><img id="image" class="hidden" width="150" /></center>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Register as Tourist</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="<?php echo base_url('assets/tourist/js/bootstrap.min.js');?>"></script>
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
        <script src="<?php echo base_url('assets/tourist/js/login.js');?>"></script>

    </body>
</html>