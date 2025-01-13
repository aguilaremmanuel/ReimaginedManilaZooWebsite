// Global variable to track the current key being edited
let currentEditingKey = null;

// Function to load ticket rates from the server
function loadTicketRates() {
    fetch('../admin/loadRates.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('ratesTableBody');
            tableBody.innerHTML = ''; // Clear the table body

            let count = 1;
            for (let key in data) {
                let row = tableBody.insertRow(-1);
                let cell1 = row.insertCell(0);
                let cell2 = row.insertCell(1);
                let cell3 = row.insertCell(2);
                
                cell1.innerHTML = count++;
                cell2.innerHTML = displayTicketType(key);
                cell3.innerHTML = `₱${data[key].toFixed(2)}`;
            }
        })
        .catch(error => console.error('Error loading ticket rates:', error));
}

// Function to show the edit modal
function showEditModal(key, price) {
    currentEditingKey = key;
    console.log(currentEditingKey);
    document.getElementById('ticketPrice').value = price;
    document.getElementById('editModal').style.display = 'block';
    document.getElementById('ticketEditHead').innerHTML = displayTicketType(key) + ":";
}

function displayTicketType(key) {
    let ticketType = null;

    switch(key) {
        case "REG-MNL":
            ticketType =  "Regular Manila Resident";
            break;
        case "REG-NON-MNL":
            ticketType =  "Regular Non-Manila Resident";
            break;
        case "STUD-MNL":
            ticketType =  "Student Manila Resident";
            break;
        case "STUD-NON-MNL":
            ticketType =  "Student Non-Manila Resident";
            break;
        case "SC-PWD-MNL":
            ticketType =  "Senior Citizen and PWD Manila Resident";
            break;
        case "SC-PWD-NON-MNL":
            ticketType =  "Senior Citizen and PWD Non-Manila Resident";
            break;
        case "CHLDRN":
            ticketType =  "Children";
            break;
        case "MNL-EMP":
            ticketType =  "Manila Employee";
            break;
        case "OTHER-CITIZEN":
            ticketType =  "Priviledge Citizen";
            break;
    }

    return ticketType;
}

// Function to close the edit modal without saving
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
    currentEditingKey = null; // Reset the currentEditingKey
}

// Function to save changes made to the ticket rate
function saveChanges() {
    const newPrice = parseFloat(document.getElementById('ticketPrice').value);
    if (!isNaN(newPrice) && currentEditingKey !== null) {
        fetch('../admin/updateRate.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ key: currentEditingKey, price: newPrice }),
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert(data.message);
                closeEditModal(); // Close the modal
                // Reload ticket rates in rates.php after update
                parent.loadTicketRates();
            } else {
                alert('Failed to update ticket rate.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Error saving changes.');
        });
    }
}

// Event listeners for modal buttons
window.onload = function() {
    document.querySelector('.close').addEventListener('click', closeEditModal);
    document.querySelector('.cancel-btn').addEventListener('click', closeEditModal);
};
