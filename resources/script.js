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

        localStorage.setItem('q_quick', quick);
        localStorage.setItem('q_surveyPercentage', surveyPercentage);
        localStorage.setItem('q_vipEngage', vipEngage);
        localStorage.setItem('q_tableSize', tableSize);
        localStorage.setItem('q_vipPercentage', vipPercentage);
        localStorage.setItem('q_rtr', rtr);
        localStorage.setItem('q_addVisits', addVisits);
        localStorage.setItem('q_offerSent', offerSent);

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

        var formulaArray = [full, surveyPercentage, vipEngage, tableSize, vipPercentage, rtr, addVisits];
        localStorage.setItem('fullFormula', JSON.stringify(formulaArray));
        // localStorage.setItem('f_full', full);
        // localStorage.setItem('f_surveyPercentage', surveyPercentage);
        // localStorage.setItem('f_vipEngage', vipEngage);
        // localStorage.setItem('f_tableSize', tableSize);
        // localStorage.setItem('f_vipPercentage', vipPercentage);
        // localStorage.setItem('f_rtr', rtr);
        // localStorage.setItem('f_addVisits', addVisits);

        var arrayData = localStorage.getItem('fullFormula');
        var value = JSON.parse(arrayData);

    });
}


var questionHeader = "Hello There?";
var answer1 = "Do you know how much your restaurant is capable of earning?";
var answer2 = "We Can tell you! \n Simply tell us about your restaurant and we will send you a custom ROI report absolutely free!";

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
            typeSpeed: 3.5
        });
    }, 2300);
});

window.onload = function() {
    init();
    loadFullForm();
    loadQuickForm();
};