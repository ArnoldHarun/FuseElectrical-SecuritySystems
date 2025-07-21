<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Request a Quotation - Fuse Electrical and Security Systems</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="electrical services, security systems, CCTV, electrical installation, Uganda" name="keywords">
  <meta content="Request a free quotation for electrical and security services in Uganda" name="description">

  <!-- Favicons -->
  <link href="img/fuse_logo.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fa fa-envelope-o"></i> <a href="mailto:info@fuseelectrical.ug">info@fuseelectrical.ug</a>
        <i class="fa fa-phone"></i> +256 704 000 474
      </div>
      <div class="social-links float-right">
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </section>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="index.html"><img src="img/fuse_logo.png" alt="Fuse Electrical and Security Systems" title="Fuse Electrical and Security Systems" style="width: 2cm; height: 1.6cm;" /></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="index.html">Home</a></li>
          <li><a href="index.html#about">About Us</a></li>
          <li><a href="index.html#services">Services</a></li>
          <li class="menu-has-children menu-active"><a href="#">Products</a>
            <ul>
              <li><a href="work.html">Work</a></li>
              <li class="menu-active"><a href="quotation.html">Quotation</a></li>
            </ul>
          </li>
          <li><a href="index.html#portfolio">Portfolio</a></li>
          <li><a href="index.html#contact">Contact</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Page Header
  ============================-->
  <section class="page-header">
    <div class="container">
      <h2>Request a Quotation</h2>
      <p>Get a customized quote for your electrical and security needs</p>
    </div>
  </section>

  <main id="main">

    <!--==========================
      Quotation Form Section
    ============================-->
    <section id="quotation-form" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="quotation-wrapper">
              <div class="quotation-steps">
                <div class="step" id="step1">
                  <div class="step-header active">
                    <span class="step-number">Step 1</span>
                    <span class="step-title">Personal Info</span>
                  </div>
                </div>
                <div class="step" id="step2">
                  <div class="step-header">
                    <span class="step-number">Step 2</span>
                    <span class="step-title">Your Address</span>
                  </div>
                </div>
                <div class="step" id="step3">
                  <div class="step-header">
                    <span class="step-number">Step 3</span>
                    <span class="step-title">Project Details</span>
                  </div>
                </div>
              </div>

              <div class="quotation-form">
                <form id="quoteForm" action="submit-quote.php" method="post">
                  <!-- Step 1: Personal Information -->
                  <div class="form-step" id="form-step1">
                    <h3>Personal Information</h3>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="firstName">First Name</label>
                          <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="lastName">Last Name</label>
                          <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone">Phone Number</label>
                          <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="propertyDescription">Describe your property type</label>
                      <textarea class="form-control" id="propertyDescription" name="propertyDescription" rows="4" placeholder="Please describe your property type (e.g., rooms, electric equipment, volumes, etc.)"></textarea>
                    </div>
                    
                    <div class="form-navigation">
                      <button type="button" class="btn btn-next" onclick="nextStep(1)">Next Step</button>
                    </div>
                  </div>
                  
                  <!-- Step 2: Address Information -->
                  <div class="form-step" id="form-step2" style="display: none;">
                    <h3>Your Address</h3>
                    
                    <div class="form-group">
                      <label for="city">City</label>
                      <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="streetAddress">Street Address</label>
                      <input type="text" class="form-control" id="streetAddress" name="streetAddress" required>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="state">State/Province</label>
                          <input type="text" class="form-control" id="state" name="state">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="postalCode">Postal Code</label>
                          <input type="text" class="form-control" id="postalCode" name="postalCode">
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-navigation">
                      <button type="button" class="btn btn-prev" onclick="prevStep(2)">Previous Step</button>
                      <button type="button" class="btn btn-next" onclick="nextStep(2)">Next Step</button>
                    </div>
                  </div>
                  
                  <!-- Step 3: Project Details -->
                  <div class="form-step" id="form-step3" style="display: none;">
                    <h3>Project Details</h3>
                    
                    <div class="form-group">
                      <label>Services Required (Select all that apply)</label>
                      <div class="checkbox-group">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="service1" name="services[]" value="Electrical Installation">
                          <label class="custom-control-label" for="service1">Electrical Installation</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="service2" name="services[]" value="CCTV Security">
                          <label class="custom-control-label" for="service2">CCTV Security</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="service3" name="services[]" value="Access Control">
                          <label class="custom-control-label" for="service3">Access Control</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="service4" name="services[]" value="Alarm Systems">
                          <label class="custom-control-label" for="service4">Alarm Systems</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="service5" name="services[]" value="Smart Home Solutions">
                          <label class="custom-control-label" for="service5">Smart Home Solutions</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="service6" name="services[]" value="Maintenance & Support">
                          <label class="custom-control-label" for="service6">Maintenance & Support</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="projectScope">Project Scope</label>
                      <select class="form-control" id="projectScope" name="projectScope">
                        <option value="">Select project scope</option>
                        <option value="New Installation">New Installation</option>
                        <option value="Upgrade/Renovation">Upgrade/Renovation</option>
                        <option value="Repair">Repair</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Consultation">Consultation Only</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="budget">Estimated Budget (Optional)</label>
                      <select class="form-control" id="budget" name="budget">
                        <option value="">Select budget range</option>
                        <option value="Under $1,000">Under $1,000</option>
                        <option value="$1,000 - $5,000">$1,000 - $5,000</option>
                        <option value="$5,000 - $10,000">$5,000 - $10,000</option>
                        <option value="$10,000 - $25,000">$10,000 - $25,000</option>
                        <option value="Over $25,000">Over $25,000</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="timeline">Preferred Timeline</label>
                      <select class="form-control" id="timeline" name="timeline">
                        <option value="">Select timeline</option>
                        <option value="As soon as possible">As soon as possible</option>
                        <option value="Within 1 month">Within 1 month</option>
                        <option value="1-3 months">1-3 months</option>
                        <option value="3-6 months">3-6 months</option>
                        <option value="6+ months">6+ months</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="additionalInfo">Additional Information</label>
                      <textarea class="form-control" id="additionalInfo" name="additionalInfo" rows="4" placeholder="Please provide any additional details that will help us understand your project better"></textarea>
                    </div>
                    
                    <div class="form-navigation">
                      <button type="button" class="btn btn-prev" onclick="prevStep(3)">Previous Step</button>
                      <button type="submit" class="btn btn-submit">Submit Quote Request</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="sidebar-widget">
                <h4>Our Services</h4>
                <ul class="service-list">
                  <li><a href="work.html#electrical-installation"><i class="fa fa-angle-right"></i> Electrical Installation</a></li>
                  <li><a href="work.html#cctv-security"><i class="fa fa-angle-right"></i> CCTV Security</a></li>
                  <li><a href="work.html#access-control"><i class="fa fa-angle-right"></i> Access Control Systems</a></li>
                  <li><a href="work.html#alarm-systems"><i class="fa fa-angle-right"></i> Alarm & Monitoring</a></li>
                  <li><a href="work.html#smart-home"><i class="fa fa-angle-right"></i> Smart Home Solutions</a></li>
                  <li><a href="work.html#maintenance"><i class="fa fa-angle-right"></i> Maintenance & Support</a></li>
                </ul>
              </div>
              
              <div class="sidebar-widget">
                <h4>Need Help?</h4>
                <p>If you have any questions or need assistance with your quotation, please don't hesitate to contact us.</p>
                <div class="contact-info">
                  <p><i class="fa fa-phone"></i> +256 704 000 474</p>
                  <p><i class="fa fa-envelope"></i> info@fuseelectrical.ug</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Fuse Electrical and Security Systems</strong>. All Rights Reserved
      </div>
      <div class="credits">
        Professional Electrical & Security Solutions in Uganda
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
  
  <!-- Quotation Form Javascript -->
  <script>
    function nextStep(currentStep) {
      // Hide current step
      document.getElementById('form-step' + currentStep).style.display = 'none';
      // Show next step
      document.getElementById('form-step' + (currentStep + 1)).style.display = 'block';
      // Update step headers
      document.getElementById('step' + currentStep).querySelector('.step-header').classList.remove('active');
      document.getElementById('step' + (currentStep + 1)).querySelector('.step-header').classList.add('active');
    }
    
    function prevStep(currentStep) {
      // Hide current step
      document.getElementById('form-step' + currentStep).style.display = 'none';
      // Show previous step
      document.getElementById('form-step' + (currentStep - 1)).style.display = 'block';
      // Update step headers
      document.getElementById('step' + currentStep).querySelector('.step-header').classList.remove('active');
      document.getElementById('step' + (currentStep - 1)).querySelector('.step-header').classList.add('active');
    }
    
    // Form submission
    document.getElementById('quoteForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Collect form data
      const formData = new FormData(this);
      
      // Send form data via AJAX
      fetch('submit-quote.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Show success message
          alert('Thank you for your quote request! We will contact you shortly.');
          // Reset form
          document.getElementById('quoteForm').reset();
          // Go back to step 1
          document.getElementById('form-step3').style.display = 'none';
          document.getElementById('form-step1').style.display = 'block';
          document.getElementById('step3').querySelector('.step-header').classList.remove('active');
          document.getElementById('step1').querySelector('.step-header').classList.add('active');
        } else {
          // Show error message
          alert('There was an error submitting your quote request. Please try again or contact us directly.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('There was an error submitting your quote request. Please try again or contact us directly.');
      });
    });
  </script>

</body>
</html>
