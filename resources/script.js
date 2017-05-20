function init() {
  // Initialize Firebase

  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDQ3zo2EQyHwpsLtL3WVH5MvJPWbr2ZcYc",
    authDomain: "drivecx-4e872.firebaseapp.com",
    databaseURL: "https://drivecx-4e872.firebaseio.com",
    projectId: "drivecx-4e872",
    storageBucket: "drivecx-4e872.appspot.com",
    messagingSenderId: "987066303919"
  };
  firebase.initializeApp(config);
}

function loadQuickForm() {
  return firebase.database().ref('/quick/' + 'quickFormula').once('value').then(function(snapshot) {
    let quick, surveyPercentage, vipEngage, tableSize, vipPercentage, offerSent, rtr, addVisits;

    quick = snapshot.val().quick;
    surveyPercentage = snapshot.val().surveyPercentage;
    vipEngage = snapshot.val().vipEngage;
    tableSize = snapshot.val().tableSize;
    vipPercentage = snapshot.val().vipPercentage;
    offerSent = snapshot.val().offerSent;
    rtr = snapshot.val().rtr;
    addVisits = snapshot.val().addVisits;

    let formulaArray = [quick, surveyPercentage, vipEngage, tableSize, offerSent, vipPercentage, rtr, addVisits];

  });
}

function loadFullForm() {
  return firebase.database().ref('/full/' + 'fullFormula').once('value').then(function(snapshot) {
    var full, surveyPercentage, vipEngage, tableSize, vipPercentage, rtr, addVisits;

    full = snapshot.val().full;
    surveyPercentage = snapshot.val().surveyPercentage;
    vipEngage = snapshot.val().vipEngage;
    tableSize = snapshot.val().tableSize;
    vipPercentage = snapshot.val().vipPercentage;
    rtr = snapshot.val().rtr;
    addVisits = snapshot.val().addVisits;

    let formulaArray = [full, surveyPercentage, vipEngage, tableSize, vipPercentage, rtr, addVisits];
    localStorage.setItem('fullFormula', JSON.stringify(formulaArray));
    $.post('php/send_email.php', { variable: formulaArray });
    // var arrayData = localStorage.getItem('fullFormula');
    // var value = JSON.parse(arrayData);

  });
}

var questionHeader = "Hello There!";
var answer1 = "Do you know how much your restaurant is capable of earning?";

var info = "We can tell you!";
var info1 = "Simply tell us about your restaurant and we will send you a custom ROI report absolutely FREE!"

document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    Typed.new('.element', {
      strings: [questionHeader, answer1],
	  typeSpeed: 2,
	  backDelay: 2000
	  
    });
  }, 2300);
});

document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    Typed.new('.element2', {
      strings: [info, info1],
      startDelay: 2000,
	  backDelay: 2000,
	  typeSpeed: 2
    });
  }, 8000);
});

window.onload = function() {
  init();
  loadFullForm();
  loadQuickForm();
};