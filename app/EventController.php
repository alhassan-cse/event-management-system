<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EventController extends Connect
{
     
    public function eventStore($data)
    {
        if(isset($_SESSION['id']))
        {
            if($_SESSION['id']==1){
                header("location: index.php");
            }
        }

        if ($data["name"] == null){
            return $message = ['class'=>'danger', 'message'=>'Event name is required.'];
        }elseif ($data["maximum_capacity"] == null){
            return $message = ['class'=>'danger', 'message'=>'Maximum Capacity is required.'];
        }elseif ($data["venue"] == null){
            return $message = ['class'=>'danger', 'message'=>'Venue is required.'];
        }elseif ($data["expire_date"] == null){
            return $message = ['class'=>'danger', 'message'=>'Expire date is required.'];
        }

        $name = $data["name"];
        $created_id = $_SESSION['id'];
        $created_date = date("Y-m-d");
        $maximum_capacity = $data["maximum_capacity"];
        $description = $data["description"];
        $venue = $data["venue"];
        $expire_date = $data["expire_date"];
        $status = $data["status"]; 

        $insertSql = "INSERT INTO `events` (`name`, `created_id`, `created_date`, `maximum_capacity`, `description`, `venue`, `expire_date`, `status`) 
        VALUES ('$name', '$created_id', '$created_date', '$maximum_capacity', '$description', '$venue', '$expire_date', '$status')";

        $stmt = $this->pdo->prepare($insertSql);
        $event_result =  $stmt->execute();

        if($event_result > 0)
        {
            $_SESSION['success'] = 'Event create has been successfully.';
            header("location:events.php");
        }
        else{
            return $message = ['class'=>'danger', 'message'=>'Something went wrong.'];
        } 
    }

    public function eventUpdate($data)
    {
        $event_id = base64_decode($data["event_id"]);
        $name = $data["name"];
        $created_id = $_SESSION['id'];
        $created_date = date("Y-m-d");
        $maximum_capacity = $data["maximum_capacity"];
        $description = $data["description"];
        $venue = $data["venue"];
        $expire_date = $data["expire_date"];
        $status = $data["status"];
 
        $updateSql = "UPDATE `events` SET `name` = '$name', `created_id` = '$created_id', `maximum_capacity` = '$maximum_capacity', `description` = '$description', `venue` = '$venue', 
        `expire_date` = '$expire_date', `status` = '$status'  WHERE id = '$event_id'"; 
        $result = $this->pdo->query($updateSql);
        if($result)
        {
            return $message = ['class'=>'success', 'message'=>'Event updated has been successfully.'];
            header("location: index.php");
        }
        else{
            return $message = ['class'=>'danger', 'message'=>'Something went wrong.'];
        } 
    }

    public function removeEvent($id)
    {
        $date = date("Y-m-d H:i:s");
        $updateSql = "UPDATE `events` SET `deleted_at` = '$date', `status` = 0 WHERE `id` = '$id'";
        $result = $this->pdo->query($updateSql);
        if($result)
        {
            $message = ['class'=>'success', 'id'=>$id, 'message'=>'Event trash has been successfully.'];
            header('Content-type: application/json');
            echo json_encode($message);
        }
        else{
            $message = ['class'=>'danger','message'=>'Something went wrong.'];
            header('Content-type: application/json');
            echo json_encode($message);
        } 
    }

    public function restoreEvent($id)
    {
        $date = date("Y-m-d H:i:s");
        $updateSql = "UPDATE `events` SET `deleted_at` = NULL, `status` = 1 WHERE `id` = '$id'";
        $result = $this->pdo->query($updateSql);
        if($result)
        {
            $message = ['class'=>'success', 'id'=>$id, 'message'=>'Event restore has been successfully.'];
            header('Content-type: application/json');
            echo json_encode($message);
        }
        else{
            $message = ['class'=>'danger', 'message'=>'Something went wrong.'];
            header('Content-type: application/json');
            echo json_encode($message);
        } 
    }

    public function statusEvent($id,  $status)
    {
        if($status==1){
            $statusMSG = 'active';
        }
        else{
            $statusMSG = 'inactive';
        }
        $updateSql = "UPDATE `events` SET `status` = '$status' WHERE `id` = '$id'";
        $result = $this->pdo->query($updateSql);
        if($result)
        {
            $message = ['class'=>'success', 'id'=>$id, 'message'=>'Event '. $statusMSG .' has been successfully.'];
            header('Content-type: application/json');
            echo json_encode($message);
        }
        else{
            $message = ['class'=>'danger', 'message'=>'Something went wrong.'];
            header('Content-type: application/json');
            echo json_encode($message);
        } 
    }

    public function eventApply($data)
    {
        $eventID = $data['event_id'];
        $date = date("Y-m-d");
        if(isset($_SESSION['id']))
        {
            $userID = $_SESSION['id'];
            // event has reached maximum capacity
            $maximumCapacity = $this->maximumCapacity($eventID);
            if($maximumCapacity['class'] == 'danger')
            {
                return $message = ['class'=>'danger', 'message'=>'Registration is closed as the event has reached maximum capacity.'];
            }
            // already registered for this event 
            $applyEventSql = "SELECT * FROM apply_events WHERE user_id = '$userID' AND `event_id` = '$eventID'";
            $stmt = $this->pdo->query($applyEventSql);
            $mysqlResult = $stmt->fetchAll();
            if(count($mysqlResult) > 0) 
            { 
                return $message = ['class'=>'danger', 'message'=>'You have already registered for this event.'];
            }
            else{
                // mail send
                $mail = $this->mailSend($userID, $eventID); 
                $apply_insertSql = "INSERT INTO `apply_events` (`user_id`, `event_id`, `date`) VALUES ('$userID', '$eventID', '$date')";
                $result = $this->pdo->query($apply_insertSql);
                // $result = mysqli_query($this->conn, $apply_sql);
                $_SESSION['success'] = "Your event registration has been completed successfully.";
                header('Location: success.php?id='.$eventID.'&user_id='.$userID);
            }
        }
        else
        {
            if ($data["name"] == ''){
                return $message = ['class'=>'danger', 'message'=>'Name is required.'];
            }elseif ($data["email"] == null){
                return $message = ['class'=>'danger', 'message'=>'Email is required.'];
            }elseif ($data["phone"] == null){
                return $message = ['class'=>'danger', 'message'=>'Phone is required.'];
            }elseif ($data["password"] == null){
               return $message = ['class'=>'danger', 'message'=>'Password is required.'];
            }elseif ($data["confirm_password"] == null){
                return $message = ['class'=>'danger', 'message'=>'Confirm password is required.'];
            }elseif ($data["password"] != $data["confirm_password"]) {
                return $message = ['class'=>'danger', 'message'=>'Password don\'t match.'];
            }

            $name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $password = md5($data['password']);
            $user_type = 2;
            $status = 1;
            
            // already registered for this event 
            $userSql = "SELECT `email` FROM users WHERE `email` = '$email'";
            $stmt = $this->pdo->query($userSql);
            $userSqlResultData = $stmt->fetchAll();

            if(count($userSqlResultData) > 0)
            { 
                return $message = ['class'=>'danger', 'message'=>'This email is already registered.'];
            }
            // event has reached maximum capacity
            $maximumCapacity = $this->maximumCapacity($eventID);
            if($maximumCapacity['class'] == 'danger')
            {
                return $message = ['class'=>'danger', 'message'=>'Registration is closed as the event has reached maximum capacity.'];
            }
            else
            {
                $insertSql = "INSERT INTO `users` (`name`, `user_type`, `email`, `phone`, `password`, `status`) VALUES ('$name', '$user_type', '$email', '$phone', '$password', '$status')";
                $result = $this->pdo->query($insertSql);
                if($result)
                {
                    $user_sql = "SELECT * FROM users WHERE email = '$email'";
                    $stmt =  $this->pdo->query($user_sql);
                    $user_result = $stmt->fetchAll();
                    $userID = $user_result[0]['id'];
                    // mail send
                    $mail = $this->mailSend($userID, $eventID);
                    $apply_sql = "INSERT INTO `apply_events` (`user_id`, `event_id`, `date`) VALUES ('$userID', '$eventID', '$date')";
                    $stmt = $this->pdo->query($apply_sql);
                    $_SESSION['success'] = "Your event registration has been completed successfully.";
                    header('Location:success.php?id='. $eventID .'&user_id='. $userID);
                }
                else{ 
                    return $message = ['class'=>'danger','message'=>'Something went wrong.'];
                }
            }
        }  
    }

    public function downloadEvent($id)
    {
        $eventSql = "SELECT `name` FROM events WHERE `id` = '$id'";
        $stmt = $this->pdo->query($eventSql);
        $eventSqlResultData = $stmt->fetchAll();
        $eventName = str_replace(" ", "-",$eventSqlResultData[0]['name'].'.csv');
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="'.$eventName.'";');
        $output = fopen('php://output', 'wb');
        fputcsv($output, ['ID', 'Name', 'Email', 'Phone']);

        $downloadSql = "SELECT apply_events.id as apply_id, users.name as user_name, users.email, users.phone FROM apply_events
        LEFT JOIN users ON users.id = apply_events.user_id LEFT JOIN events ON events.id = apply_events.event_id WHERE events.id = '$id'";
        $result = $this->pdo->query($downloadSql);
        while ($row = $result->fetch_row()) {
            fputcsv($output, $row);
        }
    }

    public function maximumCapacity($eventID)
    {
        // event has reached maximum capacity
        $maximumEventSql = "SELECT `name`, `maximum_capacity` FROM events WHERE `id` = '$eventID'";
        $stmt = $this->pdo->query($maximumEventSql);
        $sqlResultData = $stmt->fetchAll();

        $eventName = $sqlResultData[0]['name'];
        $maximumCapacity = $sqlResultData[0]['maximum_capacity']; 

        // apply event count
        $applyEventSql = "SELECT * FROM apply_events WHERE `event_id` = '$eventID'";
        $stmt = $this->pdo->query($applyEventSql);
        $eventCounts = $stmt->fetchAll();

        if($maximumCapacity <= count($eventCounts))
        {
            return $message = ['class'=>'danger'];
        }
        else{
            return $message = ['class'=>'success'];
        }
    }

    public function mailSend($userID, $eventID)
    {
        $userSql = "SELECT `id`, `name`, `email` FROM users WHERE `id` = '$userID'";
        $stmt = $this->pdo->query($userSql);
        $sqlResult = $stmt->fetchAll();
        
        $name = $sqlResult[0]['name'];
        $email = $sqlResult[0]['email'];

        $eventSql = "SELECT `id`, `name` FROM events WHERE `id` = '$eventID'";
        $stmt = $this->pdo->query($eventSql);
        $eventResultData = $stmt->fetchAll();
        $eventName = $eventResultData[0]['name'];
        // mail send 
        $settingSql = "SELECT * FROM settings";
        $stmt = $this->pdo->query($settingSql);
        $settingResult = $stmt->fetchAll();

        if(count($settingResult)){
              
            ob_start();
            require './vendor/autoload.php';

            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 2;                                   
                $mail->isSMTP();
                $mail->Host       = $settingResult[0]['host'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $settingResult[0]['username'];
                $mail->Password   = $settingResult[0]['password'];
                $mail->SMTPSecure = $settingResult[0]['smtp_secure'];
                $mail->Port       = $settingResult[0]['port'];
            
                $mail->setFrom($settingResult[0]['email'], $settingResult[0]['app_name']);
                $mail->addAddress($email);
                
                $mail->isHTML(true);           
                $mail->Subject = 'Event Registration: '.$eventName; 
                
                $link = "";

                $title = 'Event Registration';
                $message = 'We have successfully received your registration for **'.$eventName.'**. Stay tuned for further details';
    
                $emailTemplate = file_get_contents('partials/email.php');
                $emailTemplate = str_replace('{TITLE}', $title, $emailTemplate);
                $emailTemplate = str_replace('{MESSAGE}', $message, $emailTemplate);
                $emailTemplate = str_replace('{NAME}', $name, $emailTemplate);
                $emailTemplate = str_replace('{LINK}', $link, $emailTemplate);
                $emailTemplate = str_replace('{COMPANY_NAME}', $settingResult[0]['app_name'], $emailTemplate);
                $emailTemplate = str_replace('{EMAIL}', $settingResult[0]['email'], $emailTemplate);
    
                $mail->Body    = $emailTemplate;
                $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                $mail->send();
                ob_end_clean();
                return $message = ['success'=>1];
            } catch (Exception $e) {
                return $message = ['class'=>'danger', 'message'=>"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"];
            }
        }
        // mail send
    }
}

?>