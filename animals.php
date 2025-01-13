<!DOCTYPE html>
<html lang="en">
    <?php include("assets/html-head.php"); ?>
    <head>
        <title>Manila Zoo — Animals</title>
        <!-- <link rel="stylesheet" href="styles.css"> -->
        <style>
            /* Additional CSS styles for card layout */
            body {
                font-family: "Inter", Arial, sans-serif;
                margin: 0;
                background-color: #f4f4f4;
            }

            .card-container {
                display: flex;
                flex-wrap: wrap;
                gap: 50px;
            }

            .card {
                width: 300px;
                height: 200px;
                perspective: 1000px;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 5px 5px gray;
            }

            .card-inner {
                width: 100%;
                height: 100%;
                transition: transform 0.8s;
                transform-style: preserve-3d;
            }

            .card.flip .card-inner {
                transform: rotateY(180deg);
            }

            .card-front, .card-back {
                width: 100%;
                height: 100%;
                position: absolute;
                backface-visibility: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                box-sizing: border-box;
                background-color: #fff;
                text-align: center;
            }

            .card-back {
                transform: rotateY(180deg);
                background-color: #f2f2f2;
            }

            img {
                max-width: 100%;
                max-height: 100%;
                border-radius: 8px;
            }

            p {
                margin: 5px 0;
            }

            h2{
                color: #229ca7;
                text-transform: uppercase;
                text-align: center;
                font-size: 50px;
                font-style: italic;
                padding-bottom: 20px;
            }

            .card-front{
                flex-direction: column;
                justify-content: center;
                text-transform: uppercase;
            }

            .card-back{
                flex-direction: column;
                justify-content: center;
            }

            .card-container{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                padding-bottom: 50px;
            }
            
            .animal-content{
                color: #45BCC8;
            }
        </style>
    </head>

    <body>
        <?php include("assets/header.php"); ?>

        <section id="animals" class="visible">
            <div id="animals1">
                <h1 class="titles">ANIMALS</h1>
            </div>
            <div id="animals2"> 
                <?php
                require 'connection.php';

                // Fetch distinct categories
                $query_categories = "SELECT DISTINCT category FROM tb_animal";
                $result_categories = mysqli_query($conn, $query_categories);

                // Loop through each category
                while ($row_category = mysqli_fetch_assoc($result_categories)) {
                    $category = $row_category['category'];

                    // Display category heading
                    echo "<h2>$category</h2>";
                    echo "<div class='card-container'>";

                    // Fetch records for the current category
                    $query_records = "SELECT * FROM tb_animal WHERE category='$category'";
                    $result_records = mysqli_query($conn, $query_records);

                    // Loop through each record in the current category
                    while ($row_record = mysqli_fetch_assoc($result_records)) {
                        ?>
                        <!-- Display record as a card -->
                        <div class="card" onclick="flipCard(this)">
                            <div class="card-inner">
                                <!-- Front face of the card -->
                                <div class="card-front">
                                    <img src="admin/img/<?php echo htmlspecialchars($row_record['image']); ?>" alt="Image" width:30px;>
                                    <p><b><?php echo htmlspecialchars($row_record['name']); ?></b></p>
                                </div>
                                <!-- Back face of the card -->
                                <div class="card-back">
                                    <p><h3 class="animal-content"><b>Name:</b></h3><?php echo htmlspecialchars($row_record['name']); ?></p>
                                    <p><h3 class="animal-content"><b>Scientific Name:</b></h3><?php echo htmlspecialchars($row_record['scientific_name']); ?></p>
                                    <p><h3 class="animal-content"><b>Description:</b></h3><?php echo htmlspecialchars($row_record['description']); ?></p>
                                    <?php if (!empty($row_record['sound'])): ?>
                                        <audio id="audio_<?php echo $row_record['animal_no']; ?>" src="admin/sounds/<?php echo htmlspecialchars($row_record['sound']); ?>"></audio>
                                    <?php endif; ?>
                                </div>
                        </div>
                </div>

                        <?php
                    }
                    echo "</div>"; // Close card-container div
                }
                ?>
            </div>
        </section>

        <?php include("assets/footer.php"); ?>

        <script>
            let flippedCard = null;

function flipCard(card) {
    if (flippedCard !== null && flippedCard !== card) {
        // If another card is flipped, flip it back
        flippedCard.classList.remove('flip');
        stopSound(flippedCard);
    }
    
    card.classList.toggle('flip');
    playOrStopSound(card);
    flippedCard = card;
}

function playOrStopSound(card) {
    var audio = card.querySelector('.card-back audio');
    if (audio) {
        if (card.classList.contains('flip')) {
            // If card is flipped, play the audio
            audio.play();
        } else {
            // If card is flipped back, pause the audio
            audio.pause();
            audio.currentTime = 0; // Reset audio to beginning
        }
    }
}

function stopSound(card) {
    var audio = card.querySelector('.card-back audio');
    if (audio) {
        audio.pause();
        audio.currentTime = 0; // Reset audio to beginning
    }
}
        </script>
    </body>
</html>
