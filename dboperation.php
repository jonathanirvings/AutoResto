<?php
	Class DBOperation
	{
		private $tableName;
		private $dbHandler;
		private $uniqueKey;

		public function DBOperation($tableName,$uniqueKey)
		{
			$this->tableName = $tableName;
			$this->dbHandler = new DBHandler();
			$this->uniqueKey = $uniqueKey;
		}

		public function insertData($values)
		{
			$query = "INSERT INTO ".$this->tableName." VALUES ";
			$this->dbHandler->doQuery($query);
		}

		public function updateData($uniqeValue,$modifyKey,$modifyValue)
		{
			//$query =
		}

		public function deleteData($uniqueValue)
		{
			//$query = 
		}

		public function getAll()
		{
			$query = "SELECT * FROM ".$this->tableName;
			return $this->dbHandler->getQuery($query);
		}

		public function get($key, $value)
		{
			$query = "SELECT * FROM ".$this->tableName." WHERE ".$key." = ".$value;
			return $this->dbHandler->getQuery($query);
		}
	};
?>