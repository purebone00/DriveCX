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

        jQuery.post("php/send_mail.php", { myKey: value }, function(data) {
            alert("Do something with example.php response");
        }).fail(function() {
            alert("Damn, something broke");
        });
    });
}


var questionHeader = "How much more should your restaurant be earning?";
var answer = "We can tell you! \n Simply tell us a little about your restaurant and we’ll send you a custom ROI Report absolutley Free!";


document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        Typed.new('.element', {
            strings: [questionHeader, answer],
            typeSpeed: 2
        });
    }, 2300);
});

window.onload = function() {
    init();
    loadFullForm();
    loadQuickForm();
};