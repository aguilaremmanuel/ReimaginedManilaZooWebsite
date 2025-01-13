document.addEventListener('DOMContentLoaded', function () {
    var isDragging = false;
    var dragX, dragY;
    var mapImage = document.getElementById('map-image');

    // Define the boundaries for dragging
    var minX = 0; // Minimum X coordinate
    var minY = 0; // Minimum Y coordinate
    var maxX = 300; // Maximum X coordinate
    var maxY = 250; // Maximum Y coordinate

    mapImage.addEventListener('mousedown', function (e) {
        isDragging = true;
        dragX = e.clientX - mapImage.offsetLeft;
        dragY = e.clientY - mapImage.offsetTop;
        mapImage.style.cursor = 'grabbing';
    });

    document.addEventListener('mousemove', function (e) {
        if (isDragging) {
            var posX = e.clientX - dragX;
            var posY = e.clientY - dragY;

            // Limit drag within specified boundaries
            posX = Math.min(Math.max(posX, minX), maxX);
            posY = Math.min(Math.max(posY, minY), maxY);

            mapImage.style.left = posX + 'px';
            mapImage.style.top = posY + 'px';
        }
    });

    document.addEventListener('mouseup', function () {
        isDragging = false;
        mapImage.style.cursor = 'grab';
    });
});