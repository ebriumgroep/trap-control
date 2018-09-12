<?php
	$servername = "localhost";
	$dUsername = "root";
	$dPassword = "";
	$db = "erbium";
	$returnedString = "";

	session_start();
	$active_client = $_SESSION['clientId'];


	$conn = new mysqli($servername, $dUsername, $dPassword, $db);
//TODO
    $sql = "SELECT  client_id, hardware_id, token, type, Upload_Interval from device";
    $result = $conn->query($sql);
    $counter = 0;
	
	if($result->num_rows > 0)
	{
        $result_array = array();
		while ($row = $result->fetch_assoc()) {
			# code...
			if($row["client_id"] == $active_client)
			{
                $result_array[] = array($row["hardware_id"],$row["token"],$row["type"],$row["Upload_Interval"]);
				//$returnedString .=  $row["hardware_id"].' '.$row["type"]."\n";
            }
            $counter = $counter + 1;
		}
	}
    $json_array = json_encode($result_array);
	// phpLog($returnedString);
	$conn->close();
	//echo ($returnedString);

?>
<!DOCTYPE html>

<html>


<head>
<link rel="stylesheet" type="text/css" href="modalcss.css">
<script src="modalJS.js"></script>
<title>Erbuim Project</title>

<style>
body{
    
    background: url("background.jpg") no-repeat center center fixed;
    -webkit-background-size: cover; /* For WebKit*/
    -moz-background-size: cover;    /* Mozilla*/
    -o-background-size: cover;      /* Opera*/
    background-size: cover;  
    
}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
.trap {
    background-color: grey;
          height: 200px;
          width:200px;
          margin-left: 20px;
          margin-top: 10px;
          float:left;
}
#heading {
            margin:auto;
            width: 800px;
            height: 400px;
            background-color: #696969;;
            position: absolute;
            top:4;
            bottom: 4;
            left: 0;
            right: 0;

         }


#menu {
         background-color:rgb(7, 7, 7);
         color:white;
         font-family: Arial, Helvetica, sans-serif;
         height: 100px;
      }
.buttons{
    background-color: rgb(255, 238, 0);
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
#traps{
    border:1px solid black;
    min-height: 100px;
	overflow: hidden;
	background-color:rgba(0, 0, 0, 0.5);
}
#Traps{
    background-color:rgba(0, 0, 0, 0.5);
}

</style>

</head>


<body onload="displayNumOfTraps()">
<!-- PHP LOGIN WAS HERE -->

<div id="menu">
<label style="margin-left: 1000px">Settings</label>
<label style="margin-left: 20px">Contact Us</label>
<label style="margin-left: 20px">About Us</label><br><br><br>

<!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Traps')">Traps</button>
  <button class="tablinks" onclick="openCity(event, 'Graphs')">Graphs</button>
</div>



<div id="Traps" class="tabcontent">
<p> Welcome <?php echo $_SESSION['fullname']; ?>. This is an overview of all the registered traps in your name<p><br>
<button onclick="addTrap()" class="buttons">Add Trap</button><br>
<!-- testing trap add locally on this html page 
<button onclick="addTrapDiv()">test trap add</button> -->

<label id="trapNo"></label><br>

<label style="margin-left: 20px">Sort Traps By :</label>
<select>
  <option value="numOfMoths">Number of moths</option>
  <option value="Temp">Temprature</option>
  <option value="GroupMac">Group Macadamia</option>
  <option value="GroupOrch">Group Orchard</option>
    <option value="Add another group">Add another group</option>
</select><br><br>
<div id="modal" name="EditModal">
        <span class="close-button" onclick="close_click()"> X </span>
        Trap Type: <input type="text" id="editType"><br>
        Hardware ID: <input type="text" id="editHardwareID"><br>
        Upload Interval: <!--<input type="text" id="editUpload"><br>-->
        <select id="upload_interval">
                <option value="Everyhour">Every hour</option>
                <option value="fiveperday">Five times a day</option>
                <option value="threeperday">Three times a day</option>
                <option value="onceperday">Once a day</option>
        </select><br>
        Humidity and Temprature interval: 
        <select>
            <option value="Everyhour">Every hour</option>
            <option value="Twiceperday">Twice per day</option>
            <option value="Onceperday">Once per day</option>
        </select><br><br><br>

        <button>Submit changes for SINGLE trap</button><br>
        <button>Submit changes for ALL traps</button><br>

</div>
<div id="modal2" name="addTrapModal">
        <span class="close-button" onclick="close_click()"> X </span>
		<form method="POST" action="addTrap.php">
			Trap Type: <input type="text" id="addTraptype" name="type"><br>
			Hardware ID: <input type="text" id="addTraphardware" name="hardware"><br>
			Upload Interval: <!--<input type="text" id="editUpload"><br>-->
			<select id="Trap_upload_interval" name="upload_interval">
                <option value="Everyhour">Every hour</option>
                <option value="fiveperday">Five times a day</option>
                <option value="threeperday">Three times a day</option>
                <option value="onceperday">Once a day</option>
			</select><br>
			<input type="submit" value="Submit">
		</form>
        
        <button onclick="document.location.reload()">Submit</button>

