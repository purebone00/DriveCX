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

var questionHeader = "Hello There?";
var answer1 = "Do you know how much your restaurant is capable of earning?";
var answer2 = "We can tell you! \n Simply tell us about your restaurant and we will send you a custom ROI report absolutely free!";

var info = "Our ROI calculations are based on average customer engagement rates and may not be the same for every restaurant."
var info2 = "DRIVE can't guarantee these numbers, but we'll help you to acheive the best outcomes for your restaurants.";

document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    Typed.new('.element', {
      strings: [questionHeader, answer1, answer2],
      typeSpeed: 2
    });
  }, 2300);
});

document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    Typed.new('.element2', {
      strings: [info, info2],
      typeSpeed: 2
    });
  }, 16850);
});

window.onload = function() {
  init();
  loadFullForm();
  loadQuickForm();
};