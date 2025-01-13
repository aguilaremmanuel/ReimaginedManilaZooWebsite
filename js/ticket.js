function addGuest() {
    if(canAddGuest()){
        var newForm = document.createElement("div");
            newForm.className = "form";
            // Copy the HTML structusre of a single guest form
            newForm.innerHTML = document.querySelector(".form").innerHTML;

            // Add a remove button to the new form
            var removeButton = document.createElement("button");
            removeButton.className = "remove-btn";
            removeButton.textContent = "REMOVE";
            removeButton.onclick = function () {
                removeGuest(newForm);
            };

            newForm.querySelector(".remove-btn-container").appendChild(removeButton);

            // Append the new form to the container
            document.getElementById("guestFormsContainer").appendChild(newForm);
    }
}

function canAddGuest() {
    var allForms = document.querySelectorAll(".form");
    // Check if the maximum number of guests has been reached
    var canAdd = true;

    allForms.forEach(function (form) {
        var requiredInputs = form.querySelectorAll("[required]");
        requiredInputs.forEach(function (input) {
            if (!input.value.trim()) {
                canAdd = false;
            }
        });
    });

    if (canAdd) {
        var termsCheckboxes = document.querySelectorAll("[name='termsAndCondition']");
        termsCheckboxes.forEach(function (checkbox) {
            if (!checkbox.checked) {
                canAdd = false;
                alert("Please agree to the Terms and Conditions before adding a new guest.");
            }
        });
    } else {
        alert("Please fill out all fields in existing forms before adding a new guest.");
    }
    return canAdd;
}

function removeGuest(form) {
    // Remove the form from the container
    document.getElementById("guestFormsContainer").removeChild(form);
}

function validateForm() {
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var mobileNo = document.getElementById('mobileNo').value;
    var email = document.getElementById('email').value;
    var age = document.getElementById('age').value;

    // Simple validation for first name and last name
    if (!/^[a-zA-Z\s]+$/.test(firstName) || !/^[a-zA-Z\s]+$/.test(lastName)) {
        alert("First name and last name should only contain letters.");
        return false;
    }

    // Simple validation for mobile number
    if (!mobileNo.match(/^\d{11}$/)) {
        alert("Please enter a valid 10-digit mobile number.");
        return false;
    }

    // Simple validation for email
    if (!email.match(/^\S+@\S+\.\S+$/)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Simple validation for age
    if (isNaN(age) || age < 0) {
        alert("Please enter a valid age.");
        return false;
    }

    return true; // Form is valid
}