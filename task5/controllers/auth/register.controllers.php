<?php
class registerControllers
{
    private $email;
    private $password;
    private $confirmPassword;

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
     * Get the value of confirmPassword
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set the value of confirmPassword
     *
     * @return  self
     */
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }


    //Validates password & confirm passwords.
    public function validationPassowrd()
    {
        $errors = [];

        if (empty($this->password)) {
            $errors['password-required'] = "<div class='alert alert-danger'> Password Is Required </div>";
        }

        if (empty($this->confirmPassword)) {
            $errors['confirmPassword-required'] = "<div class='alert alert-danger'> Confirm Password Is Required </div>";
        }


        if (empty($errors)) {
            if ($this->password != $this->confirmPassword) {
                $errors['password-confrim'] = "<div class='alert alert-danger'> Confirm Password Dosen't Match Your Password </div>";
            }
            if (strlen($this->password) <= 6) {
                $errors['password-pattern'] = "<div class='alert alert-danger'> Your Password Must Contain At Least 6 Number! </div>";
            }
            // if (!preg_match("/#[0-9]+#/", $this->password)) {
            //     $errors['password-pattern'] = "<div class='alert alert-danger'> Your Password Must Contain At Least 1 Number! </div>";
            // }
            // if (!preg_match("/#[A-Z]+#/", $this->password)) {
            //     $errors['password-pattern'] = "<div class='alert alert-danger'> Your Password Must Contain At Least 1 Capital Letter! </div>";
            // }
            // if (!preg_match("/#[a-z]+#/", $this->password)) {
            //     $errors['password-pattern'] = "<div class='alert alert-danger'> Your Password Must Contain At Least 1 Lowercaser Letter! </div>";
            // }
        }
        // print_r($this);
        // die;
        return $errors;
    }





    //Validates email

    public function emailValidation()
    {
        $errors = [];

        if (empty($this->email)) {
            $errors['email-required'] = "<div class='alert alert-danger'> Email Is Required </div>";
        }
        if (empty($errors)) {
            if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/', $this->email)) {
                $errors['email-pattern'] = "invalid Email Format!";
            }
        }

        return $errors;
    }
}