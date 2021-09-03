<?php
include_once "../config/dbConnect.php";
include_once "../services/operation.php";

class user extends database implements operation
{
    private $id;
    private  $name;
    private $phone;
    private $email;
    private $password;
    private $code;
    private $image;
    private $status;
    private $gender;
    private $created_at;
    private $update_at;


    /* --------------------------------------------insertData --------------------------------------------*/

    public function insertData()
    {
        $query = "INSERT INTO 
        `users` (`users`.`name`,`users`.`email`,`users`.`phone`,`users`.`password`,`users`.`gender`,`users`.`code`)
         VALUES ('$this->name','$this->email','$this->phone','$this->password','$this->gender',$this->code)";
        return $this->runDML($query);
    }
    /* --------------------------------------------updateData --------------------------------------------*/

    public function updateData()
    {
        $query =    "   UPDATE `users` 
        SET `users`.`name` = '$this->name',`users`.`phone` = '$this->phone',`users`.`gender` = '$this->gender'";
        if ($this->image) {
            $query .= ",`users`.`image` = '$this->image'";
        }
        $query .=   "   WHERE `users`.`email` = '$this->email'
    ";
        return $this->runDML($query);
    }
    /* --------------------------------------------deleteData --------------------------------------------*/

    public function deleteData()
    {
        # code ..
    }


    /* --------------------------------------------emailCheck --------------------------------------------*/

    public function emailCheck()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email'";
        // print_r($query);
        // die;
        return $this->runDQL($query);
    }
    /* --------------------------------------------checkCode --------------------------------------------*/

    public function checkCode()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`code` = $this->code";

        return $this->runDQL($query);
    }

    /* --------------------------------------------updateStatus --------------------------------------------*/

    public function updateStatus()
    {
        $query = "UPDATE `users` SET `users`.`status` = $this->status WHERE `users`.`email` = '$this->email'";


        return $this->runDML($query);
    }
    /* --------------------------------------------login --------------------------------------------*/
    public function login()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`password` ='$this->password'";
        return $this->runDQL($query);
    }
    /* --------------------------------------------updateCode --------------------------------------------*/

    public function updateCode()
    {
        $query = "UPDATE `users` SET `users`.`code` = $this->code WHERE `users`.`email` = '$this->email'";
        return $this->runDML($query);
    }
    /* --------------------------------------------updatePassword --------------------------------------------*/

    public function updatePassword()
    {
        $query = "UPDATE `users` SET `users`.`password` = '$this->password' WHERE `users`.`email` = '$this->email'";
        return $this->runDML($query);
    }
    /* --------------------------------------------updateEmail --------------------------------------------*/

    public function updateEmail()
    {
        $query =    "UPDATE `users`
                    SET `users`.`email` = '$this->email',`users`.`code` = $this->code,`users`.`status` = $this->status
                    WHERE `users`.`id` = '$this->id'";
        return $this->runDML($query);
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
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

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
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

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
     * Get the value of update_at
     */
    public function getUpdate_at()
    {
        return $this->update_at;
    }

    /**
     * Set the value of update_at
     *
     * @return  self
     */
    public function setUpdate_at($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }
}