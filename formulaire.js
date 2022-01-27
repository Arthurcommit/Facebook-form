var firstname = document.getElementById('firstname');
var miss_firstname = document.getElementById('missfirstname');
var check_firstname = new RegExp("^[a-zA-ZÀ-ÖØ-öø-ÿœŒ]");

var name = document.getElementById('lastname');
var miss_name = document.getElementById('missname');
var check_name = new RegExp("^[a-zA-ZÀ-ÖØ-öø-ÿœŒ]");

var mail = document.getElementById('mail');
var miss_mail = document.getElementById('missmail');
var check_mail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;

var confirm_mail = document.getElementById('confirm_mail');
var missconfirm_mail = document.getElementById('missconfirm_mail');
var check_confirmmail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;

var password = document.getElementById('password');
var miss_mdp = document.getElementById('missmdp');

var date = document.getElementById('date');
var miss_date = document.getElementById('missdate');





var formValid = document.getElementById('btnregistration');
formValid.addEventListener('click', validation);



function validation(event) {
    console.log("test")

    if (firstname.value == "") {

        event.preventDefault(); //To block form submission */
        miss_firstname.style.color = 'red' // missfirstname must be defined as span id in HTML
        miss_firstname.textContent = 'Please enter your first name';
        /*To display "missing first name", you must create a span id in HTML and report the same name in JS.*/
    } else if (check_firstname.test(firstname.value) == false) {
        event.preventDefault();
        miss_firstname.style.color = 'red'
        miss_firstname.textContent = 'Enter your full first name';
    }

    if (lastname.value == "") {
        event.preventDefault();
        miss_name.style.color = 'red'
        miss_name.textContent = 'Please enter your last name';
    } else if (check_name.test(firstname.value) == false) {
        event.preventDefault();
        miss_name.style.color = 'red'
        miss_name.textContent = 'Please enter your full name';
    }


    if (mail.value == "") {
        event.preventDefault();
        miss_mail.style.color = 'red'
        miss_mail.textContent = 'Missing Mail';
    } else if (check_mail.test(mail.value) == false) {
        event.preventDefault();
        miss_mail.style.color = 'red'
        miss_mail.textContent = 'Please enter a valid email address';
    }

    if (mail.value == "") {
        event.preventDefault();
        miss_mail.style.color = 'red'
        miss_mail.textContent = 'Please enter your email address';
    } else if (check_mail.test(mail.value) == false) {
        event.preventDefault();
        miss_mail.style.color = 'red'
        miss_mail.textContent = 'Please enter a valid email address';
    }

    if (confirm_mail.value == "") {
        event.preventDefault();
        missconfirm_mail.style.color = 'red'
        missconfirm_mail.textContent = 'Please enter your confirmation email address';
    } else if (check_confirmmail.test(confirm_mail.value) == false) {
        event.preventDefault();
        missconfirm_mail.style.color = 'red'
        missconfirm_mail.textContent = 'Please enter a valid email address';
    }
    if (mdp.value == "") {
        event.preventDefault();
        miss_mdp.style.color = 'red'
        miss_mdp.textContent = 'Please enter a password';
    }

    if (day.value == "") {
        event.preventDefault();
        miss_date.style.color = 'red'
        miss_date.textContent = 'Please choose a birthday';

    }

    if (month.value == "") {
        event.preventDefault();
        miss_date.style.color = 'red'
        miss_date.textContent = 'Please choose a birth month';

    }

    if (year.value == "") {
        event.preventDefault();
        miss_date.style.color = 'red'
        miss_date.textContent = 'Please enter your date of birth';
    }
}



var email = document.getElementById('email');
var miss_mailLog = document.getElementById('missmailLog');

var password = document.getElementById('password');
var miss_pwdLog = document.getElementById('misspassword');



var formValid = document.getElementById('btnLogIn');
formValid.addEventListener('click', validationLogIn);

function validationLogIn(event) {
    console.log("testLog");

    if (email.value == "") {

        event.preventDefault(); //To block form submission */
        miss_mailLog.style.color = 'red'
        miss_mailLog.textContent = 'Please enter your email';
    }

    if (password.value == "") {

        event.preventDefault();
        miss_pwdLog.style.color = 'red'
        miss_pwdLog.textContent = 'Please enter your password';
    }
}
