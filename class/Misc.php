<?php

class Misc{
	private $conn;

	public function __construct($conn){
		$this ->conn = $conn;
	}

	public function getNumPosts(){
		$query = "SELECT * FROM news WHERE status='approved'";
		$run = mysqli_query($this->conn,$query);
		$results = mysqli_num_rows($run);
		return $results;
	}

	public function getNumUsers(){
 		$query = "SELECT * FROM users";
		$run = mysqli_query($this->conn,$query);
		$results = mysqli_num_rows($run);
		return $results;
	}

	public function getNumComments(){
 		$query = "SELECT * FROM comments WHERE status='approved'";
		$run = mysqli_query($this->conn,$query);
		$results = mysqli_num_rows($run);
		return $results;
	}


	public function getNumCategories(){
 	$query = "SELECT * FROM category ";
	$run = mysqli_query($this->conn,$query);
	$results = mysqli_num_rows($run);
	return $results;
	}

	public function getNumSubscribers(){
 	$query = "SELECT * FROM subscribers ";
	$run = mysqli_query($this->conn,$query);
	$results = mysqli_num_rows($run);
	return $results;
	}

}
