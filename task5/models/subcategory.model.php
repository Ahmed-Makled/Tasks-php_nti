<?php

include_once "../config/dbConnect.php";
include_once "../services/operation.php";


class subcategory extends database implements operation
{

    private $id;
    private $name;
    private $status;
    private $image;
    private $category_id;
    private $created_at;
    private $updated_at;

    /* --------------------------------------------insertData --------------------------------------------*/

    public function insertData()
    {
        # code...
    }
    /* --------------------------------------------updateData --------------------------------------------*/

    public function updateData()
    {
        # code...
    }
    /* --------------------------------------------deleteData --------------------------------------------*/

    public function deleteData()
    {
        # code...
    }

    /* --------------------------------------------getSubsFromCats --------------------------------------------*/


    public function getSubsFromCats()
    {
        return $this->runDQL("SELECT `Subcategories`.`id`,`subcategories`.`name` 
        FROM `subcategories` WHERE `subcategories`.`category_id` = $this->category_id AND `subcategories`.`status` = 1 ORDER BY `subcategories`.`name`");
    }
    /* --------------------------------------------searchOnSub --------------------------------------------*/
    public function searchOnSub()
    {
        return $this->runDQL("SELECT `Subcategories`.`id`,`subcategories`.`name` 
        FROM `subcategories` WHERE `subcategories`.`id` = $this->id AND `subcategories`.`status` = 1");
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
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

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