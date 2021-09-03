<?php


include_once "../config/dbConnect.php";
include_once "../services/operation.php";


class product extends database implements operation

{

    private $id;
    private $name;
    private $status;
    private $image;
    private $details;
    private $price;
    private $quantity;
    private $brand_id;
    private $subcategory_id;
    private $supplier_id;
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
    /* --------------------------------------------selectData --------------------------------------------*/

    public function selectData()
    {
        return $this->runDQL("SELECT `products`.* FROM `products` WHERE `products`.`status` = 1 ORDER BY `products`.`name`");
    }
    /* --------------------------------------------productsBySub --------------------------------------------*/

    public function productsBySub()
    {
        return $this->runDQL("SELECT `products`.* FROM `products` WHERE `products`.`status` = 1 AND `products`.`subcategory_id` = $this->subcategory_id ORDER BY `products`.`name`");
    }
    /* --------------------------------------------productsByBrand --------------------------------------------*/

    public function productsByBrand()
    {
        return $this->runDQL("SELECT `products`.* FROM `products` WHERE `products`.`status` = 1 AND `products`.`brands_id` = $this->brand_id ORDER BY `products`.`name`");
    }
    /* --------------------------------------------searchOnProduct --------------------------------------------*/

    public function searchOnProduct()
    {
        return $this->runDQL("SELECT
                                `products_ratings`.*
                            FROM
                                `products_ratings`
                            WHERE
                                `products_ratings`.`id` = $this->id AND `products_ratings`.`status` = 1");
    }
    /* --------------------------------------------getProductReviews --------------------------------------------*/

    public function getProductReviews()
    {
        return $this->runDQL("SELECT
                               `reviews`.*,
                                `users`.`name` AS `user_name`
                            FROM
                                `reviews`
                            JOIN `users`
                            ON `users`.`id` = `reviews`.`user_id`
                            WHERE
                                `reviews`.`product_id` = $this->id");
    }

    /* --------------------------------------------relatedProducts --------------------------------------------*/

    public function relatedProducts()
    {
        return $this->runDQL("SELECT `products`.* FROM `products` WHERE `products`.`subcategory_id` = $this->subcategory_id AND `products`.`id` != $this->id");
    }
    /* --------------------------------------------newProducts --------------------------------------------*/

    public function newProducts()
    {
        $query = "SELECT `products`.* FROM `products` ORDER BY `products`.`created_at` DESC LIMIT 4";
        return $this->runDQL($query);
    }
    /* --------------------------------------------topProducts --------------------------------------------*/

    public function topRateProducts()
    {
        $query = "SELECT `products_ratings`. * FROM `products_ratings` order by  reviews_avg * reviews_count DESC
        LIMIT 4";

        return $this->runDQL($query);
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

    /**
     * Get the value of details
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set the value of details
     *
     * @return  self
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of brand_id
     */
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @return  self
     */
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of subcategory_id
     */
    public function getSubcategory_id()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of subcategory_id
     *
     * @return  self
     */
    public function setSubcategory_id($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;

        return $this;
    }

    /**
     * Get the value of supplier_id
     */
    public function getSupplier_id()
    {
        return $this->supplier_id;
    }

    /**
     * Set the value of supplier_id
     *
     * @return  self
     */
    public function setSupplier_id($supplier_id)
    {
        $this->supplier_id = $supplier_id;

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