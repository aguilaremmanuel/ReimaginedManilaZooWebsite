var ticketId = null;
var scheduleDate = null;
//var guestCount = null;

document.addEventListener('DOMContentLoaded', function() {
    // Modal initialization for ticket details
    initializeTicketModalListeners();

    // Event delegation for dynamically loaded ticket links
    document.querySelector('#table-container').addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('ticket-link')) {
            event.preventDefault();
            ticketId = event.target.getAttribute('data-ticketid');
            fetchTicketDetailsAndShowModal(ticketId);
        }
    });
});

function initializeTicketModalListeners() {
    var modal = document.getElementById("ticketModal");
    var close = document.getElementById("close");

    close.onclick = function() {
        modal.style.display = "none";
    };

}

function fetchTicketDetailsAndShowModal(ticketId) {
    fetch('../admin/fetch-ticket-details-archive.php?ticketId=' + ticketId)
    .then(response => response.json())
    .then(data => {
        var dateObject = new Date(data.Schedule_Date + 'T00:00:00'); // Adjust based on your actual data structure

        var formatDate = new Intl.DateTimeFormat('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric', 
            timeZone: 'Asia/Manila'
        }).format(dateObject);

        document.getElementById('showScheduleDate').innerHTML = formatDate;
        document.getElementById('showTicketPrice').innerHTML = "Php " + data.Ticket_Price + ".00";
        document.getElementById('showGuestCount').innerHTML = data.Guest_Count;
        document.getElementById('showTicketID').innerHTML = ticketId;
        document.getElementById("ticketModal").style.display = "block";
        
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('delete-record').addEventListener('click', function() {
    document.getElementById('deletePopup').style.display = 'flex';
});

document.getElementById('deleteCancel').addEventListener('click', function() {
    document.getElementById('deletePopup').style.display = 'none';
});

document.getElementById('deleteConfirm').addEventListener('click', function() {
    var ticketIdToDelete = document.getElementById('ticketIdInput').value;
    if (ticketIdToDelete) {
        // Here you can send Ticket ID to server for deletion
        // For demonstration, using window.location to simulate the request
        window.location.href = "delete-record.php?ticketId=" + ticketIdToDelete;
        alert('No record found with that Ticket ID.');
    } else {
        alert("Please enter a Ticket ID");
    }
});

function fetchSuggestions() {
    
    let searchInput = document.getElementById('searchInput').value;

    fetch('../admin/fetch-records-past.php?searchInput=' + encodeURIComponent(searchInput))
    .then(response => response.json())
    .then(data => {
        let tableContainer = document.getElementById('table-container');
        let tableHTML = "<table><tr><th>Ticket ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Age</th><th>Residency</th><th>Status</th><th>Contact No</th><th>Email</th><th>Price</th></tr>";

        if(data.length) {
            data.forEach(function(row) {
                tableHTML += `<tr><td class="ticket-link" data-ticketid="${row.Ticket_ID}">${row.Ticket_ID}</td><td>${row.Guest_FirstName}</td><td>${row.Guest_LastName}</td><td>${row.Gender}</td><td>${row.Age}</td><td>${row.Residency}</td><td>${row.Guest_Status}</td><td>${row.Contact_No}</td><td>${row.Email}</td><td>${row.Price}</td></tr>`;
            });
        } else {
            tableHTML += "<tr><td colspan='10'>No results found</td></tr>";
        }
        tableHTML += "</table>";
        tableContainer.innerHTML = tableHTML;
    })
    .catch(error => console.error('Error:', error));
}

