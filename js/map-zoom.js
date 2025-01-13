document.addEventListener('DOMContentLoaded', function () {
    var scale = 1;
    var maxZooms = 2;
    var currentZooms = 0;

    var mapImage = document.getElementById('map-image');
    var zoomInButton = document.getElementById('zoom-in');
    var zoomOutButton = document.getElementById('zoom-out');

    function updateButtonStyles() {
        if (currentZooms >= maxZooms) {
            zoomInButton.disabled = true;
            zoomInButton.style.backgroundColor = '#2d5658';
            zoomInButton.style.color = '#ccc';
        } else {
            zoomInButton.disabled = false;
            zoomInButton.style.backgroundColor = '#1D2C32';
            zoomInButton.style.color = '#fff';
        }

        if (scale <= 1) {
            zoomOutButton.disabled = true;
            zoomOutButton.style.backgroundColor = '#2d5658';
            zoomOutButton.style.color = '#ccc';
        } else {
            zoomOutButton.disabled = false;
            zoomOutButton.style.backgroundColor = '#1D2C32';
            zoomOutButton.style.color = '#fff';
        }
    }

    zoomInButton.addEventListener('click', function () {
        if (currentZooms < maxZooms) {
            scale += 0.25;
            applyZoom();
            currentZooms++;
        }
        updateButtonStyles();
    });

    zoomOutButton.addEventListener('click', function () {
        if (scale > 1) {
            scale -= 0.25;
            applyZoom();
            currentZooms--;
        }
        updateButtonStyles();
    });

    function applyZoom() {
        mapImage.style.transform = 'scale(' + scale + ')';

        var leftPosition = 220 - ((scale - 1) * 300);
        mapImage.style.left = leftPosition + 'px';
    }

    updateButtonStyles();
});