
const logForm = document.querySelector('#loginform');
// Generate a CSRF token and include it in the HTML form.
const logtoken = Math.random().toString(36).substr(2, 10);
const csrflogInput = document.createElement('input');
csrflogInput.type = 'hidden';
csrflogInput.name = 'csrf_log_token';
csrflogInput.value = logtoken;
logForm.appendChild(csrflogInput);

logForm.addEventListener('submit', function (event) {

    const csrflogToken = logForm.elements.csrf_log_token.value;
    if (!csrflogToken || csrflogToken !== logtoken) {
        // CSRF token is invalid, cancel the form submission.
        event.preventDefault();
        newToast("CSRF attack detected!", 'danger', "white", 3000);
    }


    event.preventDefault(); // prevent the default form submission
    // Get the form data.
    const formdata = new FormData(logForm);
    formdata.forEach((value, key) => {
        //console.log(key, value);
    });

    // Validate the form data.
    const { errors, formData } = validateLogData(formdata);
    //console.log(formData.get("identiferlog"));
    //checks if we have no errors
    if (errors.length <= 0) {
        //console.log("here for some reason")
        //console.log(errors.length)
        // If there are no errors, submit the form.
        fetch('user/login.php', {
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
                    newToast("Successfully logged in! returning you to home page now!", 'success', "white", 3000);
                    //returns to home page
                    setTimeout(function () {
                        // Redirect the user to the homepage
                        window.location.href = "../index.php";
                    }, 3000);
                    //gets rid of the alert after ex amount of seconds
                } else {

                    newToast("Incorrect password / username combination, please try again", 'danger', 'white', 3000);
                    //gets rid of the alert after ex amount of seconds
                }
                //console.log(data.status);
                //console.log(data.message);
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
})


function validateLogData(formData) {
    const errors = [];

    //we sanitize the password, username and email in case any injection attempts to happen
    console.log(formData.get("identifierlog"));
    formData.set("identiferlog", sanitizeInput(formData.get("identiferlog")));
    formData.set("passwordlog", sanitizeInput(formData.get("passwordlog")));
    console.log(formData.get("identifierlog"));
    return { errors: errors, formData: formData };
}