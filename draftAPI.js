var sEcReT_cOdE = 'VG6oKsnz6E2EheeIFFkZwHjcAT66vwpttZTXWmXyPOSMyjmRyrA9Q5I8cUeiZTeJ';
var base = 'https://cors-anywhere.herokuapp.com/'+ 'https://www.thebluealliance.com/api/v3/';
var data = [];


//ALL BLUE ALLIANCE STUFF HERE https://www.thebluealliance.com/apidocs/v3
//Get Functions
function getEventInfo(event_code) {
	
	
}

function getTeamEvents(teamnum) {
	var append = 'team/frc' + teamnum + '/events';
	var url = base + append;
	$.ajaxSetup({
		headers : {
			'X-TBA-Auth-Key':sEcReT_cOdE,
			'accept':'application/json'
		}
	});
	$.getJSON(url,
		teamEventsSuccess,
		defaultError);
	return data;
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
function getEventOPRS(event_key) {
	var append = 'event/' + event_key + '/oprs';
	var url = base + append;
	$.ajaxSetup({
			headers : {
				'X-TBA-Auth-Key':sEcReT_cOdE,
				'accept':'application/json'
			}
		});
	$.getJSON(url,
		eventOPRSSuccess,
		defaultError);
	return data;
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
			key: success[i].key;
		};
		events[i] = evnt;
	}
	data = events;
	
}