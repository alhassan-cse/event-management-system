<?php

if(isset($_GET['search'])){ 
    // print_r($_GET['search']);LIKE '123%'
    $search = $_GET['search'];
    $searchStr = $apps->RemoveSpecialChar($search); 
    $date =  date("Y-m-d");
    $sql = "SELECT * FROM events WHERE `name` LIKE '%$searchStr%' AND `status` = 1 AND `expire_date` >= '$date' AND `deleted_at` IS NULL ORDER BY `id` DESC";
    $events = $apps->multipuleDisplay($sql);
}  
?>
<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
        <h6 class="mb-0 text-white lh-100">Events</h6>
    </div>
</div>
<?php
if(count($events)>0){?>
<div class="my-3 p-3 bg-white rounded box-shadow"> 
    <div class="row">
        <?php 
        foreach($events as $row){
        ?>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <a href="show.php?id=<?php echo $row['id']?>">
                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=<?php echo $row['name'];?>" alt="<?php echo $row['name'];?>"/>
                </a>
                <div class="card-body">
                    <p class="card-text"><?php echo mb_strimwidth($row['description'], 0, 70, "...");?></p>
                    <div class="row">
                        <div class="col-md-6 offset-md-6 text-right">
                            <a href="registration.php?id=<?php echo $row['id']?>" class="btn btn-primary btn-sm text-white">Registration</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card-footer pt-4 p-2">
                            <ul class="list-inline list-separator small text-body">
                                <li class="list-inline-item text-decoration-none">Maximum Capacity: <?php echo $row['maximum_capacity'];?></li>
                                <li class="list-inline-item text-decoration-none">Expire Date: <?php echo $row['expire_date'];?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
}
else{
    ?>
    <div class="d-flex justify-content-center align-items-center flex-column text-center w-100 vh-100">
        <div class="p-4 shadow-lg bg-white rounded">
            <h1 class="display-4 text-danger">Oops! No More Event</h1> 
            <a href="index.php" class="btn btn-success px-4 py-2 mt-3 rounded-pill">Go to Home</a>
        </div>
    </div>
    <?php
}
?>