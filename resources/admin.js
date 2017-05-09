function QuickFormulaSubmit() {

    var quick, surveyPercentage, vipEngage, tableSize, vipPercentage, offerSent, rtr, addVisits;
    quick = document.getElementById("q_quickRating").value;
    surveyPercentage = document.getElementById("q_csp").value;
    vipEngage = document.getElementById("q_vipEngage").value;
    tableSize = document.getElementById("q_tableSize").value;
    vipPercentage = document.getElementById("q_vip").value;
    offerSent = document.getElementById("q_offerSent").value;
    rtr = document.getElementById("q_rtr").value;
    addVisits = document.getElementById("q_addVisits").value;

    createQuick(quick, surveyPercentage, vipEngage, tableSize, vipPercentage, offerSent, rtr, addVisits);

    var width = document.getElementById("q_panelbody").offsetWidth;
    document.getElementById("quickSection").style.width = String(width) + "px";
    var height = document.getElementById("q_panelbody").offsetHeight;
    document.getElementById("quickSection").style.height = String(height) + "px";
    var margin = document.getElementById("q_panelheading").offsetHeight;
    document.getElementById("quickSection").style.marginTop = String(margin) + "px";

    setTimeout(function() {
        document.getElementById("quickSection").style.width = "0";
    }, 1500);

    document.getElementById("q_quickRating").value = "";
    document.getElementById("q_csp").value = "";
    document.getElementById("q_vipEngage").value = "";
    document.getElementById("q_tableSize").value = "";
    document.getElementById("q_vip").value = "";
    document.getElementById("q_offerSent").value = "";
    document.getElementById("q_rtr").value = "";
    document.getElementById("q_addVisits").value = "";
    return false;
}

//Database Writing
function createQuick(quick, surveyPercentage, vipEngage, tableSize, vipPercentage, offerSent, rtr, addVisits) {

    // 1 Write Entry to DB - Append to end
    var postData = {
        quick: quick,
        surveyPercentage: surveyPercentage,
        vipEngage: vipEngage,
        tableSize: tableSize,
        vipPercentage: vipPercentage,
        offerSent: offerSent,
        rtr: rtr,
        addVisits: addVisits
    };

    // Get a key for a new Post.
    /*var newPostKey = firebase.database().ref().child('quick').push().key;

    if (newPostKey.length == 0) {
        console.log("fail");
        return null;
    } else {
        console.log("success");
    } */
    // Write the new post's data simultaneously in the posts list and the user's post list.
    var updates = {};
    updates['/quick/' + 'quickFormula'] = postData;

    return firebase.database().ref().update(updates);
}

function FullFormulaSubmit() {

    var full, surveyPercentage, vipEngage, tableSize, vipPercentage, rtr, addVisits;
    full = document.getElementById("f_fullRating").value;
    surveyPercentage = document.getElementById("f_csp").value;
    vipEngage = document.getElementById("f_vipEngage").value;
    tableSize = document.getElementById("f_tableSize").value;
    vipPercentage = document.getElementById("f_vip").value;
    rtr = document.getElementById("f_rtr").value;
    addVisits = document.getElementById("f_addVisits").value;

    createFull(full, surveyPercentage, vipEngage, tableSize, vipPercentage, rtr, addVisits);

    var width = document.getElementById("f_panelbody").offsetWidth;
    document.getElementById("fullSection").style.width = String(width) + "px";
    var height = document.getElementById("f_panelbody").offsetHeight;
    document.getElementById("fullSection").style.height = String(height) + "px";
    var margin = document.getElementById("f_panelheading").offsetHeight;
    document.getElementById("fullSection").style.marginTop = String(margin) + "px";

    setTimeout(function() {
        document.getElementById("fullSection").style.width = "0";
    }, 1500);

    document.getElementById("f_fullRating").value = "";
    document.getElementById("f_csp").value = "";
    document.getElementById("f_vipEngage").value = "";
    document.getElementById("f_tableSize").value = "";
    document.getElementById("f_vip").value = "";
    document.getElementById("f_rtr").value = "";
    document.getElementById("f_addVisits").value = "";
    return false;
}


//Database Writing
function createFull(full, surveyPercentage, vipEngage, tableSize, vipPercentage, rtr, addVisits) {

    // 1 Write Entry to DB - Append to end
    var postData = {
        full: full,
        surveyPercentage: surveyPercentage,
        vipEngage: vipEngage,
        tableSize: tableSize,
        vipPercentage: vipPercentage,
        rtr: rtr,
        addVisits: addVisits
    };

    // Get a key for a new Post.
    //var newPostKey = firebase.database().ref().child('full').push().key;

    /*if (newPostKey.length == 0) {
        console.log("fail");
        return null;
    } else {
        console.log("success");
    }*/
    // Write the new post's data simultaneously in the posts list and the user's post list.

    var updates = {};
    updates['/full/' + 'fullFormula'] = postData;

    return firebase.database().ref().update(updates);
}

/*******************************************************************
Begin Authorization Functions
********************************************************************/
function signOut() {
    if (firebase.auth().currentUser) {
        // [START signout]
        firebase.auth().signOut();
        window.location.href = "login.html";
        // [END signout]
    }
}

function initApp() {
    // Listening for auth state changes.
    // [START authstatelistener]
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            console.log("signed in at: " + user.email);
        } else {
            console.log("not signed in");
            alert("not signed in.");
            window.location.href = "login.html";
        }
    });
    // [END authstatelistener]
}

/*******************************************************************
End Authorization Functions
********************************************************************/

window.onload = function() {
    initApp();
};