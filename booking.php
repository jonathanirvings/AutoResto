<?php
    Class Booking
    {
        private static $dbOperation;
        
        public function Booking()
        {
            self::$dbOperation = new Booking("booking");
        }
    };
?>