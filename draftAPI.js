var sEcReT_cOdE = 'VG6oKsnz6E2EheeIFFkZwHjcAT66vwpttZTXWmXyPOSMyjmRyrA9Q5I8cUeiZTeJ';
var base = 'https://cors-anywhere.herokuapp.com/'+ 'https://www.thebluealliance.com/api/v3/';
var data = [];
var o
var averageOPRS;
var averageDPRS;

var temps;
var file;
var loaded = false;
function wait(ms) {
	var d = new Date();
	var d2 = null;
	do { d2 = new Date(); }
	while(d2-d < ms);
}

//ALL BLUE ALLIANCE STUFF HERE https://www.thebluealliance.com/apidocs/v3
//Get Functions
function getEventInfo(event_code) {
	
	
}
/**
 * Returns the average OPR of the team called in
*/
function getStatus(){
	var file = $.getJSON("https://techhounds.com/FRC%20Fantasy/databases/AverageOPRS.json"),
		checker = $.when(file);
	checker.done(function() {
		console.log(file.response);
	});
}
function getAverageDPRS(teamnum) {
	loaded = false;
	$.getJSON("/FRC%20Fantasy/databases/AverageDPRS.json",function(dat) {
		console.log("loading...");
		var keys = Object.keys(dat);
		for(var i = 0; i < keys.length; i++) {
			if(keys[i] == ("frc" + teamnum)) {
				return dat[keys[i]];
			}
		}
	}, defaultError);
}
function getTeamDPR(teamnum) {
	var keys = Object.keys(averageDPRS);
	for(var i = 0; i < keys.length; i++) {
		if(keys[i] == ("frc" + teamnum)) {
			return averageDPRS[keys[i]];
		}
	}
}
function loadDPRS() {
	$.getJSON("/FRC%20Fantasy/databases/AverageDPRS.json",function(stuff) {
		averageDPRS = stuff;
	},defaultError);
}
function loadOPRS() {
	$.getJSON("/FRC%20Fantasy/databases/AverageOPRS.json",function(stuff) {
		averageOPRS = stuff;
	},defaultError);
}
function getTeamOPR(teamnum) {
	var keys = Object.keys(averageOPRS);
	for(var i = 0; i < keys.length; i++) {
		if(keys[i] == ("frc" + teamnum)) {
			return averageOPRS[keys[i]];
		}
	}
}
function getAverageOPRS(teamnum) {
	loaded = false;
	$.getJSON("/FRC%20Fantasy/databases/AverageOPRS.json",function(dat){
		console.log("loading...");
		console.log(dat);
		var keys = Object.keys(dat);
	for(var i = 0; i < keys.length; i++) {
		if(keys[i] == ("frc" + teamnum)) {
			return dat[keys[i]];
		}
	}
	},defaultError);
}

/**
 * Will Get the Key of every event this team has been to as an array
*/
function getTeamEvents(teamnum) {
	var append = 'team/frc' + teamnum + '/events';
	var url = base + append;
	$.ajaxSetup({
		headers : {
			'X-TBA-Auth-Key':sEcReT_cOdE,
			'accept':'application/json'
		}
	});
	var file = $.getJSON(url),
		checker = $.when(file);
	//Get JSON Cases Here
	checker.done(function() {
		var len = file.length;
		var events =[];
		for(var i = 0; i < len; i++) {
			var evnt = {
				key: file[i].key
			};
			events[i] = evnt;
		}
		temps = events;
	});
	checker.fail(function() {
		console.log("Failed retrieving Team Events Data");
	});
	//When implementing Loading use an always method
	checker.always(function() {
		//We should implement loading here later, ill figure out how.
	});
	
	return temps;
}

/*  - Award Documentation
	- ALL DATA WILL BE STORED IN AN ARRAY
	-yourVar[0] -> 1st awards information
	-yourVar[0].award_type -> Award Type (int)
	-yourVar[0].event_key -> Event Key
	-yourVar[0].name -> Award Name
	-yourVar[0].year -> Year (int)
*/
function getTeamAwards(team){
	var append = 'team/' + team + '/awards';
	var url = base + append;
	$.ajaxSetup({
		headers : {
			'X-TBA-Auth-Key':sEcReT_cOdE,
			'accept':'application/json'
		}
	});
	$.getJSON(url,
		teamAwardsSuccess,
		defaultError);
	return data;
}
/* - Some Simple Documentation
   - ALL DATA WILL BE STORED IN THE VARIABLE YOU CALLED
   - THIS FUNCTION WITH AS AN ARRAY
   -yourVar[0] = event 0 information
   -yourVar[0].city -> returns event city
   -yourVar[0].country -> returns event country
   -yourVar[0].key -> returns event key
   -yourVar[0].type -> returns event type (as String)
   -yourVar[0].address -> returns address 
   -yourVar[0].lat -> returns event latitude
   -yourVar[0].lng -> returns event longitude
   -yourVar[0].start_date -> returns start_date
   -yourVar[0].end_date -> returns event end date
*/
function getListOfEventsByYear(year) {
	var append = 'events/' + year;
	var url = base + append;
	$.ajaxSetup({
			headers : {
				'X-TBA-Auth-Key':sEcReT_cOdE,
				'accept':'application/json'
			}
		});
	$.getJSON(url,
		listOfEventsByYearSuccess,
		defaultError);
	return data;
}
/* - More Simple Documentation 
   - yourVar.ccwms is an array
   - yourVar.ccwms[0].team -> first team's id (as String)
   - yourVar.ccwms[0].ccwms -> first team's CCWMS
   - yourVar.dprs is an array
   - yourVar.dprs[0].team -> first team's id (as String)
   - yourVar.dprs[0].dprs -> first team's OPRS
   - yourVar.oprs is an array
   - yourVar.oprs[0].team -> first team's id (as String)
   - yourVar.oprs[0].oprs -> first team's DPRS 
*/

