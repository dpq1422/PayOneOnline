<?php
include('../_session-admin.php');

$UserName=$_POST['UserName'];
$AadharNumber=$_POST['AadharNumber'];
$Email=$_POST['Email'];

$MobileNumber=$_POST['MobileNumber'];
$Password=$_POST['Password'];
$ConfirmPassword=$_POST['ConfirmPassword'];

$Address=$_POST['Address'];

$StateName=$_POST['StateName'];
$DisttName=$_POST['DisttName'];
$City=$_POST['City'];

$PinCode=$_POST['PinCode'];
$GsName="";//$_POST['GsName'];
$GsMobileNumber=0;//$_POST['GsMobileNumber'];

$reg_amount=$_POST['soamt'];
$sec_amount=$_POST['seamt'];

$HierarchyName=$_POST['HierarchyName'];
$ParentHierarchyName=$_POST['ParentHierarchyName'];
$ParentNameByHierarchy=$_POST['ParentNameByHierarchy'];

$hierarchy_1_no=0;
$hierarchy_1_id=0;
$hierarchy_2_no=0;
$hierarchy_2_id=0;
$hierarchy_3_no=0;
$hierarchy_3_id=0;
$hierarchy_4_no=0;
$hierarchy_4_id=0;
$hierarchy_5_no=0;
$hierarchy_5_id=0;
$hierarchy_6_no=0;
$hierarchy_6_id=0;
$hierarchy_7_no=0;
$hierarchy_7_id=0;
$hierarchy_8_no=0;
$hierarchy_8_id=0;
$hierarchy_9_no=0;
$hierarchy_9_id=0;
$hierarchy_10_no=0;
$hierarchy_10_id=0;

$qry77="select * from child_user where user_id='$ParentNameByHierarchy';";

$results77=mysql_query($qry77);
while($rows77 = mysql_fetch_assoc($results77))
{
	$hierarchy_1_no=$rows77['hierarchy_1_no'];
	$hierarchy_1_id=$rows77['hierarchy_1_id'];
	$hierarchy_2_no=$rows77['hierarchy_2_no'];
	$hierarchy_2_id=$rows77['hierarchy_2_id'];
	$hierarchy_3_no=$rows77['hierarchy_3_no'];
	$hierarchy_3_id=$rows77['hierarchy_3_id'];
	$hierarchy_4_no=$rows77['hierarchy_4_no'];
	$hierarchy_4_id=$rows77['hierarchy_4_id'];
	$hierarchy_5_no=$rows77['hierarchy_5_no'];
	$hierarchy_5_id=$rows77['hierarchy_5_id'];
	$hierarchy_6_no=$rows77['hierarchy_6_no'];
	$hierarchy_6_id=$rows77['hierarchy_6_id'];
	$hierarchy_7_no=$rows77['hierarchy_7_no'];
	$hierarchy_7_id=$rows77['hierarchy_7_id'];
	$hierarchy_8_no=$rows77['hierarchy_8_no'];
	$hierarchy_8_id=$rows77['hierarchy_8_id'];
	$hierarchy_9_no=$rows77['hierarchy_9_no'];
	$hierarchy_9_id=$rows77['hierarchy_9_id'];
	$hierarchy_10_no=$rows77['hierarchy_10_no'];
	$hierarchy_10_id=$rows77['hierarchy_10_id'];
}

if($ParentHierarchyName==1)
{
	$hierarchy_1_no=$ParentHierarchyName;
	$hierarchy_1_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==2)
{
	$hierarchy_2_no=$ParentHierarchyName;
	$hierarchy_2_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==3)
{
	$hierarchy_3_no=$ParentHierarchyName;
	$hierarchy_3_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==4)
{
	$hierarchy_4_no=$ParentHierarchyName;
	$hierarchy_4_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==5)
{
	$hierarchy_5_no=$ParentHierarchyName;
	$hierarchy_5_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==6)
{
	$hierarchy_6_no=$ParentHierarchyName;
	$hierarchy_6_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==7)
{
	$hierarchy_7_no=$ParentHierarchyName;
	$hierarchy_7_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==8)
{
	$hierarchy_8_no=$ParentHierarchyName;
	$hierarchy_8_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==9)
{
	$hierarchy_9_no=$ParentHierarchyName;
	$hierarchy_9_id=$ParentNameByHierarchy;
}
else if($ParentHierarchyName==10)
{
	$hierarchy_10_no=$ParentHierarchyName;
	$hierarchy_10_id=$ParentNameByHierarchy;
}

