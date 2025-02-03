<?php
// session_start();
 
if(isset($_POST['form'])){
    $message  = $authentication->userUpdate($_POST);
} 

$sql = "SELECT * FROM users ";
$user = $apps->singleDisplay($sql, $_GET['id'],); 
if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1){
    ?>
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Edit User</h6>
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

            <form action="" method="POST" id="createUserForm">
                <div class="card-body">
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php if($user[0]['name']){ echo $user[0]['name'];}?>">
                            <i id="inputName-Error" class="text-danger"></i>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php if($user){ echo $user[0]['email'];}?>">
                            <i id="inputEmail-Error" class="text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-12">
                            <label for="inputPhone">Phone</label>
                            <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Phone" value="<?php if($user){ echo $user[0]['phone'];}?>">
                            <i id="inputPhone-Error" class="text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputPasswords">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPasswords" placeholder="Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputConfirmPasswords">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="inputConfirmPasswords" placeholder="Confirm Password">
                        </div>
                    </div> 
                    <div class="form-row row"> 
                        <div class="form-group col-md-6">
                            <label for="inputType">User Type</label>
                            <select class="form-control" id="inputType" name="user_type">
                                <option <?php echo ($user[0]['user_type'] == 1) ? 'selected' : ''; ?> value="1">Admin</option>
                                <option <?php echo ($user[0]['user_type'] == 2) ? 'selected' : ''; ?> value="2">Customer</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputStatus">Status</label>
                            <select class="form-control" id="inputStatus" name="status">
                                <option <?php echo ($user[0]['status'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                <option <?php echo ($user[0]['status'] == 0) ? 'selected' : ''; ?> value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo base64_encode($user[0]['id'])?>">
                    <button type="submit" name="form" class="btn btn-primary" id="createUser">Save</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
else{
    ?>
    <div class="d-flex justify-content-center align-items-center flex-column text-center w-100 vh-100 pt-4 mb-4">
        <div class="p-4 shadow-lg bg-white rounded">
            <h1 class="display-4 text-danger">Oops! Looks Like You're Lost</h1>
            <p class="lead text-muted">The page you are looking for not available.</p> 
            <a href="index.php" class="btn btn-success px-4 py-2 mt-3 rounded-pill">Go to Home</a>
        </div>
    </div>
    <?php
}
?>