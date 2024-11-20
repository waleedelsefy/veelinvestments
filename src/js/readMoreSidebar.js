fetch('../../../template-parts/global/readMoreSidebar.html')
    .then(response => response.text())
    .then(data =>{
        document.getElementById('the-most-reading-form').innerHTML = data;
    })
    .catch(error => console.error('Error loading element:', error));
    

    fetch('../../../template-parts/global/readMoreSidebar.html')
    .then(response => response.text())
    .then(data =>{
        document.getElementById('the-most-reading-form-for-mobile').innerHTML = data;
    })
    .catch(error => console.error('Error loading element:', error));