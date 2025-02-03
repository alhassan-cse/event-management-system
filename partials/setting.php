<?php
if(isset($_POST['form'])){ 
    $message  = $setting->settingUpdate($_POST);
} 

$sql = "SELECT * FROM settings";
$setting = $setting->settingDisplay($sql);

if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type']==1){
    ?>

    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Setting</h6>
        </div>
    </div>
 
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="card-body">
            <?php
            if(isset($message['class'])){
            ?>
                <div class="alert alert-<?php echo $message['class'];?> alert-dismissible fade show" role="alert">
                    <?php echo $message['message'];?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
            } 
            ?>
            <form action="" method="POST">
                <div class="form-group row">
                    <label for="inputAppUrl" class="col-sm-2 col-form-label">App Url</label>
                    <div class="col-sm-10">
                        <input type="url" name="app_url" class="form-control" id="inputAppUrl" placeholder="App Url" value="<?php echo ($_POST) ? $_POST['app_url'] : (($setting) ? $setting[0]['app_url'] : '');?>">
                        <i id="inputName-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputAppName" class="col-sm-2 col-form-label">App Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="app_name" class="form-control" id="inputAppName" placeholder="App Name" value="<?php echo ($_POST) ? $_POST['app_name'] : (($setting) ? $setting[0]['app_name'] : '');?>">
                        <i id="inputName-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo ($_POST) ? $_POST['email'] : (($setting) ? $setting[0]['email'] : '');?>">
                        <i id="inputEmail-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Phone" value="<?php echo ($_POST) ? $_POST['phone'] : (($setting) ? $setting[0]['phone'] : '');?>">
                        <i id="inputPhone-Error" class="text-danger"></i>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputHost" class="col-sm-2 col-form-label">Host</label>
                    <div class="col-sm-10">
                        <input type="text" name="host" class="form-control" id="inputHost" placeholder="Host" value="<?php echo ($_POST) ? $_POST['host'] : (($setting) ? $setting[0]['host'] : '');?>">
                        <i id="inputPhone-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username" value="<?php echo ($_POST) ? $_POST['username'] : (($setting) ? $setting[0]['username'] : '');?>">
                        <i id="inputPhone-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" name="password" class="form-control" id="inputPassword" placeholder="Password" value="<?php echo ($_POST) ? $_POST['password'] : (($setting) ? $setting[0]['password'] : '');?>">
                        <i id="inputPhone-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSMTPSecure" class="col-sm-2 col-form-label">SMTP Secure</label>
                    <div class="col-sm-10">
                        <input type="text" name="smtp_secure" class="form-control" id="inputSMTPSecure" placeholder="SMTP Secure" value="<?php echo ($_POST) ? $_POST['smtp_secure'] : (($setting) ? $setting[0]['smtp_secure'] : '');?>">
                        <i id="inputPhone-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPort" class="col-sm-2 col-form-label">Port</label>
                    <div class="col-sm-10">
                        <input type="text" name="port" class="form-control" id="inputPort" placeholder="Port" value="<?php echo ($_POST) ? $_POST['port'] : (($setting) ? $setting[0]['port'] : '');?>">
                        <i id="inputPhone-Error" class="text-danger"></i>
                    </div>
                </div>
    
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" name="form" class="btn btn-primary">Save</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
    }
    else{
        ?>
        <div class="d-flex justify-content-center align-items-center flex-column text-center w-100 vh-100">
            <div class="p-4 shadow-lg bg-white rounded">
                <h1 class="display-4 text-danger">Oops! Looks Like You're Lost</h1>
                <p class="lead text-muted">The page you are looking for not available.</p> 
                <a href="index.php" class="btn btn-success px-4 py-2 mt-3 rounded-pill">Go to Home</a>
            </div>
        </div>
        <?php
    }
}
?>