var numWrong;
var finalGrade;
var finalGradeFixed;

function startGrading() {

    var inputs = document.getElementById("interview-logger").elements;
    var correct = 0;
    var incorrect = 0;
    var partial = 0;
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type == 'radio' && inputs[i].checked && inputs[i].value == "correct") {
            correct++;
        }
        if (inputs[i].type == 'radio' && inputs[i].checked && inputs[i].value == "incorrect") {
            incorrect++;
        }
        if (inputs[i].type == 'radio' && inputs[i].checked && inputs[i].value == "partial") {
            partial++;
        }
    }

    // Set variables to target inside of UI elements for grading tool
    var correctCount = document.getElementById('count-correct');
    var incorrectCount = document.getElementById('count-incorrect');
    var partialCount = document.getElementById('count-partial');

    // Use targeted elements to set HTML to counted variable number
    correctCount.innerHTML = correct;
    incorrectCount.innerHTML = incorrect;
    partialCount.innerHTML = partial;

    // Calculate score percentage
    var totalCount = correct + incorrect + partial;
    var partialScore = 0.5 * partial;
    var scoreNumerator = correct + partialScore;
    var scorePercentage = (scoreNumerator / totalCount) * 100;

    // Output score percentage
    var percentageOutput = document.getElementById('percent-score');
    percentageOutput.innerHTML = scorePercentage.toFixed(1) + '%';

    // Determine if grade is pass/fail and output result
    var passfailOutput = document.getElementById('passfailOutput');
    if (scorePercentage.toFixed(1) <= 90) {
    	passfailOutput.innerHTML = 'Fail';
    	document.getElementById('passfailOutput').style.color="#d9534f";
    	var intresults = 'Fail';
    } else if (scorePercentage.toFixed(1) > 90) {
    	passfailOutput.innerHTML = 'Pass';
    	document.getElementById('passfailOutput').style.color="#5cb85c";
    	var intresults = 'Pass';
    } else {
    	passfailOutput.innerHTML = 'ERROR';
    }

    // Global veriables to use in forum post generator
    numWrong = incorrect + (partial * 0.5);
    finalGrade = (scoreNumerator / totalCount) * 100;
    finalGradeFixed = finalGrade.toFixed(1);

    // Set variables as values of hidden form inputs to pass to Google Sheet log
    document.getElementById("passorfail").value = intresults;
    document.getElementById("qwrong").value = numWrong;
}
