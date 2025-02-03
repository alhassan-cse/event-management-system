<?php
if(isset($_POST['form'])){
    $message  = $user->updateProfile($_POST);
}
?>
<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
        <h6 class="mb-0 text-white lh-100">Profile</h6>
    </div>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
    <div class="card-body">
       <?php
        if(isset($message['class'])){
            ?>
            <div class="alert alert-<?php echo $message['class'];?> alert-dismissible fade show" role="alert">
                 </strong> <?php echo $message['message'];?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?> 
         <form action="" method="POST">
            <div class="card-body">
                <div class="form-row row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php echo $_SESSION['name'];?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $_SESSION['email'];?>">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group col-md-6">
                        <label for="inputPhone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Phone" value="<?php echo $_SESSION['phone'];?>">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group col-md-6">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputConfirmPassword">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
                    </div>
                </div>
                <button type="submit" name="form" class="btn btn-primary">Update</button>
            </div>
        </form> 
    </div>
</div>