</div>
<div id="traps"> <!-- traps will be displayed in here -->

</div>


<div id="Graphs" class="tabcontent" style ="height:490px">

<label style ="margin-left: 300px">Start Date :</label> <input type="text" id="start" style="margin-left: 20px">
<label style="margin-left: 20px">End Date :</label> <input type="text" id="start" style="margin-left: 20px">


<label style="margin-left: 20px">Filter :</label>
<select>
  <option value="individual">Individual</option>
  <option value="groups">Groups</option>
</select><br><br>


<div id="heading"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<button style ="width: 130px;margin-left: 160px;">Export</button>
<button style ="margin-left: 20px;width: 130px">Email</button>
<button style ="margin-left: 20px;width: 130px">Print</button>

</div>

<!-- <script type="text/javascript" src="addTrap.js"></script> -->
<script>

//trap management
var numOfTraps = 0;
//to sort we will have to read each one again from db and allocate a certain index in the array based on the parameters
// var trapArr = new Array();
// var arrayTraps;
//  trapArr[0] = new Array("Moth","9898787987","Once a day");
//  trapArr[1] = new Array("Moth","2039810921","Twice a day");
// trapArr[2] = new Array("Moth","0130981202","Every hour");
// trapArr[3] = new Array("Moth","0981202","Every 2 hours");
function displayNumOfTraps()
{
    var trapArr = <?php echo $json_array; ?>;
    for(i=0;i<trapArr.length;i++)
                    {
                        for(j=0;j<trapArr[i].length;j++)
                        {
                            //alert(trapArr[i][j] + " ");
                            
                        }
                        //array format = hardware id, token, type, upload
                        addTrapDiv(trapArr[i][0], trapArr[i][1], trapArr[i][2], trapArr[i][3]); 
                    }
    document.getElementById("trapNo").innerHTML = "The number of traps atm is: " + numOfTraps;
}

function addTrapDiv(tempName,token,type,upload)
{
    var name = tempName;
    var TrapType = type;
    var UploadInt = upload;
     numOfTraps++;
    //var tempName = prompt("Please enter a temp name for testing","");
    var iDiv = document.createElement('div');
        iDiv.id = tempName;
        iDiv.className = "trap";
        iDiv.onclick = function(){
            document.getElementById("editHardwareID").value = name;
            document.getElementById("upload_interval").value = UploadInt;
            document.getElementById("editType").value = TrapType;
        }
    var clickMe = document.createElement("button");
        clickMe.innerHTML = "Edit";
        clickMe.id = "editTrap";
        clickMe.onclick = function() {
            document.getElementById("modal").style.visibility = "visible";
        }
    var tempLbl = document.createElement("label");
        tempLbl.innerHTML = "<br> Trap Temp: <br>";
    var humidLbl = document.createElement("label");
        humidLbl.innerHTML = "Trap Humidity: <br>";
    var tempText = document.createElement("input");
        tempText.type = "text";
        tempText.id = "tempText";
        tempText.value = "23";
    var humidText = document.createElement("input");
        humidText.type = "text";
        humidText.id = "humidText";
        humidText.value = "12";
    var tokenText = document.createElement("header");
        tokenText.innerHTML = "Caught: " + token;
        tokenText.style.fontSize = "40px";

    document.getElementById("traps").appendChild(iDiv);
    var iHeader = document.createElement('header');
    iHeader.innerHTML = "Hardware ID nom: " + tempName;
    iDiv.appendChild(iHeader);
    iDiv.appendChild(clickMe);
    iDiv.appendChild(tokenText);
    iDiv.appendChild(tempLbl);iDiv.appendChild(tempText);
    iDiv.appendChild(humidLbl);iDiv.appendChild(humidText);
    
    //document.getElementById("clickInfo").onclick = function(){
        /* if(trapClick() == "yes")
        {
            this.parentElement.removeChild(this);
            numOfTraps--;
            displayNumOfTraps();
        } */
        // Get the modal
                // var modal = document.getElementById('myModal');
                // // Get the image and insert it inside the modal - use its "alt" text as a caption
                // //var mainModal = document.getElementById('clickInfo');
                // //var modalImg = document.getElementById("img01");
                // var captionText = document.getElementById("caption");
                // clickMe.onclick = function(){
                //     modal.style.display = "block";
                //     document.getElementById("myModel").appendChild(test);
                // }
                
                // // Get the <span> element that closes the modal
                // var span = document.getElementsByClassName("close")[0];
                
                // // When the user clicks on <span> (x), close the modal
                // span.onclick = function() { 
            
                //     modal.style.display = "none";
               // }
    //} 
     
    //displayNumOfTraps();

}
// function trapClick(){
    // if(confirm("Delete?"))
        // return "yes";
    // else
        // return "no";
// }
//for the tab    
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
function addTrap(){
document.getElementById("modal2").style.visibility = "visible";
}
</script>
	
</body>





</html>