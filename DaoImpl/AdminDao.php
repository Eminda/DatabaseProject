<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:01 PM
 */
require '../Modal/PhpClasses.php';

class AdminDao
{
    public static $adminID="AdminID";
    public static $name="Name";
    public static $password="Password";
    public static $costPerKm="CostPerKm";
    public function updateCostPerKm($conn, $admin)
    {
        $sql="UPDATE Admin SET CostPerKm=:cost WHERE AdminID=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cost', $admin->getCostPerKm());
        $stmt->bindParam(':id', $admin->getAdminID());
        $stmt->execute();
    }
    public function updatePassword($conn,$admin){
        $sql="UPDATE Admin SET Password=(select password(:pass)) WHERE AdminID=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pass', $admin->getPassword());
        $stmt->bindParam(':id', $admin->getAdminID());
        $stmt->execute();
    }

}