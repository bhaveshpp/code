
/**
 * Save Get in touch form data
 */
 $(".save-contact-btn").click(function(){
    var data = {
      SUBMIT: {
        GET_IN_TOUCH: {
          first_name: "Dev11",
          last_name: "ts11",
          email: "dev11.ts11@gmail.com",
          subject: "This is test subject",
          service: "Android app development",
          message: "This is test message",
        }
      }
    };
  
    $.post( BASE_URL + "request.php", data).done(function (data) {
      console.log(data);
    });
  });
  
  /**
   * Save newsletter form data
   */
  $(".save-newsletter-btn").click(function(){
    var data = {
      SUBMIT: {
        NEWSLETTER: {
          email: "dev11.ts11@gmail.com",
        }
      }
    };
  
    $.post( BASE_URL + "request.php", data).done(function (data) {
      console.log(data);
    });
  });
  
  
  /**
   * Save apply for job form data
   */
  
   $(".save-job-request-btn").click(function(){
  
    var fileInputElement = document.getElementById('resume');
    var formData = new FormData();
    formData.append("SUBMIT[APPLY_FOR_JOB][role]", "Magento 2 developer");
    formData.append("SUBMIT[APPLY_FOR_JOB][full_name]", "Dev11 ts11");
    formData.append("SUBMIT[APPLY_FOR_JOB][email]", "dev11.ts11@gmail.com");
    formData.append("SUBMIT[APPLY_FOR_JOB][phone]", "9876543210");
    formData.append("SUBMIT[APPLY_FOR_JOB][location]", "Punagam");
    formData.append("SUBMIT[APPLY_FOR_JOB][experiance]", "2.5 year");
    formData.append("SUBMIT[APPLY_FOR_JOB][message]", "This is test message");
    formData.append("resume", fileInputElement.files[0]);
  
    var request = new XMLHttpRequest();
    request.open("POST", BASE_URL + "request.php");
    request.send(formData);
  
  });