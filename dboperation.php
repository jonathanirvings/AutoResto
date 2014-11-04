<?php
	Class DBOperation
	{
		private $tableName;
		private $dbHandler;

		public function DBOperation($tableName)
		{
			$this->tableName = $tableName;
			$this->dbHandler = new DBHandler();
		}

                /**
                 * Insert a row into the table
                 * @param type $toInsert - the row that want to be inserted
                 *          for every $values[a] = b, the inserted row R will have R.a = b
                 */
		public function insertData($toInsert)
		{
                        $keys = "";
                        $values = "";
                        foreach ($toInsert as $key => $value)
                        {
                            if ($keys != "")
                            {
                                $keys = $keys.",";
                            }
                            $keys = $keys.$key;
                            if ($values != "")
                            {
                                $values = $values.",";
                            }
                            $values = $values."\"".$value."\"";
                        }
			$query = "INSERT INTO ".$this->tableName." (".$keys.") VALUES (".$values.")";
			return $this->dbHandler->doQuery($query);
		}
                
                private function commandiseCondition($condition)
                {
                    $conditionCommand = "";
                    foreach ($condition as $key => $value)
                    {
                        if ($conditionCommand != "")
                        {
                            $conditionCommand = $conditionCommand." AND ";
                        }
                        $conditionCommand = $conditionCommand.$key." = \"".$value."\"";
                    }
                    return $conditionCommand;
                }
                
                private function commandiseSearchCondition($condition)
                {
                    $conditionCommand = "";
                    foreach ($condition as $key => $value)
                    {
                        if ($conditionCommand != "")
                        {
                            $conditionCommand = $conditionCommand." AND ";
                        }
                        $conditionCommand = $conditionCommand.$key." like \"%".$value."%\"";
                    }
                    return $conditionCommand;
                }

                /**
                 * Update a row (or maybe multiple rows) in the table
                 * @param type $conditions - conditions of the row that want to be updated
                 *        for every $conditions[a] = b, a row R that want to be updated must have R.a == b
                 * @param type $update - the values that want to be updated
                 *        for every $update[a] = b, we want to change R.a = b
                 */
		public function updateData($conditions,$update)
		{
                    $conditionCommand = $this->commandiseCondition($conditions);
                    foreach ($update as $keyUpdate => $valueUpdate)
                    {
                        $query = "UPDATE ".$this->tableName." SET ".$keyUpdate." = \"".$valueUpdate."\"";
                        if ($conditionCommand != "")
                        {
                            $query = $query." WHERE ".$conditionCommand;
                        }
                    }
                    return $this->dbHandler->doQuery($query);
		}

                /**
                 * Delete a row (or maybe multiple rows) in the table
                 * @param type $conditions - conditions of the row that want to be deleted
                 *        for every $conditions[a] = b, a row R that want to be deleted must have R.a == b
                 */
		public function deleteData($conditions)
		{
                    $conditionCommand = $this->commandiseCondition($conditions);
                    $query = "DELETE FROM ".$this->tableName;
                    if ($conditionCommand != "")
                    {
                        $query = $query." WHERE ".$conditionCommand;
                    }
                    return $this->dbHandler->doQuery($query);
		}
                
                /**
                 * Get rows. 
                 * @param type $conditions - conditions of the row that want to be achieved
                 *        for every $conditions[a] = b, a row R that want to be achieved must have R.a == b
                 * @param type $sortBy - sort based on this column
                 *       
                 * @return type. Array of rows that fullfilled the conditions
                 */
                public function get($conditions,$sortBy)
		{
                    $conditionCommand = $this->commandiseCondition($conditions);
                    $query = "SELECT * FROM ".$this->tableName;
                    if ($conditionCommand != "")
                    {
                        $query = $query." WHERE ".$conditionCommand;
                    }
                    
                    
                    if ($sortBy != "")
                    {
                        $query = $query." ORDER BY ".$sortBy;
                    }
                    return $this->dbHandler->getQuery($query);
		}
                
                public function getSearch($searchConditions,$sortBy)
		{
                    $query = "SELECT * FROM ".$this->tableName;
                    $conditionSearchCommand = $this->commandiseSearchCondition($searchConditions); 
                    if ($conditionSearchCommand != "")
                    {
                        $query = $query." WHERE ".$conditionSearchCommand;
                    }
                    if ($sortBy != "")
                    {
                        $query = $query." ORDER BY ".$sortBy;
                    }
                    return $this->dbHandler->getQuery($query);
		}
               
                
                /**
                 * Get all rows. Can be done by calling get(empty array) actually. 
                 * @return type. Array of rows that fullfilled the conditions
                 */
		public function getAll()
		{
			$query = "SELECT * FROM ".$this->tableName;
			return $this->dbHandler->getQuery($query);
		}

	};
?>