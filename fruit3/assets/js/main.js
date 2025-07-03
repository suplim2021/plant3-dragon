// Adjust dropdown height to match content
document.addEventListener('DOMContentLoaded', function () {
  const header = document.querySelector('.header--floating');
  const dropdown = document.querySelector('.nav-panel.-dropdown');
  if (!header || !dropdown) return;

  const updateHeight = () => {
    if (dropdown.classList.contains('active')) {
      dropdown.style.setProperty('--dropdown-height', dropdown.scrollHeight + 'px');
    } else {
      dropdown.style.removeProperty('--dropdown-height');
    }
  };

  const observer = new MutationObserver(updateHeight);
  observer.observe(dropdown, { attributes: true, attributeFilter: ['class'] });

  updateHeight();
});
