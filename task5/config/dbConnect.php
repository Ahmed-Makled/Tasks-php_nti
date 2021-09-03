<?php
class database
{
    private $host = 'localhost';
    private $userName = 'root';
    private $password = '';
    private $DBName = 'nti_ecommerce';
    private $con; // to use in all function 
    function __construct()
    {
        // Create connection

        $this->con = new mysqli($this->host, $this->userName, $this->password, $this->DBName);
        // Check connection
        if ($this->con->connect_error) {
            die("DB Connection failed" . $this->con->connect_error);
        }
        //      else {
        //         die("DB Connection Started Successfully");
        //     }
    }

    /**
     * @description function insert update delete DB 
     * @pram query
     * @return true or false
     */
    public function runDML($query)
    {
        $result = $this->con->query($query);

        return   $result ?  true : false;
    }

    /**
     * @description function Selects DB 
     * @pram query
     * @return result or empty[]
     */
    public function runDQL($query)
    {
        $result = $this->con->query($query);

        return $result->num_rows > 0 ?  $result : [];
    }
}