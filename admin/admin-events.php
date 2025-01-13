<?php
require '../connection.php';

// Function to safely escape HTML output
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if (isset($_POST['submit_add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['edit_date'];
    $organization_or_entities = $_POST['organization_or_entities'];

    // Check if a file was uploaded
    if ($_FILES['image']['size'] > 0) {
        $image_name = uniqid('', true) . '_' . $_FILES['image']['name'];
        $image_path = 'img/' . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    } else {
        $image_name = null; // No image uploaded
    }

    // Insert new data into the database
    $query = "INSERT INTO event_details (name_of_event, description, date, organization_or_entities, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $name, $description, $date, $organization_or_entities, $image_name);
    $stmt->execute();
}

// Check if edit parameter is present in the URL
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];

    // Fetch data for the selected row
    $query = "SELECT * FROM event_details WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Display the edit form with pre-filled values
    if ($row) {
        ?>
        <!-- Edit Form -->
        <h2>Edit Event Data</h2>
        <form action="admin-events.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" value="<?= $edit_id ?>">
            Name: <input type="text" name="name" value="<?= escape($row['name_of_event']); ?>"><br>
            Description: <textarea name="description"><?= escape($row['description']); ?></textarea><br>
            Date:
            <select name="month">
                <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" <?= ($i == date('m', strtotime($row['date']))) ? 'selected' : '' ?>><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                <?php endfor; ?>
            </select>
            <select name="day">
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" <?= ($i == date('d', strtotime($row['date']))) ? 'selected' : '' ?>><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                <?php endfor; ?>
            </select>
            <select name="year">
                <?php
                $currentYear = date('Y');
                $startYear = $currentYear - 50; // Adjust this as per your requirement
                $endYear = $currentYear + 50; // Adjust this as per your requirement
                for ($i = $startYear; $i <= $endYear; $i++): ?>
                    <option value="<?= $i ?>" <?= ($i == date('Y', strtotime($row['date']))) ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select><br>
            Organization or Entities: <input type="text" name="organization_or_entities" value="<?= escape($row['organization_or_entities']); ?>"><br>
            Current Image: <img src="img/<?= escape($row['image']); ?>" class="table-image" alt="Current Image"><br>
            New Image: <input type="file" name="new_image"><br>
            <input type="submit" name="submit_edit" value="Update">
        </form>
        <?php
        exit(); // Stop further execution
    }
}

// Handle adding, editing, and deleting data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle editing data
    if (isset($_POST['submit_edit'])) {
        $edit_id = $_POST['edit_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $date = isset($_POST['edit_date']) ? $_POST['edit_date'] : $_POST['original_date']; // Use original date if no new date provided
        $organization_or_entities = $_POST['organization_or_entities'];

        
        // Check if a new image is uploaded
        if ($_FILES['new_image']['size'] > 0) {
            $new_image_name = uniqid('', true) . '_' . $_FILES['new_image']['name'];
            $new_image_path = 'img/' . $new_image_name;
            move_uploaded_file($_FILES['new_image']['tmp_name'], $new_image_path);
        } else {
            // If no new image uploaded, keep the existing image
            $query = "SELECT image FROM event_details WHERE event_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $edit_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $existing_image = $result->fetch_assoc()['image'];
            $new_image_name = $existing_image;
        }

        // Update data in the database
        $query = "UPDATE event_details SET name_of_event=?, description=?, date=?, organization_or_entities=?, image=? WHERE event_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $name, $description, $date, $organization_or_entities, $new_image_name, $edit_id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect back to the data page if successful
            header("Location: admin-events.php");
            exit();
        } else {
            // Handle the error if update fails
            echo "Error: " . $stmt->error;
        }
    }
}

// Handle deleting data
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Fetch image path before deletion
    $query = "SELECT image FROM event_details WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $image_path = 'img/' . $row['image'];

    // Delete record from database
    $query = "DELETE FROM event_details WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Delete image file from server
    if (file_exists($image_path)) {
        unlink($image_path);
    }
}

// Fetch data to display in the table
$query = "SELECT * FROM event_details ORDER BY event_id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/animals_styles.css"> <!--table contents-->
    <title>Admin — Events</title>
    <link rel="icon" href="../admin/admin-logo.png">
    
    <style>
        .head-container a, h2 {
            text-decoration: none; /* Removes the underline */
            color: white; /* Sets the font color to white */
        }
        
        .head-container a:hover {
            color: black; /* Sets the font color to white */
            background-color: #45BCC8;
        }
    </style>
    
</head>
<body>

