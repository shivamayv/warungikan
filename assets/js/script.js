document.addEventListener('DOMContentLoaded', function() {
    var slides = document.querySelectorAll('.carousel-slide');
    var currentSlide = 0;

    // Tampilkan slide pertama secara default
    slides[currentSlide].classList.add('active');

    setInterval(nextSlide, 5000); // Ganti gambar setiap 5 detik

    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
});
