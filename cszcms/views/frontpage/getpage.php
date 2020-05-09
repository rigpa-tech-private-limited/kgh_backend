<?php
if ($page_rs !== false) {
    $totSegments = $this->uri->total_segments();
    $bannerData = ($this->RestModel->web_banner_data());
    $programData = ($this->RestModel->program_data());
    $aboutUsData = ($this->RestModel->article_data(1));
    $sportsCenterData = ($this->RestModel->sportscenter_data(89));
    $studentData = ($this->RestModel->student_data());
    $admissionCriteria = $studentData[0]['subs'];
    $campusLife = $studentData[1]['subs'];
    $internationalStudentsData = ($this->RestModel->article_data(4));
    // echo '<pre>';
    // print_r($campusLife);
    //echo $content = $this->Csz_model->getHtmlContent($page_rs->content, $this->uri->segment($totSegments));?>
<!-- Banner -->
	<div class="slider">
	<div class="install-txt"><h4>Download Our App</h4></div>
		<a href="https://itunes.apple.com/in/app/au-graduate-studies/id1307434400?mt=8" target="_blank" class="app_store">
		<img src="<?php echo base_url() ?>templates/cszdefault/imgs/app_store.png" />
		</a>
		<a href="https://play.google.com/store/apps/details?id=grad.au.edu&hl=en_US" target="_blank" class="play_store">
		<img src="<?php echo base_url() ?>templates/cszdefault/imgs/play_store.png" />
		</a>
		<div class="scroll_down">
		<a href="#courses" class="scroll_down_a">
		<img src="<?php echo base_url() ?>templates/cszdefault/imgs/scroll_down.png"></a>
		</div>
		<div  id="top" class="callbacks_container-wrap">
			<ul class="rslides" id="slider3">
			<?php for ($i=0;$i<count($bannerData);$i++) {
        ?>
				<li>
					<div class="<?=($i!=0)?"slider1 ":""?>slider<?php echo($i+1); ?>" style="background-image:url('<?php echo $bannerData[$i]["URL"]?>')"></div>
				</li>
			<?php
    } ?>
			</ul>
		</div>
	</div>
<!-- /Banner -->
<section id="install-section">

<h4>Download Our App</h4>
<div class="install-imgs">
<div class="install-inner">
<a href="https://itunes.apple.com/in/app/au-graduate-studies/id1307434400?mt=8" target="_blank" class="app_store">
<img src="http://assumptionuniversity.in/templates/cszdefault/imgs/app_store.png" />
</a>
<a href="https://play.google.com/store/apps/details?id=grad.au.edu&amp;hl=en_US" target="_blank" class="play_store">
<img src="http://assumptionuniversity.in/templates/cszdefault/imgs/play_store.png" />
</a>
</div>
</div>
</section>
<!-- About -->
<section id="courses">
<div class="container">
<div class="row">
<div class="col-sm-12">
  <div id="myCarousel" class="row carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="courseitem item active">

        <ul class="thumbnails">
          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course1.jpg" title="">
              <img src="<?php echo base_url() ?>templates/cszdefault/imgs/course1.jpg" alt="">
              </a>
            </div>
            <!--div class="caption-box">
              <h4>Praesent commodo</h4>
            </div-->
          </li>

          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course2.jpg" title="">
              	<img src="<?php echo base_url() ?>templates/cszdefault/imgs/course2.jpg" alt="">
              </a>
            </div>
          </li>

          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course3.jpg" title="">
              	<img src="<?php echo base_url() ?>templates/cszdefault/imgs/course3.jpg" alt="">
              </a>
            </div>
          </li>

          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course4.jpg" title="">
              	<img src="<?php echo base_url() ?>templates/cszdefault/imgs/course4.jpg" alt="">
              </a>
            </div>
          </li>
        </ul>
      </div><!-- /Slide1 -->

	  <div class="courseitem item">

        <ul class="thumbnails">
          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course5.jpg" title="">
              <img src="<?php echo base_url() ?>templates/cszdefault/imgs/course5.jpg" alt="">
              </a>
            </div>
            <!--div class="caption-box">
              <h4>Praesent commodo</h4>
            </div-->
          </li>

          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course6.jpg" title="">
              	<img src="<?php echo base_url() ?>templates/cszdefault/imgs/course6.jpg" alt="">
              </a>
            </div>
          </li>

          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course7.jpg" title="">
              	<img src="<?php echo base_url() ?>templates/cszdefault/imgs/course7.jpg" alt="">
              </a>
            </div>
          </li>

          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course8.jpg" title="">
              	<img src="<?php echo base_url() ?>templates/cszdefault/imgs/course8.jpg" alt="">
              </a>
            </div>
          </li>
        </ul>
      </div><!-- /Slide2 -->

      <div class="courseitem item">

        <ul class="thumbnails">
          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course9.jpg" title="">
              <img src="<?php echo base_url() ?>templates/cszdefault/imgs/course9.jpg" alt="">
              </a>
            </div>
            <!--div class="caption-box">
              <h4>Praesent commodo</h4>
            </div-->
          </li>

          <li class="col-sm-3">
            <div class="thumbnail">
              <a class="a-course" href="<?php echo base_url() ?>templates/cszdefault/imgs/course10.jpg" title="">
              	<img src="<?php echo base_url() ?>templates/cszdefault/imgs/course10.jpg" alt="">
              </a>
            </div>
          </li>
        </ul>
      </div><!-- /Slide2 -->

    </div><!-- /Wrapper for slides .carousel-inner -->



    <!-- Control box -->
    <div class="control-box">
      <a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
      <a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
    </div><!-- /.control-box -->



  </div><!-- /#myCarousel -->


</div><!-- /.col-sm-12 -->
</div><!-- /.row -->
</div><!-- /.container -->
</section>
<section id="about">
	<div class="about">
	<div class="container">
		<div class="abouttop">
			<h3>ABOUT AU</h3>
			<label class="line"></label>
			<!-- <h6>Assumption University is a private Catholic university with three campuses in different locations- Huamak near Rajamangala National Stadium, Central World Plaza in downtown Bangkok, and Suvarnabhumi areas of Samut Prakan Province, Thailand.</h6> -->
			<?php if (count($aboutUsData)>0) {
        ?>
			<div class="col-md-4 aboutleft">
				<h4><?php echo $aboutUsData[0]['title']; ?></h4>
                <img src="<?php echo $aboutUsData[0]['image']; ?>" class="welcome-img" />
                <div class="about-left-bottom">
					<div class="about-content">
					<?php echo $aboutUsData[0]['note']; ?>
					</div>
					<a href="#" data-toggle="modal" data-target="#myModal">EXPLORE</a>
			        <!-- Modal -->
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog">
							<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4><?php echo $aboutUsData[0]['title']; ?></h4>
										<img src="<?php echo $aboutUsData[0]['image']; ?>">
										<?php echo $aboutUsData[0]['note']; ?>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			<div class="col-md-8 aboutmiddle">
				<img src="<?php echo $aboutUsData[0]['image']; ?>">
			</div>
			<div class="clearfix"></div>
			<?php
    } ?>
		</div>
	</div>
	<!-- <div class="aboutbottom">
	<?php
            $flag = 0;
    for ($i=1;$i<count($aboutUsData);$i+=2) {
        //echo $i.' '.($i+1);
        if ($flag==0) {
            ?>
		<div class="col-md-3 col-sm-3 aboutimg arrow" style="background-image:url('<?php echo $aboutUsData[$i]['image']; ?>')">
		</div>
		<div class="col-md-3 col-sm-3 abouttext">
			<h4><?php echo $aboutUsData[$i]['title']; ?></h4>
			<div class="about-content">
			<?php echo $aboutUsData[$i]['note']; ?>
			</div>
			<a href="#" data-toggle="modal" data-target="#myModal01<?php echo $i; ?>">EXPLORE</a>

			<div class="modal fade" id="myModal01<?php echo $i; ?>" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4><?php echo $aboutUsData[$i]['title']; ?></h4>
							<img src="<?php echo $aboutUsData[$i]['image']; ?>">
							<?php echo $aboutUsData[$i]['note']; ?>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3 aboutimg arrow" style="background-image:url('<?php echo $aboutUsData[($i+1)]['image']; ?>')">
		</div>
		<div class="col-md-3 col-sm-3 abouttext">
			<h4><?php echo $aboutUsData[($i+1)]['title']; ?></h4>
			<div class="about-content">
			<?php echo $aboutUsData[($i+1)]['note']; ?>
			</div>
            <a href="#" data-toggle="modal" data-target="#myModal02<?php echo($i+1); ?>">EXPLORE</a>

			<div class="modal fade" id="myModal02<?php echo($i+1); ?>" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4><?php echo $aboutUsData[($i+1)]['title']; ?></h4>
							<img src="<?php echo $aboutUsData[($i+1)]['image']; ?>">
                            <?php echo $aboutUsData[($i+1)]['note']; ?>
                        </div>
					</div>
				</div>
			</div>
		</div>
				<?php
                    $flag = 1;
        } else {
            ?>
					<div class="col-md-3 col-sm-3 abouttext">
			<h4><?php echo $aboutUsData[$i]['title']; ?></h4>
			<div class="about-content">
			<?php echo $aboutUsData[$i]['note']; ?>
			</div>
			<a href="#" data-toggle="modal" data-target="#myModal03<?php echo $i; ?>">EXPLORE</a>
			<div class="modal fade" id="myModal03<?php echo $i; ?>" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4><?php echo $aboutUsData[$i]['title']; ?></h4>
							<img src="<?php echo $aboutUsData[$i]['image']; ?>">
							<?php echo $aboutUsData[$i]['note']; ?>
						</div>
					</div>
				</div>
            </div>
		</div>
		<div class="col-md-3 col-sm-3 aboutimg arrow2" style="background-image:url('<?php echo $aboutUsData[$i]['image']; ?>')">
		</div>
		<div class="col-md-3 col-sm-3 abouttext">
			<h4><?php echo $aboutUsData[($i+1)]['title']; ?></h4>
			<div class="about-content">
			<?php echo $aboutUsData[($i+1)]['note']; ?>
			</div>
			<a href="#" data-toggle="modal" data-target="#myModal04<?php echo($i+1); ?>">EXPLORE</a>
			<div class="modal fade" id="myModal04<?php echo($i+1); ?>" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4><?php echo $aboutUsData[($i+1)]['title']; ?></h4>
								<img src="<?php echo $aboutUsData[($i+1)]['image']; ?>">
								<?php echo $aboutUsData[($i+1)]['note']; ?>
						</div>
					</div>
                </div>
            </div>
		</div>
		<div class="col-md-3 col-sm-3 aboutimg arrow2" style="background-image:url('<?php echo $aboutUsData[($i+1)]['image']; ?>')">
		</div>
				<?php
                    $flag = 0;
        } ?>
			<?php
    } ?>
		<div class="clearfix"></div>
	</div> -->
</div>

</section>
<!-- /About -->
<!-- Programs Section -->
<div class="programs" id="programs">
	<div class="container">
	    <h3>PROGRAMS</h3>
		<label class="line"></label>
		<?php if (count($programData)>0) {
        ?>
		<div class="col-md-6 col-sm-12">
		<?php for ($j=0;$j<(count($programData)-4);$j++) {
            ?>
			<div class="col-md-12">
				<img class="programs-lbl-img" src="<?php echo base_url() ?>templates/cszdefault/imgs/programs_list.jpg" />
				<label class="programs-lbl"><?php echo $programData[$j]['category']?></label>
				<ul>
				<?php if (count($programData[$j]['subs'])>0) {
                for ($k=0;$k<count($programData[$j]['subs']);$k++) {
                    ?>
						<?php if ($programData[$j]['subs'][$k]['flag']) {
                        ?>
						<li class="has-children">
							<label><?php echo $programData[$j]['subs'][$k]['subcategory']; ?></label>

							<?php if (count($programData[$j]['subs'][$k]['subs'])>0) {
                            ?>
							<ul>
							<?php for ($l=0;$l<count($programData[$j]['subs'][$k]['subs']);$l++) {
                                ?>
							<li><a href="#" data-toggle="modal" data-target="#myModal1<?php echo $j.$k.$l; ?>"><?php echo $programData[$j]['subs'][$k]['subs'][$l]['subcategory']; ?></a></li>
							<div class="modal fade" id="myModal1<?php echo $j.$k.$l; ?>" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4><?php echo $programData[$j]['subs'][$k]['subs'][$l]['subcategory']; ?></h4>
											<?php if ($programData[$j]['subs'][$k]['subs'][$l]['image']) {
                                    ?>
											<img src="<?php echo $programData[$j]['subs'][$k]['subs'][$l]['image']; ?>">
											<h4 class="pre-requisite" id="pre-requisite<?php echo $j.$k.$l; ?>">Program Prerequisite</h4>
											<?php
                                } ?>
											<div id="program-prerequisite<?php echo $j.$k.$l; ?>">
												<?php echo $programData[$j]['subs'][$k]['subs'][$l]['content']; ?>
												<div class="submit-btns">
													<button type="button" class="btn btn-primary" id="request-info-btn<?php echo $j.$k.$l; ?>">Request Info</button>
													<?php if ($programData[$j]['subs'][$k]['subs'][$l]['pdf']) {
                                    ?>
													<a class="btn btn-primary" href="<?php echo $programData[$j]['subs'][$k]['subs'][$l]['pdf']; ?>" download>Download Brochure</a>
													<?php
                                } ?>
												</div>
											</div>
										<div id="request-form-info<?php echo $j.$k.$l; ?>" style="display:none;">
											<form class="form-horizontal" id="request-form<?php echo $j.$k.$l; ?>">
												<div class="form-group">
													<label class="col-md-4 control-label" for="textinput">Name</label>
													<div class="col-md-6">
													<input id="name" name="name" required type="text" placeholder="Enter Your Name" class="form-control input-md">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="textinput">Email</label>
													<div class="col-md-6">
													<input id="email" name="email" required type="text" placeholder="Enter Your Email" class="form-control input-md">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="mobile">Mobile Number</label>
													<div class="col-md-6">
                          <input type="hidden" value="IN" name="countrycode" />
                          <input type="hidden" value="India" name="countryname" />
                          <input type="hidden" value="<?php echo $programData[$j]['subs'][$k]['subs'][$l]['subcategory']; ?>" name="program" />
                          <input id="mobile" name="mobile" required type="text" placeholder="Enter Your Mobile Number" class="form-control input-md">
													</div>
												</div>

												<!-- <div class="form-group">
													<label class="col-md-4 control-label" for="country">Country</label>
													<div class="col-md-6">
														<select id="country" name="country" class="form-control" required>
														<option value="1">India</option>
														<option value="2">Thailand</option>
														</select>
													</div>
												</div> -->
												<div class="submit-btns">
													<button type="submit" class="btn btn-primary form-submit-btn" id="request-info-submit<?php echo $j.$k.$l; ?>" data-loading-text="Submitting...">Submit</button>
													<a class="btn btn-primary form-cancel-btn" id="request-info-cancel<?php echo $j.$k.$l; ?>">Cancel</a>
                        </div>
                        <div class="form-group">
                          <div class="sucess-msg" id="request-info-sucess-msg<?php echo $j.$k.$l; ?>" style="display:none;">&nbsp;</div>
												</div>
											</form>
											<script>
											$(document).ready(function(){

                        $("#request-form<?php echo $j.$k.$l; ?>").submit(function(e) {
                          $('#request-info-submit<?php echo $j.$k.$l; ?>').button('loading');
              						var form = $(this);
              						var url = '<?php echo base_url() ?>sendmail?'+form.serialize();
              						$.ajax({
              							type: "POST",
              							url: url,
              			        dataType:'json',
              							success: function(data)
              							{
                              $('#request-info-submit<?php echo $j.$k.$l; ?>').button('reset');
                              form.trigger("reset");
                              console.log(data.status);
                              $("#request-info-sucess-msg<?php echo $j.$k.$l; ?>").show();
                        			if(data.status=="success"){
                                $("#request-info-sucess-msg<?php echo $j.$k.$l; ?>").html("Thank you for your message. We will respond to you as soon as possible!");
                        			} else {
                        			 $("#request-info-sucess-msg<?php echo $j.$k.$l; ?>").html("Try again after some time.");
                        			}
                        			$("#name").val(""), $("#mobile").val(""), $("#email").val(""), $("#message").val("");
                        			setTimeout(function(){ $("#request-info-sucess-msg<?php echo $j.$k.$l; ?>").html("");$(".#request-info-sucess-msg<?php echo $j.$k.$l; ?>").hide(); }, 10000);
              							}
              						});
              						e.preventDefault();
              					});

												$("#request-info-btn<?php echo $j.$k.$l; ?>").click(function(){
													$("#request-form-info<?php echo $j.$k.$l; ?>").show();
													$("#program-prerequisite<?php echo $j.$k.$l; ?>").hide();
													$("#pre-requisite<?php echo $j.$k.$l; ?>").text('Request Info');
												});

												$("#request-info-cancel<?php echo $j.$k.$l; ?>").click(function(){
													$("#request-form-info<?php echo $j.$k.$l; ?>").hide();
													$("#program-prerequisite<?php echo $j.$k.$l; ?>").show();
													$("#pre-requisite<?php echo $j.$k.$l; ?>").text('Program Prerequisite');
												});

												$("#request-form<?php echo $j.$k.$l; ?>").submit(function(e) {
													var form = $(this);
													var url = '<?php echo base_url() ?>sendmail?'+form.serialize();
													$.ajax({
														type: "POST",
														url: url,
														success: function(data)
														{
														console.log(data);
														}
													});
													e.preventDefault();
												});
											})
											</script>
										</div>
										</div>
									</div>
								</div>
							</div>
							<?php
                            } ?>
							</ul>
							<?php
                        } ?>
						</li>
						<?php
                    } else {
                        ?>
						<li><a href="#" data-toggle="modal" data-target="#myModal1<?php echo $j.$k; ?>"><?php echo $programData[$j]['subs'][$k]['subcategory']; ?></a></li>
						<div class="modal fade" id="myModal1<?php echo $j.$k; ?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4><?php echo $programData[$j]['subs'][$k]['subcategory']; ?></h4>
											<?php if ($programData[$j]['subs'][$k]['image']) {
                            ?>
											<img src="<?php echo $programData[$j]['subs'][$k]['image']; ?>">
											<h4 class="pre-requisite" id="pre-requisite<?php echo $j.$k; ?>">Program Prerequisite</h4>
											<?php
                        } ?>
											<div id="program-prerequisite<?php echo $j.$k; ?>">
												<?php echo $programData[$j]['subs'][$k]['content']; ?>
												<div class="submit-btns">
													<button type="button" class="btn btn-primary" id="request-info-btn<?php echo $j.$k; ?>">Request Info</button>
													<?php if ($programData[$j]['subs'][$k]['pdf']) {
                            ?>
													<a class="btn btn-primary" href="<?php echo $programData[$j]['subs'][$k]['pdf']; ?>" download>Download Brochure</a>
													<?php
                        } ?>
													</div>
											</div>
										<div id="request-form-info<?php echo $j.$k; ?>" style="display:none;">
											<form class="form-horizontal" id="request-form<?php echo $j.$k; ?>">
												<div class="form-group">
													<label class="col-md-4 control-label" for="textinput">Name</label>
													<div class="col-md-6">
													<input id="name" name="name" required type="text" placeholder="Enter Your Name" class="form-control input-md">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="textinput">Email</label>
													<div class="col-md-6">
													<input id="email" name="email" required type="text" placeholder="Enter Your Email" class="form-control input-md">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="mobile">Mobile Number</label>
													<div class="col-md-6">
                            <input type="hidden" value="IN" name="countrycode" />
                            <input type="hidden" value="India" name="countryname" />
                            <input type="hidden" value="<?php echo $programData[$j]['subs'][$k]['subcategory']; ?>" name="program" />
                            <input id="mobile" name="mobile" required type="text" placeholder="Enter Your Mobile Number" class="form-control input-md">
													</div>
												</div>

												<!-- <div class="form-group">
													<label class="col-md-4 control-label" for="country">Country</label>
													<div class="col-md-6">
														<select id="country" name="country" class="form-control" required>
														<option value="1">India</option>
														<option value="2">Thailand</option>
														</select>
													</div>
												</div> -->
												<div class="submit-btns">
													<button type="submit" class="btn btn-primary form-submit-btn" id="request-info-submit<?php echo $j.$k; ?>" data-loading-text="Submitting...">Submit</button>
													<a class="btn btn-primary form-cancel-btn" id="request-info-cancel<?php echo $j.$k; ?>">Cancel</a>
                        </div>
                        <div class="form-group">
                          <div class="sucess-msg" id="request-info-sucess-msg<?php echo $j.$k; ?>" style="display:none;">&nbsp;</div>
                        </div>
											</form>
											<script>
											$(document).ready(function(){

												$("#request-info-btn<?php echo $j.$k; ?>").click(function(){
													$("#request-form-info<?php echo $j.$k; ?>").show();
													$("#program-prerequisite<?php echo $j.$k; ?>").hide();
													$("#pre-requisite<?php echo $j.$k; ?>").text('Request Info');
												});

												$("#request-info-cancel<?php echo $j.$k; ?>").click(function(){
													$("#request-form-info<?php echo $j.$k; ?>").hide();
													$("#program-prerequisite<?php echo $j.$k; ?>").show();
													$("#pre-requisite<?php echo $j.$k; ?>").text('Program Prerequisite');
												});

                        $("#request-form<?php echo $j.$k; ?>").submit(function(e) {
                          $('#request-info-submit<?php echo $j.$k; ?>').button('loading');
              						var form = $(this);
              						var url = '<?php echo base_url() ?>sendmail?'+form.serialize();
              						$.ajax({
              							type: "POST",
              							url: url,
              			        dataType:'json',
              							success: function(data)
              							{
                              $('#request-info-submit<?php echo $j.$k; ?>').button('reset');
                              form.trigger("reset");
                              console.log(data.status);
                              $("#request-info-sucess-msg<?php echo $j.$k; ?>").show();
                        			if(data.status=="success"){
                                $("#request-info-sucess-msg<?php echo $j.$k; ?>").html("Thank you for your message. We will respond to you as soon as possible!");
                        			} else {
                        			 $("#request-info-sucess-msg<?php echo $j.$k; ?>").html("Try again after some time.");
                        			}
                        			$("#name").val(""), $("#mobile").val(""), $("#email").val(""), $("#message").val("");
                        			setTimeout(function(){ $("#request-info-sucess-msg<?php echo $j.$k; ?>").html("");$(".#request-info-sucess-msg<?php echo $j.$k; ?>").hide(); }, 10000);
              							}
              						});
              						e.preventDefault();
              					});
											})
											</script>
										</div>
										<!-- <a class="download-brochure" href="<?php echo base_url(); ?>templates/cszdefault/pdf/FastTrack.pdf" download><img src="<?php echo base_url(); ?>templates/cszdefault/images/download-brochure.png"></a> -->
									</div>
								</div>
							</div>
						</div>
						<?php
                    }
                }
            } ?>
				</ul>
			</div>

			<div class="col-md-12 line-lbl">
				<label class="line"></label>
			</div>
			<?php
        } ?>
		</div>

		<div class="col-md-6 col-sm-12">
		<?php for ($j=(count($programData)-4);$j<(count($programData));$j++) {
            ?>
			<div class="col-md-12">
				<img class="programs-lbl-img" src="<?php echo base_url() ?>templates/cszdefault/imgs/programs_list.jpg" />
				<label class="programs-lbl"><?php echo $programData[$j]['category']?></label>
				<ul>
				<?php if (count($programData[$j]['subs'])>0) {
                for ($k=0;$k<count($programData[$j]['subs']);$k++) {
                    ?>
						<?php if ($programData[$j]['subs'][$k]['flag']) {
                        ?>
						<li class="has-children">
							<label><?php echo $programData[$j]['subs'][$k]['subcategory']; ?></label>

							<?php if (count($programData[$j]['subs'][$k]['subs'])>0) {
                            ?>
							<ul>
							<?php for ($l=0;$l<count($programData[$j]['subs'][$k]['subs']);$l++) {
                                ?>
							<li><a href="#" data-toggle="modal" data-target="#myModal1<?php echo $j.$k.$l; ?>"><?php echo $programData[$j]['subs'][$k]['subs'][$l]['subcategory']; ?></a></li>
							<div class="modal fade" id="myModal1<?php echo $j.$k.$l; ?>" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4><?php echo $programData[$j]['subs'][$k]['subcategory']; ?></h4>
											<?php if ($programData[$j]['subs'][$k]['image']) {
                                    ?>
											<img src="<?php echo $programData[$j]['subs'][$k]['image']; ?>">
											<h4 class="pre-requisite" id="pre-requisite<?php echo $j.$k.$l; ?>">Program Prerequisite</h4>
											<?php
                                } ?>
											<?php echo $programData[$j]['subs'][$k]['subs'][$l]['content']; ?>
											<div id="program-prerequisite<?php echo $j.$k.$l; ?>">
												<?php echo $programData[$j]['subs'][$k]['content']; ?>
												<div class="submit-btns">
													<button type="button" class="btn btn-primary" id="request-info-btn<?php echo $j.$k.$l; ?>">Request Info</button>
													<?php if ($programData[$j]['subs'][$k]['pdf']) {
                                    ?>
													<a class="btn btn-primary" href="<?php echo $programData[$j]['subs'][$k]['pdf']; ?>" download>Download Brochure</a>
													<?php
                                } ?>
												</div>
											</div>
										<div id="request-form-info<?php echo $j.$k.$l; ?>" style="display:none;">
											<form class="form-horizontal" id="request-form<?php echo $j.$k.$l; ?>">
												<div class="form-group">
													<label class="col-md-4 control-label" for="textinput">Name</label>
													<div class="col-md-6">
													<input id="name" name="name" required type="text" placeholder="Enter Your Name" class="form-control input-md">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="textinput">Email</label>
													<div class="col-md-6">
													<input id="email" name="email" required type="text" placeholder="Enter Your Email" class="form-control input-md">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="mobile">Mobile Number</label>
													<div class="col-md-6">
                            <input type="hidden" value="IN" name="countrycode" />
                            <input type="hidden" value="India" name="countryname" />
                            <input type="hidden" value="<?php echo $programData[$j]['subs'][$k]['subcategory']; ?>" name="program" />
													  <input id="mobile" name="mobile" required type="text" placeholder="Enter Your Mobile Number" class="form-control input-md">
													</div>
												</div>

												<!-- <div class="form-group">
													<label class="col-md-4 control-label" for="country">Country</label>
													<div class="col-md-6">
														<select id="country" name="country" class="form-control" required>
														<option value="1">India</option>
														<option value="2">Thailand</option>
														</select>
													</div>
												</div> -->
												<div class="submit-btns">
													<button type="submit" class="btn btn-primary form-submit-btn" id="request-info-submit<?php echo $j.$k.$l; ?>" data-loading-text="Submitting...">Submit</button>
													<a class="btn btn-primary form-cancel-btn" id="request-info-cancel<?php echo $j.$k.$l; ?>">Cancel</a>
                        </div>
                        <div class="form-group">
                          <div class="sucess-msg" id="request-info-sucess-msg<?php echo $j.$k.$l; ?>" style="display:none;">&nbsp;</div>
                        </div>
											</form>
											<script>
											$(document).ready(function(){

												$("#request-info-btn<?php echo $j.$k.$l; ?>").click(function(){
													$("#request-form-info<?php echo $j.$k.$l; ?>").show();
													$("#program-prerequisite<?php echo $j.$k.$l; ?>").hide();
													$("#pre-requisite<?php echo $j.$k.$l; ?>").text('Request Info');
												});

												$("#request-info-cancel<?php echo $j.$k.$l; ?>").click(function(){
													$("#request-form-info<?php echo $j.$k.$l; ?>").hide();
													$("#program-prerequisite<?php echo $j.$k.$l; ?>").show();
													$("#pre-requisite<?php echo $j.$k.$l; ?>").text('Program Prerequisite');
												});

                        $("#request-form<?php echo $j.$k.$l; ?>").submit(function(e) {
                          $('#request-info-submit<?php echo $j.$k.$l; ?>').button('loading');
              						var form = $(this);
              						var url = '<?php echo base_url() ?>sendmail?'+form.serialize();
              						$.ajax({
              							type: "POST",
              							url: url,
              			        dataType:'json',
              							success: function(data)
              							{
                              $('#request-info-submit<?php echo $j.$k.$l; ?>').button('reset');
                              form.trigger("reset");
                              console.log(data.status);
                              $("#request-info-sucess-msg<?php echo $j.$k.$l; ?>").show();
                        			if(data.status=="success"){
                                $("#request-info-sucess-msg<?php echo $j.$k.$l; ?>").html("Thank you for your message. We will respond to you as soon as possible!");
                        			} else {
                        			 $("#request-info-sucess-msg<?php echo $j.$k.$l; ?>").html("Try again after some time.");
                        			}
                        			$("#name").val(""), $("#mobile").val(""), $("#email").val(""), $("#message").val("");
                        			setTimeout(function(){ $("#request-info-sucess-msg<?php echo $j.$k.$l; ?>").html("");$(".#request-info-sucess-msg<?php echo $j.$k.$l; ?>").hide(); }, 10000);
              							}
              						});
              						e.preventDefault();
              					});
											})
											</script>
										</div>
										</div>
									</div>
								</div>
							</div>
							<?php
                            } ?>
							</ul>
							<?php
                        } ?>
						</li>
						<?php
                    } else {
                        ?>
						<li><a href="#" data-toggle="modal" data-target="#myModal1<?php echo $j.$k; ?>"><?php echo $programData[$j]['subs'][$k]['subcategory']; ?></a></li>
						<div class="modal fade" id="myModal1<?php echo $j.$k; ?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4><?php echo $programData[$j]['subs'][$k]['subcategory']; ?></h4>
											<?php if ($programData[$j]['subs'][$k]['image']) {
                            ?>
											<img src="<?php echo $programData[$j]['subs'][$k]['image']; ?>">
											<h4 class="pre-requisite" id="pre-requisite<?php echo $j.$k; ?>">Program Prerequisite</h4>
											<?php
                        } ?>
											<?php echo $programData[$j]['subs'][$k]['subs'][$l]['content']; ?>
											<div id="program-prerequisite<?php echo $j.$k; ?>">
												<?php echo $programData[$j]['subs'][$k]['content']; ?>
												<div class="submit-btns">
													<button type="button" class="btn btn-primary" id="request-info-btn<?php echo $j.$k; ?>">Request Info</button>
													<?php if ($programData[$j]['subs'][$k]['pdf']) {
                            ?>
													<a class="btn btn-primary" href="<?php echo $programData[$j]['subs'][$k]['pdf']; ?>" download>Download Brochure</a>
													<?php
                        } ?>
												</div>
											</div>
										<div id="request-form-info<?php echo $j.$k; ?>" style="display:none;">
											<form class="form-horizontal" id="request-form<?php echo $j.$k; ?>">
												<div class="form-group">
													<label class="col-md-4 control-label" for="textinput">Name</label>
													<div class="col-md-6">
													<input id="name" name="name" required type="text" placeholder="Enter Your Name" class="form-control input-md">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="textinput">Email</label>
													<div class="col-md-6">
													<input id="email" name="email" required type="text" placeholder="Enter Your Email" class="form-control input-md">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="mobile">Mobile Number</label>
													<div class="col-md-6">
                            <input type="hidden" value="IN" name="countrycode" />
                            <input type="hidden" value="India" name="countryname" />
                            <input type="hidden" value="<?php echo $programData[$j]['subs'][$k]['subcategory']; ?>" name="program" />
													  <input id="mobile" name="mobile" required type="text" placeholder="Enter Your Mobile Number" class="form-control input-md">
													</div>
												</div>

												<!-- <div class="form-group">
													<label class="col-md-4 control-label" for="country">Country</label>
													<div class="col-md-6">
														<select id="country" name="country" class="form-control" required>
														<option value="1">India</option>
														<option value="2">Thailand</option>
														</select>
													</div>
												</div> -->
												<div class="submit-btns">
													<button type="submit" class="btn btn-primary form-submit-btn" id="request-info-submit<?php echo $j.$k; ?>" data-loading-text="Submitting...">Submit</button>
													<a class="btn btn-primary form-cancel-btn" id="request-info-cancel<?php echo $j.$k; ?>">Cancel</a>
                        </div>
                        <div class="form-group">
                          <div class="sucess-msg" id="request-info-sucess-msg<?php echo $j.$k; ?>" style="display:none;">&nbsp;</div>
                        </div>
											</form>
											<script>
											$(document).ready(function(){

												$("#request-info-btn<?php echo $j.$k; ?>").click(function(){
													$("#request-form-info<?php echo $j.$k; ?>").show();
													$("#program-prerequisite<?php echo $j.$k; ?>").hide();
													$("#pre-requisite<?php echo $j.$k; ?>").text('Request Info');
												});

												$("#request-info-cancel<?php echo $j.$k; ?>").click(function(){
													$("#request-form-info<?php echo $j.$k; ?>").hide();
													$("#program-prerequisite<?php echo $j.$k; ?>").show();
													$("#pre-requisite<?php echo $j.$k; ?>").text('Program Prerequisite');
												});

                        $("#request-form<?php echo $j.$k; ?>").submit(function(e) {
                          $('#request-info-submit<?php echo $j.$k; ?>').button('loading');
              						var form = $(this);
              						var url = '<?php echo base_url() ?>sendmail?'+form.serialize();
              						$.ajax({
              							type: "POST",
              							url: url,
              			        dataType:'json',
              							success: function(data)
              							{
                              $('#request-info-submit<?php echo $j.$k; ?>').button('reset');
                              form.trigger("reset");
                              console.log(data.status);
                              $("#request-info-sucess-msg<?php echo $j.$k; ?>").show();
                        			if(data.status=="success"){
                                $("#request-info-sucess-msg<?php echo $j.$k; ?>").html("Thank you for your message. We will respond to you as soon as possible!");
                        			} else {
                        			 $("#request-info-sucess-msg<?php echo $j.$k; ?>").html("Try again after some time.");
                        			}
                        			$("#name").val(""), $("#mobile").val(""), $("#email").val(""), $("#message").val("");
                        			setTimeout(function(){ $("#request-info-sucess-msg<?php echo $j.$k; ?>").html("");$(".#request-info-sucess-msg<?php echo $j.$k; ?>").hide(); }, 10000);
              							}
              						});
              						e.preventDefault();
              					});
											})
											</script>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
                    }
                }
            } ?>
				</ul>
			</div>

			<div class="col-md-12 line-lbl">
				<label class="line"></label>
			</div>
			<?php
        } ?>
		</div>
		<?php
    } ?>
	</div>
</div>
<!-- //Programs Section -->
<!-- Gallery Section -->
<!-- <div class="gallery" id="sportscenter">
	<div class="container">
	    <h3>SPORTS CENTER</h3>
		<label class="line"></label>
		<section id="gallery" class="parallax section">
			<div class="container">
					<div class="row">
					<?php for ($i=0;$i<count($sportsCenterData);$i++) {
        ?>
						<div class="col-md-4 col-sm-4 ggrids">
							<a href="<?php echo $sportsCenterData[$i]['image']; ?>" title="<?php echo $sportsCenterData[$i]['title']; ?>">
							<img src="<?php echo $sportsCenterData[$i]['image']; ?>">
								<div class="description">
									<span class="caption"><?php echo $sportsCenterData[$i]['title']; ?></span>
									<span class="camera"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					 <?php
    } ?>
					</div>
				</div>
	</div>
</div> -->
<!-- //Gallery Section -->

<!-- international-students Section -->
<div class="international-students" id="international-students">
	<div class="container">
	    <div class="ftop">
		    <h3>INTERNATIONAL STUDENTS</h3>
				<label class="line"></label>
			</div>
			<?php for ($i=0;$i<count($internationalStudentsData);$i++) {
        ?>
        <div class="col-md-3 col-sm-3 fgrids" data-toggle="modal" data-target="#myModali03<?php echo $i; ?>">
					<div class="view view-fourth">
							<div class="view-img" style="background-image:url('<?php echo $internationalStudentsData[$i]['image']; ?>')"></div>
							<!-- <img src="<?php echo $internationalStudentsData[$i]['image']; ?>" /> -->
							<!-- <div class="mask">
								<?php //echo $internationalStudentsData[$i]['note'];?>
							</div> -->
					</div>
					<div class="ftext">
						<h4><?php echo $internationalStudentsData[$i]['title']; ?></h4>
					</div>
				</div>
			<!-- Modal -->
			<div class="modal fade" id="myModali03<?php echo $i; ?>" role="dialog">
				<div class="modal-dialog">
				<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4><?php echo $internationalStudentsData[$i]['title']; ?></h4>
							<img src="<?php echo $internationalStudentsData[$i]['image']; ?>">
							<?php echo $internationalStudentsData[$i]['note']; ?>
						</div>
					</div>
				</div>
      </div>
			<?php
    } ?>
	    <div class="clearfix"></div>
    </div>
</div>
<!-- //international-students Section -->

<!-- //Students Center Section -->
<div class="studentscenter" id="studentscenter">
	<div class="container">
	    <h3>STUDENTS CENTER</h3>
		<label class="line"></label>

		<div class="col-md-6 col-sm-12">
			<div class="col-md-12">
				<img class="studentscenter-lbl-img" src="<?php echo base_url() ?>templates/cszdefault/imgs/studentscenter_list.jpg" />
				<label class="studentscenter-lbl">Campus Life</label>
				<ul>
				<?php if (count($campusLife)>0) {
        for ($k=0;$k<count($campusLife);$k++) {
            ?>

						<li><a href="#" data-toggle="modal" data-target="#myModalxx112<?php echo $k; ?>"><?php echo $campusLife[$k]['title']; ?></a></li>
						<div class="modal fade" id="myModalxx112<?php echo $k; ?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4><?php echo $campusLife[$k]['title']; ?></h4>
											<?php if ($campusLife[$k]['image']) {
                ?>
											<img src="<?php echo $campusLife[$k]['image']; ?>">
											<?php
            } ?>
											<?php echo $campusLife[$k]['note']; ?>
									</div>
								</div>
							</div>
						</div>
						<?php
        }
    } ?>
				</ul>
			</div>
		</div>

		<div class="col-md-6 col-sm-12">
			<div class="col-md-12">
				<img class="studentscenter-lbl-img" src="<?php echo base_url() ?>templates/cszdefault/imgs/studentscenter_list.jpg" />
				<label class="studentscenter-lbl">Admission Criteria</label>
				<ul>
                <li><a class="apply" href="http://www.grad.au.edu/download-application-form" target="_blank">Online Application</a></li>
				<?php if (count($admissionCriteria)>0) {
        for ($k=0;$k<count($admissionCriteria);$k++) {
            ?>


						<li><a href="#" data-toggle="modal" data-target="#myModalx111<?php echo $k; ?>"><?php echo $admissionCriteria[$k]['title']; ?></a></li>
						<div class="modal fade" id="myModalx111<?php echo $k; ?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4><?php echo $admissionCriteria[$k]['title']; ?></h4>
											<?php if ($admissionCriteria[$k]['image']) {
                ?>
											<img src="<?php echo $admissionCriteria[$k]['image']; ?>">
											<?php
            } ?>
											<?php echo $admissionCriteria[$k]['note']; ?>
									</div>
								</div>
							</div>
						</div>
						<?php
        }
    } ?>

				</ul>
			</div>
		</div>

	</div>
</div>
<!-- //Students Center Section -->
<!-- Stats Section -->
<!-- <div class="stats" id="stats">
	<div class="container">
		<div class="stats-info">
			<div class="col-md-3 col-sm-3 stats-grid slideanim">
				<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='12' data-delay='.5' data-increment="100">12</div>
				<label class="line"></label>
				<p class="stats-info">Rank</p>
			</div>
			<div class="col-md-3 col-sm-3 stats-grid slideanim">
				<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='3000' data-delay='.5' data-increment="5">3000</div>
				<label class="line"></label>
				<p class="stats-info">Computers</p>
			</div>
			<div class="col-md-3 col-sm-3 stats-grid slideanim">
				<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='9000' data-delay='.5' data-increment="100">9000</div>
				<label class="line"></label>
				<p class="stats-info">Books</p>
			</div>
			<div class="col-md-3 col-sm-3 stats-grid slideanim">
				<div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='169' data-delay='.5' data-increment="1">169</div>
				<label class="line"></label>
				<p class="stats-info">Awards</p>
			</div>
			<div class="clearfix"></div>
		</div>
    </div>
</div> -->
<!-- Stats Section -->

<!-- Clients Section -->
<!-- <div class="clients">
	<div class="container">
		<h3>Companies that recruit from Assumption University</h3>
		<img src="<?php echo base_url() ?>templates/cszdefault/imgs/AURecruitingCompanies.png" style="margin:15px 0;width:75%;">
  </div>
</div> -->
<!--// Clients Section -->

<!-- Contact Section -->
<div class="contact" id="contact">
	<div class="container">
	    <div class="ctop">
			<h3>CONTACT</h3>
			<label class="line"></label>
			<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. </p> -->
		</div>
		<div class="cbottom">
			<div class="col-md-6 col-sm-12 cbl">
                <h4>Administrative Office</h4>
                <h5>
                <br><b>India</b><br>
                Assumption University<br>
                19 Aziz Nagar Main Road,<br>
                Kodambakkam,<br>
                Rangarajapuram,<br>
                Chennai - 600 024<br>
                Lan: 044 - 4850 2121<br>
                Mob: <a href="tel:9840084050">9840084050</a> / <a href="tel:a>9884566664">9884566664</a></<br><br></h5>

                <h5><br><b>Thailand</b><br>
                Office of Graduate Studies, Assumption University<br>
                Hua Mak Campus, Assumption Building<br>
                (‘A’ Building), 3rd floor, Bangkok 10240 Thailand<br>
                Tel. <a href="tel:662300454362">(662) 3004543-62</a> Ext.1360-61,<br>
                Fax.(662) 7191521<br>
                E-mail: <a href="mailto:grad@au.edu" target="_top">grad@au.edu</a><br></h5>

                <h5 class="campus-h5"><br><b>Hua Mak Campus</b><br>
                592 Ramkhamhaeng 24,<br>
                Hua Mak Bangkok Thailand 10240<br>
                Tel. (662) 300-4553 to 62<br>
                Fax. (662) 300-4563<br>
                E-mail : <a href="mailto:abac@au.edu" target="_top">abac@au.edu</a><br>
                Website : <a href="http://www.au.edu" target="_blank">http://www.au.edu</a><br></h5>

                <h5 class="campus-h5"><br><b>Suvarnabhumi Campus</b><br>
                88 Moo 8 Bang Na-Trad Km. 26<br>
                Bangsaothong Samuthprakarn<br>
                Thailand 10540<br>
                Tel. (662) 723-2222<br>
                Fax. (662) 707-0395<br></h5>

                <h5 class="campus-h5"><br><b>ABAC City Campus</b><br>
                ZEN Department Store @ Central World, 14th floor,<br>
                Rajdamri Road, Patumwan, Bangkok, Thailand 10330<br>
                Tel.: 02-100-9115-8<br>
                Fax.: 02-100-9119<br></h5>
			</div>
			<div class="col-md-6 col-sm-12 cbr">
                <h4 style="text-align:center;">General Enquiry</h4>
                <br />
				<form action="#" method="post" id="contact-form">
            <input type="text" id="name" name="name" placeholder="Your Name" required="">
						<input type="text" id="mobile" name="mobile" placeholder="Your Phone" required="">
						<input type="text" id="email" name="email" placeholder="Your Email" required="">
						<textarea rows="5" cols="50" id="message" name="message" placeholder="Write Your Message Here" required=""></textarea><br>
						<button type="submit" class="btn btn-default btn-md" id="load" data-loading-text="Submitting...">Request Info</button>
            <div class="sucess-msg" style="display:none;">&nbsp;</div>
				</form>
				<script>

					$("#contact-form").submit(function(e) {
            $('#load').button('loading');
						var form = $(this);
						var url = '<?php echo base_url() ?>sendmail?'+form.serialize();
						$.ajax({
							type: "POST",
							url: url,
			        dataType:'json',
							success: function(data)
							{
                $('#load').button('reset');
                form.trigger("reset");
                console.log(data.status);
                $(".sucess-msg").show();
          			if(data.status=="success"){
                  $(".sucess-msg").html("Thank you for your message. We will respond to you as soon as possible!");
          			} else {
          			 $(".sucess-msg").html("Try again after some time.");
          			}
          			$("#name").val(""), $("#mobile").val(""), $("#email").val(""), $("#message").val("");
          			setTimeout(function(){ $(".sucess-msg").html("");$(".sucess-msg").hide(); }, 10000);
							}
						});
						e.preventDefault();
					});
				</script>
                <!-- <div class="contact-footer">
                <div id="mobile-device">&nbsp;</div>
                <p style="text-align: center;"><a href="https://www.facebook.com/ABACIND/" target="_blank"><img src="<?php echo base_url() ?>templates/cszdefault/imgs/facebook_icon.png" alt="facebook" width="35" height="35" border="0"></a>&nbsp;&nbsp;<a href="https://twitter.com/ABACIND/" target="_blank"><img src="<?php echo base_url() ?>templates/cszdefault/imgs/twitter_icon.png" alt=""></a></p>
                <p>  &copy; <?php echo date('Y'); ?> Assumption University. All Rights Reserved | Designed by <a href="http://rigpa.in" target="_blank">Rigpa Tech</a><a class="youtube-a" data-fancybox href="https://www.youtube.com/watch?v=gO7ARD0SEzA">&nbsp;</a></p>
                </div> -->
			</div>
			<div class="clearfix"></div>
      <div class="row campus-div">
          <div class="col-md-4 col-sm-12">
              <h5><br><b>Hua Mak Campus</b><br>
                      592 Ramkhamhaeng 24,<br>
                      Hua Mak Bangkok Thailand 10240<br>
                      Tel. (662) 300-4553 to 62<br>
                      Fax. (662) 300-4563<br>
                      E-mail : <a href="mailto:abac@au.edu" target="_top">abac@au.edu</a><br>
                      Website : <a href="http://www.au.edu" target="_blank">http://www.au.edu</a><br></h5>
          </div>
          <div class="col-md-4 col-sm-12">
            <h5><br><b>Suvarnabhumi Campus</b><br>
            88 Moo 8 Bang Na-Trad Km. 26<br>
            Bangsaothong Samuthprakarn<br>
            Thailand 10540<br>
            Tel. (662) 723-2222<br>
            Fax. (662) 707-0395<br></h5>
          </div>
          <div class="col-md-4 col-sm-12">
            <h5><br><b>ABAC City Campus</b><br>
            ZEN Department Store @ Central World, 14th floor,<br>
            Rajdamri Road, Patumwan, Bangkok, Thailand 10330<br>
            Tel.: 02-100-9115-8<br>
            Fax.: 02-100-9119<br></h5>
          </div>
      </div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- //Contact Section -->
<!-- Social Icons Section -->
<!-- <div class="socialicons">
	<div class="container">
	    <div class="col-md-4 col-sm-4 left">
		    <div class="lt">
			   <a class="google" href="https://plus.google.com/115658573611548679989" target="_blank"></a>
			   <h3>GOOGLE</h3>
			   <h5>We Have A Circle</h5>
			</div>
			<div class="lb">
			    <a class="linkedin" href="https://in.linkedin.com/school/assumption-university/" target="_blank"></a>
			    <h3>LINKEDIN</h3>
				<h5>We Are Here Too</h5>
			</div>
	    </div>
		<div class="col-md-4 col-sm-4 middle">
		     <a class="facebook" href="https://www.facebook.com/abacgraduate/" target="_blank"></a>
			 <h3>FACEBOOK</h3>
			 <h5>Join Our Community</h5>
	    </div>
		<div class="col-md-4 col-sm-4 right">
		    <div class="rt">
			   <a class="twitter" href="https://twitter.com/assumptionu" target="_blank"></a>
			   <h3>TWITTER</h3>
			   <h5>Follow Us</h5>
			</div>
			<div class="rb">
			   <a class="pinterest" href="https://in.pinterest.com/pin/569986896561096891/?lp=true" target="_blank"></a>
			   <h3>PINTEREST</h3>
			   <h5>Just Pin It</h5>
			</div>
	    </div>
		<div class="clearfix"></div>
	</div>
</div> -->
<!-- //Social Icons Section -->
<?php
} else {
        if (isset($is_linkstat) && isset($url)) {
            ?>
    <div class="jumbotron">
        <div class="container">
            <br><br>
            <center><h3>Please Wait... ,Redirect to <?php echo (isset($url)) ? $url : '' ?></h3></center>
        </div>
    </div>
    <?php
        } else {
            ?>
    <div class="jumbotron">
        <div class="container">
            <h1>Sorry, Page not Found!</h1>
            <p>Sorry! Page not Found. ('<?php echo  $page ?>' page) <br>Please back to home page.<p>
                <a class="btn btn-primary btn-lg" href="<?php echo base_url()?>" role="button">back to home &raquo;</a>
        </div>
    </div>
    <?php
        }
    } ?>
