// Selecting the necessary elements from the DOM
const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const main = document.querySelector('.main');

// Toggle sidebar when sidebarOpen is clicked
sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

// Remove "close" class from sidebar on mouse enter if it has the "hoverable" class
sidebar.addEventListener("mouseenter", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
  }
});

// Add "close" class to sidebar on mouse leave if it has the "hoverable" class
sidebar.addEventListener("mouseleave", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
  }
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

// Add or remove "close" class to sidebar based on window width
if (window.innerWidth < 768) {
  sidebar.classList.add("close");
} else {
  sidebar.classList.remove("close");
}

// Function to change the content based on the navbar selection
function changeContent(navbar) {
  var content = document.getElementById('content');
  content.innerHTML = '';

  if (navbar === 'content1') {
    content.innerHTML = 'Konten 1';
  } else if (navbar === 'content2') {
    content.innerHTML = 'Konten 2';
  } else if (navbar === 'content3') {
    content.innerHTML = 'Konten 3';
  }
}

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

// Function to change the content based on the contentId parameter
function changeContent(contentId) {
  var contents = document.getElementsByClassName('content');

  // Hide all content elements
  for (var i = 0; i < contents.length; i++) {
    contents[i].style.display = 'none';
  }

  // Show the content element with the corresponding contentId
  var contentToShow = document.getElementById(contentId + 'Content');
  if (contentToShow) {
    contentToShow.style.display = 'block';
  }
}
