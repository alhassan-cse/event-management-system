<?php
// session_start();
 
if(isset($_POST['form'])){
    $message  = $event->eventStore($_POST);
}

if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1){
    ?>
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Create Event</h6>
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

            <form action="" method="POST" id="createEventForm">
                <div class="card-body">
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php if($_POST){ echo $_POST['name'];}?>">
                            <i id="inputName-Error" class="text-danger"></i>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputmaximumCapacity">Maximum Capacity</label>
                            <input type="number" name="maximum_capacity" class="form-control" id="inputmaximumCapacity" placeholder="Maximum Capacity" value="<?php if($_POST){ echo $_POST['maximum_capacity'];}?>">
                            <i id="inputmaximumCapacity-Error" class="text-danger"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Description</label>
                        <textarea type="text" name="description" rows="4" cols="50" class="form-control" id="inputDescription" placeholder="Description" value="<?php if($_POST){ echo $_POST['description'];}?>"></textarea>
                        <i id="inputDescription-Error" class="text-danger"></i>
                    </div>
                    <div class="form-group">
                        <label for="inputVenue">Venue</label>
                        <textarea type="text" name="venue" class="form-control" id="inputVenue" placeholder="Venue"><?php if($_POST){ echo $_POST['venue'];}?></textarea>
                        <i id="inputVenue-Error" class="text-danger"></i>
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputexpireDate">Expire Date</label>
                            <input type="date" name="expire_date" class="form-control" id="inputexpireDate" placeholder="Expire Date" value="<?php if($_POST){ echo $_POST['expire_date'];}?>">
                            <i id="inputexpireDate-Error" class="text-danger"></i>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputStatus">Status</label>
                            <select class="form-control" id="inputStatus" name="status">
                                <option value="1">Open</option>
                                <option value="0">Close</option>
                            </select>
                        </div>
                    </div> 
                    <button type="submit" name="form" class="btn btn-primary" id="createEvent">Save</button>
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