$query4a="INSERT INTO child_user(join_date, join_time, user_type, user_name, aadhar_no, e_mail, user_contact_no, pass_word, address, city_name, distt_id, state_id, area_pin_code, guardian_spouse_name, guardian_spouse_contact_no, hierarchy_1_no, hierarchy_1_id, hierarchy_2_no, hierarchy_2_id, hierarchy_3_no, hierarchy_3_id, hierarchy_4_no, hierarchy_4_id, hierarchy_5_no, hierarchy_5_id, hierarchy_6_no, hierarchy_6_id, hierarchy_7_no, hierarchy_7_id, hierarchy_8_no, hierarchy_8_id, hierarchy_9_no, hierarchy_9_id, hierarchy_10_no, hierarchy_10_id, business_name, pancard_no, user_status, user_remarks, reg_amount, sec_amount) VALUES ('$date_time', '$time_time', '$HierarchyName', '$UserName', '$AadharNumber', '$Email', '$MobileNumber', '$Password', '$Address', '$City', '$DisttName', '$StateName', '$PinCode', '$GsName', '$GsMobileNumber', '$hierarchy_1_no', '$hierarchy_1_id', '$hierarchy_2_no', '$hierarchy_2_id', '$hierarchy_3_no', '$hierarchy_3_id', '$hierarchy_4_no', '$hierarchy_4_id', '$hierarchy_5_no', '$hierarchy_5_id', '$hierarchy_6_no', '$hierarchy_6_id', '$hierarchy_7_no', '$hierarchy_7_id', '$hierarchy_8_no', '$hierarchy_8_id', '$hierarchy_9_no', '$hierarchy_9_id', '$hierarchy_10_no', '$hierarchy_10_id', '', '', 1, 'created by $user_types ($user_id - $user_name) at $datetime_time','$reg_amount', '$sec_amount');";
$result4=mysql_query($query4a);



if($result4==1)
{
	$last_id = mysql_insert_id();
	$update_inc_id=explode(":",$time_time);
	$update_inc_id=($update_inc_id[2]-$update_inc_id[2]%10)/10;
	$update_inc_id=$last_id+$update_inc_id+1;
	$qry_update_inc_id="ALTER TABLE child_user auto_increment = $update_inc_id;";
	//mysql_query($qry_update_inc_id);
	mysql_query("INSERT INTO child_products VALUES ('$last_id', '1','0','0','0','0','0','0','0','0','0','0','0','0','0')");

	$query4b="INSERT INTO child_wallet_remain VALUES (NULL, '$date_time', '$time_time', '$last_id', '0', '0', '0', 'Account Opened by $user_type_name $user_id $user_name', '0', '0', '0', '0');";
	$result4=mysql_query($query4b);
	
	for($x=1;$x<=1;$x++)
	{
		for($y=1;$y<=2;$y++)
		{
			$qry1="insert into child_products_margin_mt values(NULL, '$last_id', '$x', '$y', '12', '15', '20', '25', '30', '60', '90', '120', '150')";
			mysql_query($qry1);
		}
	}
	include_once('../functions/_zsms.php');
	$zsms=create_registration_msg($last_id,$HierarchyName,$UserName);
	zsms($MobileNumber,$zsms);
	
	header("location:set-mt-marginr.php?uid=$last_id");
}
else
{
	header("location:retailer.php?msg=retailer-registration-fail");
}

?>