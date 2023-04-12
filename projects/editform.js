Intl.DateTimeFormat().resolvedOptions().timeZone = 'Europe/London';

// Get all elements with the class "myInput"
const editForms = document.querySelectorAll("#editform");

editForms.forEach(function (editForm) {
    // Generate a CSRF token and include it in the HTML form.
    const editToken = Math.random().toString(36).substr(2, 10);
    const csrfeditInput = document.createElement('input');
    csrfeditInput.type = 'hidden';
    csrfeditInput.name = 'csrf_edit_token';
    csrfeditInput.value = editToken;
    editForm.appendChild(csrfeditInput);

    editForm.addEventListener('submit', function (event) {

        const csrfeditToken = editForm.elements.csrf_edit_token.value;
        if (!csrfeditToken || csrfeditToken !== editToken) {
            // CSRF token is invalid, cancel the form submission.
            event.preventDefault();
            newToast("CSRF attack detected!", 'danger', "white", 3000);
        }

        event.preventDefault(); // prevent the default form submission
        // Get the form data.
        const formdata = new FormData(editForm);
        const projectId = editForm.getAttribute('data-project-id');
        formdata.append("editprojectID", projectId);
        formdata.forEach((value, key) => {
            //console.log(key, value);
        });

        // Validate the form data.
        const { errors, formData } = validateEditFormData(formdata);

        //checks if we have no errors
        if (errors.length <= 0) {
            //console.log("here for some reason")
            //console.log(errors.length)
            // If there are no errors, submit the form.
            fetch('projects/edit.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server
                    if (data.status === 'success') {
                        //console.log(data.message);
                        // Handle the response from the server.
                        newToast(data.message, 'success', "white", 3000);

                        // Get the modal element
                        $("#editModal" + projectId).modal("hide");

                        //since we edited the project succesfully, we tell the user to refresh their page to see the changes

                        newToast("Please refresh the page to observe the changes!", 'success', "white", 3000);
                    } else {
                        console.log(data.message);
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
})

function validateEditFormData(formData) {
    const errors = [];
    start = new Date(formData.get("editstart"));
    end = new Date(formData.get("editend"));
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
    formData.set("edittitle", sanitizeInput(formData.get("edittitle")));
    formData.set("editdesc", sanitizeInput(formData.get("editdesc")));

    return { errors: errors, formData: formData };
}