var questionHeader = "How much more should your restaurant be earning?";
var answer = "We can tell you! \n Simply tell us a little about your restaurant and we’ll send you a custom ROI Report absolutley Free!";


document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        Typed.new('.element', {
            strings: [questionHeader, answer],
            typeSpeed: 2
        });
    }, 1000);
});

window.onload = function() {

    console.log("Hello");

};