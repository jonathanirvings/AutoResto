<?php
Class Booking
	{
            private static $dbOperation;
        
            public function Booking()
            {
                self::$dbOperation = new DBOperation("booking");
            }
            
            
            /**
             * Book Restaurant 
             * 
             * Pre-condition:
             *      $dbOperation has information on booking table
             *      $dpOperationResto has informatin on restaurant table
             * Steps:
             *      checks all the necessary conditions (e.g. check whether the restaurant is full)
             *      and decides on the appropriate table/n-seater to allocate
             * 
             * @param type $cust_nric - customer's NRIC (primary key)
             * @param type $resto_contact - restaurant's contact number (primary key)
             * @param type $date - the date of booking
             * @param type $session = meal session, lunch or dinner
             * @param type $no_of_pax = number of pax
             * 
             * Post-condition:
             *      if restaurant is booked succesfully, store information in booking table
             *      else return error message string.
             */
            public static function book($arrQuery,$no_of_pax,$totalSeatCapacity)
            {
                //assuming all table 1,2,and 4 seaters are mobile and can be moved around conveniently 
                
                //counts the number of seats taken
                $condition1 = [];
                $condition1["restaurant_contact_no"] = $arrQuery["restaurant_contact_no"];
                $condition1["date"] = $arrQuery["date"];
                $condition1["session"] = $arrQuery["session"];
                
                $rows = self::$dbOperation->get($condition1,"");
                $totalSeatTaken = 0;
                for ($i = 0; $i < sizeof($rows); ++$i){
                    $row = $rows[$i];
                    $totalSeatTaken = $row["booked1seaters"] + (2*$row["booked2seaters"]) + (4*$row["booked4seaters"]);
                }
                
                
                //checks whether there are enough seats for booking
                if($totalSeatTaken + $no_of_pax > $totalSeatCapacity){
                    return "ERROR! Only ".$totalSeatCapacity-$totalSeatTaken." seats left!";
                }
             
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
                return "Booking successful!";
            }
	};
?>