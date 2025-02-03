<?php
class UserController extends Connect
{ 
    public function updateProfile($data)
    {
        $id = $_SESSION['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = md5($data['password']);
        $condition = ''; 
        if ($data["password"] !='') {

            if (strlen($data['password']) < 6) {
                return $message = ['class'=>'danger', 'message'=>'Password should be min 6 characters.'];
            }

            if ($data["password"] != $data["confirm_password"]) {
                return $message = ['class'=>'danger', 'message'=>'Password don\'t match.'];
            }
            else{
                $condition = ", `password`=  '$password'";
            }
        }

        $user_sql = "SELECT `email` FROM users WHERE `id` = '$id'";
        $stmt = $this->pdo->query($user_sql);
        $user_result = $stmt->fetchAll();

        if($user_result[0]['email'] != $email) 
        {
            $check_sql = "SELECT * FROM users WHERE email = '$email'";
            $stmt = $this->pdo->query($check_sql);
            $check_result = $stmt->fetchAll();
            if($check_result) {
                return $message = ['class'=>'danger', 'message'=>'This email address is already registered.'];
            }
        }
 
        $updateSql = "UPDATE `users` SET `name` = '$name', `email` = '$email', `phone` = '$phone' $condition WHERE `id` = '$id'";
        $updateSqlresult = $this->pdo->query($updateSql);
        if($updateSqlresult)
        {
            $_SESSION['id']   = $id;
            $_SESSION['name'] = $name; 
            $_SESSION['email'] = $email; 
            $_SESSION['phone'] = $phone;
            return $message = ['class'=>'success', 'message'=>'Profile update has been successfully.'];
            header("location: profile.php");
        }
        else{
            return $message = ['class'=>'danger', 'message'=>'Something went wrong.'];
            header("location: profile.php");
        } 
    }
    public function statusUser($id,  $status)
    {
        if($status==1){
            $statusMSG = 'active';
        }
        else{
            $statusMSG = 'inactive';
        }
        $updateSql = "UPDATE `users` SET `status` = '$status' WHERE `id`='$id'";
        $updateSqlresult = $this->pdo->query($updateSql);
        if($updateSqlresult)
        {
            $message = ['class'=>'success', 'id'=>$id, 'message'=>'User '.$statusMSG.' has been successfully'];
            header('Content-type: application/json');
            echo json_encode($message);
        }
        else{
            $message = ['class'=>'danger','message'=>'Something went wrong'];
            header('Content-type: application/json');
            echo json_encode($message);
        }
    }

    public function removeUser($id)
    {
        $removesql = "DELETE FROM users WHERE `id`='$id'";
        $sqlresult = $this->pdo->query($removesql); 
        if($sqlresult)
        {
            $message = ['class'=>'success', 'message'=>'User remove has been successfully'];
            header('Content-type: application/json');
            echo json_encode($message);
        }
        else{
            $message = ['class'=>'danger','message'=>'Something went wrong'];
            header('Content-type: application/json');
            echo json_encode($message);
        }  
    }
}
?>