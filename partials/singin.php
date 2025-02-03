
<?php
// session_start();

if(isset($_POST['form'])){
    $message  = $authentication->singIn($_POST);
} 
?>
<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
        <h6 class="mb-0 text-white lh-100">Sing In</h6>
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
        <form action="" method="POST" id="singInForm">
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email"  value="<?php if($_POST){ echo $_POST['email'];}?>">
                    <i id="inputEmail-Error" class="text-danger"></i>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                    <i id="inputPassword-Error" class="text-danger"></i>
                </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-12 text-right"> 
                    <a href="forgot_password.php" class="forget_password">Forgot Password</a>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" name="form" class="btn btn-primary" id="singIn">Sign in</button>
                </div>
            </div>
            <div class="text-center p-t-115"> <span class="txt1"> Don&rsquo;t have an account? </span> <a class="txt2" href="singup.php"> Sign Up </a> </div>
        </form>
    </div>
</div>