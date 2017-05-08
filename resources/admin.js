
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