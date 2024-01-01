<?php
class Demmand_contact
{
    private $id_demmand;
    private $first_name;
    private $last_name;
    private $email;
    private $phonenumber;
    private $date_demmand;
    private $message;
    private $clientId;
    private $serviceId;

    public function __construct($first_name, $last_name, $email, $phonenumber, $date_demmand, $message, $clientId, $serviceId)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phonenumber = $phonenumber;
        $this->date_demmand = $date_demmand;
        $this->message = $message;
        $this->clientId = $clientId;
        $this->serviceId = $serviceId;
    }
    
    public static function getAllContactInquiries($conn)
    {
        $sql = "SELECT * FROM contact_inquiries";
        $result = mysqli_query($conn, $sql);

        $inquiries = array();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $inquiry = new Demmand_contact(
                    $row['first_name'],
                    $row['last_name'],
                    $row['email'],
                    $row['phonenumber'],
                    $row['inquiry_date'],
                    $row['message'],
                    $row['client_id'],
                    $row['service_id']
                );
                $inquiry->setIdDemmand($row['inquiry_id']);
                $inquiries[] = $inquiry;
            }
        }

        return $inquiries;
    }
    public static function getContantInquiryById($conn, $id){
        $sql = "SELECT * FROM contact_inquiries  WHERE inquiry_id = $id";
        $result = mysqli_query($conn, $sql);
        if($result != null){
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
        return null;
    }
    
    public static function deleteDemmand($conn, $id)
    {
        $sql = "DELETE FROM contact_inquiries WHERE inquiry_id = $id";

        if (mysqli_query($conn, $sql)) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }
    // Getters
    public function getIdDemmand()
    {
        return $this->id_demmand;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getServiceId()
    {
        return $this->serviceId;
    }
    public function getDateDemmand(){
        return $this->date_demmand;
    }
    // Setters
    public function setIdDemmand($id_demmand)
    {
        $this->id_demmand = $id_demmand;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }
    public function insertDemmand($conn)
    {
        $sql = "INSERT INTO contact_inquiries(first_name, last_name, email, phonenumber, message, inquiry_date, client_id, service_id)
            VALUES('$this->first_name', '$this->last_name', '$this->email', '$this->phonenumber', '$this->message', '$this->date_demmand', $this->clientId, $this->serviceId)";

        return mysqli_query($conn, $sql);
    }
    public function updateDemmand($conn, $inquiry_id, $firstname, $lastname, $email, $phone, $date, $serviceId, $message){
        $sql =  "UPDATE contact_inquiries 
        SET first_name = ?,
        last_name = ?,
        email = ?,
        message = ?,
        inquiry_date = ?,
        service_id = ?,
        phonenumber = ?
        WHERE inquiry_id  = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "sssssisi", $firstname, $lastname, $email, $message, $date, $serviceId, $phone, $inquiry_id);
            mysqli_stmt_execute($stmt);
            if(mysqli_stmt_affected_rows($stmt) > 0){
                $this->first_name = $firstname;
                $this->last_name = $lastname;
                $this->email = $email;
                $this->phonenumber = $phone;
                $this->date_demmand = $date;
                $this->serviceId = $serviceId;
                $this->message = $message;
                return true;
            }else {
                
                return false;
            }
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
