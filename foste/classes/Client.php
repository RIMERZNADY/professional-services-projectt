<?php
class Client
{
    private $client_id;
    private $username;
    private $email;
    private $password;
    private $full_name;
    private $contact_number;
    public static $email_error;
    public static $fullname_error;
    public static $username_error;
    public static $contact_error;
    public static $password_error;

    // Constructor
    public function __construct($username, $email, $password, $full_name, $contact_number)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->full_name = $full_name;
        $this->contact_number = $contact_number;
    }

    // Getters
    public function getClientId()
    {
        return $this->client_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function getContactNumber()
    {
        return $this->contact_number;
    }
    // Setters
    public function setClientId($clientid)
    {
        $this->client_id = $clientid;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    public function setContactNumber($contact_number)
    {
        $this->contact_number = $contact_number;
    }
    public function insertClient($conn)
    {
        $sql = "INSERT INTO Users (username, email, password, full_name, contact_number)
        VALUES (
        '$this->username',
        '$this->email',
        '$this->password',
        '$this->full_name',
        '$this->contact_number'
        );";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            return false;
        }
    }
    public static function authentifierClient($connection, $email, $password)
    {
        $sql = "SELECT password FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) == 0) {
            Client::$email_error = "email doesn't exist! please try to singing up.";
        } else {
            $row = mysqli_fetch_assoc($result);
            $hashpass = $row['password'];
            if (!password_verify($password, $hashpass)) {
                Client::$password_error = "incorrect password!";
            }
        }
    }

    public static function selectClientById($tableName, $conn, $id)
    {
        $sql = "SELECT * FROM $tableName WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateClient($conn, $id, $nom, $prenom, $username, $email, $contact_number)
    {
        $fullname = $nom . " " . $prenom;
        $sql = "UPDATE users 
        SET 
        full_name = ?,
        email = ?,
        contact_number = ?,
        username = ?
        WHERE user_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fullname, $email, $contact_number, $username, $id);
        if ($stmt->execute()) {
            return true;

        } else {
            echo "update failed <br>";
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
            return false;
        }
    
    }

}
