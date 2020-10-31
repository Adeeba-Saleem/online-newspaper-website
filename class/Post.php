<?php  
	class Post
	{
		private $conn;
		private $user_obj;

		public function __construct($conn, $user)
		{
			$this->conn = $conn;
			$this->user_obj = new User($conn, $user);
		}

			public function addNews($title, $content, $category, $type, $tags, $image)
		{
			if(!empty($title) && !empty($content)) 
			{
				$title = strtoupper($title);
				$title = mysqli_real_escape_string($this->conn, $title);
				$content = nl2br($content);
				$content = mysqli_real_escape_string($this->conn, $content);
				$added_by = $this->user_obj-> getID();
				$role = $this->user_obj->getRole();
				$sql = mysqli_query($this->conn, "SELECT id FROM category WHERE cat_title='$category'");
				$row = mysqli_fetch_array($sql);
				$cat_id = $row['id'];
				$date = date("Y-m-d H:i:s");

				$query = mysqli_query($this->conn, "INSERT INTO news VALUES('','$title','$content','$added_by','$role','$category','$cat_id','$image','$date','$tags','unapprove','$type','0','0','0',NOW());");
			}
		}

		public function getBreakingNews() 
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE type='Breaking News' AND status='approved' ORDER BY id DESC LIMIT 9");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$title = $row['title'];
				$content = $row['content'];
				if(strlen($title) > 15) {
					$content = substr($content, 0, 15) . "...";
				}
				$cat_title = $row['post_category'];
				$post_cat_id = $row['post_cat_id'];
				$image = $row['post_image'];
				$likes = $row['num_likes'];
				$sql=mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id=$id AND status='approved'" );
				$comments = mysqli_num_rows($sql);
				$date_added = $row['date_added'];

				$date_time_now = date("Y-m-d H:i:s");
				$startCount = new DateTime($date_added);
				$endCount = new DateTime($date_time_now);
				$interval = $startCount->diff($endCount);
				if($interval->h <= 10 && $interval->d < 1) {
				
					$str .= " 
                                <div class='col-lg-4 '>
                                <div class='single-bottom mb-35'>
                                    <div class='trend-bottom-img mb-30'>
                                       <a href='single-post.php?post_id=$id&cat_r=$cat_title'> <img src='Admin/$image' height='150'></a>
                                    </div>
                                    <div class='trend-bottom-cap'>
                                        <span class='color1'>$cat_title</span>
                                        
                                        <h4><a href='single-post.php?post_id=$id&cat_r=$cat_title'>$title</a></h4>
                                         <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png' alt=''> <span>$likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png' alt=''> <span>$comments</span></a>
                                    </div>

                                </div>
                                </div>
                     ";
				}
			}

			echo $str;
		}

		public function getFeaturedNews()
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE status='approved' ORDER BY RAND() LIMIT 5");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$image = $row['post_image'];
				$title = $row['title'];
				$date_added = $row['date_added'];
				$cat_title = $row['post_category'];
				$post_cat_id = $row['post_cat_id'];

				$str .= "    <div class='trand-right-single d-flex'>
                            <div class='trand-right-img'>
                               <a href='single-post.php?post_id=$id&cat_r=$cat_title'> <img src='Admin/$image' class='img-rounded' width='100' heigt='100'></a>
                            </div>
                            <div class='trand-right-cap'>
                            
                                <span class='color1'>$cat_title</span>
                                
                                <h4><a href='single-post.php?post_id=$id&cat_r=$cat_title'>$title</a></h4>
                                <p class='post-date'>$date_added</p>
                            </div>
                        </div>";
			}
			echo $str;
		}

		public function getCasualNews()
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE type='Casual News' AND status='approved' ORDER BY id DESC LIMIT 10");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$title = $row['title'];
				$content = $row['content'];
				$category = $row['post_category'];
				$post_cat_id = $row['post_cat_id'];
				$image = $row['post_image'];
				$num_likes = $row['num_likes'];
				$sql=mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id=$id AND status='approved'" );
				$comments = mysqli_num_rows($sql);

				$str .= "
                                    
                                        <div class='col-lg-6 col-md-6'>
                                            <div class='single-what-news mb-100'>
                                                <div class='what-img'>
                                                    <img src='Admin/$image' height='180' >
                                                </div>
                                                <div class='what-cap'>
                                                    <span class='color1'>$category</span>
                                    <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png' > <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png' alt=''> <span>$comments</span></a>
                                                    <h4><a href='single-post.php?post_id=$id&cat_r=$category'>$title</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                  
                        ";
			}
			echo $str;
		}

		public function getPostBySearch($keyword)
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE tags LIKE '%$keyword%' AND status='approved' ORDER BY id DESC LIMIT 10");
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
                                        <a href='single-post.php?post_id=$id&cat_r=$category'><img src='Admin/$image' height='150'></a>
                                    </div>
                                    <div class='trend-bottom-cap'>
                                        <span class='color1'>$category</span>
                                        
                                        <h4><a href='single-post.php?post_id=$id&cat_r=$category'>$title</a></h4>
                                         <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png' alt=''> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png' alt=''> <span>$comments</span></a>
                                    </div>

                                </div>
                                </div>";
			}
		}
			echo $str;
		}

		public function getFullNews($id)
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE status='approved' AND id=$id");
			$str = "";
			$row = mysqli_fetch_array($query);
			$id = $row['id'];
			$title = $row['title'];
			$content = $row['content'];
			$added_by = $row['added_by'];
			$post_category = $row['post_category'];
			$post_cat_id = $row['post_cat_id'];
			$image = $row['post_image'];
			$tags = explode(',', $row['tags']);
			$date_added = $row['date_added'];
			$views = $row['num_views'];
			$sql=mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id=$id AND status='approved'" );
			$comments = mysqli_num_rows($sql);
			$num_likes = $row['num_likes'];
			$str_tags = "";
			foreach ($tags as $tag) {
				$str_tags .= "<a href='tags.php?tag=$tag' class='btn btn-primary'>$tag</a>" . " ";
			}

			$str .= "           <div class='single-post'>
                  <div class='feature-img'>
                     <img class='img-fluid' src='Admin/$image' alt=''>
                  </div>
                  <div class='blog_details'>
                     <h2>$title
                     </h2>
                     <ul class='blog-info-link mt-3 mb-4'>
                        <li><a href='#'><i class='fa fa-cubes'></i> $post_category</a></li>
                        <li><a href='#'><i class='fa fa-comments'></i>$comments</a></li>
                        <li><a href='#'><i class='fa fa-eye'></i> $views</a></li>
                     </ul>
                     <p class='post-author'>By <a href='#'>$added_by</a></p>
                     <p class='excert'>
                        $content
                     </p>
                     <div class='quote-wrapper'>
                        <div class='quotes'>
                           MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                           should have to spend money on boot camp when you can get the MCSE study materials yourself at
                           a fraction of the camp price. However, who has the willpower to actually sit through a
                           self-imposed MCSE training.
                        </div>
                     </div>
                      <div class='newspaper-tags  d-flex'>
                                            <span>Tags:$str_tags</span>
                                        </div>

                  </div>
               </div>           
