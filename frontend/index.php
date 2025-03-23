<?php
session_start();
@include 'config.php';
@include 'GetFunctions.php';

// Check if user is logged in
$isLoggedIn = !empty($_SESSION["id"]);
if ($isLoggedIn) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM userlog WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
}

// Fetch common data (for both logged-in and guest users)
$class = getClass($conn);
$trainer = getTrainers($conn);
$plan = getPlans($conn);
$story = getStory($conn);

// Handle form submissions
$success = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $plan = $_POST['plan'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `customerplan`(`id`, `name`, `plan`, `email`, `description`) 
            VALUES (NULL, '$name', '$plan', '$email', '$description')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = "New plan added successfully!";
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $class = $_POST['class'];

    $sql = "INSERT INTO `customerclass`(`name`, `email`, `class`) 
            VALUES ('$name', '$email', '$class')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = "New class added successfully!";
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css" />
    <title>Web Design Mastery | Power</title>
</head>
<body>
    <header class="header">
        <nav>
            <div class="nav__header">
                <div class="nav__logo">
                    <img src="assets/logo.png" alt="logo" />
                </div>
                <div class="nav__menu__btn" id="menu-btn">
                    <span><i class="ri-menu-line"></i></span>
                </div>
            </div>
            <ul class="nav__links" id="nav-links">
                <li class="link"><a href="#home">Home</a></li>
                <li class="link"><a href="#about">About</a></li>
                <li class="link"><a href="#class">Classes</a></li>
                <li class="link"><a href="#trainer">Trainers</a></li>
                <li class="link"><a href="#price">Pricing</a></li>
                <?php if ($isLoggedIn) : ?>
                    <li class="link profile-link">
                        <a href="profil.php"><i class="bx bx-user"></i> Profile</a>
                    </li>
                <?php else : ?>
                    <li class="link"><a href="loginForm.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="section__container header__container" id="home">
            <div class="header__image">
                <img src="assets/hero-banner.png" alt="header" />
            </div>
            <div class="header__content">
                <h4>Build Your Body &</h4>
                <h1 class="section__header">Shape Yourself!</h1>
                <p>
                    Unleash your potential and embark on a journey towards a stronger,
                    fitter, and more confident you. Sign up for 'Make Your Body Shape'
                    now and witness the incredible transformation your body is capable
                    of!
                </p>
                <div class="header__btn">
                    <?php if ($isLoggedIn) : ?>
                        <span>Welcome <?php echo $row["name"]; ?></span>
                    <?php else : ?>
                        <a href="loginForm.php">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section class="section__container about__container" id="about">
        <div class="about__image">
            <img class="about__bg" src="assets/dot-bg.png" alt="bg" />
        </div>
        <div class="about__content">
            <h2 class="section__header">Our Story</h2>
            <p class="section__description">
                Led by our team of expert and motivational instructors, "The Class You Will Get Here" is a high-energy, results-driven session that combines a perfect blend of cardio, strength training, and functional exercises.
            </p>
            <div class="about__grid">
                <div class="about__card">
                    <span><i class='bx bx-dumbbell'></i></span>
                    <div>
                        <h4>State-of-the-Art Equipment</h4>
                        <p>
                            We provide the latest, high-quality equipment to help you achieve your fitness goals with precision and comfort.
                        </p>
                    </div>
                </div>
                <div class="about__card">
                    <span><i class='bx bxs-chart'></i></span>
                    <div>
                        <h4>Flexible Membership Options</h4>
                        <p>
                            We offer a variety of membership plans designed to fit different needs and lifestyles, ensuring that you can choose the best fit for your fitness goals.
                        </p>
                    </div>
                </div>
                <div class="about__card">
                    <span><i class="ri-p2p-line"></i></span>
                    <div>
                        <h4>Expert Guidance</h4>
                        <p>
                            Our team of certified trainers and fitness experts is here to guide you every step of the way, ensuring you progress safely and effectively.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Classes Section -->
    <section class="section__container class__container" id="class">
        <h2 class="section__header">Our Classes</h2>
        <p class="section__description">
            Discover a diverse range of exhilarating classes at our gym designed to
            cater to all fitness levels and interests.
        </p>
        <div class="class__grid">
            <?php foreach($class as $classes): ?>
                <div class="class__card">
                    <img src="<?php echo '/FitZone/upload_img/' . htmlspecialchars($classes['class_image']); ?>" alt="Class Image" />
                    <div class="class__content">
                        <h4><?php echo htmlspecialchars($classes['class_name']); ?></h4>
                        <p><?php echo htmlspecialchars($classes['class_date']); ?></p>
                        <p><?php echo htmlspecialchars($classes['class_time']); ?></p>
                        <p><?php echo htmlspecialchars($classes['trainer']); ?></p>
                        <h3><?php echo htmlspecialchars($classes['description']); ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if ($isLoggedIn) : ?>
                <button class="btn" id="joinNowBtn">Join Now</button>
            <?php else : ?>
                <button class="btn" onclick="window.location.href='loginForm.php';">Join Now</button>
            <?php endif; ?>
        </div>

        <!-- Class Join Form -->
        <div class="cls_popup-form" id="cls_popupForm">
            <div class="cls_popup-form-content">
                <span class="cls_close-btn" id="cls_closeBtn">&times;</span>
                <h2>Add Your Class</h2>
                <p>Please fill out the following information:</p>
                <form action="" method="POST">
                    <label for="cls_name">Name:</label>
                    <input type="text" id="cls_name" name="name" required />

                    <label for="cls_email">Email:</label>
                    <input type="email" id="cls_email" name="email" required />

                    <label for="cls_membership_plan">Plan:</label>
                    <select id="cls_membership_plan" name="class">
                        <option value="Cardio Blast">Cardio Blast</option>
                        <option value="Power Lift">Power Lift</option>
                        <option value="Zen Flow">Zen Flow</option>
                        <option value="HIIT Burn">HIIT Burn</option>
                    </select><br/>

                    <button type="submit" name="send" class="cls_submit-btn">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Trainers Section -->
    <section class="section__container trainer__container" id="trainer">
        <h2 class="section__header">Our Trainers</h2>
        <p class="section__description">
            Our trainers are more than just experts in exercise; they are passionate
            about helping you achieve your health and fitness goals.
        </p>
        <div class="trainer__grid">
            <?php foreach($trainer as $trainers): ?>
                <div class="trainer__card">
                    <img src="<?php echo '/FitZone/upload_img/' . htmlspecialchars($trainers['trainer_image']); ?>" alt="Trainer Image" />
                    <div class="trainer__content">
                        <h4><?php echo htmlspecialchars($trainers['trainer_name']); ?></h4>
                        <h5><?php echo htmlspecialchars($trainers['trainer_expe']); ?></h5>
                        <h5><?php echo htmlspecialchars($trainers['trainer_Cinfo']); ?></h5>
                        <hr />
                        <p>
                            <?php echo htmlspecialchars($trainers['description']); ?>
                        </p>
                        <div class="trainer__socials">
                            <a href="#"><i class="ri-facebook-fill"></i></a>
                            <a href="#"><i class="ri-google-fill"></i></a>
                            <a href="#"><i class="ri-instagram-line"></i></a>
                            <a href="#"><i class="ri-twitter-fill"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="section__container price__container" id="price">
        <h2 class="section__header">Our Pricing</h2>
        <p class="section__description">
            Our pricing plan comes with various membership tiers, each tailored to
            cater to different preferences and fitness aspirations.
        </p>
        <div class="price__grid">
            <?php foreach($plan as $plans): ?>
                <div class="price__card">
                    <div class="price__content">
                        <h4><?php echo htmlspecialchars($plans['membership_plan']); ?></h4>
                        <img src="assets/price-1.png" alt="price" />
                        <p>
                            <?php echo htmlspecialchars($plans['description']); ?>
                        </p>
                        <hr />
                        <h4><?php echo htmlspecialchars($plans['trainer']); ?></h4>
                        <h4><?php echo htmlspecialchars($plans['price']); ?></h4>
                        <p><?php echo htmlspecialchars($plans['plan_type']); ?></p>
                    </div>
                    <?php if ($isLoggedIn) : ?>
                        <button class="btn" onclick="showForm()">Join Now</button>
                    <?php else : ?>
                        <button class="btn" onclick="window.location.href='loginForm.php';">Join Now</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Plan Join Form -->
        <div class="popup-form" id="popupForm">
            <div class="popup-form-content">
                <span class="close-btn" onclick="closeForm()">&times;</span>
                <h2>Add Your Plan</h2>
                <p>Please fill out the following information:</p>
                <?php if ($success) : ?>
                    <div class="success-message">
                        <i class='bx bxs-check-circle'></i>
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required />

                    <label for="membership_plan">Plan:</label>
                    <select id="membership_plan" name="plan">
                        <option value="Basic">Basic</option>
                        <option value="Bronze">Bronze</option>
                        <option value="Silver">Silver</option>
                        <option value="Gold">Gold</option>
                        <option value="Premium">Premium</option>
                    </select>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required />

                    <label for="description">Description:</label>
                    <textarea name="description" id="description" cols="50" rows="3"></textarea>

                    <div class="popup-buttons">
                        <button type="submit" name="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="nav__logo">
                    <img src="assets/logo.png" alt="logo" />
                </div>
                <p>
                    Take the first step towards a healthier, stronger you with our
                    unbeatable pricing plans. Let's sweat, achieve, and conquer
                    together!
                </p>
                <div class="footer__socials">
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    <a href="#"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-twitter-fill"></i></a>
                </div>
            </div>
            <div class="footer__col">
                <h4>Company</h4>
                <div class="footer__links">
                    <a href="#">Business</a>
                    <a href="#">Franchise</a>
                    <a href="#">Partnership</a>
                    <a href="#">Network</a>
                </div>
            </div>
            <div class="footer__col">
                <h4>About Us</h4>
                <div class="footer__links">
                    <a href="#">Blogs</a>
                    <a href="#">Security</a>
                    <a href="#">Careers</a>
                </div>
            </div>
            <div class="footer__col">
                <h4>Contact</h4>
                <div class="footer__links">
                    <a href="#">Contact Us</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">BMI Calculator</a>
                </div>
            </div>
        </div>
        <div class="footer__bar">
            Copyright © 2023 Web Design Mastery. All rights reserved.
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="maini.js"></script>
    <script>
        // Show class form
        document.getElementById('joinNowBtn').addEventListener('click', () => {
            document.getElementById('cls_popupForm').style.display = 'block';
        });

        // Close class form
        document.getElementById('cls_closeBtn').addEventListener('click', () => {
            document.getElementById('cls_popupForm').style.display = 'none';
        });

        // Show plan form
        function showForm() {
            document.getElementById('popupForm').style.display = 'block';
        }

        // Close plan form
        function closeForm() {
            document.getElementById('popupForm').style.display = 'none';
        }
    </script>
</body>
</html>