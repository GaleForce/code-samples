var civAge;

function submitBday() {
    var Bdate = document.getElementById('dob').value;
    var Bday = +new Date(Bdate);
    civAge = ~~ ((Date.now() - Bday) / (31557600000));
    var Q4A = ~~ ((Date.now() - Bday) / (31557600000)) + " Years Old.";
	document.getElementById("dobAlert").style.display="block";
    var theBday = document.getElementById('resultBday');
    theBday.innerHTML = Q4A;
}

