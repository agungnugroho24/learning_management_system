				<!-- user delete modal -->
					<div id="backup_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Duplikasi dokumen?</h3>
					</div>
					<div class="modal-body">
																					<center>
										<div class="control-group">
                                   		<div class="control-group">
                                          <div class="controls">
										  <p>Pindahkan ke:</p>
										  					<div class="control-group">
                                          <div class="controls">
                                            <select name="teacher_class_id"  class="" required>
                                             	<option></option>
																		<?php $query = mysql_query("select * from teacher_class
										LEFT JOIN class ON class.class_id = teacher_class.class_id
										LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
										where teacher_id = '$session_id' and school_year = '$school_year' ")or die(mysql_error());	
										while($row = mysql_fetch_array($query)){
										$id = $row['teacher_class_id'];
										?>		
									
											<option value="<?php echo $row['teacher_class_id']; ?>">

											<?php echo $row['class_name']; ?> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row['subject_code']; ?></option>
									
									<?php } ?>
										
                                            </select>
																	
									
                                          </div>
                                        </div>
										
										  	<button name="share" class="btn btn-success"><i class="icon-copy"></i> Berbagi</button>
                                          </div>
                                        </div>
                                        </div>
										
									
										</center>
										

					</div>
					<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Tutup</button>
				
					</div>
					</div>