function updateLeftHeaderWidth() {
  const header = document.querySelector('.header-left');
  if (header) {
    const branding = header.querySelector('.site-branding');
    if (branding) {
      const margin = 20;
      const width = branding.offsetWidth + margin;
      const root = document.documentElement;
      const current = parseInt(getComputedStyle(root).getPropertyValue('--s-nav-width')) || 0;
      if (width > current) {
        root.style.setProperty('--s-nav-width', width + 'px');
      }
    }
  }
}
document.addEventListener('DOMContentLoaded', updateLeftHeaderWidth);
window.addEventListener('resize', updateLeftHeaderWidth);
