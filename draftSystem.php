<!DOCTYPE html>
<?php
	$loggedIn = false;
	$username;
	//libxml_use_internal_errors(true);
	if (isset($_COOKIE["username"])){
		$username = $_COOKIE["username"];
		$loggedIn = true;
		header("Refresh: 3");
	} else {
		//Redirect to login page
		header("Location:login.php");
	}
	
	//GET user division, then load table for that division.
	
	
	
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title>Draft System</title>
	<script src="draftAPI.js"></script>
	<style>
	body {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		
	}
	table {
		border-collapse: collapse;
	}
	tr {
		border: 1px solid black;
	}
	td {
		border: 1px solid black;
	}
	.nav {
		display: block;
		height: 2.5em;
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		background-color: #222222;
		width: 100%;
		color: white;
	}
	.nav nav ul {
		display: block;
		list-style: none;
		margin: 0;
		padding: 0;
	}
	.nav nav ul li {
		text-align: center;
		display: inline-block;
		box-sizing: border-box;
		padding: .6em;
		height: 2.5em;
	}
	.nav nav ul li:hover {
		background-color: #4a4a4a;
	}
	.nav nav { display: block; };
	
	</style>
</head>
<body>
<script>var loggedIn = "<?php echo $loggedIn; ?>";
</script>
<div class="nav">
	<nav>
		<ul>
			<li onclick="getThisYearsTeams()">
				Draft Teams
			</li>
			<li onclick="search()">
				Search Team Info
			</li>
			<li onclick="searchEventsByYear()">
				List Events For Year
			</li>
			<li onclick="listAwards()">
				List Teams Awards
			</li>
			<li style="float:right">
				<?php echo $username; ?>
			</li>
		<ul>
	</nav>
</div>
	
<input style="margin-top:20px" type="text" id="searchbar" style="width:200px" />
<br>
<ul id="currentTeams" style="display:none"></ul>
<ul id="searchData" style="display:none"></ul>
<table id="results-table" style="display:none">

<p id="usrVal" style="display:none;"></p>
</table>
<table id="drafting-table">
	<tr>
		<th>Nickname:</th>
		<th>Joined:</th>
		<th>Website:</th>
		<th>Team #:</th>
		<th>Average OPR</th>
		<th>Average DPR</th>
		<th>Pick Team</th>
	</tr>
<?php
	$division;
	$query = "SELECT * FROM divisions WHERE username='".$username."'";
		$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	$result = mysqli_query($conn, $query);
	
	if(mysqli_num_rows($result) === 0) {
		$error = "RIP";
	} else {
		$row = mysqli_fetch_assoc($result);
		$division = $row['division'];
	}
	

	$query = "SELECT * FROM drafted_teams WHERE division='".$division."' AND username IS NULL";
	$results = mysqli_query($conn,$query);
	
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($results)) {
			echo "<tr>";
			echo "<td></td><td></td><td></td>";
			echo "<td>".$row["team_num"]."</td>";
			echo "<td></td><td></td>";
			echo "<td><button onclick=\"draftAnnouncement(this)\">Pick</button></td>";
			echo "</tr>";
		}
	}
	
	?>
