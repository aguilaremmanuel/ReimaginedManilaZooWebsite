<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manila Zoo</title>
        <link rel="icon" href="images/logo-favicon.png">
        <link rel="stylesheet" href="css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="nav container">
                <div class="nav-data">
                    <a href="#index.html" class="logo"><img src="images/logo.png" alt="Logo"></a>
                    <div class="nav-toggle" id="nav-toggle">
                        <i class="ri-menu-line nav-burger"></i>
                        <i class="ri-close-line nav-close"></i>
                    </div>
                </div>
                
                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li><a href="index.php" class="nav-link">HOME</a></li>
        
                        <li class="dropdown-item">
                            <div class="nav-link">
                                EXPLORE <i class="ri-arrow-down-s-fill dropdown-arrow"></i>
                            </div>
        
                            <ul class="dropdown-menu">
                                <li><a href="animals.php" class="dropdown-link">ANIMALS</a></li>
                                <li><a href="plants.php" class="dropdown-link">PLANTS</a></li>
                                <li><a href="map.php" class="dropdown-link">ZOO MAP</a></li>
                            </ul>
                        </li>
        
                        <li class="dropdown-item">
                            <div class="nav-link">
                                INFO <i class="ri-arrow-down-s-fill dropdown-arrow"></i>
                            </div>
        
                            <ul class="dropdown-menu">
                                <li><a href="about.php" class="dropdown-link">ABOUT THE ZOO</a></li>
                                <li><a href="rates.php" class="dropdown-link">TICKET RATES</a></li>
                                <li><a href="hours.php" class="dropdown-link">OPERATING HOURS</a></li>
                                <li><a href="guidelines.php" class="dropdown-link">GUIDELINES</a></li>
                            </ul>
                        </li>
        
                        <li><a href="events.php" class="nav-link">EVENTS</a></li>
        
                        <li class="dropdown-item">
                            <div class="nav-link">
                                HELP <i class="ri-arrow-down-s-fill dropdown-arrow"></i>
                            </div>
        
                            <ul class="dropdown-menu">
                                <li><a href="contact.php" class="dropdown-link">CONTACT US</a></li>
                                <li><a href="faqs.php" class="dropdown-link">FAQs</a></li>
                            </ul>
                        </li>
        
                        <li><a href="ticket.php" id="tickets" class="nav-link"><button>TICKETS &nbsp;<i class="ri-coupon-2-fill"></i></button></a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <section id="home" class="visible">
            <div id="home1"> 
                <video autoplay muted loop playsinline id="home1-video" src="images/home.mp4" type="video/mp4">
                    <source src="images/home.mp4" type="video/mp4">
                </video>
                <div id="home-welcome">
                    <h1 id="home-tagline">Rediscover the <span class="color">NEW</span> Manila Zoo</h1>
                    <p>Experience the wonders anew at the revitalized Manila Zoo.</p>
                </div>
            </div>
            <div id="home2"> 
                <div class="box-container">
                    <a href="map.php" class="box-button" id="box-button1">
                        <div class="text-column">
                            <div class="top">
                                <div class="icon">
                                    <i class="ri-map-2-fill"></i>
                                </div>
                                <div class="title">
                                    <h3>NAVIGATE ZOO MAP</h3>
                                </div>
                            </div>
                            <div class="bottom">
                                <p>Take a virtual look of the zoo and its newest attractions.</p>
                            </div>
                        </div>
                        <div class="icon-next">
                            <i class="ri-arrow-right-circle-fill"></i>
                        </div>
                    </a>
                    
                    <a href="guidelines.php" class="box-button" id="box-button2">
                        <div class="text-column">
                            <div class="top">
                                <div class="icon">
                                    <i class="ri-clipboard-fill"></i>
                                </div>
                                <div class="title">
                                    <h3>KNOW AS YOU GO</h3>
                                </div>
                            </div>
                            <div class="bottom">
                                <p>Check out the zoo guidelines to prepare for your visit.</p>
                            </div>
                        </div>
                        <div class="icon-next">
                            <i class="ri-arrow-right-circle-fill"></i>
                        </div>
                    </a>
                    
                    <a href="events.php" class="box-button" id="box-button3">
                        <div class="text-column">
                            <div class="top">
                                <div class="icon">
                                    <i class="ri-calendar-fill"></i>
                                </div>
                                <div class="title">
                                    <h3>DISCOVER EVENTS</h3>
                                </div>
                            </div>
                            <div class="bottom">
                                <p>Stay informed about the events happening at the zoo.</p>
                            </div>
                        </div>
                        <div class="icon-next">
                            <i class="ri-arrow-right-circle-fill"></i>
                        </div>
                    </a>
                </div>

                <div id="home3">
                    <div id="home-animals"> 
                        <img src="images/home-animals.png" alt="Home-Animals">
                    </div>
                    <div id="content-animals">
                        <h2>Meet Our Animals</h2>
                        <p>Embark on a journey of discovery as you explore and learn about the diverse animal inhabitants of Manila Zoo.</p>
                        <a class="home-button" href="animals.php"><button>LEARN MORE</button></a>
                    </div>
                </div>

                <div id="divider">
                    <div id="line-bar"></div>
                </div>

                <div id="home4">
                    <div id="content-plants">
                        <h2>Explore The Naturehood</h2>
                        <p>Step into the lush world of our botanical haven — a journey through the vibrant tapestry of plants in Manila Zoo.</p>
                        <a class="home-button" href="plants.php"><button>LEARN MORE</button></a>
                    </div>

                    <div id="home-plants"> 
                        <img src="images/home-plants.png" alt="Home-Plants">
                    </div>
                </div>
            </div>


        </section>

        <footer>
            <div class="footer1">
                <div class="box-container">
                    <div class="box">
                        <div class="logo2"><img src="images/logo.png" alt="Logo"></div>
                        <p style = "text-align: justify;">The Manila Zoological & Botanical Garden is a thriving sanctuary of diverse plant
                        and animal species, nestled in the heart of the Philippines' capital city.
                        A place to immerse oneself in the wonders of life and nature.</p>
                        <br>
                        <p style = "font-size: 12px; text-align: justify;"><i>Please note: This website is created solely for project purposes. We want to assure you that we have no intention to infringe upon any copyrights, and we are not affiliated with the official Manila Zoo website.</i></p>
                    </div>
                    <div class="box">
                        <h3>Quick Links</h3>
                        <li><a href="index.php" class="links"> <i class=""></i>Home</a></li>
                        <li><a href="ticket.php" class="links"> <i class=""></i>Tickets</a></li>
                        <li><a href="animals.php" class="links"> <i class=""></i>Animals</a></li>
                        <li><a href="plants.php" class="links"> <i class=""></i>Plants</a></li>
                        <li><a href="events.php" class="links"> <i class=""></i>Events</a></li>
                        <li><a href="about.php" class="links"> <i class=""></i>About The Zoo</a></li>
                    </div>
                    <div class="box">
                        <h3>Resources</h3>
                        <li><a href="map.php" class="links"> <i class=""></i>Zoo Map</a></li>
                        <li><a href="rates.php" class="links"> <i class=""></i>Ticket Rates</a></li>
                        <li><a href="hours.php" class="links"> <i class=""></i>Operating Hours</a></li>
                        <li><a href="guidelines.php" class="links"> <i class=""></i>Guidelines</a></li>
                        <li><a href="faqs.php" class="links"> <i class=""></i>FAQs</a></li>
                    </div>
                    <div class="box">
                        <h3>Contact Info</h3>
                        <li><a href="https://maps.app.goo.gl/Mxx2nKZmwEVQbb3NA" target="_blank" class="links">M. Adriatico St, Malate, 1004<br> Manila, Philippines</a></li>
                        <li><a href="mailto:manilazoo@manila.gov.ph" class="links">manilazoo@manila.gov.ph</a></li>
                        <li><a href="https://facebook.com/ManilaZooPH.OfficialPage" target="_blank" class="links">Manila Zoo Official</a></li>
                        <div class="icons">
                            <a href="https://manila.gov.ph" target="_blank">
                                <img src="images/manila-logo.png" alt="City of Manila">
                            </a>
                            <a href="admin/admin-login.php">
                                <img href="admin/admin-login.php" src="images/admin-logo.png" alt="Admin Control Panel">
                            </a>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="footer2">
                <div class="credits">
                    <p>&copy; 2024 Manila Zoo</p>
                    <p>Website by BSIT 3-2 Group 3</p>
                </div>
                <div class="links">
                    <a href="privacy.php">Privacy Policy</a>
                    <a href="terms.php">Terms of Use</a>
                </div>
            </div>
        </footer>
        
        <script src="script.js"></script>
    </body>
</html>