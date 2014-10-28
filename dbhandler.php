<?php
	Class DBHandler
	{
		private $con;
		public function DBHandler()
		{
			$this->con = mysqli_connect("localhost","root","","autoresto");
		}

		public function doQuery($query)
		{
			mysqli_query($this->con,$query);
		}

		public function getQuery($query)
		{
			$result = mysqli_query($this->con,$query);
			$data = [];
			$i = 0;
			while ($data[$i++] = mysqli_fetch_array($result));
				unset($data[count($data)-1]);
			return $data;
		}
	};
?>