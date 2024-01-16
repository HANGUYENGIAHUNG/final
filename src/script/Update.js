
function previewImages() {
    const fileInput = document.getElementById('fileInput');
    const imagePreviews = document.getElementById('imagePreviews');
    
        if (imagePreviews.firstChild) {
            imagePreviews.removeChild(imagePreviews.firstChild);
        }
  
        const reader = new FileReader();
        const img = document.createElement('img');
       
        reader.onload = function (e) {
            img.src = e.target.result;
        };
       
        img.style.maxWidth = '100px';
        img.style.maxHeight = '100px';
        img.style.height='65px';
        img.style.width='65px';
        img.style.border= 'solid';
        img.style.borderRadius= '10px';
  
  
        reader.readAsDataURL(fileInput.files[0]);
        imagePreviews.appendChild(img);
    }