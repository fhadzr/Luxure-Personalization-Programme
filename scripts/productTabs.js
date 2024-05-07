document.addEventListener("DOMContentLoaded", function () {
  // Trigger a click on the default tab or the tab specified in the URL hash
  var defaultTab = document.getElementById("defaultOpen");
  var ordersTab = document.getElementById("ordersButton");

  if (window.location.hash === "#orders" ) {
    // If the URL hash is #orders, click on the Orders tab
    ordersTab.click();
  } else {
    // Otherwise, click on the default tab (All Products)
    defaultTab.click();
  }
});


function openProducts(evt, products) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(products).style.display = "grid";
  evt.currentTarget.className += " active";
}
