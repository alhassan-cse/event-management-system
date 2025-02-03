
<?php
// session_start();
$userid = $_GET['userid'];
if(isset($_POST['form'])){
    $message  = $authentication->updatePassword($_POST);
} 
?>
<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
        <h6 class="mb-0 text-white lh-100">New Password</h6>
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
        <form action="" method="POST" id="newPassowrdForm">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                    <i id="inputPassword-Error" class="text-danger"></i>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
                    <i id="inputConfirmPassword-Error" class="text-danger"></i>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $userid;?>">
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" name="form" class="btn btn-primary" id="newPassowrd">Submit</button>
                </div>
            </div>
            <div class="text-center p-t-115"> <span class="txt1"> Login? </span> <a class="txt2" href="singin.php"> Sign In </a> </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    //  new passowrd validation
    $("#newPassowrd").on('click', function(event)
    {
        // alert(44);
        // event.preventDefault();
        let inputPassword = $('#inputPassword').val();
        let inputConfirmPassword = $('#inputConfirmPassword').val(); 
  
        if(inputPassword == ""){
            $('#inputPassword-Error').html('Password is required.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }

        if(inputPassword.length < 6){
            $('#inputPassword-Error').html('Password must be at least 6 characters.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }
        
        if(inputConfirmPassword == ""){
            $('#inputConfirmPassword-Error').html('Confirm password is required.');
            return false;
        }else{
            $('#inputConfirmPassword-Error').html('');
        }

        if(inputPassword != inputConfirmPassword){
            $('#inputConfirmPassword-Error').html('Password don\'t match.');
            return false;
        }else{
            $('#inputConfirmPassword-Error').html('');
        }
 
         $("#newPassowrdForm").submit(); 
    });
</script>