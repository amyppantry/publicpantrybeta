<!DOCTYPE html>
<?php 
session_start();
include("includes/header.php");

if (isset($_SESSION['user_email'])) {
	header("location: index.php");
}

?>
<html>
<head>
	<title>Edit Account Settings</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<form action="" method="post" enctype="multipart/form-data">
			<table class="table table-bordered table-hover">
				<tr align="center">
					<td colspan="6" class="active"><h2>Edit Your Profile</h2></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Change Your Firstname</td>
					<td>
						<input class="form-control" type="text" name="first_name" required value="<?php echo $first_name; ?>">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Change Your Lastname</td>
					<td>
						<input class="form-control" type="text" name="last_name" required value="<?php echo $last_name; ?>">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Change Your Username</td>
					<td>
						<input class="form-control" type="text" name="u_name" required value="<?php echo $user_name; ?>">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Description</td>
					<td>
						<input class="form-control" type="text" name="describe_user" required value="<?php echo $describe_user; ?>">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Relationship Status</td>
					<td>
						<select class="form-control" name="Relationship">
							<option><?php echo $Relationship_status; ?></option>
							<option>Engaged</option>
							<option>Married</option>
							<option>Single</option>
							<option>In a Relationship</option>
							<option>It's Complicated</option>
							<option>Separated</option>
							<option>Divorced</option>
							<option>Widowed</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Password</td>
					<td>
						<input class="form-control" type="password" name="pass" id="mypass" required value="<?php echo $pass; ?>"> <!--please check this NAME if it matches with the table, I forgot what it is. DO NOT CHANGE TYPE="password" or ID="mypass" THOUGH.--> 
						<input type="checkbox" onclick="show_password()"><strong>Show Password</strong>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Email</td>
					<td>
						<input class="form-control" type="email" name="e_mail" required value="<?php echo $e_mail; ?>"> <!--please check the email NAME and REQUIRED VALUE only if it matches to the table I forgot-->
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Country</td>
					<td>
						<select class="form-control" name="u_country">
							<option><?php echo $user_country; ?></option>
							<option>United States</option>
							<option>Pakistan</option>
							<option>India</option>
							<option>Brazil</option>
							<option>UK</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Gender</td>
					<td>
						<select class="form-control" name="u_gender">
							<option><?php echo $user_gender; ?></option>
							<option>Male</option>
							<option>Female</option>
							<option>Other</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Birthday</td>
					<td>
						<input class="form-control input-md" type="date" name="u_birthday" required value="<?php echo $user_birthday; ?>">
					</td>
				</tr>

				<!---recover password option--->
				<tr>
					<td style="font-weight: bold;">Forgotten Password</td>
					<td>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Turn On</button>

						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Modal Header</h4>
									</div>
									<div class="modal-body">
										<form action="recover.php?id=<?php echo $user_id; ?>" method="post" id="f">	
											<strong>What is your School Best Friend Name?</strong>
											<textarea class="form-control" cols="83" rows="4" name="content" placeholder="Someone"></textarea><br>
											<input class="btn btn-default" type="submit" name="sub" value="Submit" style="width: 100px;"><br><br>
											<pre>Answer the above question we will ask this if you forget your <br>password.</pre>
											<br><br>
										</form>
										<?php 
											if(isset($_POST['sub'])){
												$bfn = htmlentities($_POST['content']);

											if ($bfn =='') {
												echo "<script>alert('Please enter something')</script>";
												echo "<script>window.open('edit_profile.php?u_id$user_id', '_self'";

												exit();
											}
											else{
												$update = "update users set recovery_account='$bfn' where user_id='$user_id'";
												$run = mysqli_query($con, $update);

												if($run){
													echo "<script>alert('Working...')</script>";

													echo "<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
												}else{
													echo "<script>alert('Error while Updating information')</script>";
													echo "<script>window.open('edit_profile.php?u_id$user_id', '_self')</script>";
												}
											}
										}
										?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>						
					</td>
				</tr>

				<tr align="center">
					<td colspan="6">
						<input type="submit" class="btn btn-info" name="update" style="width: 250px;" value="Update">
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="col-sm-2">
	</div>
</div>
</body>
</html>
<?php 
	if (isset($_POST['update'])) {
		$first_name = htmlentities($_POST['first_name']);
		$last_name = htmlentities($_POST['last_name']);
		$u_name = htmlentities($_POST['u_name']);
		$describe_user = htmlentities($_POST['describe_user']);
		$Relationship_status = htmlentities($_POST['Relationship']);
		$pass = htmlentities($_POST['pass']); //double check this variable pls 
		$e_mail = htmlentities($_POST['e_mail']); //double check, i think the variable is right but I could be wrong cus I can't remember 
		$u_country = htmlentities($_POST['u_country']);
		$u_gender = htmlentities($_POST['u_gender']);
		$u_birthday = htmlentities($_POST['u_birthday']);

		$update = "update users set first_name='$first_name', last_name='$last_name', user_name='$u_name' describe_user='$describe_user',Relationship='$Relationship_status', pass='$pass', e_mail='$e_mail', user_country='$u_country', user_gender='$u_gender', user_birthday='$u_birthday' where user_id='$user_id'";

		$run = mysqli_query($con, $update);

		if($run){
			echo "<script>alert('Your Profile Updated')</script>";

			echo "<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
		}
	}
?>