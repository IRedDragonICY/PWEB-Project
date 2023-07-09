// Selecting the necessary elements from the DOM
const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const main = document.querySelector('.main');

// Toggle sidebar when sidebarOpen is clicked
sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

// Add or remove "close" class to sidebar based on window width
if (window.innerWidth < 768) {
  sidebar.classList.add("close");
} else {
  sidebar.classList.remove("close");
}

// Toggle submenu visibility when submenu item is clicked
submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
  });
});

// Toggle dark mode and update icon when darkLight is clicked
darkLight.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (body.classList.contains("dark")) {
    darkLight.classList.replace("bx-sun", "bx-moon");
  } else {
    darkLight.classList.replace("bx-moon", "bx-sun");
  }
});

// Function to adjust the width of the main content area based on the sidebar state and window width
function adjustMainWidth() {
  const sidebarWidth = sidebar.offsetWidth;
  if (window.innerWidth > 768) {
    if (sidebar.classList.contains('close')) {
      main.style.transform = `translateX(-190px)`;
    } else {
      main.style.transform = `translateX(0)`;
    }
  } else {
    main.style.transform = 'none';
  }
}

// Adjust main content width on page load and window resize
window.addEventListener('load', adjustMainWidth());
window.addEventListener('resize', adjustMainWidth());

// Adjust main content width when sidebar transition ends
sidebar.addEventListener('transitionend', () => {
  adjustMainWidth();
});

// Function to change content and title
function changeContentAndTitle(contentId, newTitle) {
  var contents = document.getElementsByClassName('content');
  var titleElement = document.getElementsByTagName('title')[0];

  for (var i = 0; i < contents.length; i++) {
    contents[i].style.display = 'none';
  }

  var contentToShow = document.getElementById(contentId + 'Content');
  if (contentToShow) {
    contentToShow.style.display = 'block';
    titleElement.innerHTML = newTitle;
  }

  window.location.hash = contentId;
}

// Function to keep the content on page load
function onPageLoad() {
  var navLinks = document.querySelectorAll('nav a');

  navLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
      event.preventDefault();
      changeContentAndTitle(this.getAttribute('data-content'), this.getAttribute('data-title'));
    });
  });

  var hash = window.location.hash.substr(1) || 'home';

  var activeLink = document.querySelector('nav a[href="#' + hash + '"]');
  if (activeLink) {
    activeLink.click();
  }
}
window.onload = onPageLoad;

// Create a function to make AJAX calls
async function fetchData() {
  // Files to be called by AJAX
  var urls = [
    "connect.php",
    "config.php",
    "deposit.php",
    "withdraw.php",
    "balance.php"
  ];

  // Use Promise.all to make parallel AJAX calls
  var responses = await Promise.all(urls.map(url => fetch(url)));

  // Retrieve data from JSON response of each AJAX call
  var data = await Promise.all(responses.map(response => response.json()));

  // Display the data in HTML
  displayData(data);
}

// Function to display data in HTML
function displayData(data) {
  var container = document.getElementById("dataContainer");

  // Display name from connect.php
  var name = data[0].name;
  var nameElement = document.createElement("p");
  nameElement.textContent = name;
  container.appendChild(nameElement);

  // Display photo from config.php
  var photo = data[1].photo;
  var photoElement = document.createElement("img");
  photoElement.src = photo;
  container.appendChild(photoElement);

  // Display totalDeposit from deposit.php
  var totalDeposit = data[2].totalDeposit;
  var totalDepositElement = document.createElement("p");
  totalDepositElement.textContent = totalDeposit;
  container.appendChild(totalDepositElement);

  // Display totalWithdraw from withdraw.php
  var totalWithdraw = data[3].totalWithdraw;
  var totalWithdrawElement = document.createElement("p");
  totalWithdrawElement.textContent = totalWithdraw;
  container.appendChild(totalWithdrawElement);

  // Display balances from balance.php
  var balances = data[4].balances;

  // Display makananBalance
  var makananBalanceElement = document.getElementById("makananBalance");
  makananBalanceElement.textContent = "Rp " + balances.makanan;

  // Display hiburanBalance
  var hiburanBalanceElement = document.getElementById("hiburanBalance");
  hiburanBalanceElement.textContent = "Rp " + balances.hiburan;

  // Display kesehatanBalance
  var kesehatanBalanceElement = document.getElementById("kesehatanBalance");
  kesehatanBalanceElement.textContent = "Rp " + balances.kesehatan;

  // Display pendidikanBalance
  var pendidikanBalanceElement = document.getElementById("pendidikanBalance");
  pendidikanBalanceElement.textContent = "Rp " + balances.pendidikan;
}

// Call the fetchData function when the page loads
window.onload = fetchData;