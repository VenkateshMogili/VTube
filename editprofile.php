<?php
session_start();
error_reporting(0);
require 'connect.php';
if(isset($_SESSION['stuid'])==true)
{
$stuid=strip_tags($_SESSION['stuid']);
$det=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE stuid='$stuid'"));
$sql=mysqli_query($con,"SELECT * FROM users where stuid='$stuid' ");
while($row=mysqli_fetch_array($sql))
{
	$name=htmlspecialchars(stripcslashes(strip_tags($row['s_name'])));
	$gender=$row['s_gender'];
}
?>
<section class="main" style="color:white;">
				<div class="pag-nav">
				<ul class="p-list">
					<a href="index.php" style="color:white">Home</a> &nbsp;&nbsp;/&nbsp;
					<b>&nbsp;Edit profile</b>
				</ul>
			</div>
			
				<div class="col-md-2">
				</div><form action="editprofiles.php" enctype="multipart/form-data" method="post" class="role">
				<center><div class="col-md-8 sign-up text-center" id="editpro" style="background:#787878;box-shadow:1px 2px 3px lightgray;">
					<div>
					<h4 style="color:white;"><?php echo strip_tags($_SESSION['stuid']);?> Edit Profile</h4>
					<center><div id="status"></div></center>
					<div class="cus_info_wrap">
						<label class="labelTop">
						Name
						<span class="require">*</span>
						</label>
						<?php
						echo '<input type="text" id="stuname" disabled class="form-control"  placeholder="Student Name" class="vpb_textAreaBoxInputs" value="'.$name.'">';
						?>
					</div>
					
					
					<div class="clearfix"></div>
				    <div class="cus_info_wrap">
						<label class="labelTop">
						Gender
						<span class="require">*</span>
						</label>
					<select id="gender" style="width:70%;" class="form-control" name="gender">
					<option value=<?php echo $det['s_gender']?>><?php echo $det['s_gender'];?></option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					</select>
					</div>
					
					
					
					<div class="clearfix"></div>
				    <div class="cus_info_wrap">
						<label class="labelTop">
						Branch
						<span class="require">*</span>
						</label>
					<select id="branch" name="branch" style="width:70%;" class="form-control" required>
					<option value=<?php echo $det['s_branch'];?>><?php echo $det['s_branch'];?></option>
					<option value=""></option>
						<option value="PUC" >PUC</option>
						<option value="CSE">CSE</option>
						<option value="ECE">ECE</option>
						<option value="Mech">Mech</option>
						<option value="Civil">Civil</option>
						<option value="MME">MME</option>
						<option value="CE">CE</option>
					</select>
					</div>
					
					
					
					<div class="clearfix"></div>
				    <div class="cus_info_wrap">
						<label class="labelTop">
						Class
						<span class="require">*</span>
						</label>
					<select id="block" name="block" style="width:35%;" class="form-control" required>
					<option value=<?php echo $det['s_class'];?>><?php echo $det['s_class'];?></option>
					<option value=""></option>
					<option value="LH">LH</option>
					<option value="CG">CG</option>
					<option value="CF">CF</option>
					<option value="CS">CS</option>
					<option value="CT">CT</option>
					<option value="SG">SG</option>
					<option value="SF">SF</option>
					<option value="SS">SS</option>
					<option value="ST">ST</option>
					<option value="TG">TG</option>
					<option value="TF">TF</option>
					<option value="TS">TS</option>
					<option value="TT">TT</option>
					</select>
					
					
					<select id="room" name="room" style="width:30%;" class="form-control">
					<option value="">Room</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					
					</select>
					</div>
					
					<div class="clearfix"></div>
				    <div class="cus_info_wrap">
						<label class="labelTop">
						Year
						<span class="require">*</span>
						</label>
					<select id="year" name="year" style="width:70%;"class="form-control" required>
					<option value=<?php echo $det['s_year'];?>><?php echo $det['s_year'];?></option>
					<option value=""></option>
					<option value="P1">P1</option>
					<option value="P2">P2</option>
					<option value="E1">E1</option>
					<option value="E2">E2</option>
					<option value="E3">E3</option>
					<option value="E4">E4</option>
					</select>
					</div>
					<div class="cus_info_wrap">
						<label class="labelTop">
						Dormitary
						</label>
						<input type="text" id="dorm" name="dorm" class="form-control" required placeholder="Dormitary" class="vpb_textAreaBoxInputs" value=<?php echo $det['s_dorm'];?>>
					</div>
					<div class="cus_info_wrap">
						<label class="labelTop">
						Security Question
						</label>
						<select id="squestion" name="squestion" class="form-control" required>
							<option value=<?php echo $det['question'];?>><?php echo $det['question'];?></option>
							<option value="">Select security question</option>
							<option value="What is your tenth Hallticket number?">What is your tenth Hallticket number?</option>
							<option value="Who is your first teacher?">Who is your first teacher?</button>
							<option value="What is your pet name?">What is your pet name?</button>
							<option value="Who is your best friend?">Who is your best friend?</button>
							<option value="What primary school did you attend?">What primary school did you attend?</button>
						</select>
						</div>
						<div class="cus_info_wrap">
						<label class="labelTop">
						Security Answer
						</label>
						<input type="text" id="sanswer" name="sanswer" class="form-control" required placeholder="Security answer" class="vpb_textAreaBoxInputs" value=<?php echo $det['answer'];?>>
					
						</div>
					
					<div class="cus_info_wrap">
						<label class="labelTop">
						Mobile
						</label>
						<input type="text" id="mobile" name="mobile" class="form-control"required placeholder="Mobile Number" class="vpb_textAreaBoxInputs" value=<?php echo $det['s_phone'];?>>
					</div>
					
					
					<div class="botton1">
					<input  type="submit" value="Update" id="editing_status" class="btn btn-success">
				</div><br><br>
				</div><br>
				</div>
				</form>

		</section>
	 <?php
 }
 else{
 echo "<script>alert('Please Login');window.location='index.php'</script>";
 }
 ?>
		<script src="js/myscript.js"></script>