<!DOCTYPE html>
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
<div class="nav">
	<nav>
		<ul>
			<li onclick="showThisYearsTeams()">
				This Years Teams
			</li>
			<li onclick="search()">
				Search Team History
			</li>
			<li onclick="searchEventsByYear()">
				List Events For Year
			</li>
			<li onclick="listAwards()">
				List Teams Awards
			</li>
		<ul>
	</nav>
</div>
	
<input style="margin-top:20px" type="text" id="searchbar" style="width:200px" />
<br>
<ul id="currentTeams" style="display:none"></ul>
<ul id="searchData" style="display:none"></ul>


	<script>
	var url = 'https://cors-anywhere.herokuapp.com/'+ 'https://www.thebluealliance.com/api/v3/district/2020in/teams';
	$(document).ready(function() {
		$.ajaxSetup({
			headers : {
				'X-TBA-Auth-Key':'VG6oKsnz6E2EheeIFFkZwHjcAT66vwpttZTXWmXyPOSMyjmRyrA9Q5I8cUeiZTeJ',
				'accept':'application/json'
			}
		});
		$.getJSON(url,
			getFRCTeamSuccess,
			getFRCTeamError);
	});
	
	
	function getFRCTeamSuccess(data) {
		for(var i = 0; i < data.length; i++) {

			var body = document.getElementById('currentTeams');
			var team_key = data[i].key;
		    var nickname = data[i].nickname;
			var website = data[i].website;
			var joined = data[i].rookie_year;
			
			var genOut = team_key + " - " + nickname + " - JOINED: " + joined;
			var node = document.createElement("LI");
			var textnode = document.createTextNode(genOut);
			node.appendChild(textnode);
			body.appendChild(node);
		}
	}
	function getFRCTeamError(error) {
		console.log(error);
	}
	function showThisYearsTeams() {
		document.getElementById('searchData').style.display = "none";
		document.getElementById('currentTeams').style.display = "block";
	}
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
		var body = document.getElementById('searchData');
		var team = document.getElementById('searchbar').value;
		$("#searchData").empty();
		
		if(!team.includes("frc")){
			team = "frc" + team;
		}
		var data = getTeamAwards(team);
		
		for(var i = 0; i < data.length; i++) {
			var output = "Award: " + data[i].name + "\n";
			output += "Year: " + data[i].year + " | Event Key: " + data[i].event_key;
			
			var node = document.createElement("LI");
			var textnode = document.createTextNode(output);
			node.appendChild(textnode);
			body.appendChild(node);
		}
		body.style.display = "block";
	}
	function getTeamInfoSuccess(data) {
		var body = document.getElementById('searchData');
		var key = data.key;
		var name = data.name;
		var nickname = data.nickname;
		var rookie_year = data.rookie_year;
		var state_prove = data.state_prov;
		var team_number = data.team_number;
		var website = data.website;
		
		var node = document.createElement("LI");
			var textnode = document.createTextNode("Name: " + name);
			node.appendChild(textnode);
		body.appendChild(node);
		node = document.createElement("LI");
		textnode = document.createTextNode("Rookie Year: " + rookie_year);
		node.appendChild(textnode);
		body.appendChild(node);
		node = document.createElement("LI");
		textnode = document.createTextNode("Nickname: " + nickname);
		node.appendChild(textnode);
		body.appendChild(node);
		node = document.createElement("LI");
		textnode = document.createTextNode("State Province: " + state_prove);
		node.appendChild(textnode);
		body.appendChild(node);
		node = document.createElement("LI");
		textnode = document.createTextNode("Website: " + website);
		node.appendChild(textnode);
		body.appendChild(node);
		body.style.display = "block";
		
		
	}
	function getTeamInfoError(error) {
		console.log(error);
	}
	
	function searchEventsByYear() {
		document.getElementById('currentTeams').style.display = "none";

		//Get searchbar data
		var year = document.getElementById('searchbar').value;
		var body = document.getElementById('searchData');
		var data = getListOfEventsByYear(year);
		$("#searchData").empty();
		for(var i = 0; i < data.length; i++) {
			var output = data[i].type + " in " + data[i].city + ", " + data[i].country + "\n";
			output += "Event Key: " + data[i].key + "\n";
			output += "Starts: " + data[i].start_date + " | Ends: " + data[i].end_date;
			var node = document.createElement("LI");
			var textnode = document.createTextNode(output);
			node.appendChild(textnode);
			body.appendChild(node);
		}
		body.style.display = "block";
	}
	</script>
</body>
</html>