<?php
// show all errors and warning
  ini_set('display_errors',0);
  error_reporting(E_ALL);
	include 'DAO/BaseDAO.php';
	class MainDAO extends BaseDAO{
		
		function GetUserFullName($UserID){
		
			$this->openCon();
				
				$sql = "SELECT ui.users_info_ID,ui.Fname,ui.Lname,ui.Nname FROM users AS u, users_info AS ui
						WHERE u.usersID = ui.usersID AND ui.usersID = ?";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$UserID);
				$stmt->execute();
				
			$this->closeCon();
		
			$info = $stmt->fetch();
			return "<span class='profilename' id='".$info[0]."'>".$info[1]." ".$info[2]."<span class='nickname'> (".$info[3].")</span></span>";
			
		}
		
		function CountUsersOnline(){
		
			$this->openCon();
				
				$sql = "SELECT COUNT(usersID) FROM users WHERE status = 'online'";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$UserID);
				$stmt->execute();
				
			$this->closeCon();
			
			$NumberOfUser = $stmt->fetch();
			return $NumberOfUser[0];
		}
		
		function GetListOfUsers($name){
		   	   
			$this->openCon();
				
				$sql = "SELECT users_info_ID,Fname,Lname FROM users_info
						WHERE Fname LIKE '".$name."%' OR Lname LIKE '".$name."%'";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->execute();
				
				
	   	$this->closeCon();
	   	
	   	while($row = $stmt->fetch()){
			      echo "<span id='search".$row[0]."'> ".$row[1]." ".$row[2]. "<br /></span>";
		   }
			   
						
		}
	
		function SaveChatMsg($UserID,$Msg){
		   	   
			$this->openCon();
				
				$sql = "INSERT INTO public_chat_msg VALUES(null,?,?)";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$UserID);
				$stmt->bindParam(2,$Msg);
				$stmt->execute();
				
		  	$sql_del = "DELETE FROM public_chat_msg WHERE message IS NULL OR message = ''";
				$stmt = $this->dbCon->prepare($sql_del);
				$stmt->execute();	
								
	   	$this->closeCon();
	   	
		}
		
		function RefreshPubChat(){
		
		    	   
			$this->openCon();
				
				$sql = "SELECT pcm.pcmID,ui.Fname,ui.Lname,pcm.message FROM users_info AS ui,users AS u,public_chat_msg AS pcm
				        WHERE pcm.usersID= ui.usersID AND ui.usersID = u.usersID ORDER BY pcm.pcmID";
				$stmt = $this->dbCon->prepare($sql);
				
				$stmt->execute();
								
			$this->closeCon();
				
				while($row = $stmt->fetch()){
				
					if($row[3] == 'smiley_bleeh.png' || $row[3] == 'smiley_cool.png' || $row[3] == 'smiley_rar.png' || $row[3] == 'smiley_robot.png'){
						$row[3] = "<img src = 'images/".$row[3]."' alt='smiley_icon'  />";
					}
					echo "<span id='chat".$row[0]."' class='ChatUser'>".$row[1]." ".$row[2]." :</span>"."&nbsp".$row[3]."<br/>";			  
				}
			
		}
		
		function SaveUploaded_Img($UserID,$NewProfilePic){
		
			$this->openCon();
				
				$sql = "SELECT * FROM profile_pics WHERE usersID = ?";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$UserID);				
				$stmt->execute();
				
				$found = $stmt->fetch();
				
				if($found[0] == "" || $found[0] == null){
					$sql2 = "INSERT INTO profile_pics VALUES(null,?,?)";
					$stmt = $this->dbCon->prepare($sql2);
					$stmt->bindParam(1,$UserID);			
					$stmt->bindParam(2,$NewProfilePic);		
					$stmt->execute();	
					
				}else{
					$sql2 = "UPDATE profile_pics SET pic_name = ? WHERE usersID = ?";
					$stmt = $this->dbCon->prepare($sql2);				
					$stmt->bindParam(1,$NewProfilePic);	
					$stmt->bindParam(2,$UserID);				
					$stmt->execute();	
					return 'not found';
					
				}
				
			
	   	$this->closeCon();
	   	
		}
		
		function GetUsersProfile_Pic($UserID){
		
			$this->openCon();
				
				$sql = "SELECT pp.pic_name FROM profile_pics AS pp, users as u WHERE pp.usersID = u.usersID AND pp.usersID=?";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$UserID);				
				$stmt->execute();
			
				
				$Pic_name = $stmt->fetch();
				
			$this->closeCon();
			
			return $Pic_name[0];
	   	
		}
		
		function SaveUsersPost($UserID,$Users_Post,$P_date){
				
			$this->openCon();
				
				$sql = "INSERT INTO users_post values(null,?,?,?)";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$UserID);	
				$stmt->bindParam(2,$Users_Post);
				$stmt->bindParam(3,$P_date);			
				$stmt->execute();								
							
				$sql_del = "DELETE FROM users_post WHERE users_post IS NULL OR users_post = ''";
				$stmt = $this->dbCon->prepare($sql_del);
				$stmt->execute();	
				
			$this->closeCon();
		
		}
		
		
		function GetUsersPost($UserID){
		
		    $this->openCon();
				
				$sql = "SELECT p.postID,ui.Fname,ui.Lname,p.users_post,p.date_posted,u.usersID FROM users as u, users_post as p, users_info as ui
				        WHERE ui.usersID = u.usersID AND p.usersID = u.usersID ORDER BY postID DESC";
				$stmt = $this->dbCon->prepare($sql);		
				$stmt->execute();				
				
		
			while($row = $stmt->fetch()){
			
				$sql_stat = "SELECT ps.status FROM post_status as ps, users as u, users_post as up WHERE ps.postID = up.postID 
							AND ps.postID = ? AND ps.usersID=u.usersID AND ps.usersID=?";
				$stmt_stat= $this->dbCon->prepare($sql_stat);
				$stmt_stat->bindParam(1,$row[0]);
				$stmt_stat->bindParam(2,$UserID);
				$stmt_stat->execute();
				$status = $stmt_stat->fetch();
				
				if($status[0] == ""){
					$status[0] = 'Like';
				}else if($status[0] == 'Like'){
					$status[0] = 'Unlike';
				}else{
					$status[0] = 'Like';
				}
				
				$sql_countlike = "SELECT COUNT(status) FROM post_status WHERE postID = ? AND status='Like'";
				$stmt_countlike= $this->dbCon->prepare($sql_countlike);
				$stmt_countlike->bindParam(1,$row[0]);
				$stmt_countlike->execute();
				$n_likes = $stmt_countlike->fetch();
				
				$sql_profile_pic = "SELECT pics.pic_name FROM profile_pics AS pics, users_post AS up, users AS u
									WHERE pics.usersID = up.usersID AND up.usersID = u.usersID AND up.postID = ?";
				$stmt_profile_pic= $this->dbCon->prepare($sql_profile_pic);
				$stmt_profile_pic->bindParam(1,$row[0]);
				$stmt_profile_pic->execute();
				$profile_img =$stmt_profile_pic->fetch();
				if($profile_img[0]==""){
					$profile_img[0] = 'images/p.jpg';
				}
				
				$comments="";
				$sql_post_comment = "SELECT ui.Fname,ui.Lname, pc.comment FROM post_comment AS pc,users AS u, users_post AS up, users_info AS ui
									WHERE up.postID =pc.postID AND u.usersID = ui.usersID AND u.usersID = pc.usersID
									AND pc.postID=? ORDER BY pc.post_commentID DESC";
				$stmt_post_comment = $this->dbCon->prepare($sql_post_comment);
				$stmt_post_comment ->bindParam(1,$row[0]);
				$stmt_post_comment->execute();
				
				while($users_comment = $stmt_post_comment->fetch()){
					$comments = "<span class='commentor_name'>".$users_comment[0]." ".$users_comment[1].":
					</span> <span class='comment_content'>".$users_comment[2]."</span><br/> ".$comments;
				}
				
						
				//$sql_commentator_name = "SELECT ui.Fname,ui.Lname FROM users_info AS ui, users AS u WHERE ui.usersID=u.usersID AND ui.usersID=? ";
			//	$stmt_commentator_name = $this->dbCon->prepare($sql_commentator_name);
			//	$stmt_commentator_name ->bindParam(1,$UserID);
			//	$stmt_commentator_name->execute();
			//	$commentator_name = $stmt_commentator_name->fetch();
				
				$class_for_posted_name="";
				if($row[5] == 24 || $row[5] == 25){
				  $class_for_posted_name = 'Users_Posted_Name_admin';
				  $row[2] = $row[2]." <span class='admin_label'>-[admin]-</span> ";
				}else{
				 $class_for_posted_name = 'Users_Posted_Name';
				}
				  $type='true';
			    echo "<div class='Displayed_Post' id=".$row[0]."><img src='".$profile_img[0]."' alt='profile image' class='post_img' OnClick="."InlargeProfilePic('".$profile_img[0]."')"." title='Click To View In A Larger Image!' />
			            <p class='".$class_for_posted_name."'>".$row[1]." ".$row[2].":</p>
			            <p class='Users_Posted_Content'>".$row[3]."</p>
			            <span class='Date_Posted'>".$row[4]."<br/></span>
			            <div class='Post_Actions'><span class='like_btn' OnClick="."Post_status(".$row[0].",'".$status[0]."')"."> ".$status[0]."</span> 
						&nbsp comment &nbsp share &nbsp <span class='remove_btn' OnClick="."Remove_post(".$row[0].")".">remove</span> 
						<span class='num_likes'>[".$n_likes[0]." person like this]</span></div><br/>
						<textarea id='post_comment_".$row[0]."' class='post_comment' placeholder='Enter your comment here' onkeyup= 'StopPostInterval()' onblur='SetIntervalForPost()'></textarea>
						<button class='comment_btn' OnClick='SavePostComment(".$row[0].",".$type.")'".">comment</button>
						<div id='div-post-comment_".$row[0]."' class='comment_area'><span class='comment_title'>Comment Area:</span> <br/><br/>".$comments."<br/></div>
							
						
						<hr/>
			         </div>";
			}
			
			$this->closeCon();
		}
		
		function UpdatePostStatus($postID,$userID,$status){
	
		 	$this->openCon();
				
				$sql = "SELECT ps.status FROM post_status as ps, users_post as up WHERE ps.postID=up.postID AND ps.postID=? AND ps.usersID =?";
				$stmt = $this->dbCon->prepare($sql);	
				$stmt->bindParam(1,$postID);
				$stmt->bindParam(2,$userID);
				$stmt->execute();
				$exist = $stmt->fetch();
				if($exist[0] == ""){
					$sql2 = "INSERT INTO post_status VALUES(null,?,?,?)";
					$stmt2 = $this->dbCon->prepare($sql2);
					$stmt2->bindParam(1,$postID);
					$stmt2->bindParam(2,$userID);
					$stmt2->bindParam(3,$status);
					$stmt2->execute();
				}else{
					$sql2 = "UPDATE post_status SET status=? WHERE postID = ? AND usersID=?";
					$stmt2 = $this->dbCon->prepare($sql2);
					$stmt2->bindParam(1,$status);
					$stmt2->bindParam(2,$postID);
					$stmt2->bindParam(3,$userID);				
					$stmt2->execute();	
				}
				
			$this->closeCon();
		}
		
		function SavePostComment($UserID,$PostID,$Comment){
		
			$this->openCon();
				
				$status = '0';
				$sql = "INSERT INTO post_comment values(null,?,?,?,?)";
				$stmt = $this->dbCon->prepare($sql);					
				$stmt->bindParam(1,$PostID);
				$stmt->bindParam(2,$UserID);
				$stmt->bindParam(3,$Comment);
				$stmt->bindParam(4,$status);			
				
				$stmt->execute();
				
					
				$pcID = $this->dbCon->lastInsertId();
				$sql_select = "SELECT comment FROM post_comment WHERE comment != '' AND post_commentID =?";
				$stmt_select = $this->dbCon->prepare($sql_select);
				$stmt_select->bindParam(1,$pcID);
        $stmt_select ->execute();
        $cm =  $stmt_select ->fetch();
          
				$sql_del = "DELETE FROM post_comment WHERE comment IS NULL OR comment = ''";
				$stmt = $this->dbCon->prepare($sql_del);
				$stmt->execute();
			
        
        
			$this->closeCon();
			
			if($cm[0] != ""){
				echo true;
			}else{
				echo false;
			}
		
	  }
	  
	  function CountCommentNotifications($UserID){
	  
		 	$this->openCon();
				
				$sql = "SELECT COUNT(pc.post_commentID) FROM post_comment AS pc,users_post AS up, users AS u 
				        WHERE pc.postID = up.postID AND up.usersID = u.usersID AND up.usersID = ? AND pc.usersID != ? AND pc.status = 0";
				$stmt = $this->dbCon->prepare($sql);	
				$stmt->bindParam(1,$UserID);
				$stmt->bindParam(2,$UserID);
				$stmt->execute();
				$notifications = $stmt->fetch();
				
			$this->closeCon();
			
			echo $notifications[0];
			
	  }
	  
	  function DisplayNotification($UserID){
	  
	  	$this->openCon();
				
				$sql = "SELECT pc.postID,ui.Fname,ui.Lname FROM users_info AS ui, post_comment AS pc, users_post AS up, users AS u
				        WHERE ui.usersID = u.usersID AND pc.usersID = u.usersID AND  pc.postID = up.postID AND pc.usersID != ?";
				$stmt = $this->dbCon->prepare($sql);	
				$stmt->bindParam(1,$UserID);
				$stmt->execute();
				
				$sql_upt = "UPDATE post_comment AS pc, users_post AS up SET pc.status=1 WHERE pc.postID = up.postID AND up.usersID=? ";
				$stmt_upt = $this->dbCon->prepare($sql_upt);	
				$stmt_upt->bindParam(1,$UserID);
				$stmt_upt->execute();
				
			$this->closeCon();
			
			while($notifications = $stmt->fetch()){
			   echo "<p id='postID_".$notifications[0]."' class='displayed_notification' onclick='Display_SelectedPost(".$notifications[0].")'>
			    <span class='notification_name'>".$notifications[1]." ".$notifications[2]."</span>
			    commented on your post</p>";
			}
			
	  }
	  
	  function Display_SelectedPost($UserID,$postID){
	    
	    $this->openCon();
	    
	    		$sql_stat = "SELECT ps.status FROM post_status as ps, users as u, users_post as up WHERE ps.postID = up.postID
	    		             AND ps.postID = ? AND ps.usersID=u.usersID AND ps.usersID=?";
				  $stmt_stat= $this->dbCon->prepare($sql_stat);
				  $stmt_stat->bindParam(1,$postID);
				  $stmt_stat->bindParam(2,$UserID);
				  $stmt_stat->execute();
				  $status = $stmt_stat->fetch();
				
				  if($status[0] == ""){
					  $status[0] = 'Like';
				  }else if($status[0] == 'Like'){
					  $status[0] = 'Unlike';
				  }else{
					  $status[0] = 'Like';
				  }
				
				  $sql_countlike = "SELECT COUNT(status) FROM post_status WHERE postID = ? AND status='Like'";
				  $stmt_countlike= $this->dbCon->prepare($sql_countlike);
				  $stmt_countlike->bindParam(1,$postID);
				  $stmt_countlike->execute();
				  $n_likes = $stmt_countlike->fetch();
				
				  $sql_profile_pic = "SELECT pics.pic_name FROM profile_pics AS pics, users_post AS up, users AS u
									  WHERE pics.usersID = up.usersID AND up.usersID = u.usersID AND up.postID = ?";
				  $stmt_profile_pic= $this->dbCon->prepare($sql_profile_pic);
				  $stmt_profile_pic->bindParam(1,$postID);
				  $stmt_profile_pic->execute();
				  $profile_img =$stmt_profile_pic->fetch();

				  if($profile_img[0]==""){
					  $profile_img[0] = 'images/p.jpg';
				  }
				  
				  $sql_checkifadmin = "SELECT usersID FROM users_post WHERE postID = ?";
				  $stmt_checkifadmin  = $this->dbCon->prepare( $sql_checkifadmin);
				  $stmt_checkifadmin  ->bindParam(1,$UserID);
				  $stmt_checkifadmin  ->execute();
				  $checkifadmin = $stmt_checkifadmin->fetch();
				  
				  $sql_usersPost = "SELECT ui.Fname,ui.Lname,up.users_post,up.date_posted
	                      FROM users_info AS ui, users AS u, users_post AS up WHERE ui.usersID=u.usersID 
	                      AND up.usersID = u.usersID AND up.postID=? ";
				  $stmt_usersPost= $this->dbCon->prepare($sql_usersPost);
				  $stmt_usersPost ->bindParam(1,$postID);
				  $stmt_usersPost->execute();
				  $usersPost =  $stmt_usersPost->fetch();
				  $class_for_posted_name="";
				  if( $checkifadmin[0] == 24 || $checkifadmin[0] == 25){
				    $class_for_posted_name = 'Users_Posted_Name_admin';
				    $usersPost[1] = $usersPost[1]." <span class='admin_label'>-[admin]-</span> ";
				  }else{
				   $class_for_posted_name = 'Users_Posted_Name';
				  }
				  
				  $comments="";
				  $sql_post_comment = "SELECT ui.Fname,ui.Lname, pc.comment FROM post_comment AS pc,users AS u, users_post AS up, users_info AS ui
									  WHERE up.postID =pc.postID AND u.usersID = ui.usersID AND u.usersID = pc.usersID
									  AND pc.postID=? ORDER BY pc.post_commentID DESC";
				  $stmt_post_comment = $this->dbCon->prepare($sql_post_comment);
				  $stmt_post_comment ->bindParam(1,$postID);
				  $stmt_post_comment->execute();
				
				  while($users_comment = $stmt_post_comment->fetch()){
					  $comments = "<span class='commentor_name'>".$users_comment[0]." ".$users_comment[1].":
					  </span> <span class='comment_content'>".$users_comment[2]."</span><br/> ".$comments;
				  }
	

			$this->closeCon();

				  
				  echo "<div class='Displayed_Post' id=disp_post_".$postID.">
				        <img src='".$profile_img[0]."' alt='profile image' class='post_img' 
				        OnClick="."InlargeProfilePic('".$profile_img[0]."')"." title='Click To View In A Larger Image!' />
						<p class='".$class_for_posted_name."'>". $usersPost[0]." ". $usersPost[1].":</p>
						<p class='Users_Posted_Content'>".$usersPost[2]."</p>
						<span class='Date_Posted'>".$usersPost[3]."<br/></span>
						<div class='Post_Actions'><span class='like_btn' OnClick="."Post_status(".$postID.",'".$status[0]."')"."> ".$status[0]."</span> 
						&nbsp comment &nbsp share &nbsp <span class='remove_btn' OnClick="."Remove_post(".$postID.")".">remove</span> 
						<span class='num_likes'>[".$n_likes[0]." person like this]</span></div><br/>					    
						<textarea id='select_post_comment_".$postID."' class='post_comment' placeholder='Enter your comment here' onkeyup= 'StopPostInterval()' onblur='SetIntervalForPost()' ></textarea>
						<button class='comment_btn' OnClick='SavePostComment(".$postID.")'".">comment</button>
						<div id='div-selected_post-comment_".$postID."' class='comment_area'><span class='comment_title'>Comment Area:</span> <br/><br/>".$comments."<br/></div>
							
						
						<hr/>
			         </div>";
				
	  }
}






















?>
