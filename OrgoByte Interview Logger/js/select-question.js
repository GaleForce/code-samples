function selectQuestion() {
	var questions = [
		'Your ex is about to get married, and the happy couple has invited everyone to their wedding. You ended things on terrible terms. How does your character react?', 
		'In roleplay on Humanity, what would be your character’s dream job?', 
		'You\'re at a bar, and you see someone being really obnoxious. They\'re starting to really irritate you. Suddenly, that person hones in on you and says something that really pisses you off. How does your character react?',
		'You find out that someone you\'re hanging out with is beginning to slip into crime. Up until this point, you both haven\'t been in trouble with the police. How does your character handle that?',
		'In roleplay on Humanity, what would be your character’s idea of a perfect day?',
		'Your friend is in the hospital after a car accident. The other driver was drunk. How does your character react?',
		'You see someone acting really strangely outside of a shop, yelling at everyone in sight and calling people really offensive terms. What is your character\'s course of action?',
		'You\'re driving down the road, and someone collides into you. How does your character react?',
		'The server kicks you out for some unexplained reason, and you were driving to meet your friends. You reconnect and show up at where you\'re supposed to meet them. What\'s your roleplay reason to explain what happened?',
		'When trying to cross the street, a homeless man walks up to you and starts asking for money/food/whatever. How do you respond?',
		'The map has eaten your items, such as a gun/clothing when you put it on the ground, or something. There are a few people around you to have seen it - how do you respond?',
		'A lone patrolmen is walking around chatting with civilians and you notice two "shady" people following him. What is your response?',
		'Someone begins punching you every time you speak in a greenzone. How do you handle this?',
		'A police officer pulls you over and explains that they have texts reporting your description and vehicle was involved in multiple robberies. How do you interact?',
		'A civilian is roaming around town in their car with their radio blasting highly offensive music, they stop in front of your shop. What do you do?',
		'You hear, blatant out-of-character or meta-gaming coming from within earshot of you.  How do you handle it?',
		'Someone initiates roleplay with you in the greenzone and then steals your vehicle as you pull it out of the garage.  It’s a clear greenzone violation and you have a VOD of the crime.  What is your next step? Do you report them?',
		'A person walks up to you and asks for a gun, then tells you that they\'re going to kill someone. How do you react?'
	];
	randSelect = questions[Math.floor(Math.random() * questions.length)];
	// var randSelect2 = questions2.splice(randSelect);
	// var copy = randSelect.slice();
	// var resultQuestion2 = questions.splice( Math.floor(Math.random()*copy.length), 1 );
	var resultQuestion = document.getElementById('resultQuestion');
	document.getElementById("resultAlert").style.display="block";
	resultQuestion.innerHTML = randSelect;
}


var firstSet = false;
var firstRP;
var secondRP;

function appendQuestion() {

	if(firstSet == false) {
		document.getElementById("roleplay1-label").innerHTML = randSelect;
		firstRP = randSelect;
		document.getElementById("rp1").value = firstRP;
	} 

	if(firstSet == true) {
		document.getElementById("roleplay2-label").innerHTML = randSelect;
		secondRP = randSelect;
		document.getElementById("rp2").value = secondRP;
		firstSet = 0;
	} 

	firstSet = true;

}