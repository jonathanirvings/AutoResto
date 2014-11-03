<?php
Class Booking
	{
            private static $dbOperation;
            private static $dbOperationResto;
        
            public function Booking()
            {
                self::$dbOperation = new DBOperation("booking");
                self::$dbOperationResto = new DBOperation("restaurant");
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
            public function book($arrQuery,$no_of_pax)
            {
                //assuming all table 1,2,and 4 seaters are mobile and can be moved around conveniently 
                
                //counts the number of seats taken
                $condition1 = [];
                $condition1["restaurant"] = $arrQuery["restaurant"];
                $condition1["date"] = $arrQuery["date"];
                $condition1["session"] = $arrQuery["session"];
                
                $rows = self::$dbOperation->get($condition1,"");
                $totalSeatTaken = 0;
                for ($i = 0; $i < sizeof($rows); ++$i){
                    $row = $rows[$i];
                    $totalSeatTaken = $row["booked1seaters"] + (2*$row["booked2seaters"]) + (4*$row["booked4seaters"]);
                }
                
                //counts the number of seat capacity
                $condition2 = [];
                $condition2["contact_no"] = $arrQuery["contact_no"];
                $rows2 = self::$dbOperationResto->get($condition2,"");
                $row2 = $rows2[0];
                $totalSeatCapacity = $row2["total1seaters"] + (2*$row2["total2seaters"]) + (4*$row2["total4seaters"]);
                
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