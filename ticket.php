<?php
    session_start(); // Start the session

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assuming you have validated and sanitized the input

        $_SESSION['firstName'] = $_POST['firstName'];
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['mobileNo'] = $_POST['mobileNo'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['residency'] = $_POST['residency'];
        $_SESSION['status'] = $_POST['status'];

        // Redirect to the form page or another page
        header("Location: set-date.php");
        exit;
    }
    
?>

<html lang="en">
    
    <?php include("assets/html-head.php"); ?>
    <head>
        <title>Manila Zoo — Tickets</title>
        
        <style>
        /* Existing CSS styles */

        /* Style for modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            margin: 0 auto;
        }
        
        .icon-back {
            font-family: "Inter", sans-serif; 
            font-size: 20px;
            font-weight: 600;
            padding-bottom: 20px;
        }

        .icon-back a {
            text-decoration: none;
            font-size: 20px;
            font-weight: 600;
            color: #000;
        }

        .terms-box h1 span {
            color: #F7A832;
        }

        /* Style for modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 1% auto;
            padding-top: 0px;
            border: 1px solid #888;
            width: 80%;
            text-align: left; /* Align text to left for better readability */
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style for close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        /* Style for close button hover */
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Style for headings */
        .subtitles h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        /* Style for terms boxes */
        .terms-box {
            margin-bottom: 0;
            margin-top: 0;
        }

        .terms-box h1 {
            font-size: 18px;
            color: #555;
            text-align: center;
        }

        .terms-box p {
            font-size: 16px;
            color: #777;
            line-height: 1.5;
            text-align: center;
            padding-bottom: 20px;
            padding-left: 5%;
            padding-right: 5%;
        }
        
        .popup-trigger{
            color: #D65B26;
            text-decoration: underline;
        }

        .popup-trigger:hover{
            cursor: pointer;
        }
        
        .subtitles h1{
            padding-top: 20px;
            text-align: center;
        }
        
        .close{
            padding-right: 10px;
        }
    </style>
        
    </head>

    <body>
        <section id="ticket" class="visible">
            <div id="tickets1">
                <h1 class="titles">TICKETS</h1>
            </div>

            <div id="tickets-join">
                <div id="tickets2">
                    <div class="icon-back">
                        <a href="index.php"><i class="ri-arrow-left-double-line"></i>BACK</a>
                    </div>
                    <div>
                        <a href="#index.html" class="logo3"><img src="images/logo.png" alt="Logo"></a>
                        <h1 class="main-head">Personal Details</h1>
                        <p>Fill out the required fields to get your ticket.</p>
                        <a id="rates-button" href="rates.php"><button>VIEW TICKET RATES</button></a>
                    </div>
                </div>
                <div id="tickets3">
                    <form method="post" action="" onsubmit="return validateForm()">
                        <div id="formContainer" class="formContainer">
                            <div class="form" id="form">
                                <div class="input">
                                    <span class="details">First Name</span>
                                    <input type="text" id="firstName" name="firstName[]" required>
                                </div>
                                <div class="input">
                                    <span class="details">Last Name</span>
                                    <input type="text" id="lastName" name="lastName[]" required>
                                </div>
                                <div class="input">
                                    <span class="details">Mobile Number</span>
                                    <input type="text" id="mobileNo" name="mobileNo[]" required>
                                </div>
                                <div class="input">
                                    <span class="details">Email</span> 
                                    <input type="email" id="email" name="email[]" required>
                                </div>
                                <div class="input">
                                    <span class="details">Gender</span>
                                    <select id="gender" name="gender[]" required> 
                                        <option disabled selected value="">-Select-</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="input">
                                    <span class="details">Age</span>
                                    <input type="number" id="age" name="age[]" min="0" required>
                                </div>
                                <div class="input" id="residency">
                                    <span class="details">Residency</span>
                                    <select id="residency" name="residency[]" required>
                                        <option disabled selected value="">-Select-</option>
                                        <option value="MNL">Resident of Manila</option>
                                        <option value="NON-MNL">Non-resident (Outside of Manila)</option>
                                    </select>
                                </div>
                                <div class="input" id="status">
                                    <span class="details">Please select if apply:</span>
                                    <select id="residency" name="status[]" required>
                                        <option disabled selected value="">-Select-</option>
                                        <option value="STUD">I am Student</option>
                                        <option value="SC-PWD">I am PWD (Persons with disabilities)</option>
                                        <option value="MNL-EMP">I am Manila LGU Employee/Teacher of Manila.</option>
                                        <option value="SC-PWD">I am Senior Citizen (Must be 60 years old up)</option>
                                        <option value="CHLDRN">I am 2 years old and below</option>
                                        <option value="OTHER-CITIZEN">Priviledge Citizen</option>
                                        <option value="REG">None of the above</option>
                                    </select>
                                </div>
                                
                                <div class="container-join">
                                    <div class="terms">
                                        <p>Required:</p>
                                        <input type="checkbox" name="termsAndCondition" value="terms-and-condition" required>
                                        <label>I agree with the <span class="popup-trigger" id="highlight">Terms and Conditions</span></label>
                                    </div>
                                    <div class="btn-container">
                                        <div class="remove-btn-container">
                                            <!-- <button style="display:none;" class="remove-btn" onclick="removeGuest(this)">Remove</button> -->
                                        </div>
                                        <div class="add-btn-container">
                                             <button onclick="addGuest()"><i class="ri-add-line"></i> ADD GUEST</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="guestFormsContainer" id="guestFormsContainer"></div>
                        </div>
                         <input type="submit" value="SET APPOINTMENT"> 
                    </form>
                    
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                                <div class="subtitles">
                                    <h1>Terms and Conditions of Use</h1>
                                </div>

                                <div class="main-content">
                                    <div class="terms-box">
                                        <h1>Agreement:</h1>
                                        <p>By accessing Manila Zoo's website, you agree to comply with these Terms and Conditions of Use and applicable laws.
                                        If you disagree, do not use the site.</p>
                                    </div>
                                    <div class="terms-box">
                                        <h1>Limited License:</h1>
                                        <p>You may temporarily download materials for personal, non-commercial use only. You 
                                        may not modify, copy, or use the materials for commercial purposes. The license terminates if you violate these terms.</p>
                                    </div>
                                    <div class="terms-box">
                                        <h1>Disclaimer:</h1>
                                        <p>Manila Zoo provides materials "as is" without warranties. 
                                        It disclaims all other warranties and does not guarantee accuracy or reliability of materials.</p>
                                    </div>
                                    <div class="terms-box">
                                        <h1>Limitations of Liability:</h1>
                                        <p>Manila Zoo and its suppliers are not liable for damages arising from the use or inability to use the website.</p>
                                    </div>
                                    <div class="terms-box">
                                        <h1>Revisions:</h1>
                                        <p>Materials may contain errors, and Manila Zoo may change them without notice.</p>
                                    </div>
                                    <div class="terms-box">
                                        <h1>Links:</h1>
                                        <p>Manila Zoo is not responsible for the content of linked sites.</p>
                                    </div>
                                    <div class="terms-box">
                                        <h1>Modifications:</h1>
                                        <p>Manila Zoo may change these terms without notice.</p>
                                    </div>
                                    <div class="terms-box" id="terms-box-special">
                                        <h1>Governing Law:</h1>
                                        <p>The laws of the Philippines govern any claims related to Manila Zoo's website.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
         <script src="js/ticket.js"></script> 
         
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // Get the elements that trigger the popup
            var popupTriggers = document.getElementsByClassName("popup-trigger");

            // Function to open the modal
            function openModal() {
            modal.style.display = "block";
            }

            // Function to close the modal
            function closeModal() {
            modal.style.display = "none";
            }

            // Assigning click event handlers to popup triggers
            for (var i = 0; i < popupTriggers.length; i++) {
            popupTriggers[i].onclick = openModal;
            }

            // Click event handler for the close button
            span.onclick = closeModal;

            // Click event handler to close the modal when clicking outside of it
            window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
            }
        </script>
         
    </body>
</html>