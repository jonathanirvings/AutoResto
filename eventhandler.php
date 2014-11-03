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
            if($sortedKey == ""){
                return Restaurant::listOfRestaurants();
            }
            else{
                if($sortedKey == "name"){
                    $sortedKey = "restaurant_name";
                }
                else if($sortedKey == "cuisine"){
                    $sortedKey = "cuisine";
                }
                else if ($sortedKey == "status"){
                    $sortedKey = "open";
                }
                return Restaurant::listOfRestaurantsSorted($sortedKey);
            }
        }
    };
?>