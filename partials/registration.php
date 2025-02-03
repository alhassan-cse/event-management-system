<?php
// session_start(); #157F77
 
if(isset($_POST['form'])){
    $message  = $event->eventApply($_POST);
}

$sql = "SELECT * FROM events ";
$event  = $apps->singleDisplay($sql, $_GET['id'],);
// print_r($event);
?>
<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
        <h6 class="mb-0 text-white lh-100">Registration Event</h6>
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
         <form action="" method="POST" id="registrationEventForm">
            <div class="bd-callout bd-callout-info">
                <a href="https://www.w3.org/TR/mediaqueries-4/#range-context">Event Name: <?php echo $event[0]['name']; ?></a>
            </div>
            <input type="hidden" name="event_id" id="event_id" value="<?php echo $event[0]['id']; ?>">
            <div class="card-body">
            <?php 
             if(isset($_SESSION['id'])){?> 
                <p>Name: <?php echo $_SESSION['name'];?></p>
                <p>Email: <?php echo $_SESSION['email'];?></p>
                <p>Phone: <?php echo $_SESSION['phone'];?></p> 
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>"> 
                <button type="submit" name="form" class="btn btn-primary">Submit</button>
                <?php
            }
            else{
                ?>
                <div class="form-row row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php if($_POST){ echo $_POST['name'];}?>">
                        <i id="inputName-Error" class="text-danger"></i>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php if($_POST){ echo $_POST['email'];}?>">
                        <i id="inputEmail-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group col-md-6">
                        <label for="inputPhone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Phone" value="<?php if($_POST){ echo $_POST['phone'];}?>">
                        <i id="inputPhone-Error" class="text-danger"></i>
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                        <i id="inputPassword-Error" class="text-danger"></i>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputConfirmPassword">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
                        <i id="inputConfirmPassword-Error" class="text-danger"></i>
                    </div>
                </div>
                <button type="submit" name="form" class="btn btn-primary" id="registrationEvent">Submit</button>
                <?php
            }
            ?> 
            </div>
        </form> 
    </div>
</div>