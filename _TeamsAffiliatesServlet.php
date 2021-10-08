<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>

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
                    	<div class="box-head">
                        	<h3>LIST OF AFFILIATES <span class="w3-right w3-blue w3-center badges">122</span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>DATE OF JOINING</span>
                                    <span>NAME</span>
                                    <span>CITY</span>
                                    <span>SOFTWARE FEE</span>
                                    <span>SECURITY FEE</span>
                                    <span>WALLET BALANCE</span>
                                    <span>AFFILIATES CONNECTED</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
                                <li>
                                	<span>1</span>
                                    <span>12-Dec-2017</span>
                                    <span>Ram</span>
                                    <span>Chandigarh</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>Active</span>
                                    <span><a  class="add-icon add"></a></span>
                                </li>
                                <li>
                                	<div class="address inner-add wh w3-left">
                                        <p><strong>Address:-</strong> Neel giri apartment, Fortview Road Opposite JK Hospital, Near Arti Petrol Pump</p>
                                        <p><strong>Email:-</strong> ABC@gmail.com</p>
                                        <p><strong>Contact No:-</strong> 1234567890</p>
                                        <p><strong>Joined Through:-</strong> Aff 1/Aff 2/Aff 3/Aff 4</p>
                                    </div>
                                </li>
                                <li>
                                	<span>1</span>
                                    <span>12-Dec-2017</span>
                                    <span>Ram</span>
                                    <span>Chandigarh</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>Active</span>
                                    <span><a  class="add-icon add2"></a></span>
                                </li>
                                <li>
                                	<span>1</span>
                                    <span>12-Dec-2017</span>
                                    <span>Ram</span>
                                    <span>Chandigarh</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>01234</span>
                                    <span>Active</span>
                                    <span><a  class="add-icon add"></a></span>
                                </li>
                            </ul>
                        </div>                        
                        
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
    
    <section class="wh w3-left w3-center w3-margin-top">
    	<div class="w3-row-padding">
        	<div class="w3-col m12">
            	<div class="w3-bar">
                  <a  class="w3-button"><img src="img/pre-icon.png" style="margin-bottom:0px;"></a>
                  <a  class="w3-button w3-green">1</a>
                  <a  class="w3-button">2</a>
                  <a  class="w3-button">3</a>
                  <a  class="w3-button">4</a>
                  <a  class="w3-button"><img src="img/next-icon.png" style="margin-bottom:0px;"></a>
                </div>
            </div>
    	</div>
    </section> 
       
    <?php include_once('_footer.php');?>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

</body>
</html> 