<!DOCTYPE html>
<html lang="en">
    <title>Manila Zoo — Events</title>
    <?php include("assets/html-head.php"); ?>
    <style>
            body {
                font-family: "Inter", Arial, sans-serif;
                margin: 0;
                background-color: #f4f4f4;
            }

            .card-container {
                display: flex;
                flex-wrap: wrap;
                gap: 50px;
                justify-content: center;
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
            
            .event-content{
                color: #45BCC8;
            }
            
            .card-back a:hover{
                color: #F7A832;
            }
            
            .section-details{
                text-align: center;
                background-color: white;
                padding-bottom: 50px;
            }
            
            .event-section img{
                border: 2px solid #E5F6F8;
            }
            
            .event-section p{
                padding: 0 250px 0 250px;
            }
            
            .namo-hostinger{
                height: 130px;
            }
            
            .divider{
                margin-top: 130px;
            }

        </style>

    <body>
        <?php include("assets/header.php"); ?>

        <section id="events" class="visible">
            <div id="events1">
                <h1 class="titles">EVENTS</h1>
            </div>
            <div id="events2" class="card-container"> 
                <?php
                require 'connection.php';
                $query = "SELECT * FROM event_details ORDER BY event_id ASC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="card" onclick="flipCard(this)">
                        <div class="card-inner">
                            <div class="card-front">
                                <img src="admin/img/<?= htmlspecialchars($row['image']); ?>" alt="Image">
                                <h3><?= htmlspecialchars($row['name_of_event']); ?></h3>
                            </div>
                            <div class="card-back">
                            <!--<p><h3 class="event-content"><b>Description:</b></h3><?= htmlspecialchars($row['description']); ?></p>-->
                            <p><h3 class="event-content"><b>Organization:</b></h3><?= htmlspecialchars($row['organization_or_entities']); ?></p>
                            <p><h3 class="event-content"><b>Date:</b></h3><?= htmlspecialchars($row['date']); ?></p>
                            <a href="#event<?= htmlspecialchars($row['event_id']); ?>" class="event-content">Learn More</a>
                           </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

    <div id="divider">
        <div id="line-bar"></div>
    </div>
        
    <div class="section-details">
        <!-- Continuous display of sections for each event -->
        <?php
        mysqli_data_seek($result, 0); // Reset the result pointer
        while ($row = mysqli_fetch_assoc($result)): ?>
            <section class="event-section" id="event<?= htmlspecialchars($row['event_id']); ?>">
                <div class="namo-hostinger"></div>
                <!-- Content for this event -->
                <h2><?= htmlspecialchars($row['name_of_event']); ?></h2>
                <img src="admin/img/<?= htmlspecialchars($row['image']); ?>" alt="Image" width="800">
                <p><?= htmlspecialchars($row['description']); ?></p>
                <p><h3 class="event-content"><b>Organization:</b></h3><?= htmlspecialchars($row['organization_or_entities']); ?></p>
                <p><h3 class="event-content"><b>Date:</b></h3><?= htmlspecialchars($row['date']); ?></p>
                <!-- Add more content as needed -->
            </section>
        <?php endwhile; ?>
    </div>

        <?php include("assets/footer.php"); ?>

        <script>
            function flipCard(card) {
                card.classList.toggle('flip');
            }
        </script>
    </body>
</html>
