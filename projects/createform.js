Intl.DateTimeFormat().resolvedOptions().timeZone = 'Europe/London';

const createForm = document.querySelector('#createform');

const logForm = document.querySelector('#loginform');
// Generate a CSRF token and include it in the HTML form.
const cretoken = Math.random().toString(36).substr(2, 10);
const csrfcreInput = document.createElement('input');
csrfcreInput.type = 'hidden';
csrfcreInput.name = 'csrf_cre_token';
csrfcreInput.value = cretoken;
createForm.appendChild(csrfcreInput);




createForm.addEventListener('submit', function (event) {

    const csrfcreToken = createForm.elements.csrf_cre_token.value;
    if (!csrfcreToken || csrfcreToken !== cretoken) {
        // CSRF token is invalid, cancel the form submission.
        event.preventDefault();
        newToast("CSRF attack detected!", 'danger', "white", 3000);
    }

    event.preventDefault(); // prevent the default form submission
    // Get the form data.
    const formdata = new FormData(createForm);
    formdata.forEach((value, key) => {
        //console.log(key, value);
    });

    // Validate the form data.
    const { errors, formData } = validateCreateFormData(formdata);

    //checks if we have no errors
    if (errors.length <= 0) {
        //console.log("here for some reason")
        //console.log(errors.length)
        // If there are no errors, submit the form.
        fetch('projects/create.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server
                if (data.status === 'success') {
                    //console.log(data.message);
                    // Handle the response from the server.
                    newToast("Successfully created project! check project page to view project " + data.projectID + " or refresh this page to edit the project!", 'success', "white", 3000);
                } else {
                    //console.log(data.message);
                    newToast(data.message, 'danger', "white", 3000);
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
        //console.log(errors.length);
        errors.forEach((value, key) => {
            newToast(value, 'danger', "white", 10000);
        });
        //gets rid of the alert after ex amount of seconds
        //console.log("Test5");
    }
})


function validateCreateFormData(formData) {
    const errors = [];
    const start = new Date(formData.get("createstart"));
    const end = new Date(formData.get("createend"));
    //console.log(start);
    //console.log(end);
    //we check if the start date is not 1 day ahead
    const currentDate = new Date();
    const oneDayInMs = 24 * 60 * 60 * 1000; // 1 day in milliseconds
    if (start.getTime() <= currentDate.getTime() + oneDayInMs) {
        errors.push("Error #" + (errors.length + 1) + ": Please select a start day thats at least 1 day in the future.");
    }
    //console.log("Test2");

    //here we check if the end date is not before the start date
    if (start.getTime() > end.getTime()) {
        errors.push("Error #" + (errors.length + 1) + ": Please make sure the end date is not before the start date.");
        //console.log("here");
    }

    //we sanitize the title and description in case any injection attempts to happen
    formData.set("createtitle", sanitizeInput(formData.get("createtitle")));
    formData.set("createdesc", sanitizeInput(formData.get("createdesc")));


    return { errors: errors, formData: formData };
}