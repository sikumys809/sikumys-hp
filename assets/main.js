document.addEventListener('DOMContentLoaded', function () {
  const hero = document.querySelector('.hero');
  if (hero) {
    hero.animate([
      { opacity: 0, transform: 'translateY(16px)' },
      { opacity: 1, transform: 'translateY(0)' }
    ], {
      duration: 900,
      easing: 'cubic-bezier(0.2, 0.7, 0.2, 1)',
      fill: 'forwards'
    });
  }
});
