<?php
require '../connection.php';

// Function to safely escape HTML output
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_add'])) {
        $name = $_POST['name'];
        $scientific_name = $_POST['scientific_name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        
        // Check if a file was uploaded
        if ($_FILES['image']['size'] > 0) {
            $image_name = uniqid('', true) . '_' . $_FILES['image']['name'];
            $image_path = 'img/' . $image_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        } else {
            $image_name = null; // No image uploaded
        }

        // Check if a sound file was uploaded
        if ($_FILES['sound']['size'] > 0) {
            $sound_name = uniqid('', true) . '_' . $_FILES['sound']['name'];
            $sound_path = 'sounds/' . $sound_name;
            move_uploaded_file($_FILES['sound']['tmp_name'], $sound_path);
        } else {
            $sound_name = null; // No sound uploaded
        }

        // Insert new data into the database
        $query = "INSERT INTO tb_animal (name, scientific_name, category, description, image, sound) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $name, $scientific_name, $category, $description, $image_name, $sound_name);
        $stmt->execute();

    } elseif (isset($_POST['submit_edit'])) {
        // Handle editing data
        $edit_id = $_POST['edit_id'];
        $name = $_POST['name'];
        $scientific_name = $_POST['scientific_name'];
        $category = $_POST['category'];
        $description = $_POST['description'];

        // Check if a new image is uploaded
        if ($_FILES['new_image']['size'] > 0) {
            $new_image_name = uniqid('', true) . '_' . $_FILES['new_image']['name'];
            $new_image_path = 'img/' . $new_image_name;
            move_uploaded_file($_FILES['new_image']['tmp_name'], $new_image_path);
        } else {
            // If no new image uploaded, keep the existing image
            $query = "SELECT image FROM tb_animal WHERE animal_no = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $edit_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $existing_image = $result->fetch_assoc()['image'];
            $new_image_name = $existing_image;
        }

        // Update data in the database
        $query = "UPDATE tb_animal SET name=?, scientific_name=?, category=?, description=?, image=? WHERE animal_no=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $name, $scientific_name, $category, $description, $new_image_name, $edit_id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect back to the data page if successful
            header("Location: admin-animals.php");
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
    $query = "SELECT image FROM tb_animal WHERE animal_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $image_path = 'img/' . $row['image'];
    $sound_path = 'sounds/' . $row['sound'];

    // Delete record from database
    $query = "DELETE FROM tb_animal WHERE animal_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Delete image file from server
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Delete sound file from server
    if (file_exists($sound_path)) {
        unlink($sound_path);
    }
}

// Fetch data to display in the table
$query = "SELECT * FROM tb_animal ORDER BY animal_no DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/animals_styles.css">
    <title>Admin — Animals</title>
    <link rel="icon" href="../admin/admin-logo.png">
    
    <style>
        .head-container a, h2{
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

        <div class="main-container dashboard-page" id = "mainContainer-dashboard">
            <div class="header">
            </div>
            <!-- Main content header -->
            <div class="data-container">
                <h2 class="table-heading">Manage Animal Data</h2>
                <table border="1">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Scientific Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Sound</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= escape($row['name']); ?></td>
                            <td><?= escape($row['scientific_name']); ?></td>
                            <td><?= escape($row['category']); ?></td>
                            <td><?= escape($row['description']); ?></td>
                            <td><img src="img/<?= escape($row['image']); ?>" class="table-image" alt="Image"></td>
                            <td><?php echo !empty($row['sound']) ? 'Has Sound' : 'No Sound'; ?></td>
                            <td>
                                <button class="edit-btn" data-id="<?= escape($row['animal_no']); ?>">Edit</button> |
                                <a href="admin-animals.php?delete=<?= escape($row['animal_no']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>

              
                <!-- Hidden Edit Form -->
                
            </div>
              <!-- Add New Animal Form -->
            
            <div class="data-container">
                <h2 class="add-new">Add New Animal</h2>
                <form action="admin-animals.php" method="post" enctype="multipart/form-data" id="babangPangit">
                    Name: <input type="text" name="name" required><br>
                    Scientific Name: <input type="text" name="scientific_name" required><br>
                    Category:
                    <select name="category" required>
                        <option value="mammals">Mammals</option>
                        <option value="avian">Avian</option>
                        <option value="reptiles">Reptiles</option>
                        <option value="aquatic">Aquatic</option>
                    </select><br>
                    Description: <textarea name="description" required></textarea><br>
                    Image: <input type="file" name="image" required><br>
                    Sound: <input type="file" name="sound"><br>
                    <input type="submit" name="submit_add" value="Add Data">
                </form>
                
                <div id="edit-form" style="display: none;" id="babangPangit">
                    <h2>Edit Data</h2>
                    <form action="admin-animals.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" id="edit_id">
                        Name: <input type="text" name="name" id="edit_name"><br>
                        Scientific Name: <input type="text" name="scientific_name" id="edit_scientific_name"><br>
                        Category:
                        <select name="category" id="edit_category">
                            <option value="mammals">Mammals</option>
                            <option value="avian">Avian</option>
                            <option value="reptiles">Reptiles</option>
                            <option value="aquatic">Aquatic</option>
                        </select><br>
                        Description: <textarea name="description" id="edit_description"></textarea><br>
                        Current Image: <img id="edit_image" src="" class="table-image" alt="Current Image"><br>
                        New Image: <input type="file" name="new_image"><br>
                        Current Sound: <?= escape($row['sound']); ?><br> 
                        New Sound: <input type="file" name="new_sound"><br> 
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
                var scientificName = row.cells[2].innerText;
                var category = row.cells[3].innerText;
                var description = row.cells[4].innerText;
                var imageSrc = row.cells[5].querySelector('img').getAttribute('src');

                document.getElementById('edit_id').value = editId;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_scientific_name').value = scientificName;
                document.getElementById('edit_category').value = category;
                document.getElementById('edit_description').value = description;
                document.getElementById('edit_image').setAttribute('src', imageSrc);

                document.getElementById('edit-form').style.display = 'block';
            });
        });
    </script>
</body>
</html>
