function copyArticleUrl() {
  const articleUrl = window.location.href; // Get the current page URL

  if (navigator.clipboard && navigator.clipboard.writeText) {
    // استخدام Clipboard API إذا كانت مدعومة
    navigator.clipboard.writeText(articleUrl).then(() => {
      alert(translations.copySuccess); // Display success message
    }).catch(err => {
      console.error('Error copying text: ', err);
      alert(translations.copyError); // Display error message
    });
  } else {
    const tempInput = document.createElement('input');
    tempInput.value = articleUrl;
    document.body.appendChild(tempInput);
    tempInput.select();
    try {
      document.execCommand('copy');
      alert(translations.copySuccess);
    } catch (err) {
      console.error('Error copying text: ', err);
      alert(translations.copyError);
    }
    document.body.removeChild(tempInput);
  }
}
