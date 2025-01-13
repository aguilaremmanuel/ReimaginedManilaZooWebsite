<!DOCTYPE html>
<html lang="en">
<?php include("assets/html-head.php"); ?>
<head>
    <title>Manila Zoo — Plants</title>
    <!-- <link rel="stylesheet" href="plants_styles.css"> -->
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
            
            .plant-name {
                color: #45BCC8;
            }
        </style>
</head>
<body>
    <?php include("assets/header.php"); ?>

    <section id="plants" class="visible">
        <div id="plants1">
            <h1 class="titles">PLANTS</h1>
        </div>
        <div id="plants2" class="card-container"> 
            <?php
            require 'connection.php';

            $query = "SELECT * FROM tb_plants ORDER BY plant_no DESC";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="card" onclick="flipCard(this)">
                    <div class="card-inner">
                        <div class="card-front">
                            <img src="../admin/img/<?= htmlspecialchars($row['image']); ?>" alt="Image">
                            <h3><?= htmlspecialchars($row['name']); ?></h3>
                        </div>
                        <div class="card-back">
                            <h3 class="plant-name"><?= htmlspecialchars($row['name']); ?></h3>
                            <p><?= htmlspecialchars($row['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <?php include("assets/footer.php"); ?>

    <script>
        function flipCard(card) {
            card.classList.toggle('flip');
        }
    </script>
</body>
</html>
