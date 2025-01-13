const date = new Date(); //2004-02-20
const options = { year: 'numeric', month: 'long', day: '2-digit' };
const formattedDate = date.toLocaleDateString('en-US', options);

function displayCurrentDate() {
    document.getElementById("currentDate").innerHTML = formattedDate;
}

window.onload = displayCurrentDate;

function showSelectAnalytics() {
    document.getElementById('choose-analytics-modal').style.display = "flex";
}
var currentYear = new Date().getFullYear();

    // Set the initial value of year inputs to the current year
    document.getElementById("yearForMonthly").value = currentYear;
    document.getElementById("yearForYearly").value = currentYear;
  document.getElementById("chooseAnalytics").addEventListener("change", function() {
  console.log("pumasok");
    var selectedOption = this.value;

    document.getElementById("dateForDaily").style.display = "none";
    document.getElementById("monthForMonthly").style.display = "none";
    document.getElementById("yearForMonthly").style.display = "none";
    document.getElementById("yearForYearly").style.display = "none";

    document.getElementById("dailyDateLabel").style.display = "none";
    document.getElementById("monthlyMonthLabel").style.display = "none";
    document.getElementById("monthlyYearLabel").style.display = "none";
    document.getElementById("yearlyYearLabel").style.display = "none";

    console.log(selectedOption);
    if (selectedOption === "Daily") {
      document.getElementById("dateForDaily").style.display = "block";
      document.getElementById("dailyDateLabel").style.display = "block";
    } else if (selectedOption === "Monthly") {
      document.getElementById("monthForMonthly").style.display = "block";
      document.getElementById("yearForMonthly").style.display = "block";
      document.getElementById("monthlyMonthLabel").style.display = "block";
    document.getElementById("monthlyYearLabel").style.display = "block";
    } else if (selectedOption === "Yearly") {
      document.getElementById("yearForYearly").style.display = "block";
      document.getElementById("yearlyYearLabel").style.display = "block";
    }
  });

  document.getElementById("cancel-btn").addEventListener("click", function() {
    document.getElementById('choose-analytics-modal').style.display = "none";
  });

  document.addEventListener('DOMContentLoaded', function() {
    // Select the form by using the class name, ID, or any method that suits your structure
    document.querySelector('form').addEventListener('submit', function(e) {
        // Optionally, you can still prevent the default action to test the behavior without actually submitting the form
        // e.preventDefault();
        
        // Hide the mainContainer-dashboard
        document.getElementById('mainContainer-dashboard').style.display = 'none';
        
        // If you are preventing the default submit action for testing, remember to comment it out or remove it for the actual form submission to work.
    });
});