<?php 

 class Category {
 	private $conn;
 	private $user_obj;

 	public function __construct($conn, $user) {
 		$this->conn = $conn;
 		$this->user_obj = new User($conn, $user);
 	}

 	public function addCategory($category) {
 		if (!empty($category)) {
 			$query = mysqli_query($this->conn, "INSERT INTO category VALUES('','$category');");
 			($query) ?  true :  false;
 		}else {
 			return false;
 		}
 	}

 	public function getAdminCategory() {
 		$query = mysqli_query($this->conn, "SELECT * FROM category ORDER BY cat_title ASC");
 		$str = "";
 		$role = $this->user_obj->getRole();

 		while ($row = mysqli_fetch_array($query)) {
 			$id = $row['id'];
 			$cat_title = $row['cat_title'];

 			if($role === 'Admin') {
 				$str .= "<tr>" .
 						"<td>{$id}</td>".
 						"<td>{$cat_title}</td>".
 						"<td><a href='edit_category.php?cat_id=$id' class='btn btn-primary'>Edit</a></td>".
 						"<td><a href='category.php?d_cat_id=$id' class='btn btn-danger'>Delete</a></td>".
 						"</tr>";
 			}else {
 				$str .= "<tr>" .
 						"<td>{$id}</td>".
 						"<td>{$cat_title}</td>".
 						"</tr>";
 			}
 		}

 		echo $str; 
 	}

 	public function updateCategory($id, $category) {
 		$query = mysqli_query($this->conn, "UPDATE category SET cat_title='$category' WHERE id=$id");
 		if ($query) {
 			return true;
 		} else{
 			return false;
 		}
 	}

 	public function deleteCategory($id) {
 		$query = mysqli_query($this->conn, "DELETE FROM category WHERE id=$id");
 		if($query) {
 			return true;
 		} else {
 			return false;
 		}
 	}

 	public function getAllCategory() {
 		$query = mysqli_query($this->conn, "SELECT * FROM category ORDER BY cat_title ASC");
 		$str = "";
 		while ($row = mysqli_fetch_array($query)) {
 			$cat_title = $row['cat_title'];
 			$cat_id = $row['id'];
 			$str .= "<li><a href='category.php?c_id=$cat_id'>$cat_title</a></li>";
 		}
 		echo $str;
 	}

 	public function getPostByCat($id)
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE status='approved' AND post_cat_id = $id ORDER BY id DESC LIMIT 10");
			$str = "";
		if (mysqli_num_rows($query) === 0) {
			$str = "<h2 class='text-center text-danger'>No results found!</h2>";
		}	
		else {
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$title = $row['title'];
				$content = $row['content'];
				if (strlen($content) > 200) {
					$content = substr($content, 0, 200) . "...";
				}
				$category = $row['post_category'];
				$post_cat_id = $row['post_cat_id'];
				$image = $row['post_image'];
				$num_likes = $row['num_likes'];
				$sql=mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id=$id AND status='approved'" );
				$comments = mysqli_num_rows($sql);
				$str .= "<div class='col-lg-4 '>
                                <div class='single-bottom mb-35'>
                                    <div class='trend-bottom-img mb-30'>
                                        <img src='Admin/$image' height='150'>
                                    </div>
                                    <div class='trend-bottom-cap'>
                                        <span class='color1'>$category</span>
                                        
                                        <h4><a href=''>$title</a></h4>
                                         <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png' alt=''> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png' alt=''> <span>$comments</span></a>
                                    </div>

                                </div>
                                </div>";
			}
		}
			echo $str;
		}

		 	public function sgetAllCategory() {
 		$query = mysqli_query($this->conn, "SELECT * FROM category ORDER BY cat_title ASC");
 		$str = "";
 		while ($row = mysqli_fetch_array($query)) {
 			$cat_title = $row['cat_title'];
 			$cat_id = $row['id'];
 			$sql = mysqli_query($this->conn, "SELECT * FROM news WHERE status='approved' AND  post_cat_id = $cat_id");
 			$num = mysqli_num_rows($sql);
 			$str .= " <li>
                           <a href='category.php?c_id=$cat_id' class='d-flex'>
                              <p>$cat_title</p>
                              <p>($num)</p>
                           </a>
                        </li>";
 		}
 		echo $str;
 	}
		

 	
 }