<div class="wrapper">

    <div class="side-bar">
        <div class="header">
            <div class="head-container">
                <img src="../images/logo.png" alt="Manila Zoo Logo">
                <h2><a href="admin-login.php">ADMIN</h2></a>
            </div>

        </div>
        <div class="dashboard-nav"> <a href="dashboard.php">Dashboard</a></div>
        <div class="feature-header"><span>FEATURES:</span></div>
        <div class="feature-nav"><a href="today-appointment.php">Incoming Appointments</a></div>
        <div class="feature-nav"><a href="archive-appointment.php">Past Appointments</a></div>
        <div class="feature-nav"><a href="ticket-categories.php">Ticket Categories</a></div>
        <div class="feature-nav"><a href="operating-hours-categories.php">Operating Hours</a></div>
        <div class="feature-nav"><a href="admin-animals.php">Animals Management</a></div>
        <div class="feature-nav"><a href="admin-plants.php">Plants Management</a></div>
        <div class="feature-nav"><a href="admin-events.php">Events Management</a></div>
        <div class="feature-nav"><a href="admin-operations.php">Operations</a></div>
    </div>

    <div class="main-container dashboard-page" id="mainContainer-dashboard">
    <div class="header"></div>
        <!-- Main content header -->
        <div class="data-container">
            <h2 class="table-heading">Manage Event Data</h2>
            <table id="table" border="1">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Organization or Entities</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= escape($row['name_of_event']); ?></td>
                        <td><?= escape($row['description']); ?></td>
                        <td><?= date('F d, Y', strtotime($row['date'])); ?></td>
                        <td><?= escape($row['organization_or_entities']); ?></td>
                        <td><img src="img/<?= escape($row['image']); ?>" class="table-image" alt="Image"></td>
                        <td>
                            <button class="edit-btn" data-id="<?= escape($row['event_id']); ?>">Edit</button> |
                            <a href="admin-events.php?delete=<?= escape($row['event_id']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

        

        </div>

        <div class="data-container">
            <!-- Add New Event Form -->
            <h2 class="add-new">Add New Event</h2>
            <form action="admin-events.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="edit_id" id="edit_id">
                <input type="hidden" name="original_date" id="original_date"> <!-- Hidden input for original date -->
                Name: <input type="text" name="name" id="edit_name" required><br>
                Description: <textarea name="description" id="edit_description" required></textarea><br>
                Date: 
                <input type="date" name="edit_date" id="edit_date" required><br> <!-- Change to date input -->
                Organization or Entities: <input type="text" name="organization_or_entities" id="edit_organization_or_entities" required><br>
                Image: <input type="file" name="image" required><br>
                <input type="submit" name="submit_add" value="Add Data">
            </form>


            <!-- Hidden Edit Form -->
            <div id="edit-form" style="display: none;">
                <h2>Edit Data</h2>
                <form action="admin-events.php" method="post" enctype="multipart/form-data" id="edit_form">
                    <input type="hidden" name="edit_id" id="edit_id_hidden">
                    <input type="hidden" name="original_date" id="original_date_hidden"> <!-- Hidden input for original date -->
                    Name: <input type="text" name="name" id="edit_name_hidden"><br>
                    Description: <textarea name="description" id="edit_description_hidden"></textarea><br>
                    Date: <input type="date" name="edit_date" id="edit_date_hidden" required><br> <!-- Change to date input -->
                    Organization or Entities: <input type="text" name="organization_or_entities" id="edit_organization_or_entities_hidden"><br>
                    Current Image: <img id="edit_image_hidden" src="" class="table-image" alt="Current Image"><br>
                    New Image: <input type="file" name="new_image"><br>
                    <input type="submit" name="submit_edit" value="Submit">
                </form>
            </div>
        </div>

    </div>
</div>

<script>
        document.querySelectorAll('.edit-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var editId = button.getAttribute('data-id');
            var row = button.parentElement.parentElement;
            var name = row.cells[1].innerText;
            var description = row.cells[2].innerText;
            var date = row.cells[3].innerText;
            var organizationOrEntities = row.cells[4].innerText;

            // Populate the form fields with values
            document.getElementById('edit_id_hidden').value = editId;
            document.getElementById('edit_name_hidden').value = name;
            document.getElementById('edit_description_hidden').value = description;
            document.getElementById('original_date_hidden').value = date; // Store the original date
            document.getElementById('edit_date_hidden').value = date; // Set the date input value
            document.getElementById('edit_organization_or_entities_hidden').value = organizationOrEntities;

            document.getElementById('edit-form').style.display = 'block';
        });
    });
</script>

</body>
</html>
