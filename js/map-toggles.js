document.addEventListener("DOMContentLoaded", function() {
    // Get all markers
    var markers = document.querySelectorAll('.marker');

    // Initially hide all markers
    markers.forEach(function(marker) {
        marker.classList.add('marker-show-effect'); // Add the show effect class
    });

    // Function to toggle marker visibility and apply effect
    function toggleMarkers(markerType) {
        markers.forEach(function(marker) {
            if (marker.classList.contains(markerType)) {
                marker.classList.toggle('show'); // Toggle the 'show' class for the specific marker type
            }
        });
    }

    var toggleButtons = document.querySelectorAll('.toggle-button');

    toggleButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            if (button.id === 'all-toggle') {
                // If the "All" toggle button is clicked
                if (button.classList.contains('active')) {
                    // If the button is already active, deactivate it and hide all markers
                    button.classList.remove('active');
                    markers.forEach(function(marker) {
                        marker.classList.remove('show');
                    });
                } else {
                    // Show all pins
                    markers.forEach(function(marker) {
                        marker.classList.add('show');
                    });

                    // Deactivate all buttons
                    toggleButtons.forEach(function(otherButton) {
                        otherButton.classList.remove('active');
                    });

                    // Activate the clicked button
                    button.classList.add('active');
                }
            } else {
                if (button.classList.contains('active')) {
                    // If the button is already active, deactivate it and hide corresponding markers
                    button.classList.remove('active');
                    toggleMarkers(button.id.split('-')[0]); // Remove markers associated with the clicked button
                } else {
                    // Deactivate all buttons
                    toggleButtons.forEach(function(otherButton) {
                        otherButton.classList.remove('active');
                    });

                    // Activate the clicked button
                    button.classList.add('active');

                    // Hide all markers
                    markers.forEach(function(marker) {
                        marker.classList.remove('show');
                    });

                    // Toggle the corresponding marker type
                    toggleMarkers(button.id.split('-')[0]);
                }
            }
        });
    });
});