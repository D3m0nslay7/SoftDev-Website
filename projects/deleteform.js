// Get all elements with the class "myInput"
const deleteForms = document.querySelectorAll("#deleteform");

deleteForms.forEach(function (deleteForm) {
    // Generate a CSRF token and include it in the HTML form.
    const deltoken = Math.random().toString(36).substr(2, 10);
    const csrfdelInput = document.createElement('input');
    csrfdelInput.type = 'hidden';
    csrfdelInput.name = 'csrf_del_token';
    csrfdelInput.value = deltoken;
    deleteForm.appendChild(csrfdelInput);

    deleteForm.addEventListener('submit', function (event) {

        const csrfdelToken = deleteForm.elements.csrf_del_token.value;
        if (!csrfdelToken || csrfdelToken !== deltoken) {
            // CSRF token is invalid, cancel the form submission.
            event.preventDefault();
            newToast("CSRF attack detected!", 'danger', "white", 3000);
        }

        event.preventDefault(); // prevent the default form submission
        // Get the form data.
        formData = new FormData();
        const projectId = deleteForm.getAttribute('data-project-id');
        formData.append("deleteprojectID", projectId);
        formData.forEach((value, key) => {
            //console.log(key, value);
        });

        //submit the form
        fetch('projects/delete.php', {
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
                    $("#deleteModal" + projectId).modal("hide");

                    //get rid of the modal element and the card
                    $("#projectcon-" + projectId).remove();
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
    })
})