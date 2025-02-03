<?php
class SettingController extends Connect
{ 
    public function settingDisplay($sql)
    {
        $stmt = $this->pdo->query($sql);
        return $result = $stmt->fetchAll();
    }

    public function settingUpdate($data)
    {
        $app_url = $data['app_url'];
        $app_name = $data['app_name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $host = $data['host'];
        $username = $data['username'];
        $password = $data['password'];
        $smtp_secure = $data['smtp_secure'];
        $port = $data['port'];
 
        $updateSql = "UPDATE `settings` SET `app_url` = '$app_url', `app_name` = '$app_name', `email` = '$email', `phone` = '$phone', `host` = '$host', `username` = '$username', `password` = '$password', `smtp_secure` = '$smtp_secure', `port` = '$port'";
        $updateSqlresult = $this->pdo->query($updateSql);
        if($updateSqlresult){
            return $message = ['class'=>'success', 'message'=>'Setting has been updated successfully.']; 
        }
        else{
            $insertSql = "INSERT INTO `settings` (`app_url`, `app_name`, `email`, `phone`, `password`, `host`, `username`, `password`, `smtp_secure`, `port`) VALUES ('$app_url', '$app_name', '$email', '$phone', '$host', '$username', '$password', '$smtp_secure', '$port')";
            $insertSqlResult = $this->pdo->query($insertSql);
            if($insertSqlResult){
                return $message = ['class'=>'success', 'message'=>'Setting has been updated successfully.']; 
            }
            else{
                return $message = ['class'=>'danger', 'message'=>'Something went wrong.'];
            }
        }
    }

}