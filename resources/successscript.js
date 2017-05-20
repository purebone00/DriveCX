
var questionHeader = "Thank you !";
var answer = "Please check your email account for your ROI report!";

document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    Typed.new('.element', {
      strings: [questionHeader, answer],
	  typeSpeed: 2,
	  backDelay: 2000
    });
  }, 2300);
});

window.onload = function() {

    console.log("Hello");

};