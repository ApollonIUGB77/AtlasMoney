<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['phone'])) 
{
  ?>
  <!DOCTYPE html>
    <html>
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="MeitePro.css">
          <title>My Website Project </title>
        </head>

      <body>
        <section id="header">
          <div class="header container">
            <div class="nav-bar">
              <div class="brand">
                <a href="#ares1">
                  <h1><span>A</span>T<span>L</span>A <span><span>S</span>M</span>O<span>N</span>E<span>Y</span></h1>
                </a>
              </div>
              <div class="nav-list">
                <div class="hamburger">
                  <div class="bar"></div>
                </div>
                <ul>
                  <li><a href="#ares1" data-after="Home">Home</a></li>
                  <li><a href="#services" data-after="Service">Services</a></li>
                  <li><a href="updateProfile.php" data-after="Projects">EDIT PROFILE </a></li>
                  <li><a href="#about" data-after="About">About</a></li>
                  <li><a href="#contact" data-after="Contact">Contact</a></li>
                  <li><a href="logout.php" data-after="Logout">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
        </section>
        
        <section id="ares1">
          <div class="hero container">
            <div>
              <h1>Hello, <?php echo $_SESSION['name']?> <span></span></h1>
              
              <a href="#projects" type="button" class="cta">PortFolio</a>
            </div>
          </div>
        </section>
      
        <section id="services">
          <div class="services container">
            <div class="service-top">
              <h1 class="section-title">S<span>E</span>R<span>V</span>I<span>C</span>E<span>S</span></h1>
              <p> <q> GOD HELPS WHO HELPS HIMSELF. </q> </p>
              <q style="color:red";>
            </div>
            <div class="service-bottom">
              <div class="service-item">
                <div class="icon"><img src="webpic.jpg" /></div>
                <h2>WEB DESIGN </h2>
                <p>I am a beginner in Web programming. I can designers plan, create and code internet sites and web pages by combining text with sounds, pictures, graphics and video clips. I am also responsible for creating the design and layout of a website or web pages . I master the basics of java, HTML and CSS. I am also able to use php and javascript when needed .</p>
              </div>
              <div class="service-item">
                <div class="icon"><img src="codpic.png" /></div>
                <h2>CODING </h2>
                <p>Since I master some language while understanding how they work. I am able to improve your program, detect its flaws and offer you a solution. The languages ​​mastered are the following: Java, Html; CSS, C++. <q>Let me help you create powerful program . </q> </p>
              </div>
              <div class="service-item">
                <div class="icon"><img src="mainpic.jfif" /></div>
                <h2>Computer Maintenance</h2>
                <p>I have the ability to improve the proper functioning of your computer by updating software, detecting certain viruses or flaws that can slow down your computer. Need to disassemble, increase your RAM, change your hard drive? I can also do it, satisfied or reimbursed. <q> Trust is the invisible cement that drives a team to win.</q>   </p>
              </div>
            </div>
          </div>
        </section>
        <section id="contact">
          <div class="contact container">
            <div>
              <h1 class="section-title"> CLIENT SERVICES <span>info</span></h1>
            </div>
            <div class="contact-items">
              <div class="contact-item">
                <div class="icon"><img src="phone.png" /></div>
                <div class="contact-info">
                  <h1>Phone</h1>
                  <h2>+225 0789777163</h2>
                  <h2>+225 0141333068</h2>
                </div>
              </div>
              <div class="contact-item">
                <div class="icon"><img src="contact.png" /></div>
                <div class="contact-info">
                  <h1>Email</h1>
                  <h2>desperados12@gmail.com</h2>
                  <h2>despemoney@ymail.com</h2>
                </div>
              </div>
              <div class="contact-item">
                <div class="icon"><img src="map.png" /></div>
                <div class="contact-info">
                  <h1>Address</h1>
                  <h2>Ivory Coast , Grand Bassam , Modeste</h2>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Contact Section -->

        <!-- Footer -->
        <section id="footer">
          <div class="footer container">
            <div class="brand">
              <h1><span>ME</span>ITE <span>SI</span>DICK</h1>
          
            <p>Copyright © 2023 DESPERADOS. All rights reserved</p>
          </div>
        </section>
        <!-- End Footer -->
        <script src="MeitePro.js"></script>
      </body>
    </html>
<?php
} 
{
  header("Location: index.php");
  exit();
}
?>