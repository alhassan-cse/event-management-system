 

<?php
$statusArr = ['1'=>'open', '0'=>'close'];
$classArr = ['1'=>'success', '0'=>'danger'];
$sql = "SELECT * FROM events WHERE `deleted_at` IS NOT NULL";
$events = $apps->multipuleDisplay($sql);

if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1)
{
    ?>
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Tash Events</h6>
        </div>
    </div>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <table id="example" class="table table-striped table-bordered nowrap data-table" style="width:100%">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Maximum Capacity</th>
                    <th>Expire Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($events as $key=>$row){
                ?>
                <tr id="event_id_<?php echo $key++;?>">
                    <td><?php echo $key++;?></td>
                    <td><a href="show.php?event=<?php echo str_replace(" ", "-", $row['name']);?>&id=<?php echo $row['id']?>" class="text-decoration-none"><?php echo mb_strimwidth($row['name'], 0, 20, "...");?><a></td>
                    <td><?php echo $row['created_date'];?></td>
                    <td class="text-center"><?php echo $row['maximum_capacity'];?></td>
                    <td><?php echo $row['expire_date'];?></td>
                    <td class="text-center"><span class="badge badge-<?php echo $classArr[$row['status']];?>"><?php echo $statusArr[$row['status']];?></span></td>
                    <td>
                        <a href="javascript:void(0)" data-url="restore.php?id=<?php echo $row['id']?>" id="" class="url_action_click">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bootstrap-reboot" viewBox="0 0 16 16">
                            <path d="M1.161 8a6.84 6.84 0 1 0 6.842-6.84.58.58 0 1 1 0-1.16 8 8 0 1 1-6.556 3.412l-.663-.577a.58.58 0 0 1 .227-.997l2.52-.69a.58.58 0 0 1 .728.633l-.332 2.592a.58.58 0 0 1-.956.364l-.643-.56A6.8 6.8 0 0 0 1.16 8z"/>
                            <path d="M6.641 11.671V8.843h1.57l1.498 2.828h1.314L9.377 8.665c.897-.3 1.427-1.106 1.427-2.1 0-1.37-.943-2.246-2.456-2.246H5.5v7.352zm0-3.75V5.277h1.57c.881 0 1.416.499 1.416 1.32 0 .84-.504 1.324-1.386 1.324z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table> 
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