const tabLinks = document.querySelectorAll('.tab-link');
const tabContents = document.querySelectorAll('.tab-content');

tabLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      tabLinks.forEach(l => l.classList.remove('active'));
      tabContents.forEach(c => c.classList.remove('active'));

      link.classList.add('active');
      document.getElementById(link.dataset.tab).classList.add('active');
    });
});

const slides = document.querySelectorAll(".usage-photo img");
let current = 0;

function changeSlide() {
     slides[current].classList.remove("active");
     current = (current + 1) % slides.length;
     slides[current].classList.add("active");
}

setInterval(changeSlide, 2000); // change every 2 seconds