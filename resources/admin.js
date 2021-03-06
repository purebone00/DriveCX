function changePassword() {
  var user = firebase.auth().currentUser;

  var credential;

  var oldPassword, newPassword, newPasswordConfirm;
  oldPassword = document.getElementById("oldPW").value;
  newPassword = document.getElementById("newPW").value;
  newPasswordConfirm = document.getElementById("newPWConfirm").value;

  if (newPassword != newPasswordConfirm) {
    console.log("old and confirm don't match.");
    return null;
  }

  credential = firebase.auth.EmailAuthProvider.credential(user.email, oldPassword);

  user.reauthenticate(credential).then(function() {
    // User re-authenticated.
    console.log("reauthenticated.");
  }, function(error) {
    // An error happened.
    console.log("failed to reauthenticate.");
  });

  user.updatePassword(newPassword).then(function() {
    // Update successful.
    console.log("Successful password change.");

    document.getElementById("oldPW").value = "";
    document.getElementById("newPW").value = "";
    document.getElementById("newPWConfirm").value = "";
    document.getElementById("pwError").style.display = 'none';

  }, function(error) {
    // An error happened.
    document.getElementById("pwError").style.display = 'block';
    console.log("Unsuccessful password change.");
  });

  var width = document.getElementById("pw_panelbody").offsetWidth;
  document.getElementById("pw").style.width = String(width) + "px";
  var height = document.getElementById("pw_panelbody").offsetHeight;
  document.getElementById("pw").style.height = String(height) + "px";
  var margin = document.getElementById("pw_panel-heading").offsetHeight;
  document.getElementById("pw").style.marginTop = String(margin) + "px";

  document.getElementById("oldPW").value = "";
  document.getElementById("newPW").value = "";
  document.getElementById("newPWConfirm").value = "";

  setTimeout(function() {
    document.getElementById("pw").style.width = "0";
  }, 1500);
}

function QuickFormulaSubmit() {

  let quick, surveyPercentage, vipEngage, tableSize, vipPercentage, offerSent, rtr, addVisits;
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

  document.getElementById("q_quickRating").value = quick;
  document.getElementById("q_csp").value = surveyPercentage;
  document.getElementById("q_vipEngage").value = vipEngage;
  document.getElementById("q_tableSize").value = tableSize;
  document.getElementById("q_vip").value = vipPercentage;
  document.getElementById("q_offerSent").value = offerSent;
  document.getElementById("q_rtr").value = rtr;
  document.getElementById("q_addVisits").value = addVisits;
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

  document.getElementById("f_fullRating").value = full;
  document.getElementById("f_csp").value = surveyPercentage;
  document.getElementById("f_vipEngage").value = vipEngage;
  document.getElementById("f_tableSize").value = tableSize;
  document.getElementById("f_vip").value = vipPercentage;
  document.getElementById("f_rtr").value = rtr;
  document.getElementById("f_addVisits").value = addVisits;
  return false;
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

    document.getElementById("q_quickRating").value = quick;
    document.getElementById("q_csp").value = surveyPercentage;
    document.getElementById("q_vipEngage").value = vipEngage;
    document.getElementById("q_tableSize").value = tableSize;
    document.getElementById("q_vip").value = vipPercentage;
    document.getElementById("q_offerSent").value = offerSent;
    document.getElementById("q_rtr").value = rtr;
    document.getElementById("q_addVisits").value = addVisits;
  });
}


function loadFullForm() {
  return firebase.database().ref('/full/' + 'fullFormula').once('value').then(function(snapshot) {
    let full, surveyPercentage, vipEngage, tableSize, vipPercentage, rtr, addVisits;

    full = snapshot.val().full;
    surveyPercentage = snapshot.val().surveyPercentage;
    vipEngage = snapshot.val().vipEngage;
    tableSize = snapshot.val().tableSize;
    vipPercentage = snapshot.val().vipPercentage;
    rtr = snapshot.val().rtr;
    addVisits = snapshot.val().addVisits;

    document.getElementById("f_fullRating").value = full;
    document.getElementById("f_csp").value = surveyPercentage;
    document.getElementById("f_vipEngage").value = vipEngage;
    document.getElementById("f_tableSize").value = tableSize;
    document.getElementById("f_vip").value = vipPercentage;
    document.getElementById("f_rtr").value = rtr;
    document.getElementById("f_addVisits").value = addVisits;
  });
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

  var updates = {};
  updates['/full/' + 'fullFormula'] = postData;

  return firebase.database().ref().update(updates);
}

function loadAPIKeys() {
  return firebase.database().ref('/keys/').once('value').then(function(snapshot) {
    let pipeDrive, mailChimp, mailchimpCampaignID;
    pipeDrive = snapshot.val().pipeDrive;
    mailChimp = snapshot.val().mailChimp;
    mailchimpCampaignID = snapshot.val().mailchimpCampaignID;
    console.log(mailchimpCampaignID);
    document.getElementById("mailchimpAPI").value = mailChimp;
    document.getElementById("pipedriveAPI").value = pipeDrive;
    document.getElementById("mailchimpCampaignID").value = mailchimpCampaignID;

  });
}

function APISubmit() {
  let mailChimp, pipeDrive, mailchimpCampaignID;

  mailChimp = document.getElementById("mailchimpAPI").value;
  pipeDrive = document.getElementById("pipedriveAPI").value;
  mailchimpCampaignID = document.getElementById("mailchimpCampaignID").value;

  createAPI(mailChimp, pipeDrive, mailchimpCampaignID);

  var width = document.getElementById("api_panelBody").offsetWidth;
  document.getElementById("api").style.width = String(width) + "px";
  var height = document.getElementById("api_panelBody").offsetHeight;
  document.getElementById("api").style.height = String(height) + "px";
  var margin = document.getElementById("api_panelHeading").offsetHeight;
  document.getElementById("api").style.marginTop = String(margin) + "px";

  setTimeout(function() {
    document.getElementById("api").style.width = "0";
  }, 1500);

}

function createAPI(mailChimp, pipeDrive, mailchimpCampaignID) {
  // 1 Write Entry to DB - Append to end
  var postData = {
    mailChimp: mailChimp,
    pipeDrive: pipeDrive,
    mailchimpCampaignID: mailchimpCampaignID
  };

  var updates = {};
  updates['/keys/'] = postData;

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
function init() {
  // Initialize Firebase

  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBlmfw5aA-ps2pVLWWuekiHk0F9Ji0J7ho",
    authDomain: "driveroicalculator.firebaseapp.com",
    databaseURL: "https://driveroicalculator.firebaseio.com",
    projectId: "driveroicalculator",
    storageBucket: "driveroicalculator.appspot.com",
    messagingSenderId: "951202623290"
  };
  firebase.initializeApp(config);
}

window.onload = function() {

  init();
  loadFullForm();
  loadQuickForm();
  loadAPIKeys();
  initApp();
};