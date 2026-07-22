<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<section class="py-5" style="margin-top: 100px; min-height: 80vh; position: relative; z-index: 2;">
  <div class="container">
    <div class="text-center mb-5">
      <div class="badge bg-primary bg-opacity-25 text-primary border border-primary-subtle px-3 py-2 rounded-5 mb-3">
        FAQs
      </div>
      <h1 class="font-display font-weight-800 text-white">Frequently Asked Questions</h1>
      <p class="text-secondary col-md-6 mx-auto">Get answers to the most common queries regarding admissions, portals, and curriculums.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="accordion accordion-flush" id="faqAccordion" style="background: transparent;">
          <div class="accordion-item mb-3 glass-card p-2 border-0">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed bg-transparent text-white border-0 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                How do I log into the Student Portal?
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body text-secondary">
                Students receive active logins during enrollment. Access the login screen, enter your credentials (e.g. email student1@aether.edu) and input security keys.
              </div>
            </div>
          </div>
          
          <div class="accordion-item mb-3 glass-card p-2 border-0">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button collapsed bg-transparent text-white border-0 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo">
                Is online fee payment supported?
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body text-secondary">
                Yes! Both Student and Parent Portals support fee invoice processing with instant PDF billing receipt downloads.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once APPROOT . '/views/layouts/footer.php'; ?>