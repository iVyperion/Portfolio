var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0vh";
  } else {
    document.getElementById("navbar").style.top = "-15vh";
  }
  prevScrollpos = currentScrollPos;
}