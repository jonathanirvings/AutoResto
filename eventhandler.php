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
        
        public function  bookRestaurant($cust_nric,$resto_contact,$date,$session,$no_of_pax)
        {
            return $booking->book($cust_nric,$resto_contact,$date,$session,$no_of_pax);
        }

        public function getListOfRestaurants($sortedKey)
        {
            $list = Restaurant::listOfRestaurants();
            if($sortedKey == ""){
                return Restaurant::listOfRestaurants();
            }
            else{
                return Restaurant::listOfRestaurantsSorted($sortedKey);
            }
        }
        
        public function book($array, $pax)
        {
            $this->booking->book($array,$pax);
        }
    };
?>