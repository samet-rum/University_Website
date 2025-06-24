let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
    dots[i].classList.remove("active");
    if (i === index) {
      slide.classList.add("active");
      dots[i].classList.add("active");
    }
  });
  currentSlide = index;
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(currentSlide);
}

// Otomatik geçiş
setInterval(nextSlide, 5000); // 5 saniyede bir geçiş

// Ok butonları
document.querySelector(".arrow.left").addEventListener("click", prevSlide);
document.querySelector(".arrow.right").addEventListener("click", nextSlide);

// Noktalar
dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    showSlide(index);
  });
});

// İlk gösterim
showSlide(0);
