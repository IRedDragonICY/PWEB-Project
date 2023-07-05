
      // Event listener for scroll event
      window.addEventListener("scroll", function () {
        // Get the current scroll position
        var scrollPosition = window.pageYOffset;
        // Select the hero image element
        var parallaxElement = document.querySelector(".hero-image");
        // Apply a parallax effect to the hero image
        parallaxElement.style.transform =
          "translateY(" + scrollPosition * 0.2 + "px)";
      });
    
      // Function to smoothly scroll to the top of the page
      function scrollToTop() {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      }
    
      // Function to smoothly scroll to a specific section
      function scrollToSection(sectionId) {
        document.querySelector(sectionId).scrollIntoView({
          behavior: "smooth",
        });
      }
    
      // Event listener for DOMContentLoaded event
      document.addEventListener("DOMContentLoaded", () => {
        // Select various elements
        const videoContainer = document.querySelector(".introduction  .videoContainer");
        const textContainer = document.querySelector(".introduction .textContainer");
        const featuresVideoContainer = document.querySelectorAll(".video-row");
        const featuresTitle = document.querySelector(".features .title-section");
        const sponsorSection = document.querySelector(".sponsor-section");
        const scrollYThreshold = [450, 1100, 1100, 1700];
              
        // Event listener for scroll event
        window.addEventListener("scroll", () => {
          // Show/hide elements based on scroll position
          if (window.scrollY > scrollYThreshold[0]) {
            videoContainer.classList.remove("hidden");
            videoContainer.classList.add("show");
            textContainer.classList.remove("hidden");
            textContainer.classList.add("show");
          }
          if (window.scrollY > scrollYThreshold[1]) {
            featuresTitle.classList.remove("hidden");
            featuresTitle.classList.add("show");
          }
          if (window.scrollY > scrollYThreshold[2]) {
            featuresVideoContainer.forEach((videoRow) => {
              videoRow.classList.remove("hidden");
              videoRow.classList.add("show");
            });
          }
          if (window.scrollY > scrollYThreshold[3]) {
            sponsorSection.classList.remove("hidden");
            sponsorSection.classList.add("show");
          }

        });
      });
    
      // Initialize Slick carousel when document is ready
      $(document).ready(function(){
        $('.sponsor-carousel').slick({
          slidesToShow: 6,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3500,
          arrows: false,
          centerMode: true,
          centerPadding: '0px', 
          infinite: true, 
          swipe: false, 
          draggable: false, 
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 5,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });
      });
