<?php  include('header.php'); ?>
<?php  include('session.php'); ?>
    <body>
		<?php include('navbar.php') ?>
        <div class="container-fluid">
            <div class="row-fluid">
					<?php include('sidebar_dashboard.php'); ?>
                <!--/span-->
                <div class="span9" id="content">
						<div class="row-fluid"></div>
						
                    <div class="row-fluid">
            
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Jumlah data</div>
                            </div>
                            <div class="block-content collapse in">
							        <div class="span12">
						
									
								
								<?php 
								$query_teacher = mysql_query("select * from teacher")or die(mysql_error());
								$count_teacher = mysql_num_rows($query_teacher);
								?>
								
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_teacher; ?>"><?php echo $count_teacher ?></div>
                                    <div class="chart-bottom-heading"><strong>Guru</strong>

                                    </div>
                                </div>
								
								
								
								
										<?php 
								$query_student = mysql_query("select * from student")or die(mysql_error());
								$count_student = mysql_num_rows($query_student);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_student ?>"><?php echo $count_student ?></div>
                                    <div class="chart-bottom-heading"><strong>Murid</strong>

                                    </div>
                                </div>
								
								
								
								
							
								
									<?php 
								$query_class = mysql_query("select * from class")or die(mysql_error());
								$count_class = mysql_num_rows($query_class);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_class; ?>"><?php echo $count_class; ?></div>
                                    <div class="chart-bottom-heading"><strong>Kelas</strong>

                                    </div>
                                </div>
								
								
										<?php 
								$query_file = mysql_query("select * from files")or die(mysql_error());
								$count_file = mysql_num_rows($query_file);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_file; ?>"><?php echo $count_file; ?></div>
                                    <div class="chart-bottom-heading"><strong>Dokumen yang bisa diunduh</strong>

                                    </div>
                                </div>
								
								
										<?php 
								$query_subject = mysql_query("select * from subject")or die(mysql_error());
								$count_subject = mysql_num_rows($query_subject);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_subject; ?>"><?php echo $count_subject; ?></div>
                                    <div class="chart-bottom-heading"><strong>Mata pelajaran</strong>

                                    </div>
                                </div>
						
						
                            </div>
                        </div>
                        <!-- /block -->
						
                    </div>
                    </div>
                
                
                 
                 
                </div>
            </div>
    
         <?php include('footer.php'); ?>
        </div>
	<?php include('script.php'); ?>
    </body>

</html>