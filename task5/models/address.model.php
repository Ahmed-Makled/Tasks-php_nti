<?php

include_once "../config/dbConnect.php";
include_once "../services/operation.php";

class address extends database implements operation
{

    private $id;
    private $status;
    private $street;
    private $building;
    private $floor;
    private $flat;
    private $notes;
    private $user_id;
    private $region_id;
    private $created_at;
    private $updated_at;


    /* --------------------------------------------insertData --------------------------------------------*/

    public function insertData()
    {
        $query = "INSERT INTO `addresses` 
        (`addresses`.`street`,`addresses`.`floor_no`, `addresses`.`flat_no`,`addresses`.`building_no`,`addresses`.`notes`,`addresses`.`regions_id`,`addresses`.`users_id`) 
        VALUES ('$this->street','$this->floor','$this->flat','$this->building','$this->notes','$this->region_id','$this->user_id')";
        return $this->runDML("$query");
    }
    /* --------------------------------------------updateData --------------------------------------------*/

    public function updateData()
    {
        return $this->runDML("UPDATE `addresses` 
        SET `addresses`.`street` = '$this->street',`addresses`.`floor_no` = '$this->floor',
        `addresses`.`flat_no` = '$this->flat',`addresses`.`building_no` = '$this->building',
        `addresses`.`notes` = '$this->notes',`addresses`.`regions_id` = '$this->region_id'
         WHERE `addresses`.`id` = $this->id");
    }
    /* --------------------------------------------deleteData --------------------------------------------*/

    public function deleteData()
    {
        return $this->runDML("DELETE FROM `addresses` WHERE `addresses`.`id` = $this->id");
    }

    /* --------------------------------------------selectData --------------------------------------------*/

    public function selectData()
    {
        # code...
    }
    /* --------------------------------------------getAllAddress --------------------------------------------*/

    public function getAllAddress()
    {
        return $this->runDQL("SELECT `addresses`.* FROM `addresses` WHERE `addresses`.`users_id` = $this->user_id");
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }


    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setBuilding($building)
    {
        $this->building = $building;

        return $this;
    }


    public function getflat()
    {
        return $this->flat;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;

        return $this;
    }


    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }


    public function getRegion_id()
    {
        return $this->region_id;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setRegion_id($region_id)
    {
        $this->region_id = $region_id;

        return $this;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }
}