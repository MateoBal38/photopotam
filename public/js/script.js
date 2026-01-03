const images = document.querySelectorAll('.grand');

const overlay = document.createElement('div');
overlay.style.position = 'fixed';
overlay.style.top = '0';
overlay.style.left = '0';
overlay.style.width = '100vw';
overlay.style.height = '100vh';
overlay.style.background = 'rgba(0, 0, 0, 0.6)';
overlay.style.backdropFilter = 'blur(6px)';
overlay.style.display = 'none';
overlay.style.justifyContent = 'center';
overlay.style.alignItems = 'center';
overlay.style.zIndex = '9999';

const bigImg = document.createElement('img');
bigImg.style.maxWidth = '90%';
bigImg.style.maxHeight = '90%';
bigImg.style.borderRadius = '10px';
bigImg.style.boxShadow = '0 0 20px rgba(0, 0, 0, 0.5)';

overlay.appendChild(bigImg);
document.body.appendChild(overlay);

images.forEach(img => {
    img.addEventListener('click', () => {
        bigImg.src = img.src;
        overlay.style.display = 'flex';
    });
});

overlay.addEventListener('click', (e) => {
    if (e.target === bigImg) return;
    overlay.style.display = 'none';
});

// Modal for add photo
const addPhotoBtn = document.getElementById('add-photo-btn');
const addPhotoModal = document.getElementById('add-photo-modal');
const closeBtn = document.getElementsByClassName('close')[0];

if (addPhotoBtn) {
    addPhotoBtn.addEventListener('click', () => {
        addPhotoModal.style.display = 'block';
    });
}

if (closeBtn) {
    closeBtn.addEventListener('click', () => {
        addPhotoModal.style.display = 'none';
    });
}

window.addEventListener('click', (e) => {
    if (e.target === addPhotoModal) {
        addPhotoModal.style.display = 'none';
    }
});
