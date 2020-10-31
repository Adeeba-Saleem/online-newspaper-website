<?php  
	class Addvertistement
	{
		private $conn;
		private $user_obj;

		public function __construct($conn, $user)
		{
			$this->conn = $conn;
			$this->user_obj = new User($conn, $user);
		}

			public function addAdt($image) {
 		if (!empty($image)) {
 			$query = mysqli_query($this->conn, "INSERT INTO advertistment VALUES('','$image');");
 			($query) ?  true :  false;
 		}else {
 			return false;
 		}
 	}

		public function getAdv()
		{
			$query = mysqli_query($this->conn, "SELECT * FROM advertistment ORDER BY id DESC LIMIT 9");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$post_image = $row['post_image'];

				$str .= "
 						  <li>
                              <img class='img-fluid' src='Admin/$post_image'>
                        </li>
			
                                  
                        ";
			}
			echo $str;
		}



	}