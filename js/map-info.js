document.addEventListener("DOMContentLoaded", function() {
    var markerIcons = document.querySelectorAll(".marker");

    markerIcons.forEach(function(markerIcon) {
        markerIcon.addEventListener("click", function() {
            var markerId = markerIcon.getAttribute("marker-id");

            var markerInfo = document.querySelector(".marker_info[data-marker-id='" + markerId + "']");

            if (markerInfo) {
                markerInfo.classList.toggle("open");
            }
        });
    });

    var closeButtons = document.querySelectorAll(".marker_info .close_button");

    closeButtons.forEach(function(closeButton) {
        closeButton.addEventListener("click", function() {
            var markerInfo = closeButton.closest(".marker_info");

            if (markerInfo) {
                markerInfo.classList.remove("open");
            }
        });
    });
});