   <div class="row-fluid">
       <a href="teachers.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Tambah guru</a>
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Ubah guru</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<form method="post">
								<!--
										<label>Photo:</label>
										<div class="control-group">
                                          <div class="controls">
                                               <input class="input-file uniform_on" id="fileInput" type="file" required>
                                          </div>
                                        </div>
									-->	
									<?php
									$query = mysql_query("select * from teacher where teacher_id = '$get_id' ")or die(mysql_error());
									$row = mysql_fetch_array($query);
									?>
										
										  <div class="control-group">
											<label>Pilihan kelas:</label>
                                          <div class="controls">
                                            <select name="department"  class="chzn-select"required>
											<?php
											$query_teacher = mysql_query("select * from teacher join  department")or die(mysql_error());
											$row_teacher = mysql_fetch_array($query_teacher);
											
											?>
											
                                             	<option value="<?php echo $row_teacher['department_id']; ?>">
												<?php echo $row_teacher['department_name']; ?>
												</option>
											<?php
											$department = mysql_query("select * from department order by department_name");
											while($department_row = mysql_fetch_array($department)){
											
											?>
											<option value="<?php echo $department_row['department_id']; ?>"><?php echo $department_row['department_name']; ?></option>
											<?php } ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" value="<?php echo $row['username']; ?>" name="username" id="focusedInput" type="text" placeholder = "Nomor induk">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" value="<?php echo $row['firstname']; ?>" name="firstname" id="focusedInput" type="text" placeholder = "Nama depan">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" value="<?php echo $row['lastname']; ?>"  name="lastname" id="focusedInput" type="text" placeholder = "Nama belakang">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" value="<?php echo $row['password']; ?>"  name="password" id="focusedInput" type="text" placeholder = "Kata sandi">
                                          </div>
                                        </div>
										
										
									
											<div class="control-group">
                                          <div class="controls">
												<button name="update" class="btn btn-success"><i class="icon-save icon-large"></i></button>

                                          </div>
                                        </div>
                                </form>
								</div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
					
					
				   <?php
                            if (isset($_POST['update'])) {
                       
                                $firstname = $_POST['firstname'];
                                $lastname = $_POST['lastname'];
                                $department_id = $_POST['department'];
								$username = $_POST['username'];
								$password = $_POST['password'];
								
								$query = mysql_query("select * from teacher where firstname = '$firstname' and lastname = '$lastname' ")or die(mysql_error());
								$count = mysql_num_rows($query);
								
								if ($count > 1){ ?>
								<script>
								alert('Data Already Exist');
								</script>
								<?php
								}else{
								
								mysql_query("update teacher set firstname = '$firstname' , lastname = '$lastname' , department_id = '$department_id', username = '$username', password = '$password' where teacher_id = '$get_id' ")or die(mysql_error());	
								
								?>
								<script>
							 	window.location = "teachers.php"; 
								</script>
								<?php   }} ?>
						 
						 