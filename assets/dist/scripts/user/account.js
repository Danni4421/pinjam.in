document.addEventListener('change', function (event) {
  if (event.target.classList.contains('uploadProfileInput')) {
    const triggerInput = event.target;
    const currentImg = triggerInput
      .closest('.pic-holder')
      .querySelector('.pic').src;
    const holder = triggerInput.closest('.pic-holder');
    const wrapper = triggerInput.closest('.profile-pic-wrapper');

    const alerts = wrapper.querySelectorAll('[role="alert"]');
    alerts.forEach(function (alert) {
      alert.remove();
    });

    triggerInput.blur();
    const files = triggerInput.files || [];
    if (!files.length || !window.FileReader) {
      return;
    }

    if (/^image/.test(files[0].type)) {
      const reader = new FileReader();
      reader.readAsDataURL(files[0]);

      reader.onloadend = function () {
        holder.classList.add('uploadInProgress');
        holder.querySelector('.pic').src = this.result;
      };
    }
  }
});
