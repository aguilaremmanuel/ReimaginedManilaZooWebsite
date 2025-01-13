<!DOCTYPE html>
<html lang="en">
    <?php include("assets/html-head.php"); ?>
    <head>
        <title>Manila Zoo — Zoo Map</title>
        <link rel="stylesheet" href="css/map.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <style>
            #map-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: auto;
                padding: 30px;
                background-color: #45BCC8;
            }
        </style>
    </head>

    <body>
        <?php include("assets/header.php"); ?>

        <section id="map" class="visible">
            <div id="map-2">
                <div id="map-image-container">
                    <div id="map-image">
                        <a class="marker icon attraction" style="left: 21%; top: 24.8%;" marker-id="museum">
                            <i class="ri-government-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Museum</div>
                            </div>
                        </a>

                        <a class="marker icon habitat" style="left: 12%; top: 29.5%;" marker-id="indoor-reptiles">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Indoor Reptiles</div>
                            </div>
                        </a>

                        <a class="marker icon habitat" style="left: 19%; top: 28%;" marker-id="outdoor-reptiles">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Outdoor Reptiles</div>
                            </div>
                        </a>

                        <a class="marker icon habitat" style="left: 25.5%; top: 18.5%;" marker-id="philippine-endemic">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Philippine Endemic</div>
                            </div>
                        </a>  

                        <a class="marker icon restroom" style="left: 29%; top: 23%;">
                            <i class='bx bx-male-female'></i>
                            <div class="marker_inner">
                                <div class="marker_content">Restroom</div>
                            </div>
                        </a>  
                    
                        <a class="marker icon habitat" style="left: 33%; top: 34.8%;" marker-id="savanna">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Savanna</div>
                            </div>
                        </a> 
                        
                        <a class="marker icon habitat" style="left: 26.8%; top: 34.8%;" marker-id="apex-predators">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Apex Predators</div>
                            </div>
                        </a>    

                        <a class="marker icon habitat" style="left: 21.6%; top: 54.5%;" marker-id="aviary">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Aviary</div>
                            </div>
                        </a>

                        <a class="marker icon habitat" style="left: 28.3%; top: 60%;" marker-id="elephant-hippo">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Elephant & Hippopotamus</div>
                            </div>
                        </a>

                        <a class="marker icon shop" style="left: 24.4%; top: 59.2%;">
                            <i class="ri-shopping-bag-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Shop</div>
                            </div>
                        </a>

                        <a class="marker icon shop" style="left: 20.3%; top: 63%;">
                            <i class="ri-shopping-bag-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Shop</div>
                            </div>
                        </a>

                        <a class="marker icon attraction" style="left: 8.8%; top: 68.8%;" marker-id="butterfly">
                            <i class="ri-bluesky-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Butterfly Garden</div>
                            </div>
                        </a>

                        <a class="marker icon restroom" style="left: 30%; top: 41%;">
                            <i class='bx bx-male-female'></i>
                            <div class="marker_inner">
                                <div class="marker_content">Restroom</div>
                            </div>
                        </a>

                        <a class="marker icon habitat" style="left: 30.5%; top: 47.5%;" marker-id="hyena">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Hyena</div>
                            </div>
                        </a>

                        <a class="marker icon restroom" style="left: 11%; top: 35%;">
                            <i class='bx bx-male-female'></i>
                            <div class="marker_inner">
                                <div class="marker_content">Restroom</div>
                            </div>
                        </a>

                        <a class="marker icon habitat" style="left: 12.6%; top: 44.5%;" marker-id="primates">
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Primates</div>
                            </div>
                        </a>

                        <a class="marker icon attraction" style="left: 19.8%; top: 38%;" marker-id="island">
                            <i class='bx bxs-directions'></i>
                            <div class="marker_inner">
                                <div class="marker_content">Center Island</div>
                            </div>
                        </a>

                        <a class="marker icon attraction" style="left: 16.8%; top: 43%;" marker-id="lagoon">
                            <i class='bx bx-water' ></i>
                            <div class="marker_inner">
                                <div class="marker_content">Lagoon</div>
                            </div>
                        </a>
                                                
                        <a class="marker icon attraction" style="left: 11.7%; top: 49%;" marker-id="park">
                            <i class="ri-open-arm-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Children's Park</div>
                            </div>
                        </a>

                        
                        <a class="marker icon shop" style="left: 20.6%; top: 69%;">
                            <i class="ri-restaurant-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Food Court</div>
                            </div>
                        </a>

                        <a class="marker icon restroom" style="left: 17.3%; top: 52.5%;">
                            <i class='bx bx-male-female'></i>
                            <div class="marker_inner">
                                <div class="marker_content">Restroom</div>
                            </div>
                        </a>

                        <a class="marker icon shop" style="left: 17%; top: 57%;">
                            <i class="ri-restaurant-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Food Court</div>
                            </div>
                        </a>
                        
                        <a class="marker icon attraction" style="left: 15.5%; top: 60.5%;" marker-id="fountain">
                            <i class="ri-windy-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Interactive Fountain</div>
                            </div>
                        </a>

                        <a class="marker icon restroom" style="left: 18.3%; top: 69.8%;">
                            <i class='bx bx-male-female'></i>
                            <div class="marker_inner">
                                <div class="marker_content">Restroom</div>
                            </div>
                        </a>

                        <a class="marker icon attraction" style="left: 14.5%; top: 69%;" marker-id="botanical">
                            <i class="ri-seedling-fill"></i>
                            <div class="marker_inner">
                                <div class="marker_content">Botanical Garden</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div id="map-toggles">
                <div id="map-content">
                    <a href="#index.html" id="map-logo"><img src="images/logo.png" alt="Logo"></a>
                    <h1 id="map-title">ZOO MAP</h1>
                </div>
                <button id="all-toggle" class="toggle-button"><i class='bx bxs-check-circle'></i>&nbsp; SHOW ALL PINS</button>
                <button id="habitat-toggle" class="toggle-button"><i class="ri-home-heart-fill"></i>&nbsp; ANIMAL HABITATS</button>
                <button id="attraction-toggle" class="toggle-button"><i class="ri-star-fill"></i>&nbsp; ZOO ATTRACTIONS</button>
                <button id="restroom-toggle" class="toggle-button"><i class='bx bx-male-female'></i>&nbsp; RESTROOMS / TOILET</button>
                <button id="shop-toggle" class="toggle-button"><i class="ri-store-fill"></i>&nbsp; SHOPS & FOOD COURTS</button>
            </div>

            <div id="zoom-controls">
                <button id="zoom-in"><i class="ri-add-fill"></i></button>
                <button id="zoom-out"><i class="ri-subtract-fill"></i></button>
            </div>

            <div class="marker_info habitat" data-marker-id="elephant-hippo">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/elephant-hippo.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <h1 class="title">Elephant & Hippopotamus</h1>
                        <p class="subtitle">ANIMAL HABITATS</p>
                        <p class="description">Witness the majestic giants of the savanna, where elephants and hippos roam.</p>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info habitat" data-marker-id="aviary">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/aviary.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Aviary</div>
                        <div class="subtitle">ANIMAL HABITATS</div>
                        <div class="description">Immerse yourself in the colorful world of birds in our expansive aviary.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info habitat" data-marker-id="hyena">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/hyena.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Hyena</div>
                        <div class="subtitle">ANIMAL HABITATS</div>
                        <div class="description">Encounter the cunning laughter of hyenas in their naturalistic savanna setting.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info habitat" data-marker-id="savanna">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/savanna.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Savanna</div>
                        <div class="subtitle">ANIMAL HABITATS</div>
                        <div class="description">Explore the vast savanna, teeming with wildlife such as ostriches and zebras.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info habitat" data-marker-id="apex-predators">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/apex-predators.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Apex Predators</div>
                        <div class="subtitle">ANIMAL HABITATS</div>
                        <div class="description">Come face-to-face with the rulers of the food chain in our apex predator exhibit.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info habitat" data-marker-id="philippine-endemic">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/philippine-endemic.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Philippine Endemic</div>
                        <div class="subtitle">ANIMAL HABITATS</div>
                        <div class="description">Discover the unique biodiversity of the Philippines with our exhibit showcasing endemic species.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info habitat" data-marker-id="outdoor-reptiles">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/outdoor-reptiles.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Outdoor Reptiles</div>
                        <div class="subtitle">ANIMAL HABITATS</div>
                        <div class="description">Experience the fascinating world of reptiles under the open sky, including crocodiles and turtles.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info habitat" data-marker-id="indoor-reptiles">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/indoor-reptiles.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Indoor Reptiles</div>
                        <div class="subtitle">ANIMAL HABITATS</div>
                        <div class="description">Delve into the secretive world of indoor reptiles, from slithering snakes to basking iguanas.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info habitat" data-marker-id="primates">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/primates.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Primates</div>
                        <div class="subtitle">ANIMAL HABITATS</div>
                        <div class="description">Observe the playful antics and social dynamics of our primate inhabitants in their habitat.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info attraction" data-marker-id="botanical">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/botanical.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Botanical Garden</div>
                        <div class="subtitle">ZOO ATTRACTIONS</div>
                        <div class="description">Stroll through our botanical garden and marvel at the beauty and diversity of plant life.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info attraction" data-marker-id="butterfly">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/butterfly.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Butterfly Garden</div>
                        <div class="subtitle">ZOO ATTRACTIONS</div>
                        <div class="description">Step into a magical world of fluttering wings and vibrant colors in our butterfly garden.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info attraction" data-marker-id="fountain">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/fountain.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Interactive Fountain</div>`
                        <div class="subtitle">ZOO ATTRACTIONS</div>
                        <div class="description">Enjoy a captivating spectacle that doubles as a scenic view, offering entertainment for all who watch.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info attraction" data-marker-id="park">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/park.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Children's Park</div>
                        <div class="subtitle">ZOO ATTRACTIONS</div>
                        <div class="description">Let the little ones run wild in our children's park, filled with activities for endless fun.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info attraction" data-marker-id="lagoon">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/lagoon.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Lagoon</div>
                        <div class="subtitle">ZOO ATTRACTIONS</div>
                        <div class="description">Wander and immerse yourself in the picturesque beauty of the zoo's serene waterscape.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info attraction" data-marker-id="island">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/island.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Center Island</div>
                        <div class="subtitle">ZOO ATTRACTIONS</div>
                        <div class="description">Capture memorable moments with stunning photo opportunities at the center island.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

            <div class="marker_info attraction" data-marker-id="museum">
                <div class="marker_info_inner">
                    <div class="image">
                        <img src="images/map-images/museum.png" alt="Habitat Image">
                    </div>
                    <div class="text">
                        <div class="title">Museum</div>
                        <div class="subtitle">ZOO ATTRACTIONS</div>
                        <div class="description">Uncover the mysteries of the natural world with interactive exhibits and displays in our museum.</div>
                    </div>
                    <div class="close_button"><i class="ri-close-fill"></i></div>
                </div>
            </div>

        </section>

        <script src="js/map-toggles.js"></script>
        <script src="js/map-drag.js"></script>
        <script src="js/map-zoom.js"></script>
        <script src="js/map-info.js"></script>
    </body>
</html>