<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
function clrval()
{
	$("#s1").val('');
	$("#s2").val('');
	$("#s3").val('');
}
function expand(exp_no)
{
	$(".address"+exp_no).slideToggle();
	$(".add"+exp_no).toggleClass("add-show");
}
function recheck(order,txnst,row)
{
	$("#error-message").html($("#error-message").html()+"<br>for <b>order no. : "+order+"</b>");
	$("#error-box").show();
	var loc=document.location.href;
	loc=loc.split("&selectedrow=")[0];
	$.ajax({
		type: "POST",
		url: "AjaxCheckOrderRcStatus.php",
		data: {'order': order , 'txnst': txnst },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			locs=loc.split("?");
			if(locs.length==1)
				window.location.href=loc+'?1=1&selectedrow='+row;
			else
				window.location.href=loc+'&selectedrow='+row;
		}	 
	});
}
</script>
<script>
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});
</script>

</head>
<body>

	<?php include_once('_header.php'); ?>
    
    <section class="boxes wh w3-left">
        <!--<div class="w3-container">-->
            <!--<div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Transactions</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						include_once('zf-TxnService2.php');
						include_once('zf-User.php');
						/**************************/
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where 1=1 and type in(5) ";
						if(isset($_REQUEST['search']))
						{
							if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
							if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
							if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
							if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
							if(isset($_REQUEST['s5'])) $s5=mysql_real_escape_string($_REQUEST['s5']);
							if($s1!=""){$cond.=" and rc_id='$s1' ";}
							if($s2!=""){$cond.=" and user_id = '$s2' ";}
							if($s3!=""){$cond.=" and mobile_number='$s3' ";}
							if($s4!=""){$cond.=" and user_department_info like '%$s4%' ";}
							if($s5!=""){$cond.=" and user_status='$s5' ";}
						}
						$total_records=show_orders_count($cond);
						$user_result=show_orders_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>TRANSACTIONS - Prepaid Mob Recharge, DTH Recharge, PostPaid Mob Bill <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="get">
								<ul>
                                    <li>
										<label>Txn ID</label>
                                        <input name="s1" id="s1" onclick="clrval()" value="<?php echo $s1;?>" type="number" placeholder="Txn ID" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User Id</label>
                                        <input name="s2" id="s2" onclick="clrval()" value="<?php echo $s2;?>" type="text" placeholder="User Id" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Mobile</label>
                                        <input name="s3" id="s3" onclick="clrval()" value="<?php echo $s3;?>" type="text" placeholder="Mobile" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>&nbsp;</label>
										<button name='search' value='search' class="w3-button w3-blue w3-round">Search</button>
                                    </li>                                    
                                </ul>
                            </form>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>TXN ID</span>
                                    <span>DATE</span>
                                    <span>USER ID</span>
                                    <span>USER NAME</span>
                                    <span>TXN TYPE</span>
                                    <span>OPERATOR</span>
                                    <span>MOBILE</span>
                                    <span>RECHARGE</span>
                                    <span>DEDUCTED</span>
                                    <span>STATUS</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;
									$txn_type=$user_row['type'];
									if($txn_type==3)
										$txn_type="<b class='w3-text-blue'>PREPAID MOBILE RECHARGE</b>";
									else if($txn_type==4)
										$txn_type="<b class='w3-text-green'>DTH RECHARGE</b>";
									else if($txn_type==5)
										$txn_type="<b class='w3-text-orange'>POSTPAID MOBILE BILL</b>";
									
									$rc_id=$user_row['rc_id'];
									$txn_status2=$txn_status=$user_row['rc_status'];
									if($txn_status==0)
									{
										$txn_status="Not Initiated";
									}
									else if($txn_status==1)
									{
										$txn_status="<b class='w3-text-blue'>Initiated</b>";
									}
									else if($txn_status==2)
									{
										$txn_status="<b class='w3-text-green'>Success</b>";
									}
									else if($txn_status==3)
									{
										$txn_status="<b class='w3-text-blue'>Response Awaited</b>";
									}
									else if($txn_status==4 || $txn_status==-4)
									{
										$txn_status="<b class='w3-text-red'>Refund Pending</b>";
									}
									else if($txn_status==5)
									{
										$txn_status="<b class='w3-text-blue'>Refunded</b>";
									}
									else
									{
										$txn_status="<b class='w3-text-blue'>In Progress</b>";
									}
									$recheck="";
									$dt1=strtotime($user_row['created_on']);
									$dt2=time();
									if($txn_status2!=5 && $dt2-$dt1<=259200)
									{
										//$oidcheck=$user_row['tid'];
										//if($oidcheck!=0)
										$recheck=" &nbsp;<img title='Re-Check Status of Order $rc_id' src='img/refresh-icon.png' onclick='recheck(\"$rc_id\",\"$txn_status2\",\"$i\")'>";
									}
								?>
                                <li>
                                	<span><?php echo $rc_id;?></span>
                                    <span><?php echo $user_row['created_on'];?></span>
                                    <span><?php echo $user_row['user_id'];?></span>
                                    <span><?php echo show_user_name($user_row['user_id']);?></span>
                                    <span><?php echo $txn_type;?></span>
                                    <span><?php echo $user_row['operator'];?></span>
                                    <span><?php echo $user_row['mobile_number'];?></span>
                                    <span><?php echo $user_row['amount'];?></span>
                                    <span><?php echo $user_row['deducted_amt'];?></span>
                                    <span><?php echo $txn_status.$recheck;?></span>
                                </li>
								<?php
								}
								?>
                            </ul>
                        </div>                        
                        
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
    
    <section class="wh w3-left w3-center w3-margin-top <?php if($total_records==0) echo "display-none";?>">
    	<div class="w3-row-padding">
        	<div class="w3-col m12">
            	<div class="w3-bar">
                  <a title="Jump to First Page" href='?page=1<?php echo $qr;?>' class='w3-button'><img src='img/pre-icon.png' style='margin-bottom:0px;'></a>
				<?php
				$total_pages = ceil($total_records / $num_rec_per_page);
				$pager=1;
				$cur_pos=$page;
				if($page-$pager>=2 && $page-$pager<=0)
					$pager=1;
				else
					$pager=$page-2;
				if($pager<0)
					$pager=1;
				
				$pre_pager=$pager-3;
				if($pre_pager>0)
				echo "<a title='Jump to Previous 5 Pages' href='?page=$pre_pager$qr' class='w3-button'><img src='img/pres-icon.png' style='margin-bottom:0px;'></a>";
				for(;$pager<=$total_pages && $pager<=$page+2;$pager++) 
				{ 
						$selection="";
						if($page==$pager)
							$selection=" w3-green";
						if($pager>0)
						echo "<a href='?page=$pager$qr' class='w3-button $selection'>$pager</a>";
				};
				$post_pager=$pager+2;
				if($post_pager<$total_pages)
				echo "<a title='Jump to Next 5 Pages' href='?page=$post_pager$qr' class='w3-button'><img src='img/nexts-icon.png' style='margin-bottom:0px;'></a>";
				?>
                  <a title="Jump to Last Page" href='?page=<?php echo $total_pages.$qr;?>' class='w3-button'><img src='img/next-icon.png' style='margin-bottom:0px;'></a>
                </div>
            </div>
    	</div>
    </section>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
