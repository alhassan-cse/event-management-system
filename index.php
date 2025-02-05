
<?php
session_start();
include('connect/Connect.php');
include('app/HomeController.php');
include('app/EventController.php');
include('app/UserController.php');
include('app/Authentication.php');
include('app/SettingController.php');

$apps = new HomeController;
$event = new EventController;
$authentication = new Authentication;
$user = new UserController;
$setting = new SettingController;

 
 
if(isset($_GET['status'])){ 
    $authentication->logout($user_type = 2);
}
$statusArr = [0=>'Inactive', 1=>'Active'];
$sql = "SELECT * FROM settings";
$settingResult = $setting->settingDisplay($sql);
 
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content>
        <meta name="author" content>
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
        <title>Home | <?php echo ($settingResult[0]['app_name']) ? $settingResult[0]['app_name'] : ''?></title> 
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/offcanvas.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">
        <link href="assets/css/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- <link href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
        <link href="assets/css/responsive.bootstrap4.css" rel="stylesheet">
        <!-- <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap4.css" rel="stylesheet"> -->
    </head> 
    <body class="bg-light">
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Event Management</a>
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <?php
                    if(isset($_SESSION['id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?id=<?php echo $_SESSION['id'];?>">Profile</a>
                    </li>
                    <?php } ?>
                    <?php
                    
                    if(isset($_SESSION['user_type'])) {
                        if($_SESSION['user_type']==1){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Users</a>
                        </li> 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Event</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="events.php">Events</a>
                                <a class="dropdown-item" href="trash.php">Tash Events</a>
                                <a class="dropdown-item" href="setting.php">Setting</a>
                            </div>
                        </li>
                    <?php } } ?>
                </ul>
                <form action="search.php" method="GET" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0 m-2 text-white" type="submit">Search</button>
                </form>
                <div class="d-flex flex-row-reverse">
                    <?php 
                    if(isset($_SESSION['id'])){
                        ?>
                        <a class="btn btn-outline-success my-2 my-sm-0 m-2 text-white" href="javascript:void(0)"><?php echo $_SESSION['name'];?></a>
                        <a class="btn btn-outline-success my-2 my-sm-0 text-white" href="?status=logout&logout=true">Logout</a>
                        <?php
                    }
                    else{
                        ?>
                        <a class="btn btn-success my-2 my-sm-0 m-2 text-white" href="singup.php">Sign up</a>
                        <a class="btn btn-success my-2 my-sm-0 text-white" href="singin.php">Sign in</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </nav>

        <main role="main" class="container">
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
            <?php
            if(isset($page)){
                if($page == 'singin'){
                    include('partials/singin.php');
                }
                elseif($page == 'singup'){
                    include('partials/singup.php'); 
                }
                elseif($page == 'forgot_password'){
                    include('partials/forgot_password.php'); 
                }
                elseif($page == 'new_password'){
                    include('partials/new_password.php'); 
                }
                elseif($page == 'create_event'){
                    include('events/create.php'); 
                }
                elseif($page == 'events'){
                    include('events/index.php'); 
                }
                elseif($page == 'edit'){
                    include('events/edit.php'); 
                }
                elseif($page == 'show'){
                    include('events/show.php'); 
                }
                elseif($page == 'users'){
                    include('users/index.php'); 
                }
                elseif($page == 'create_user'){
                    include('users/create.php'); 
                }
                elseif($page == 'edit_user'){
                    include('users/edit.php'); 
                }
                elseif($page == 'trash'){
                    include('events/trash.php'); 
                }
                elseif($page == 'registration'){
                    include('partials/registration.php'); 
                }
                elseif($page == 'profile'){
                    include('users/profile.php'); 
                }
                elseif($page == 'setting'){
                    include('partials/setting.php'); 
                }
                elseif($page == 'success'){
                    include('partials/success.php'); 
                }
                elseif($page == 'search'){
                    include('partials/search.php'); 
                }
            } 
            else{
                include('content.php'); 
            }
            ?>
        </main>
        
        <footer class="text-muted">
            <div class="container">
                <p class="float-right">
                    <a href="#">Back to top</a>
                </p>
                <p>Powered by <strong><?php echo ($settingResult) ? $settingResult[0]['app_name'] : ''?></strong> | © 2024 All Rights Reserved</p>
                <p>Need help? Contact our support team at <?php echo ($settingResult) ? $settingResult[0]['email'] : ''?>.</p>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript================================================== -->
         
    </body>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/libs/jquery.min.js"></script>
    <script src="assets/libs/popper.min.js"></script>
    <script src="assets/libs/bootstrap.min.js"></script>
    <script src="assets/libs/holder.min.js"></script>
    <script src="assets/js/offcanvas.js"></script>
    <script src="assets/libs/sweetalert.min.js"></script>
    <script src="assets/libs/jsframe.js"></script>
    <script src="assets/js/dataTables.js"></script>
    <script src="assets/js/dataTables.bootstrap4.js"></script>
    <!-- <script src="assets/js/dataTables.responsive.js"></script> -->
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <!-- <script src="assets/js/responsive.bootstrap4.js"></script> -->
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap4.js"></script>
    
    <script src="assets/js/validation.js"></script>

    <script>
        new DataTable('#example', {
            responsive: true,
            // aaSorting: [[ 0, "desc" ]]
        });

        $(document).on("click", ".url_action_click",function(event) {
        // function removeEvent(val){
            var url =  $(this).attr("data-url");
            // alert(url);
            event.preventDefault();
            swal({
                title: `Are you sure you want to update this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                const jsFrame = new JSFrame();
                if (willDelete) {
                    $.post(url, 
                    function(data) {
                        if(data.class=='success'){ 
                            jsFrame.showToast({
                                html: data.message, align: 'bottom', duration: 2000
                            });
                            // if ($.fn.DataTable.isDataTable('.data-table')) {
                            //     $('.data-table').DataTable().ajax.reload();
                            // } else {
                            //     console.error("DataTable is not initialized yet.");
                            // }
                            setInterval(function() {
                                location.reload();
                            }, 2000); 
                        }
                        else{ 
                            jsFrame.showToast({
                                html: data.message, align: 'bottom', duration: 2000
                            });
                        }
                    });
                }
                else{
                    jsFrame.showToast({
                        html: 'Changes have not been saved', align: 'bottom', duration: 2000
                    });
                }
            });
        });

    </script>
 
</html>