";

                        return $str;
		}
		
		public function getPopularNews() 
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE status='approved' AND timestamped>DATE_SUB(curdate(),INTERVAL 1 WEEK) ORDER BY num_views DESC LIMIT 6");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$title = $row['title'];
				$category = $row['post_category'];
				$image = $row['post_image'];
				$num_likes = $row['num_likes'];
				$post_cat_id = $row['post_cat_id'];
				$sql=mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id=$id AND status='approved'" );
				$comments = mysqli_num_rows($sql);

				$str .= "     <div class='col-lg-4 col-md-4'>
                                            <div class='single-what-news mb-100'>
                                                <div class='what-img'>
                                                    <a href='single-post.php?post_id=$id&cat_r=$category'><img src='Admin/$image' height='200'></a>
                                                </div>
                                                <div class='what-cap'>
                                                    <span class='color1'>$category</span>
                                                           <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png' alt=''> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png' alt=''> <span>$comments</span></a>
                                                    <h4><a href='single-post.php?post_id=$id&cat_r=$category'>$title</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                   ";
			}
			echo $str;
		}

		public function getNewsByTags($tag)
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE tags LIKE '%$tag%' AND status='approved' ORDER BY id DESC LIMIT 10");
			$str = "";
		if (mysqli_num_rows($query) === 0) {
			$str = "<h2 class='text-center text-danger'>No results found!</h2>";
		}	
		else {
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$title = $row['title'];
				$category = $row['post_category'];
				$image = $row['post_image'];
				$post_cat_id = $row['post_cat_id'];
				$num_likes = $row['num_likes'];
				$sql=mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id=$id AND status='approved'" );
				$comments = mysqli_num_rows($sql);

				$str .= "<div class='col-lg-4 '>
                                <div class='single-bottom mb-35'>
                                    <div class='trend-bottom-img mb-30'>
                                       <a href='single-post.php?post_id=$id&cat_r=$category'> <img src='Admin/$image' height='150'></a>
                                    </div>
                                    <div class='trend-bottom-cap'>
                                        <span class='color1'>$category</span>
                                        
                                        <h4><a href='single-post.php?post_id=$id&cat_r=$category'>$title</a></h4>
                                         <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png' alt=''> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png' alt=''> <span>$comments</span></a>
                                    </div>

                                </div>
                                </div>";
			}
		}
			echo $str;
		}
		

		public function getRecentNews() 
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE status='approved' AND timestamped>DATE_SUB(curdate(),INTERVAL 1 WEEK) ORDER BY num_views DESC LIMIT 4");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$title = $row['title'];
				$category = $row['post_category'];
				$image = $row['post_image'];
				$num_likes = $row['num_likes'];
				$post_cat_id = $row['post_cat_id'];
				$sql=mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id=$id AND status='approved'" );
				$comments = mysqli_num_rows($sql);

				$str .= " <div class='col-lg-4 col-md-4'>
                                            <div class='single-what-news mb-100'>
                                                <div class='what-img'>
                                                  <a href='single-post.php?post_id=$id&cat_r=$category'>  <img src='Admin/$image' height='200'></a>
                                                </div>
                                                <div class='what-cap'>
                                                    <span class='color1'>$category</span>
                                                           <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png' alt=''> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png' alt=''> <span>$comments</span></a>
                                                    <h4><a href='single-post.php?post_id=$id&cat_r=$category'>$title</a></h4>
                                                </div>
                                            </div>
                                        </div>";
			}
			echo $str;
		}

		public function getAllPosts() {
		$role = $this->user_obj->getRole();	
 		$query = mysqli_query($this->conn, "SELECT * FROM news ORDER BY id ASC ");
 		$str = "";
 		$role = $this->user_obj->getRole();
 		
 		while ($row = mysqli_fetch_array($query)) {
 			$id = $row['id'];
 			$title = $row['title'];
 			$added_by = $row['added_by'];
 			$role = $row['role'];
 			$category = $row['post_category'];
 			$type = $row['type'];
 			$num_views = $row['num_views'];
 			$status = $row['status'];
 			if($status === 'unapproved') {
  				$str .= "<tr>" .
 						"<td>{$id}</td>".
 						"<td>{$title}</td>".
 						"<td>{$added_by}</td>".
 						"<td>{$role}</td>".
 						"<td>{$category}</td>".
 						"<td>{$type}</td>".
 						"<td>{$num_views}</td>".
 						"<td><a href='edit_post.php?pos_id=$id' class='btn btn-primary'>Edit</a></td>".
 						"<td><a href='post.php?d_post_id=$id' class='btn btn-danger'>Delete</a></td>".
 						"<td>{$status}</td>".
 						"<td><a href='includes/function.php?a_post_id=$id' class='btn btn-primary'>Approve</a>".
 						"</tr>";
 			}else{
 				$str .= "<tr>" .
 						"<td>{$id}</td>".
 						"<td>{$title}</td>".
 						"<td>{$added_by}</td>".
 						"<td>{$role}</td>".
 						"<td>{$category}</td>".
 						"<td>{$type}</td>".
 						"<td>{$num_views}</td>".
 						"<td><a href='edit_post.php?pos_id=$id' class='btn btn-primary'>Edit</a></td>".
 						"<td><a href='post.php?d_post_id=$id' class='btn btn-danger'>Delete</a></td>".
 						"<td>{$status}</td>".
 						"<td><a href='includes/function.php?u_post_id=$id' class='btn btn-danger'>Unapprove</a>".
 						"</tr>";
 			}
 		}

 		echo $str; 
 	}

 		public function getUserPosts() {
 		$username = $this->user_obj->getUserName();
 		$id = $this->user_obj-> getID();
 		$query = mysqli_query($this->conn, "SELECT * FROM news WHERE added_by='$id' AND role !='Admin' ORDER BY id ASC");
 		$str = "";
 		

 		while ($row = mysqli_fetch_array($query)) {
 			$id = $row['id'];
 			$title = $row['title'];
 			$added_by = $row['added_by'];
 			$role = $row['role'];
 			$category = $row['post_category'];
 			$type = $row['type'];
 			$num_views = $row['num_views'];
 				$str .= "<tr>" .
 						"<td>{$id}</td>".
 						"<td>{$title}</td>".
 						"<td>{$added_by}</td>".
 						"<td>{$role}</td>".
 						"<td>{$category}</td>".
 						"<td>{$type}</td>".
 						"<td>{$num_views}</td>".
 						"<td><a href='edit_user_post.php?pos_id=$id&added_by=$added_by' class='btn btn-primary'>Edit</a></td>".
 						"<td><a href='post.php?d_post_id=$id&added_by=$added_by' class='btn btn-danger'>Delete</a></td>".
 						"</tr>";
 			
 		}

 		echo $str; 
 	}

 	public function deletePost($id) {
 		$query = mysqli_query($this->conn, "DELETE FROM news WHERE id=$id");
 		if($query) {
 			return true;
 		} else {
 			return false;
 		}
 	}

 	public function deleteUserPost($id) {
 		$uid = $this->user_obj-> getID();
 		$query = mysqli_query($this->conn, "DELETE FROM news WHERE id=$id AND added_by='$uid' AND role !='Admin' ");
 		if($query) {
 			return true;
 		} else {
 			return false;
 		}
 	}

 	public function updatePost($id, $title,$content,$category,$type,$tag,$image) {
 		$sql = mysqli_query($this->conn, "SELECT id FROM category WHERE cat_title='$category'");
				$row = mysqli_fetch_array($sql);
				$cat_id = $row['id'];
 		$query = mysqli_query($this->conn, "UPDATE news SET title='$title',content='$content',post_category='$category',post_cat_id='$cat_id',type='$type',tags='$tag',post_image='$image' WHERE id=$id");
 		if ($query) {
 			return true;
 		} else{
 			return false;
 		}
 	}

 	 	public function updateUserPost($id, $title,$content,$category,$type,$tag,$image) {
 	 		$uid = $this->user_obj-> getID();
 	 		$sql = mysqli_query($this->conn, "SELECT id FROM category WHERE cat_title='$category'");
				$row = mysqli_fetch_array($sql);
				$cat_id = $row['id'];
 		$query = mysqli_query($this->conn, "UPDATE news SET title='$title',content='$content',post_category='$category',post_cat_id='$cat_id',type='$type',tags='$tag',post_image='$image' WHERE added_by='$uid' AND  id=$id AND role !='Admin'");
 		if ($query) {
 			return true;
 		} else{
 			return false;
 		}
 	}




	}