</table>

	<script>
	loadOPRS();
	loadDPRS();
	function search() {
		document.getElementById('currentTeams').style.display = "none";
		$("#searchData").empty();
		//Get searchbar data
		var team_num = document.getElementById('searchbar').value;
		//Format the input here:
		if(team_num.includes("frc")) {
			team_num = team_num.replace("frc","");
		}
		var url = 'https://cors-anywhere.herokuapp.com/'+ 'https://www.thebluealliance.com/api/v3/team/frc' + team_num;
		$.ajaxSetup({
			headers : {
				'X-TBA-Auth-Key':'VG6oKsnz6E2EheeIFFkZwHjcAT66vwpttZTXWmXyPOSMyjmRyrA9Q5I8cUeiZTeJ',
				'accept':'application/json'
			}
		});
		$.getJSON(url,
			getTeamInfoSuccess,
			getTeamInfoError);
	}
	function listAwards() {
		var table = document.getElementById('results-table');
		table.innerHTML = "";
		table.style.display = "block";
		var header = table.insertRow(0);
		var th1 = header.insertCell(0);
		var th2 = header.insertCell(1);
		var th3 = header.insertCell(2);
		
		th1.innerHTML = "Award Name:";
		th2.innerHTML = "Event Key:";
		th3.innerHTML = "Year:";
		
		var team = document.getElementById('searchbar').value;
		$("#searchData").empty();
		
		if(!team.includes("frc")){
			team = "frc" + team;
		}
		var data = getTeamAwards(team);
		
		for(var i = 0; i < data.length; i++) {
			var row = table.insertRow(i + 1);
			var awardType = row.insertCell(0);
			var eventkey = row.insertCell(1);
			var eyear = row.insertCell(2);
			
			awardType.innerHTML = data[i].name;
			eventkey.innerHTML = data[i].event_key;
			eyear.innerHTML = data[i].year;
		}

	}
	function getTeamInfoSuccess(data) {
		var body = document.getElementById('searchData').style.display = "none";
		document.getElementById('currentTeams').style.display = "none";
		var table = document.getElementById('results-table');
		table.innerHTML = "";
		table.style.display = "block";
		var key = data.key;
		var name = data.name;
		var nickname = data.nickname;
		var rookie_year = data.rookie_year;
		var state_prove = data.state_prov;
		var team_number = data.team_number;
		var website = data.website;
		
		var row = table.insertRow(0);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		cell1.innerHTML = "Name";
		cell2.innerHTML = name;
		row = table.insertRow(1);
		cell1 = row.insertCell(0);
		cell2 = row.insertCell(1);
		cell1.innerHTML = "Rookie Year";
		cell2.innerHTML = rookie_year;
		row = table.insertRow(2);
		cell1 = row.insertCell(0);
		cell2 = row.insertCell(1);
		cell1.innerHTML = "Nickname";
		cell2.innerHTML = nickname;
		row = table.insertRow(3);
		cell1 = row.insertCell(0);
		cell2 = row.insertCell(1);
		cell1.innerHTML = "State Province";
		cell2.innerHTML = state_prove;
		row = table.insertRow(4);
		cell1 = row.insertCell(0);
		cell2 = row.insertCell(1);
		cell1.innerHTML = "Website";
		cell2.innerHTML = website;
		
		
	}
	function getTeamInfoError(error) {
		console.log(error);
	}
	
	function searchEventsByYear() {
		document.getElementById('currentTeams').style.display = "none";
		var table = document.getElementById('results-table');
		table.innerHTML = "";
		table.style.display = "block";
		//Get searchbar data
		var year = document.getElementById('searchbar').value;
		var data = getListOfEventsByYear(year);
		$("#searchData").empty();
		
		var header = table.insertRow(0);
		var th1 = header.insertCell(0);
		var th2 = header.insertCell(1);
		var th3 = header.insertCell(2);
		var th4 = header.insertCell(3);
		var th5 = header.insertCell(4);
		var th6 = header.insertCell(5);
		th1.innerHTML = "Type:";
		th2.innerHTML = "City:";
		th3.innerHTML = "Country:";
		th4.innerHTML = "Event Key:";
		th5.innerHTML = "Starts:";
		th6.innerHTML = "Ends:";
		
		for(var i = 0; i < data.length; i++) {
			var output = data[i].type + " in " + data[i].city + ", " + data[i].country + "\n";
			output += "Event Key: " + data[i].key + "\n";
			output += "Starts: " + data[i].start_date + " | Ends: " + data[i].end_date;
			
			var row = table.insertRow(i+1);
			var type = row.insertCell(0);
			var city = row.insertCell(1);
			var country = row.insertCell(2);
			var key = row.insertCell(3);
			var starts = row.insertCell(4);
			var ends = row.insertCell(5);
			
		    type.innerHTML = data[i].type;
			city.innerHTML = data[i].city;
			country.innerHTML = data[i].country;
			key.innerHTML = data[i].key;
			starts.innerHTML = data[i].start_date;
			ends.innerHTML = data[i].end_date;
		}

	}
	/* This event happens when the user drafts a team */
	function  draftAnnouncement(elementId) {
		/*  AJAX */
		
		
		
		
		var row = elementId.parentNode.parentNode.rowIndex;
		var teamNum = document.getElementById("drafting-table").rows[row].cells[3].innerHTML;
		var name = "<?php echo $username; ?>";
		
		$.ajax({
			url: 'draftTeam.php',
			type: 'POST',
			data: { "username":name, "teamnum":teamNum},
			success: function(aData) {
				console.log("Worked");
				console.log(aData);
			}
		});
		document.getElementById("drafting-table").deleteRow(row);
		alert("You have drafted team " + teamNum);
		var table = document.getElementById("drafting-table");
		var length = document.getElementById("drafting-table").rows.length;
		for(var i = 0; i < length; i++) {
				var r = table.rows[i];
				r.deleteCell(6);
		}
	}
	</script>
	
	<script>
	//LOAD ALL DRAFTING DATA
	var table = document.getElementById("drafting-table");
	var length = document.getElementById("drafting-table").rows.length;
	if(localStorage.getItem("teams") == null) {
			$.ajaxSetup({
				headers : {
					'X-TBA-Auth-Key':'VG6oKsnz6E2EheeIFFkZwHjcAT66vwpttZTXWmXyPOSMyjmRyrA9Q5I8cUeiZTeJ',
					'accept':'application/json'
				}
			});
		$.getJSON('https://cors-anywhere.herokuapp.com/'+ 'https://www.thebluealliance.com/api/v3/district/2020in/teams',
			function(aData) {
				for(var i = 1; i < length; i++) {
					var r = table.rows[i];
					var nickname = r.cells[0];
					var joined = r.cells[1];
					var website = r.cells[2];
					var teamnum = parseInt(r.cells[3].innerHTML);
					var avgOPR = r.cells[4];
					var avgDPR = r.cells[5];
					
					
					var oprNum = getTeamOPR(teamnum);
					var dprNum = getTeamDPR(teamnum);
					
					
					avgOPR.innerHTML = oprNum;
					avgDPR.innerHTML = dprNum;
					localStorage.setItem(teamnum + ":OPR",oprNum);
					localStorage.setItem(teamnum + ":DPR",dprNum);
					for(var j = 0; j < aData.length; j++) {
						if(teamnum == aData[j].team_number) {
							nickname.innerHTML = aData[j].nickname;
							joined.innerHTML = aData[j].rookie_year;
							website.innerHTML = aData[j].website;
							
							localStorage.setItem(teamnum + ":nickname",aData[j].nickname);
							localStorage.setItem(teamnum + ":joined",aData[j].rookie_year);
							localStorage.setItem(teamnum + ":website",aData[j].website);
							break;
						}
					}					
				}
				localStorage.setItem("teams","saved");
			});
	} else {
		for(var i = 1; i < length; i++) {
			var r = table.rows[i];
			var nickname = r.cells[0];
			var joined = r.cells[1];
			var website = r.cells[2];
			var teamnum = parseInt(r.cells[3].innerHTML);
			var avgOPR = r.cells[4];
			var avgDPR = r.cells[5];
			
			nickname.innerHTML = localStorage.getItem(teamnum + ":nickname");
			joined.innerHTML = localStorage.getItem(teamnum + ":joined");
			website.innerHTML = localStorage.getItem(teamnum + ":website");
			avgOPR.innerHTML = localStorage.getItem(teamnum + ":OPR");
			avgDPR.innerHTML = localStorage.getItem(teamnum + ":DPR");
		}
	}
	
	
	</script>
</body>
</html>