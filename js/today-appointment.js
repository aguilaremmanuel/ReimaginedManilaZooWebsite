var ticketId = null;
var scheduleDate = null;
var guestCount = null;

document.addEventListener('DOMContentLoaded', function() {
    // Modal initialization for ticket details
    initializeTicketModalListeners();

    initializeEditDateModal();

    // Archive confirmation modal interactions
    initializeArchiveConfirmationListeners();

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
    var editBtn = document.getElementById("ticket-action-btn");

    close.onclick = function() {
        modal.style.display = "none";
    };

    editBtn.addEventListener('click', function() {
        document.querySelector('.modal-content').style.display = 'none';
        document.querySelector('.edit-date-content').style.display = 'block';
    });

}

function fetchTicketDetailsAndShowModal(ticketId) {
    fetch('../admin/fetch-ticket-details.php?ticketId=' + ticketId)
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
        
        
        scheduleDate = data.Schedule_Date;
        guestCount = data.Guest_Count;
    })
    .catch(error => console.error('Error:', error));
    document.getElementById("ticketModal").style.display = "block";
   
}
function initializeEditDateModal() {
    document.getElementById('dateInput').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Reset hours, minutes, seconds, and milliseconds to 0
    
        if (selectedDate < currentDate) {
            // If the selected date is in the past, clear the input
            alert('Selected date is in the past. Please select a current or future date.');
            this.value = ''; // Clear the input field
        } else {
            document.getElementById("ticketId").value = ticketId;
            document.getElementById("oldDate").value = scheduleDate;
            document.getElementById('guestCount').value = guestCount;
            console.log(scheduleDate);
            console.log(guestCount);
            
        }
    });

    document.getElementById('cancel-edit-date-btn').addEventListener('click', function() {
        document.getElementById('edit-date-content').style.display="none";
        document.querySelector('.modal-content').style.display = 'block';
        document.getElementById('dateInput').value = '';
    });
}


document.getElementById('cancel-edit-date-btn').addEventListener('click', function() {
    document.getElementById('edit-date-content').style.display="none";
    document.getElementById('ticketModal').style.display="none";
});


function initializeArchiveConfirmationListeners() {
    document.getElementById('archive-record').addEventListener('click', function() {
        document.getElementById('confirmation').style.display = "block";
        document.getElementById('admin-action-container').style.filter = "blur(8px)";
        document.getElementById('table-container').style.filter = "blur(8px)";
    });

    document.getElementById('cancel-btn').addEventListener('click', function() {
        document.getElementById('confirmation').style.display = "none";
        document.getElementById('admin-action-container').style.filter = "none";
        document.getElementById('table-container').style.filter = "none";
    });
}

// Fetch and display search suggestions
function fetchSuggestions() {
    let searchInput = document.getElementById('searchInput').value;

    fetch('../admin/fetch-records.php?searchInput=' + encodeURIComponent(searchInput))
    .then(response => response.json())
    .then(data => {
        let tableContainer = document.getElementById('table-container');
        let tableHTML = "<table><tr><th>Ticket ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Age</th><th>Residency</th><th>Status</th><th>Contact No</th><th>Email</th><th>Price</th></tr>";

        if(data.length) {
            data.forEach(function(row) {
                tableHTML += `<tr><td class="ticket-link" data-ticketid="${row.Ticket_ID}">${row.Ticket_ID}</td><td>${row.Guest_FirstName}</td><td>${row.Guest_LastName}</td><td>${row.Gender}</td><td>${row.Age}</td><td>${row.Residency}</td><td>${row.Guest_Status}</td><td>${row.Contact_No}</td><td>${row.Email}</td><td>${row.Price}</td></tr>`;
            });
        } else {
            tableHTML += "<tr><td colspan='10'>No records found</td></tr>";
        }

        tableHTML += "</table>";
        tableContainer.innerHTML = tableHTML;
    })
    .catch(error => console.error('Error:', error));
}
