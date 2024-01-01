<?php
class Services
{
    private $service_id;
    private $service_nom;
    private $description;
    private $price;

    public function __construct($service_id, $service_nom, $description, $price)
    {
        $this->service_id = $service_id;
        $this->service_nom = $service_nom;
        $this->description = $description;
        $this->price = $price;
    }
    public static function selectServiceById($conn, $id){
        $sql = "SELECT * FROM services WHERE service_id = $id;";
        $service = mysqli_query($conn, $sql);
        if($service != null){
            return mysqli_fetch_assoc($service);
        }else {
            return null;
        }
    }
    public static function getAllService($conn)
    {
        $sql = "SELECT * FROM services";
        $result = mysqli_query($conn, $sql);
        $services = array();
        if ($result != null) {
            $services = array(); 
            while ($row = mysqli_fetch_assoc($result)) {
                $services[] = $row; 
            }
            return $services;
        } else {
            return null;
        }
    }
    // Getters
    public function getServiceId()
    {
        return $this->service_id;
    }

    public function getServiceNom()
    {
        return $this->service_nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    // Setters
    public function setServiceId($service_id)
    {
        $this->service_id = $service_id;
    }

    public function setServiceNom($service_nom)
    {
        $this->service_nom = $service_nom;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}
