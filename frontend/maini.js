const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e) => {
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
});

navLinks.addEventListener("click", (e) => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "ri-menu-line");
});

const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

// header container
ScrollReveal().reveal(".header__image img", {
  ...scrollRevealOption,
});

ScrollReveal().reveal(
  ".header__content h4, .header__content .section__header",
  {
    ...scrollRevealOption,
    delay: 500,
  }
);

ScrollReveal().reveal(".header__content p", {
  ...scrollRevealOption,
  delay: 1000,
});

ScrollReveal().reveal(".header__btn", {
  ...scrollRevealOption,
  delay: 1500,
});

// about container
ScrollReveal().reveal(".about__image img", {
  ...scrollRevealOption,
  origin: "left",
});

ScrollReveal().reveal(".about__content .section__header", {
  ...scrollRevealOption,
  delay: 500,
});

ScrollReveal().reveal(".about__content .section__description", {
  ...scrollRevealOption,
  delay: 1000,
});

ScrollReveal().reveal(".about__card", {
  ...scrollRevealOption,
  delay: 1500,
  interval: 500,
});

// price container
ScrollReveal().reveal(".price__card", {
  ...scrollRevealOption,
  interval: 500,
});

const swiper = new Swiper(".swiper", {
  loop: true,
  slidesPerView: "auto",
  spaceBetween: 20,
});



document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".success-story__card");
  let currentIndex = 0;

  // Initially show only the first card
  cards[currentIndex].classList.add("active");

  // Handle 'Next' button click
  document.querySelector(".next-btn").addEventListener("click", function () {
    cards[currentIndex].classList.remove("active"); // Hide current card
    currentIndex = (currentIndex + 1) % cards.length; // Move to the next card
    cards[currentIndex].classList.add("active"); // Show the new current card
  });

  // Handle 'Previous' button click
  document.querySelector(".prev-btn").addEventListener("click", function () {
    cards[currentIndex].classList.remove("active"); // Hide current card
    currentIndex = (currentIndex - 1 + cards.length) % cards.length; // Move to the previous card
    cards[currentIndex].classList.add("active"); // Show the new current card
  });
});





function openForm(planName) {
  document.getElementById("popupForm").style.display = "flex";
  document.getElementById("plan").value = planName;
}

function closeForm() {
  document.getElementById("popupForm").style.display = "none";
}

document.querySelectorAll(".btn").forEach(button => {
  button.addEventListener("click", (event) => {
    event.preventDefault();  // Prevent page refresh
    const planName = button.closest(".price__card").querySelector("h4").innerText;
    openForm(planName);
  });
});

document.getElementById("joinNowBtn").addEventListener("click", function(event) {
  event.preventDefault();  // Prevent page refresh
  document.getElementById("cls_popupForm").style.display = "block";
});

document.getElementById("cls_closeBtn").addEventListener("click", function() {
  document.getElementById("cls_popupForm").style.display = "none";
});

window.onclick = function(event) {
  if (event.target == document.getElementById("cls_popupForm")) {
    document.getElementById("cls_popupForm").style.display = "none";
  }
}













