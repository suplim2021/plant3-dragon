// Adjust dropdown height to match content
document.addEventListener('DOMContentLoaded', function () {
  const dropdown = document.querySelector('.nav-panel.-dropdown');
  if (!dropdown) return;

  const updateHeight = () => {
    if (dropdown.classList.contains('active')) {
      dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
    } else {
      dropdown.style.maxHeight = '';
    }
  };

  const observer = new MutationObserver(updateHeight);
  observer.observe(dropdown, { attributes: true, attributeFilter: ['class'] });

  updateHeight();
});
