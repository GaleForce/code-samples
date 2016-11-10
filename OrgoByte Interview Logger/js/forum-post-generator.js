function getStamp () {
	var timestamp = new Date();
	return timestamp;
}

var stampStarted = false;
var stampEnded = false;
var startStamp;
var endStamp;
//var timeStampExec = false;

function timeStamp () {
	if (stampStarted == false) {
		startStamp = getStamp();
		//timeStampExec = true;
	}
	stampStarted = true;
}
		
function timeStampEnd () {
	if (stampEnded == false) {
		endStamp = getStamp();
	}
	stampEnded = true;
}

// Please excuse the disgusting inline CSS below, it's a necessary workaround for IPS board copying formatting

function generatePost() {

	var topicTitle = '<b>Topic Title:</b> ' + document.getElementById('rpName').value + ' - Pass/Fail';

	document.getElementById('forumTitle').innerHTML = topicTitle;

	document.getElementById('forumLog').innerHTML =
		'<span class="clearFormatting">' +
		'<b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Interviewer Name: </b>' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('interviewer').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Account Link:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('forumProfile').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Application Link:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('civApp').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Steam ID:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('steamID').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Roleplay Name:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('rpName').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Referrals:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('referral').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Age:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + civAge + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Date of Birth:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('dob').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Location:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('location').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Language:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('language').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">First Roleplay Question:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + firstRP + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">First Roleplay Answer:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('roleplay1').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Second Roleplay Question:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + secondRP + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Second Roleplay Answer:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + document.getElementById('roleplay2').value + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Agrees to Terms:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">Yes</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Start Time:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + startStamp.toUTCString() + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">End Time:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + endStamp.toUTCString() + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Additional Notes:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + '' + '</span>' + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Questions Wrong:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + numWrong + '</span>' +
		'<br><b style="background:rgba(0,0,0,0) !important; color:inherit !important;">Interview Score:</b> ' + '<span style="background:rgba(0,0,0,0) !important; color:inherit !important;">' + finalGradeFixed + '%' + '</span>' +
		'</span>';


}