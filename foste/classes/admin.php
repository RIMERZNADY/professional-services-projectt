<?php
class Admin
{
    private $username = "admin1";
    private $email = "admin1@email.com";
    private $password = "abc123ABC";
    private $hashedPassword;
    private $full_name = "admin fullname";
    private $contact_number = "+212 111-1111";
    private $is_lawyer = 1;
    public static $email_error;
    public static $password_error;
    public function __construct($conn){
        $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "SELECT user_id FROM users WHERE email = '$this->email' AND is_lawyer = 1;";
        $result = mysqli_query($conn, $sql);
        if($result != null){
            $row = mysqli_fetch_assoc($result);
            if($row && $row['user_id']){
                return;
            }else {
                $sql = "INSERT INTO Users(username,email,password,full_name,contact_number,is_lawyer)
                VALUES('$this->username', '$this->email', '$this->hashedPassword', '$this->full_name', '$this->contact_number', '$this->is_lawyer');";
                if(mysqli_query($conn, $sql)){
                    return;
                }else{
                    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    public function authentifierAdmin($email, $password){
        if($email != $this->email){
            Admin::$email_error = "Email incorrect!";
        }else if(!password_verify($password, $this->hashedPassword)){
            Admin::$password_error = "password incorrect!";
        }
    }
    public function getAdminEmail(){
        return $this->email;
    }
}
