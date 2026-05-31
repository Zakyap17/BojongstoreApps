// BojongStore - Main JavaScript

document.addEventListener('DOMContentLoaded', function () {

  // ── Search input live filter (placeholder functionality) ──
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && this.value.trim()) {
        window.location.href = 'produk.php?q=' + encodeURIComponent(this.value.trim());
      }
    });
  }

  // ── Navbar scroll shadow ──
  const navbar = document.getElementById('navbar');
  if (navbar) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 10) {
        navbar.style.boxShadow = '0 2px 16px rgba(0,0,0,0.10)';
      } else {
        navbar.style.boxShadow = '0 1px 4px rgba(0,0,0,0.06)';
      }
    });
  }

  // ── Intersection Observer – fade in cards on scroll ──
  const observerOptions = {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px'
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  const animateEls = document.querySelectorAll(
    '.category-card, .testi-card, .feature-item'
  );

  animateEls.forEach(function (el, i) {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.5s ease ' + (i * 0.08) + 's, transform 0.5s ease ' + (i * 0.08) + 's';
    observer.observe(el);
  });

});
