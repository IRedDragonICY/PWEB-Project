// Mendapatkan semua elemen <img>
const lazyImages = document.querySelectorAll('img');

// Fungsi untuk memuat gambar secara lazy
const lazyLoad = target => {
  const io = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        const src = img.getAttribute('data-src');

        // Mengganti atribut src dengan data-src untuk memuat gambar
        img.setAttribute('src', src);

        // Menghentikan observasi setelah gambar dimuat
        observer.disconnect();
      }
    });
  });

  io.observe(target);
};

// Memuat gambar secara lazy untuk setiap elemen <img>
lazyImages.forEach(lazyLoad);
