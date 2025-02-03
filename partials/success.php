<?php
$sql = "SELECT * FROM events ";
$usql = "SELECT * FROM users ";
if(empty($_GET['id']) || empty($_GET['user_id'])){
   header("location: index.php");
}
$event = $apps->singleDisplay($sql, $_GET['id']);

$user = $apps->singleDisplay($usql, $_GET['user_id']);
 
if(isset($_SESSION['success'])){
?>
<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
    <div class="lh-100">
        <h6 class="mb-0 text-white lh-100"><?php echo $_SESSION['success'];?></h6>
    </div>
</div>
<?php
}
?>
 

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <b>Thank You for Registering for <?php echo $event[0]['name'];?>!</b>

        <p>Dear <?php echo $user[0]['name'];?>,</p>

        Thank you for registering for <b><?php echo $event[0]['name'];?></b>! We’re excited to have you join us and can’t wait for you to be a part of this amazing experience.

        Here are the details of your registration:

        
        We’ll send you additional information and reminders as we get closer to the event. In the meantime, feel free to reach out if you have any questions.
        Looking forward to seeing you at the event!
        <br/>
        <br/>
        Event Name: <?php echo $event[0]['name'];?><br/>
        Address: <?php echo $event[0]['venue'];?>
        <br/><br/>

        Best regards,<br/>
        Event Management
        <br/>
       
        <b>Thank You</b>
    </div>
    
</div>