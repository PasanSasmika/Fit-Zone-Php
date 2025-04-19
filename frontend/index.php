<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliteFit Gym - Premium Fitness Experience</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styleiii.css" />
</head>
<body>
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
        $selectedPlan = $_POST['plan']; // Changed variable name
        $email = $_POST['email'];
        $description = $_POST['description'];
    
        $sql = "INSERT INTO `customerplan`(`id`, `name`, `plan`, `email`, `description`) 
                VALUES (NULL, '$name', '$selectedPlan', '$email', '$description')"; // Use new variable
    
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            $success = "New plan added successfully!";
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    
    // Fetch plans (this remains unchanged)
    $plan = getPlans($conn);

    if (isset($_POST['send'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $selected_class = $_POST['class']; // Changed variable name
    
        $sql = "INSERT INTO `customerclass`(`name`, `email`, `class`) 
                VALUES ('$name', '$email', '$selected_class')";
    
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            $success = "New class added successfully!";
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }

    
    if (isset($_POST['add'])) {
        $name = $_POST['trainer_name'];
        $email = $_POST['customer_email'];
        $c_name = $_POST['customer_name'];

        $sql = "INSERT INTO `customertrainer`(`trainer_name`, `customer_email`, `customer_name`) 
                VALUES ('$name', '$email', '$c_name')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $success = "New Trainer added successfully!";
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    ?>
    
    <!-- Navigation -->
    <header id="header">
        <div class="container">
            <nav>
                <a href="#" class="logo">Fit<span>Zone</span></a>
                <ul class="nav-links">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#trainers">Trainers</a></li>
                    <li><a href="#plans">Plans</a></li>
                    <li><a href="#success-stories">Success Stories</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php if ($isLoggedIn) : ?>
                        <li class="profile-link">
                            <a href="profil.php"><i class="fas fa-user"></i> Profile</a>
                        </li>
                    <?php else : ?>
                        <li><a href="loginForm.php">Login</a></li>
                    <?php endif; ?>
                </ul>
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Elevate Your Fitness Journey</h1>
                <p>Join our premium fitness center with world-class facilities, expert trainers, and personalized programs designed to help you achieve your goals.</p>
                <a href="#plans" class="btn">View Plans</a>
                <?php if ($isLoggedIn) : ?>
                    <div class="welcome-message">
                        Welcome <?php echo htmlspecialchars($row["name"]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <h2>About EliteFit Gym</h2>
            <div class="about-content">
                <div class="about-text">
                    <h3>Why Choose EliteFit?</h3>
                    <p>EliteFit Gym is a premier fitness destination offering cutting-edge equipment, diverse training programs, and expert guidance. Our facility is designed to provide the ultimate workout experience for all fitness levels.</p>
                    <p>We combine science-backed training methods with personalized attention to help you achieve sustainable results. Our community-focused approach ensures you'll always feel motivated and supported.</p>
                    <p>With 24/7 access, recovery facilities, and nutrition counseling, we provide everything you need for complete fitness transformation.</p>
                    <a href="#trainers" class="btn">Meet Our Trainers</a>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Gym Interior">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <h2>Our Services</h2>
            <p class="text-center">Comprehensive fitness solutions tailored to your needs</p>
            <div class="services-grid">
                <?php foreach($class as $classes): ?>
                    <div class="service-card">
                        <div class="service-img">
                            <img src="<?php echo '/FitZone/upload_img/' . htmlspecialchars($classes['class_image']); ?>" alt="<?php echo htmlspecialchars($classes['class_name']); ?>">
                        </div>
                        <div class="service-text">
                            <h3><?php echo htmlspecialchars($classes['class_name']); ?></h3>
                            <p><?php echo htmlspecialchars($classes['description']); ?></p>
                            <p>Trainer: <?php echo htmlspecialchars($classes['trainer']); ?></p>
                            <p>Schedule: <?php echo htmlspecialchars($classes['class_date']) . ' ' . htmlspecialchars($classes['class_time']); ?></p>
                            <?php if ($isLoggedIn) : ?>
                                <button class="btn" onclick="openClassModal('Cardio Blast')">Select Class</button>
                                <?php else : ?>
                                <button class="btn select-btn" onclick="window.location.href='loginForm.php';">Login to Join</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
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
    <section id="trainers">
        <div class="container">
            <h2>Our Expert Trainers</h2>
            <p class="text-center">Learn from the best in the industry</p>
            <div class="trainers-grid">
                <?php foreach($trainer as $trainers): ?>
                    <div class="trainer-card">
                        <div class="trainer-img">
                            <img src="<?php echo '/FitZone/upload_img/' . htmlspecialchars($trainers['trainer_image']); ?>" alt="<?php echo htmlspecialchars($trainers['trainer_name']); ?>">
                        </div>
                        <div class="trainer-info">
                            <h3><?php echo htmlspecialchars($trainers['trainer_name']); ?></h3>
                            <p class="trainer-specialty"><?php echo htmlspecialchars($trainers['trainer_expe']); ?></p>
                            <p class="trainer-contact"><?php echo htmlspecialchars($trainers['trainer_Cinfo']); ?></p>
                            <p class="trainer-bio"><?php echo htmlspecialchars($trainers['description']); ?></p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                            <?php if ($isLoggedIn) : ?>
                                <button class="btn select-btn">Select Trainer</button>
                            <?php else : ?>
                                <button class="btn select-btn" onclick="window.location.href='loginForm.php';">Login to Book</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="trainer-popup-form" id="trainerPopupForm">
    <div class="trainer-popup-content">
        <span class="close-btn" id="trainerCloseBtn">×</span>
        <h2>Book Trainer: <span id="selectedTrainerName"></span></h2>
        <p>Please fill out the following information:</p>
        <?php if ($success) : ?>
            <div class="success-message">
                <i class='bx bxs-check-circle'></i>
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="trainer_name">Trainer Name:</label>
            <input type="text" id="trainer_name" name="trainer_name" readonly required />

            <label for="customer_name">Your Name:</label>
            <input type="text" id="customer_name" name="customer_name" 
                   value="<?php echo $isLoggedIn ? htmlspecialchars($row['name']) : ''; ?>" required />

            <label for="customer_email">Your Email:</label>
            <input type="email" id="customer_email" name="customer_email" 
                   value="<?php echo $isLoggedIn ? htmlspecialchars($row['email']) : ''; ?>" required />

            <button type="submit" name="add" class="submit-btn">Book Trainer</button>
        </form>
    </div>
</div>
    </section>

    <!-- Plans Section -->
   <!-- Plans Section -->
<section id="plans">
    <div class="container">
        <!-- Success Message Display -->
        <?php if (!empty($success)): ?>
            <div class="success-banner">
                <i class="fas fa-check-circle"></i>
                <?php echo $success; ?>
                <span class="close-banner" onclick="this.parentElement.style.display='none'">&times;</span>
            </div>
        <?php endif; ?>

        <h2>Membership Plans</h2>
        <p class="text-center">Choose the perfect plan for your fitness journey</p>
        
        <div class="plans-grid">
            <?php foreach($plan as $plans): ?>
                <div class="plan-card">
                    <div class="plan-header">
                        <h3><?php echo htmlspecialchars($plans['membership_plan']); ?></h3>
                        <div class="plan-price"><?php echo htmlspecialchars($plans['price']); ?></div>
                        <div class="plan-type"><?php echo htmlspecialchars($plans['plan_type']); ?></div>
                    </div>
                    <div class="plan-features">
                        <p><?php echo htmlspecialchars($plans['description']); ?></p>
                        <p class="plan-trainer">Recommended trainer: <?php echo htmlspecialchars($plans['trainer']); ?></p>
                        <?php if ($isLoggedIn) : ?>
                            <button class="btn" onclick="openPlanModal('<?php echo htmlspecialchars($plans['membership_plan']); ?>', '<?php echo htmlspecialchars($plans['price']); ?>')">Select Plan</button>
                        <?php else : ?>
                            <button class="btn" onclick="window.location.href='loginForm.php';">Login to Join</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

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
    <!-- Success Stories Section -->
    <section id="success-stories">
        <div class="container">
            <h2>Success Stories</h2>
            <p class="text-center">Real people, real results - be inspired by our members' transformations</p>
            <div class="stories-grid">
                <?php foreach($story as $stories): ?>
                    <div class="story-card">
                        <div class="story-img">
                            <img src="<?php echo '/FitZone/upload_img/' . htmlspecialchars($stories['picture']); ?>" alt="<?php echo htmlspecialchars($stories['title']); ?>">
                        </div>
                        <div class="story-content">
                            <h3 class="story-title"><?php echo htmlspecialchars($stories['title']); ?></h3>
                            <p class="story-name"><?php echo htmlspecialchars($stories['name']); ?></p>
                            <p class="story-achievement"><?php echo htmlspecialchars($stories['achievement']); ?></p>
                            <p class="story-date"><?php echo htmlspecialchars($stories['date']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2>Get In Touch</h2>
            <p class="text-center">Ready to start your fitness transformation? Contact us today!</p>
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <p>We're here to answer your questions about memberships, training programs, or our facilities.</p>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Location</h4>
                            <p>456 Fitness Avenue, Health City, HC 67890</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <h4>Phone</h4>
                            <p>(555) 987-6543</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>info@elitefitgym.com</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h4>Hours</h4>
                            <p>Monday - Friday: 5:00 AM - 11:00 PM</p>
                            <p>Saturday - Sunday: 7:00 AM - 9:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>EliteFit Gym</h3>
                    <p>Your premier destination for comprehensive fitness training and wellness programs designed to help you achieve your health goals.</p>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#trainers">Trainers</a></li>
                        <li><a href="#plans">Plans</a></li>
                        <li><a href="#success-stories">Success Stories</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Personal Training</a></li>
                        <li><a href="#">Group Classes</a></li>
                        <li><a href="#">Nutrition Counseling</a></li>
                        <li><a href="#">Weight Management</a></li>
                        <li><a href="#">Recovery Services</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Connect With Us</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 EliteFit Gym. All Rights Reserved.</p>
            </div>
        </div>
    </footer>


<!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');
        
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
        
        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });
        
        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
        
        // Smooth scrolling for all links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        



        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target.className === 'modal') {
                e.target.style.display = 'none';
            }
        });


        // Success message handling
        <?php if ($success): ?>
            alert('<?php echo $success; ?>');
        <?php endif; ?>

        // Update your existing JavaScript with these functions
