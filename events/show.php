<?php
 
$statusArr = ['1'=>'open', '0'=>'close'];
$classArr = ['1'=>'success', '0'=>'danger'];
$sql = "SELECT * FROM events ";
$event = $apps->singleDisplay($sql, $_GET['id']);
   
    ?>
<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
        <h6 class="mb-0 text-white lh-100">Event</h6>
    </div>
</div>

<div class="jumbotron">
    <div class="d-flex flex-row-reverse bd-highlight">
        <p class="badge badge-<?php echo $classArr[$event[0]['status']];?>"><?php echo $statusArr[$event[0]['status']];?></p>
    </div>
    <h4 class="display-5"><?php echo $event[0]['name'];?></h4>
    <p class="lead"><?php echo $event[0]['description'];?></p>
    <hr class="my-4">
    <p>Maximum Capacity: <?php echo $event[0]['maximum_capacity'];?></p>
    <p>Venue: <?php echo $event[0]['venue'];?></p>
    <p>Expire Date: <?php echo $event[0]['expire_date'];?></p> 
    <a class="btn btn-primary btn-sm" href="registration.php?id=<?php echo $event[0]['id']?>">Registration</a>
</div>