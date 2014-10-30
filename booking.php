<?php
Class Booking
	{
            private static $dbOperation;
        
            public function Booking()
            {
                self::$dbOperation = new DBOperation("booking");
            }
            
            
            // pre-condition : 
            //     accessible/available information on Booking Table
            // process :
            //     checks all the necessary conditions (e.g. check whether the restaurant is full)
            //     and decides on the appropriate table/n-seater to allocate
            // post-cond :
            //     Restaurant is booked successfully, and stored in the table
            // param:
            //     $cust_nric = customer's NRIC (primary key)
            //     $resto_contact = restaurant's contact number (primary key)
            //     $date = the date of booking
            //     $session = meal session, lunch or dinner
            //     $no_of_pax = number of pax
            public function book($cust_nric,$resto_contact,$date,$session,$no_of_pax)
            {
                $arrQuery = [];
                $arrQuery["booker"] = $cust_nric;
                $arrQuery["restaurant"] = $resto_contact;
                $arrQuery["date"] = $date;
                $arrQuery["session"] = $session;
                $arrQuery["booked1seaters"] = 0;
                $arrQuery["booked2seaters"] = 0;
                $arrQuery["booked4seaters"] = 0;
                while ($no_of_pax >= 2) {
                    if ($no_of_pax >= 4) {
                        $arrQuery["booked4seaters"] = $no_of_pax / 4;
                        $no_of_pax = $no_of_pax / 4;
                    } elseif ($no_of_pax >= 2) {
                        $arrQuery["booked2seaters"] = $no_of_pax / 2;
                        $no_of_pax = $no_of_pax / 2;
                    }
                }
                $arrQuery["booked1seaters"] = $no_of_pax;
                
                self::$dbOperation->insertData($arrQuery);
            }
	};
?>