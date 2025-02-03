<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Authentication extends Connect
{
    public function singUp($data)
    {
        if ($data["name"] == null){
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
        $user_type = isset($data['user_type']) ? $data['user_type'] : 2;
        $status = isset($data['status']) ? $data['status'] : 1;

        if (strlen($data['password']) < 6) {
            return $message = ['class'=>'danger', 'message'=>'Password should be min 6 characters.'];
        }
         
        $user_sql = "SELECT * FROM users WHERE email = '$email'";
        $stmt =  $this->pdo->query($user_sql);
        $user_result = $stmt->fetchAll();
        

        if(count($user_result) == 1)
        { 
            return $message = ['class'=>'danger', 'message'=>'This email is already registered.'];
        }
        else{
            $insertSql = "INSERT INTO `users` (`name`, `user_type`, `email`, `phone`, `password`, `status`) VALUES ('$name', '$user_type', '$email', '$phone', '$password', '$status')";
            $stmt = $this->pdo->prepare($insertSql);
            $user_result =  $stmt->execute();
   
            if($user_result > 0)
            {
                $user_sql = "SELECT * FROM users WHERE email = '$email'";
                $stmt =  $this->pdo->query($user_sql);
                $user_result = $stmt->fetchAll();
                $userID = $user_result[0]['id'];
                $mail = $this->mailSend($userID);
                $userSql = "SELECT * FROM users WHERE id = '$userID'";
                $userResult =  $this->pdo->query($userSql);
                $user = $userResult->fetchAll();

                if($_SESSION['user_type']==1){
                    $message = ['class'=>'success', 'message'=>'User has been create successfully.'];
                    header("location:users.php");
                }
                else{
                    $_SESSION['id'] = $user[0]['id'];
                    $_SESSION['name'] = $user[0]['name']; 
                    $_SESSION['email'] = $user[0]['email']; 
                    $_SESSION['phone'] = $user[0]['phone'];  
                    $_SESSION['user_type'] = $user[0]['user_type'];
                    $message = ['class'=>'success', 'message'=>'Registration has been successfully.'];
                    header("location:index.php");
                }
            }
            else{
                return $message = ['class'=>'danger','message'=>'Something went wrong.5'];
            }
        }
    }

    public function singIn($data)
    {
        $email = $data['email'];
        $password = $data['password'];
        $sql = "SELECT * FROM users WHERE email = '$email' and password = md5('$password')";
        $stmt = $this->pdo->query($sql);
        $user = $stmt->fetchAll();
        if($user && $user[0]['status'] == 0)
        {
            return $message = ['class'=>'danger', 'message'=>'Your account has been deactivated. Please contact your site administrator.']; 
        }

        if(count($user) == 1)
        {
            $_SESSION['id']   = $user[0]['id'];
            $_SESSION['name'] = $user[0]['name'];
            $_SESSION['email'] = $user[0]['email'];
            $_SESSION['phone'] = $user[0]['phone'];
            $_SESSION['user_type'] = $user[0]['user_type']; 
            header("location:index.php");
        }else {
            return $message = ['class'=>'danger', 'message'=>'Your Email or Password is invalid.'];
        }
    }

    public function userUpdate($data)
    {
        if ($data["name"] == null){
            return $message = ['class'=>'danger', 'message'=>'Name is required.'];
        }elseif ($data["email"] == null){
            return $message = ['class'=>'danger', 'message'=>'Email is required.'];
        }elseif ($data["phone"] == null){
            return $message = ['class'=>'danger', 'message'=>'Phone is required.'];
        }

        $id = base64_decode($data['user_id']);
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = md5($data['password']);
        $user_type = isset($data['user_type']) ? $data['user_type'] : 2;
        $status = isset($data['status']) ? $data['status'] : 1;


        $user_sql = "SELECT * FROM users WHERE id = '$id'";
        $stmt =  $this->pdo->query($user_sql);
        $user_result = $stmt->fetchAll(); 

        if($user_result[0]['email'] != $email) 
        {
            $check_sql = "SELECT * FROM users WHERE email = '$email'";
            $stmt = $this->pdo->query($check_sql);
            $check_result = $stmt->fetchAll();
            if($check_result) {
                return $message = ['class'=>'danger', 'message'=>'Email already exits.'];
            }
        }

        $condition = '';
        if ($data["password"] !='') {
            $condition = ", `password`=  '$password'";
        }
 
        $updateSql = "UPDATE `users` SET `name` = '$name', `email` = '$email', `phone` = '$phone' $condition WHERE id = '$id'"; 
        $updateSqlresult = $this->pdo->query($updateSql); 
        if($updateSqlresult){ 
            return $message = ['class'=>'success', 'message'=>'User updated has been successfully.'];
        }
        else{
            return $message = ['class'=>'danger', 'message'=>'Something went wrong.'];
        } 
    }
 
    public function forgotPassword($data)
    {
        ob_start();

        $email = $data['email'];

        $userSql = "SELECT * FROM users WHERE email = '$email'";
        $stmt = $this->pdo->query($userSql);
        $userSqlresult = $stmt->fetchAll(); 

        if(!$userSqlresult)
        {
            return $message = ['class'=>'danger', 'message'=>'Oops! We couldn’t find an account with that email. Please double-check or sign up if you’re new!.'];
        }

        require './vendor/autoload.php';

        $name = $userSqlresult[0]["name"];
        $userID = base64_encode($userSqlresult[0]["id"]);
         
        $mail = new PHPMailer(true);

        $settingSql = "SELECT * FROM settings";
        $stmt = $this->pdo->query($settingSql);
        $settingResult = $stmt->fetchAll();

        if(!$settingResult){
            return $message = ['class'=>'danger', 'message'=>'SMTP information could not be updated. Please try again.'];
        }

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
            $mail->Subject = 'Forgot Password'; 
            $path = $settingResult[0]['app_url']."/new_password.php?userid=".$userID;

            $link = "<a href='$path'>Reset Password</a>";

            $title = 'Password Reset Request';
            $message = 'We received a request to reset your password. Click the link below to create a new password:';

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
            return $message = ['class'=>'success', 'message'=>'Your email has been sent successfully. Please check your inbox.'];
        } catch (Exception $e) {
            return $message = ['class'=>'danger', 'message'=>"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"];
        }
    }

    public function updatePassword($data)
    {
        if ($data["password"] == null){
            return $message = ['class'=>'danger', 'message'=>'Password is required.'];
        }elseif ($data["confirm_password"] == null){
            return $message = ['class'=>'danger', 'message'=>'Confirm password is required.'];
        }elseif ($data["password"] != $data["confirm_password"]){
            return $message = ['class'=>'danger', 'message'=>'Password don\'t match.'];
        }

        $user_id = base64_decode($data['user_id']); 
        $password = md5($data['password']); 

        if (strlen($data['password']) < 6) {
            return $message = ['class'=>'danger', 'message'=>'Password should be min 6 characters.'];
        }

        if ($data["password"] != $data["confirm_password"]) {
            return $message = ['class'=>'danger', 'message'=>'Password don\'t match.'];
        } 
         
        $userSql = "UPDATE `users` SET `password` = '$password' WHERE `id` = '$user_id'";
        $stmt =  $this->pdo->query($userSql);
        if($stmt){
            return $message = ['class'=>'success', 'message'=>'Password has been updated successfully.']; 
        }
        else{
            return $message = ['class'=>'danger', 'message'=>'Something went wrong.'];
        }
    }
    
    public function logout($user_type){
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['phone']); 
        unset($_SESSION['user_type']);
        if($user_type == 2){
            header("location: singin.php");
        }
        else{
            header("location: login.php");
        }
    }

    public function mailSend($userID)
    {
        $userSql = "SELECT `id`, `name`, `email` FROM users WHERE `id` = '$userID'";
        $stmt =  $this->pdo->query($userSql);
        $sqlResult = $stmt->fetchAll();
        $name = $sqlResult[0]['name'];
        $email = $sqlResult[0]['email'];
 
        // mail send 
        $settingSql = "SELECT * FROM settings";
        $stmt =  $this->pdo->query($settingSql);
        $settingResult = $stmt->fetchAll(); 
 
        if($settingResult)
        {
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
                $mail->Subject = 'Welcome to '.$settingResult[0]['app_name']; 
                
                $link = "";

                $title ='Welcome to  '.$settingResult[0]['app_name'];
                $message = 'Thank you for signing up! Your account has been successfully created.';
    
                $emailTemplate = file_get_contents('partials/email.php');
                $emailTemplate = str_replace('{TITLE}', $title, $emailTemplate);
                $emailTemplate = str_replace('{MESSAGE}', $message, $emailTemplate);
                $emailTemplate = str_replace('{NAME}', $name, $emailTemplate);
                $emailTemplate = str_replace('{LINK}', $link, $emailTemplate);
                $emailTemplate = str_replace('{COMPANY_NAME}', $settingResult[0]['app_name'], $emailTemplate);
                $emailTemplate = str_replace('{EMAIL}', $settingResult[0]['email'], $emailTemplate);
    
                $mail->Body = $emailTemplate; //  'email.php HTML message body in <b>bold</b> = '. $verify_code;
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