<?php
    Class DBHandler
    {
        private $con;
        
        public function DBHandler()
	{   
            global $db_location;
            global $db_name;
            global $db_password;
            global $db_username;
            $this->con = mysqli_connect($db_location,$db_username,$db_password,$db_name);
	}
	
        public function doQuery($query)
	{
            global $db_handler_success;
            mysqli_query($this->con,$query);
            return $db_handler_success;
	}

	public function getQuery($query)
	{
            $result = mysqli_query($this->con,$query);
            $data = [];
            $i = 0;
            while ($data[$i++] = mysqli_fetch_array($result));
            unset($data[count($data)-1]);
            
            return $data;
	}
    };
?>