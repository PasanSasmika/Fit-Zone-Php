<?php
@include 'config.php';
@include 'GetFunctions.php';

$class = getClass(conn: $conn);
$trainer = getTrainers(conn: $conn);
$plan = getPlans(conn: $conn);
$story = getStory(conn: $conn);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
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
            of!Unlock your true potential and start your journey toward a stronger, healthier, 
            and more confident version of yourself. Join 'Shape Your Body' today
             and experience the incredible change your body can achieve!
          </p>
          <div class="header__btn">
            <a href="loginForm.php">Login</a>
          </div>
        </div>
      </div>
    </header>

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
              <h4>Flexible Membership Options </h4>
              <p>
                We offer a variety of membership plans designed to fit different needs and lifestyles, ensuring that you can choose the best fit for your fitness goals.
              </p>
            </div>
          </div>
          <div class="about__card">
            <span><i class="ri-p2p-line"></i></span>
            <div>
              <h4> Expert Guidance </h4>
              <p>
                Our team of certified trainers and fitness experts is here to guide you every step of the way, ensuring you progress safely and effectively.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container class__container" id="class">
      <h2 class="section__header">Our Classes</h2>
      <p class="section__description">
        Discover a diverse range of exhilarating classes at our gym designed to
        cater to all fitness levels and interests. Whether you're a seasoned
        athlete or just starting your fitness journey, our classes offer
        something for everyone.
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
        <button class="btn" onclick="window.location.href='indexLog.php';">Join Now</button>

      </div>
    </section>

    <section class="section__container trainer__container" id="trainer">
      <h2 class="section__header">Our Trainers</h2>
      <p class="section__description">
        Our trainers are more than just experts in exercise; they are passionate
        about helping you achieve your health and fitness goals. Our trainers
        are equipped to tailor workout programs to meet your unique needs.
      </p>
      <div class="trainer__grid">
        <?php foreach($trainer as $trainers): ?>
          <div class="trainer__card">
          <img src="<?php echo '/FitZone/upload_img/' . htmlspecialchars($trainers['trainer_image']); ?>" alt="Class Image" />
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
          <button class="btn" onclick="window.location.href='indexLog.php';">Join Now</button>
        </div>
        <?php endforeach; ?>
      </div>
    </section>


    <section class="success-story">
  <div class="section__container">
    <h2 class="section__header">Success Stories</h2>

    <div class="success-story__carousel">
      <!-- Carousel Items -->
      <?php foreach($story as $stories): ?>
      <div class="success-story__card">
        <div class="success-story__image">
          <img src="<?php echo '/FitZone/upload_img/' . htmlspecialchars($stories['picture']); ?>" alt="Class Image" />
        </div>
        <div class="success-story__content">
          <h3 class="success-story__title"><?php echo htmlspecialchars($stories['title']); ?></h3>
          <p class="success-story__name"> <strong><?php echo htmlspecialchars($stories['name']); ?></strong></p>
          <p class="success-story__achievement"><span><?php echo htmlspecialchars($stories['achievement']); ?></span></p>
          <p class="success-story__date"> <span><?php echo htmlspecialchars($stories['date']); ?></span></p>
        </div>
      </div>
      <?php endforeach; ?>

      <!-- Carousel Navigation Buttons -->
      <button class="carousel-btn prev-btn">&#8592;</button>
      <button class="carousel-btn next-btn">&#8594;</button>
    </div>
  </div>
</section>







<section class="section__container client__container" id="client">
      <h2 class="section__header">What People Says About Us?</h2>
      <p class="section__description">
        These testimonials serve as a testament to our commitment to helping
        individuals achieve their fitness goals, and fostering a supportive
        environment for everyone who walks through our doors.
      </p>
      <!-- Slider main container -->
      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <div class="client__card">
              <img src="assets/client-1.jpg" alt="client" />
      
              <p>
                The trainers here customized a plan that balanced my work-life
                demands, and I've seen remarkable progress in my fitness
                journey. It's not just a gym; it's my sanctuary for self-care.
              </p>
              <h4>Jane Smith</h4>
              <h5>Marketing Manager</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card">
              <img src="assets/client-2.jpg" alt="client" />
              
              <p>
                The trainers' expertise and the gym's commitment to cleanliness
                during these times have made it a safe haven for me to maintain
                my health and de-stress.
              </p>
              <h4>Emily Carter</h4>
              <h5>Registered Nurse</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card">
              <img src="assets/client-3.jpg" alt="client" />
              
              <p>
                The variety of classes and the supportive community have kept me
                motivated. I've shed pounds, gained confidence, and found a new
                level of energy to inspire my students.
              </p>
              <h4>John Davis</h4>
              <h5>Teacher</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card">
              <img src="assets/client-4.jpg" alt="client" />
              
              <p>
                This gym's 24/7 access has been a lifesaver. Whether it's a
                late-night workout or an early morning session, the convenience
                here is unbeatable.
              </p>
              <h4>David Martinez</h4>
              <h5>Entrepreneur</h5>
            </div>
          </div>
        </div>
      </div>
    </section>

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
  </body>
</html>
