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
        
        public function addRestaurant($array)
        {
            $this->restaurant->addRestaurant($array);
        }
        
        public function editRestaurant($arrayOld,$arrayNew)
        {
            $this->restaurant->editRestaurant($arrayOld,$arrayNew);
        }

        public function getListOfRestaurants($keyword,$sortedKey)
        {
            if(($sortedKey == "")&&($keyword == "")){
                return Restaurant::listOfRestaurants();
            }
            else if (($sortedKey != "")&&($keyword != "")){
                return Restaurant::listOfRestaurantsSearch($keyword,$sortedKey);
            }
            else if ($keyword != ""){
                return Restaurant::listOfRestaurantsSearch($keyword,"");
            }
            else if ($sortedKey != ""){
                return Restaurant::listOfRestaurantsSearch("",$sortedKey);
            }
        }
        
        public function getRestaurantDetails($resto_contact_number)
        {  
            return Restaurant::getRestaurantDetails($resto_contact_number);
        }
        
        
        
        public function book($array, $pax)
        {
            $this->booking->book($array,$pax);
        }
    };
?>