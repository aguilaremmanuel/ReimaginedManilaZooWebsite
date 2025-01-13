// admin-operating-hours.js

// Function to open the edit modal with current day and hours
function editHours(day, hours) {
    document.getElementById('hoursEditHead').innerText = `Edit Hours for ${day}`;
    document.getElementById('hoursInput').value = hours;
    document.getElementById('editModal').style.display = 'block';
}

// Function to close the edit modal
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

document.getElementById('cancelBtn').addEventListener("click", function() {
     closeModal();
});

// Function to save changes to operating hours
function saveChanges() {
    const day = document.getElementById('hoursEditHead').innerText.split(' ')[3]; // Extract day from modal header
    const newHours = document.getElementById('hoursInput').value;

    // Update the table cell with new hours
    document.getElementById('hoursTableBody').querySelectorAll('tr').forEach(row => {
        if (row.cells[0].innerText === day) {
            row.cells[1].innerText = newHours;
        }
    });

    // Update the JSON file with new hours via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update-operating-hours.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Log server response
        }
    };
    xhr.send(JSON.stringify({ day: day, hours: newHours }));

    // Close the modal
    closeModal();
}
