<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('content_sidebar.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					 <a href="" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Tambah konten</a>
							<!-- block -->
		                        <div class="block">
		                            <div class="navbar navbar-inner block-header">
		                                <div class="muted pull-left">Ubah konten</div>
		                            </div>
		                            <div class="block-content collapse in">
									<a href="content.php"><i class="icon-arrow-left"></i> Kembali</a>
									   <?php
									   $query = mysql_query("select * from content where content_id = '$get_id'")or die(mysql_error());
									   $row = mysql_fetch_array($query);
									   ?>
									   
									   <form class="form-horizontal" method="POST">
										<div class="control-group">
										<label class="control-label" for="inputEmail">Judul</label>
										<div class="controls">
										<input type="text" name="title" id="inputEmail" placeholder="Judul" value="<?php echo $row['title']; ?>">
										</div>
										</div>
										
												<div class="control-group">
										<label class="control-label" for="inputPassword">Konten</label>
										<div class="controls">
												<textarea name="content" id="ckeditor_full">
												<?php echo $row['content']; ?>
												</textarea>
										</div>
										</div>
												
																		
											
										<div class="control-group">
										<div class="controls">
										
										<button name="update" type="submit" class="btn btn-info"><i class="icon-save icon-large"></i> Ubah</button>
										</div>
										</div>
										</form>
										
										<?php
										if (isset($_POST['update'])){
										$title = $_POST['title'];
										$content = $_POST['content'];
										mysql_query("update content set title = '$title' , content = '$content' where content_id = '$get_id'")or die(mysql_error());
										?>
										<script>
										window.location = 'content.php';
										</script>
										<?php
										}
										?>
									
								
		                            </div>
		                        </div>
		                        <!-- /block -->
                    </div>


                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>

</html>