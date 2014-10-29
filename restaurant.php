<?php
    Class Restaurant
    {
        private static $dbOperation;
        
        public static function listOfRestaurants()
        {
            return self::$dbOperation->getAll();
        }

        public function Restaurant()
        {
            self::$dbOperation = new DBOperation("restaurant","");
        }
        
        public function add()
        {
            array_push(self::$listOfRestaurants,$this);
        }
        

    };
?>