function getTeamsOPRS(teamnum, eventkey) {
	var teamid = 'frc' + teamnum;
	getEventOPRS(eventkey);
	wait(10);
	var op = data.oprs;
	var oprs;
	
	for(var i = 0; i < op.length; i++) {
		if(op[i].team == teamid) {
			return op[i].oprs;
		}
	}		
}
function getEventOPRS(event_key) {
	var append = 'event/' + event_key + '/oprs';
	var url = base + append;
	$.ajaxSetup({
			headers : {
				'X-TBA-Auth-Key':sEcReT_cOdE,
				'accept':'application/json'
			}
		});
	var file = $.getJSON(url,
		eventOPRSSuccess,
		defaultError);
	return data;
}

function getThisYearsTeams() {
	var urlstuff = 'https://cors-anywhere.herokuapp.com/'+ 'https://www.thebluealliance.com/api/v3/district/2020in/teams';
	$(document).ready(function() {
		$.ajaxSetup({
			headers : {
				'X-TBA-Auth-Key':'VG6oKsnz6E2EheeIFFkZwHjcAT66vwpttZTXWmXyPOSMyjmRyrA9Q5I8cUeiZTeJ',
				'accept':'application/json'
			}
		});
		$.getJSON(urlstuff,
			getFRCTeamSuccess,
			getFRCTeamError);
	});
}

function averageOPRSSuccess(succ) {
	console.log("in average oprs function");
	file = succ;
	loaded = true;
}

function getFRCTeamSuccess(data) {
		var table = document.getElementById('results-table');
		table.innerHTML = "";
		table.style.display = "block";
		//Insert Header
		var row = table.insertRow(0);
		var nickname = row.insertCell(0);
		var joined = row.insertCell(1);
		var website = row.insertCell(2);
		var teamNum = row.insertCell(3);
		var avgOPR = row.insertCell(4);
		var avgDPR = row.insertCell(5);
		var pickTeam = row.insertCell(6);
		
		nickname.innerHTML = "Nickname";
		joined.innerHTML = "Joined";
		website.innerHTML = "Website";
		teamNum.innerHTML = "Team #";
		avgOPR.innerHTML = "Average OPR";
		pickTeam.innerHTML = "Pick Team";
		
		for(var i = 0; i < data.length; i++) {
			var key = data[i].key;
		    var nick = data[i].nickname;
			var web = data[i].website;
			var join = data[i].rookie_year;
			var teamnum = data[i].team_number;
			var oprNum = getTeamOPR(teamnum);
			var dprNum = getTeamDPR(teamnum);
			
			row = table.insertRow(i+1);
			nickname = row.insertCell(0);
			joined = row.insertCell(1);
			website = row.insertCell(2);
			teamNum = row.insertCell(3);
			avgOPR = row.insertCell(4);
			avgDPR = row.insertCell(5);
			pickTeam = row.insertCell(6);
			
			nickname.innerHTML = nick;
			joined.innerHTML = join;
			website.innerHTML = web;
			teamNum.innerHTML = teamnum;
			avgOPR.innerHTML = oprNum;
			avgDPR.innerHTML = dprNum;
			pickTeam.innerHTML = "<button onclick=\"draftAnnouncement(this)\">Pick</button>";
		}
	}
	

	
	function getFRCTeamError(error) {
		console.log(error);
	}




//ALL PROCESSING Functions
function listOfEventsByYearSuccess(success) {
	var collector = [];
	var evt;
	for(evt in success) {
		var info = success[evt];
		//TODO: Format this code into a more readable format
		var n = {city:info.city, country:info.country,key:info.key,
		type:info.event_type_string,address:info.address,
		lat:info.lat,lng:info.lng,start_date:info.start_date,
		end_date:info.end_date};
		
		collector[evt] = n;
	}
	data = collector;
}
function defaultError(error) {
	console.log("in default error");
	console.log(error);
	data = [];
}

function eventOPRSSuccess(success) {
	var ccwmsEx = success.ccwms;
	var newccwms = [];
	var keys = Object.keys(ccwmsEx);
	for(var i = 0; i < keys.length; i++) {
		newccwms[i] = {team:keys[i],ccwms:ccwmsEx[keys[i]]};
	}
	data.ccwms = newccwms;
	
	var dprsEx = success.dprs;
	var newdprs;
	keys = Object.keys(dprsEx);
	for(var i = 0; i < keys.length; i++) {
		newdprs[i] = {team:keys[i],dprs:dprsEx[keys[i]]};
	}
	data.dprs = newdprs;
	
	var oprsEx = success.oprs;
	var newoprs;
	keys = Object.keys(oprsEx);
	for(var i = 0; i < keys.length; i++) {
		newoprs[i] = {team:keys[i],oprs:oprsEx[keys[i]]};
	}
	data.oprs = newoprs;
}
function teamAwardsSuccess(success) {
	var len = success.length;
	var awards = [];
	for(var i = 0; i < len; i++) {
		var award = {
			award_type:success[i].award_type,
			event_key:success[i].event_key,
			name:success[i].name,
			year:success[i].year
		};
		awards[i] = award;
	}
	data = awards;
}
function teamEventsSuccess(success) {
	var len = success.length;
	var events =[];
	for(var i = 0; i < len; i++) {
		var evnt = {
			key: success[i].key
		};
		events[i] = evnt;
	}
	data = events;
	
}