const center = document.getElementsByClassName('toggle-inner')[0];
const cloud = document.getElementsByClassName('clouds')[0];
const outer = document.getElementsByClassName('toggle-outer')[0];
const footer = document.getElementById('main-footer');
// const darkModeToggle = document.getElementById('dark-mode-toggle');
const body = document.body;
const modalContent = document.querySelector('.modal-content');

// Fungsi untuk mengaktifkan/menonaktifkan dark mode
function activateToggle() {
  document.body.classList.toggle('dark-mode');

  // Periksa apakah body memiliki kelas 'dark'
  const isDarkMode = document.body.classList.contains('dark-mode');

  // Sesuaikan tampilan tergantung pada mode yang aktif
  if (isDarkMode) {
    // Mode gelap
    center.classList.add('toggle-active');
    cloud.classList.add('clouds-active');
    outer.classList.add('outer-active');
    footer.classList.add('footer-dark');
    body.classList.add('dark-mode');
    applyDarkModeStyles();
    modalContent.style.backgroundColor = '#343A40';
  } else {
    // Mode terang
    center.classList.remove('toggle-active');
    cloud.classList.remove('clouds-active');
    outer.classList.remove('outer-active');
    footer.classList.remove('footer-dark');
    body.classList.remove('dark-mode');
    removeDarkModeStyles();
    modalContent.style.backgroundColor = '#D9D9D9';
  }
}

// Function to apply dark mode styles to card-body-overlay
function applyDarkModeStyles() {
  const cardBodyOverlays = document.getElementsByClassName('card-body-overlay');
  for (const cardBodyOverlay of cardBodyOverlays) {
    cardBodyOverlay.style.position = 'absolute';
    cardBodyOverlay.style.bottom = '0';
    cardBodyOverlay.style.left = '0';
    cardBodyOverlay.style.right = '0';
    cardBodyOverlay.style.width = '100%';
    cardBodyOverlay.style.height = 'auto';
    cardBodyOverlay.style.borderRadius = '30px 0 5% 5%';
    cardBodyOverlay.style.backgroundColor = 'rgba(52, 58, 64, 0.95)';
  }
}

// Function to remove dark mode styles from card-body-overlay
function removeDarkModeStyles() {
  const cardBodyOverlays = document.getElementsByClassName('card-body-overlay');
  for (const cardBodyOverlay of cardBodyOverlays) {
    cardBodyOverlay.style.position = 'absolute';
    cardBodyOverlay.style.bottom = '0';
    cardBodyOverlay.style.left = '0';
    cardBodyOverlay.style.right = '0';
    cardBodyOverlay.style.width = '100%';
    cardBodyOverlay.style.height = 'auto';
    cardBodyOverlay.style.borderRadius = '30px 0 5% 5%';
    cardBodyOverlay.style.backgroundColor = 'rgba(255, 255, 255, 0.8)';
  }
}