function openPlanModal(planName) {
    // Auto-select the plan in dropdown
    const select = document.getElementById('membership_plan');
    select.value = planName;
    
    // Show the form
    document.getElementById('popupForm').style.display = 'flex';
}

function closeForm() {
    document.getElementById('popupForm').style.display = 'none';
}

// Add click handler to your plan buttons
document.querySelectorAll('.plan-card button').forEach(button => {
    button.addEventListener('click', function() {
        const planName = this.parentElement.querySelector('h3').textContent;
        openPlanModal(planName);
    });
});

// Close when clicking outside
window.onclick = function(event) {
    const popup = document.getElementById('popupForm');
    if (event.target === popup) {
        popup.style.display = 'none';
    }
}

function openClassModal(className) {
    const select = document.getElementById('cls_membership_plan');
    select.value = className;
    document.getElementById('cls_popupForm').style.display = 'flex';
}

function closeClassForm() {
    document.getElementById('cls_popupForm').style.display = 'none';
}

// Event listeners for class popup
document.getElementById('cls_closeBtn').addEventListener('click', closeClassForm);
window.addEventListener('click', (e) => {
    if (e.target === document.getElementById('cls_popupForm')) {
        closeClassForm();
    }
});
// Add to your JavaScript
document.querySelectorAll('.select-btn').forEach(button => {
    button.addEventListener('click', function() {
        const trainerCard = this.closest('.trainer-card');
        const trainerName = trainerCard.querySelector('h3').textContent;
        openTrainerForm(trainerName);
    });
});

// Trainer Popup Functions
function openTrainerForm(trainerName) {
    // Set trainer name in form
    document.getElementById('trainer_name').value = trainerName;
    document.getElementById('selectedTrainerName').textContent = trainerName;
    
    // Show popup
    document.getElementById('trainerPopupForm').style.display = 'flex';
}

function closeTrainerForm() {
    document.getElementById('trainerPopupForm').style.display = 'none';
}

// Event listeners for trainer popup
document.getElementById('trainerCloseBtn').addEventListener('click', closeTrainerForm);

// Close when clicking outside popup
window.addEventListener('click', (e) => {
    if (e.target === document.getElementById('trainerPopupForm')) {
        closeTrainerForm();
    }
});

// Update the trainer button click handlers
document.querySelectorAll('.trainer-card .select-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const trainerCard = this.closest('.trainer-card');
        const trainerName = trainerCard.querySelector('h3').textContent;
        openTrainerForm(trainerName);
    });
});


    </script>
</body>
</html>