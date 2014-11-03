<?php
    Class EventHandler
    {
        private $restaurant;
        private $customer;
        private $booking;
        
        public function EventHandler()
        {
            $this->restaurant = new Restaurant();
            $this->customer = new Customer();
            $this->booking = new Booking();
        }

        public function getListOfRestaurants()
        {
            return Restaurant::listOfRestaurants();
        }
        
        public function getListOfRestaurantsSorted($sortedKey)
        {
            $list = Restaurant::listOfRestaurants();
            //sort disini
        }
        
        public function book($cust_nric,$resto_contact,$date,$session,$no_of_pax)
        {
            $this->booking->book($cust_nric,$resto_contact,$date,$session,$no_of_pax);
        }
    };
?>