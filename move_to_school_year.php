				<!-- user delete modal -->
					<div id="user_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Duplikasi dokumen?</h3>
					</div>
					<div class="modal-body">
				
										<center>
										<div class="control-group">
											<label>Ke tahun ajaran:</label>
                                          <div class="controls">
										  	<input type="hidden" name="get_id" value="<?php echo $get_id; ?>">
                                            <select name="school_year"  class="">
                                            <option></option>
											<?php
											$query1 = mysql_query("select * from teacher_class where class_id ='$class_id' and school_year != '$school_year'")or die(mysql_error());
											while($row = mysql_fetch_array($query1)){
											
											?>
											<option><?php echo $row['school_year']; ?></option>
											<input type="hidden" name="teacher_class_id" value="<?php echo $row['teacher_class_id']; ?>">
											<?php } ?>
                                            </select>
                                          </div>
                                        </div>
										
											<div class="control-group">
                                          <div class="controls">
										  	<button name="delete_user" class="btn btn-danger"><i class="icon-copy"></i> Duplikasi</button>
                                          </div>
                                        </div>
										</center>
										
											<center>
										<div class="control-group">
											<label>------------Atau----------</label>
                                   		<div class="control-group">
                                          <div class="controls">
										  	<button name="copy" class="btn btn-info"><i class="icon-copy"></i> Duplikasi ke ransel</button>
                                          </div>
                                        </div>
                                        </div>
										
									
										</center>
										
										
																					<center>
										<div class="control-group">
											<label>------------Atau----------</label>
                                   		<div class="control-group">
                                          <div class="controls">
										  <p>Berbagi ke:</p>
										  					<div class="control-group">
											<label>Ke:</label>
                                          <div class="controls">
                                            <select name="teacher_id1"  class="" required>
                                             	<option></option>
											<?php
											$query = mysql_query("select * from teacher order by firstname");
											while($row = mysql_fetch_array($query)){
											
											?>
											
											<option value="<?php echo $row['teacher_id']; ?>"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?> </option>
											
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