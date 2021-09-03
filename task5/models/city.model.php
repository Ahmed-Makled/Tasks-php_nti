<?php

include_once "../config/dbConnect.php";
include_once "../services/operation.php";

class City extends database implements operation
{

    private $id;
    private $name;
    private $status;
    private $created_at;
    private $updated_at;

    /* --------------------------------------------insertData --------------------------------------------*/


    public function insertData()
    {
        # code ..
    }
    /* --------------------------------------------updateData --------------------------------------------*/

    public function updateData()
    {
        # code ..
    }
    /* --------------------------------------------deleteData --------------------------------------------*/

    public function deleteData()
    {
        # code ..
    }

    public function selectData()
    {
        return $this->runDQL("SELECT `cities`.`id`,`cities`.`name` FROM `cities` ORDER BY `cities`.`name`");
    }
    /* --------------------------------------------Setter And Getter --------------------------------------------*/

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

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of status
     */
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

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}