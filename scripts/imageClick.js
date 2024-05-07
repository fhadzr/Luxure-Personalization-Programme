function expandImage(evt, currentImg) {
  document.getElementById("overlay").style.display = "block";

  var currentImg = document.getElementById(currentImg);
  var clonedImg = currentImg.cloneNode(true);
  clonedImg.style.maxHeight = "600px";
  var src = document.getElementById("current-img");
  src.innerHTML = '';
  src.appendChild(clonedImg);
}

function exitImage() {
  document.getElementById("overlay").style.display = "none";
  // document.getElementById("product-info").style.display = "block";
}
