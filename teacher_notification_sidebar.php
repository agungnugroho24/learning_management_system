<div class="span3" id="sidebar">
	<img id="avatar" class="img-polaroid" src="admin/<?php echo $row['location']; ?>">
	<?php include('teacher_count.php'); ?>
	<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
		<li class=""><a href="dasboard_teacher.php"><i class="icon-chevron-right"></i><i class="icon-group"></i>&nbsp;Kelasku</a></li>
		<li class=""><a href="teacher_forum.php"><i class="icon-chevron-right"></i><i class="icon-group"></i>&nbsp;Forum</a></li>
		<li class="active"><a href="notification_teacher.php"><i class="icon-chevron-right"></i><i class="icon-info-sign"></i>&nbsp;Pemberitahuan
			<?php if($not_read == '0'){
				}else{ ?>
					<span class="badge badge-important"><?php echo $not_read; ?></span>
				<?php } ?>
		</a></li>
		<li class=""><a href="teacher_message.php"><i class="icon-chevron-right"></i><i class="icon-envelope-alt"></i>&nbsp;Pesan</a></li> 
		<li class=""><a href="teacher_backack.php"><i class="icon-chevron-right"></i><i class="icon-suitcase"></i>&nbsp;Ransel</a></li> 
		<li class=""><a href="add_downloadable.php"><i class="icon-chevron-right"></i><i class="icon-plus-sign"></i>&nbsp;Tambah dokumen</a></li> 
		<li class=""><a href="add_announcement.php"><i class="icon-chevron-right"></i><i class="icon-plus-sign"></i>&nbsp;Tambah pengumuman</a></li> 
		<li class=""><a href="add_assignment.php"><i class="icon-chevron-right"></i><i class="icon-plus-sign"></i>&nbsp;Tambah tugas</a></li>
		<li class=""><a href="teacher_quiz.php"><i class="icon-chevron-right"></i><i class="icon-list"></i>&nbsp;Ulangan</a></li>
		<li class=""><a href="teacher_share.php"><i class="icon-chevron-right"></i><i class="icon-file"></i>&nbsp;Berbagi dokumen</a></li>
	<?php include('search_other_class.php'); ?>	
</div>

