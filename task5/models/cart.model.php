<?php
include_once "../config/dbConnect.php";
include_once "../services/operation.php";

class cart extends database implements operation
{

    private $products_id;
    private $users_id;
    private $quantity;


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

    /* --------------------------------------------Setter And Getter --------------------------------------------*/

    /**
     * Get the value of products_id
     */
    public function getProducts_id()
    {
        return $this->products_id;
    }

    /**
     * Set the value of products_id
     *
     * @return  self
     */
    public function setProducts_id($products_id)
    {
        $this->products_id = $products_id;

        return $this;
    }

    /**
     * Get the value of users_id
     */
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * Set the value of users_id
     *
     * @return  self
     */
    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}