const currentDate = new Date();
const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const currentYear = currentDate.getFullYear();
const currentMonth = currentDate.getMonth();

const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

var operationalDays = [];

var selectedDay = 0;
var slots = 0;
var dayIndex = 0;

async function fetchOperationDates() {
    try {
        const response = await fetch('admin/fetch-operation-dates.php'); 
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        operationalDays = await response.json();
        populateCalendar();
    } catch (error) {
        console.error('Error fetching operation dates:', error);
    }
}

function populateCalendar() {
    
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
    const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);

    document.getElementById("monthYear").innerHTML = monthNames[currentMonth] + ' ' + currentYear;

    let calendarBody = document.getElementById("calendar-body");
    calendarBody.innerHTML = ""; // Clear previous cells

    let date = 1;
    for (let row = 0; row < 6; row++) {
        let rowElement = document.createElement("tr");

        for (let day = 0; day < 7; day++) {
            if (row === 0 && day < firstDayOfMonth.getDay() || date > lastDayOfMonth.getDate()) {
                rowElement.appendChild(document.createElement("td"));
            } else {
                let cell = document.createElement("td");
                cell.innerText = date;
                cell.classList.add("date");
                rowElement.appendChild(cell);
                date++;
            }
        }

        calendarBody.appendChild(rowElement);
        if (date > lastDayOfMonth.getDate()) {
            break;
        }
    }
    setupDateClickEventListeners();
}

function fetchOperatingHours(selectedDay) {
    fetch('assets/operating_hours.json?' + new Date().getTime(), {
        cache: 'no-cache', // This tells the browser to fetch a fresh copy
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const hours = data[selectedDay];
        displayOperatingHours(hours);
    })
    .catch(error => {
        console.error("Error fetching operating hours:", error);
        displayOperatingHours("Operating Hours not available");
    });
}


function displayOperatingHours(hours) {
    const operatingHoursSpan = document.getElementById("OperatingHours");
    operatingHoursSpan.textContent = hours ? hours : "Operating Hours not available";
}

function setupDateClickEventListeners() {
    const dates = document.querySelectorAll('.date');
    const hiddenInput = document.getElementById('selectedValue');

    dates.forEach(date => {
        let hasDate = date.innerHTML.trim();
        if(hasDate.length > 0 && hasDate >= currentDate.getDate()) {
            

            let hasOperation = false;

            operationalDays.forEach(operationalDate => {
                if(operationalDate == date.innerText) {
                    hasOperation = true;
                }
            });

            if(hasOperation) {
                date.style.opacity = "40%";
            } else {
                date.addEventListener('click', function() {
                    date.classList.add('future-date');
                    dates.forEach(otherBox => {
                        otherBox.classList.remove('selected');
                    });
                    this.classList.add('selected');
    
                    selectedDay = this.textContent;
                    hiddenInput.value = "" + currentYear + "-" + (Number(currentMonth)+1) + "-" + this.textContent;
                    displaySelectedDate(selectedDay);
    
                    updateSlotValue(selectedDay);
                    let selectedDate = new Date(currentYear, currentMonth, parseInt(this.textContent));
                    dayIndex = selectedDate.getDay(); // 0 for Sunday, 1 for Monday, and so on
                    let selectedDayName = daysOfWeek[dayIndex];
                    fetchOperatingHours(selectedDayName);
    
                });
            }
        }else{
            date.style.opacity = "40%";
        }
    });
}


function displaySelectedDate(selectedDay) {
    let showSelectedDate = document.getElementById('dateValue');
    showSelectedDate.innerHTML = "" + monthNames[currentMonth] + " " + selectedDay + ", " + currentYear;
}

function updateSlotValue(selectedDay) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_slot.php?date=' + selectedDay, true);

    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);
            document.getElementById('slotValue').innerText = response.slots;
        }
    };
    xhr.send();
}

function isSelectedDate() {
    let selectedDate = document.getElementById('selectedValue').value;
    console.log(selectedDate);
    if(!selectedDate) {
        alert("Please select a date");
        return false;
    }
    return true;
}

window.onload = function() {
    fetchOperationDates(); // This will internally call populateCalendar() after fetching dates
};
