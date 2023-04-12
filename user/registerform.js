function checkPassword(password) {
    const regex = /^[a-zA-Z0-9!@#%&_\-{}*:;]*$/;
    return regex.test(password);
}

function checkUsername(username) {
    const regex = /^[a-zA-Z0-9!@#%&{\}*:;]*$/;
    return regex.test(username);
}


const regForm = document.querySelector('#registerForm');
// Generate a CSRF token and include it in the HTML form.
const regtoken = Math.random().toString(36).substr(2, 10);
const csrfregInput = document.createElement('input');
csrfregInput.type = 'hidden';
csrfregInput.name = 'csrf_reg_token';
csrfregInput.value = regtoken;
regForm.appendChild(csrfregInput);
//console.log("tester");
regForm.addEventListener('submit', function (event) {

    const csrfregToken = regForm.elements.csrf_reg_token.value;
    if (!csrfregToken || csrfregToken !== regtoken) {
        // CSRF token is invalid, cancel the form submission.
        event.preventDefault();
        newToast("CSRF attack detected!", 'danger', "white", 3000);
    }
    //console.log("asda");
    event.preventDefault(); // prevent the default form submission
    // do some validation or processing of the form data here
    newToast("Validating your data", 'secondary', "white", 3000);
    //onsole.log("Test4");

    //console.log("Test");
    // Get the form data.
    const formdata = new FormData(regForm);
    formdata.forEach((value, key) => {
        //console.log(key, value);
    });

    // Validate the form data.
    const { errors, formData } = validateRegData(formdata);
    //console.log(errors.length);


    //console.log("Test3");
    //checks if we have no errors
    if (errors.length <= 0) {
        //console.log("here for some reason")
        //console.log(errors.length)
        // If there are no errors, submit the form.
        fetch('user/register.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server
                if (data.status === 'success') {
                    //console.log(data.message);
                    // Handle the response from the server.
                    //showAlert("Succesfully registered user, please proceed to login page <a href='login'>here.</a>", 'success');
                    newToast("Successfully registered, please login.", 'success', "white", 3000);
                    //flips the docuemnt thing around
                    document.querySelector("#flipper").classList.toggle("flip");
                    //gets rid of the alert after ex amount of seconds
                } else {

                    newToast("Username or email already exists. please proceed to the login page to login!", 'danger', "white", 3000);
                    //gets rid of the alert after ex amount of seconds
                }
                //console.log(data.status);
                //console.log(data.message);
                //console.log(data.status);
            })

            .catch(error => {
                console.error('Error submitting form:', error);
                // Handle errors.


                //console.log(error)
            });

    }
    else {
        errors.forEach((value, key) => {
            newToast(value, 'danger', "white", 10000);
        });


        //gets rid of the alert after ex amount of seconds
        //console.log("Test5");
    }
});

function validateRegData(formData) {
    const errors = [];
    //console.log(formData.get('confirmemail'));
    //check if the emails are the same
    //console.log("ada");
    if (formData.get('emailreg') != formData.get('confirmemailreg')) {
        errors.push("Error #" + (errors.length + 1) + ": Email and conformation email arent the same. Email: " + formData.get('emailreg') + " Conformation Email: " + formData.get('confirmemailreg') + ".");
        //console.log("here");
    }
    //console.log("Test1");
    //we check the username length is not above 15
    if (formData.get('usernamereg').length > 25) {
        errors.push("Error #" + (errors.length + 1) + ": Username Length bigger then 15, please make it 15 or smaller.");
    }
    //we check the username to see if it doesnt contain any of the stuff we dont want it to
    if (!checkUsername(formData.get('usernamereg'))) {
        errors.push("Error #" + (errors.length + 1) + `: Usernames cannot contain spaces or any of the following special characters: !, @, #, %, &, *, {, }, :, and ;`);
    }
    //console.log("Test2");
    //we check if the password lenght is not above 10
    if (formData.get('passwordreg').length > 20) {
        errors.push("Error #" + (errors.length + 1) + ": Password Length bigger then 10, please make it 10 or smaller.");
    }
    //we check the password to see if it doesnt contain any of the stuff we dont want it to
    if (!checkPassword(formData.get('passwordreg'))) {
        errors.push("Error #" + (errors.length + 1) + `: Invalid characters in Password. Valid characters: letters, numbers, and these special characters: !, -, _, @, #, %, &, *, {, }, :, and ;`);
    }
    //console.log("Test3");
    //we check if the privacy agreement was checked
    if (formData.get("privacyCheck") === null) {
        errors.push("Error #" + (errors.length + 1) + ": Please read our privacy agreement first before signing up!");
    }

    //we sanitize the password, username and email in case any injection attempts to happen
    formData.set("emailreg", sanitizeInput(formData.get("emailreg")));
    formData.set("usernamereg", sanitizeInput(formData.get("usernamereg")));
    formData.set("passwordreg", sanitizeInput(formData.get("passwordreg")));

    return { errors: errors, formData: formData };
}
