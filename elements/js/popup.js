function showAlert(message, type, doc) {
    const alertEl = document.getElementById(doc);
    alertEl.innerHTML = message;
    alertEl.classList.add(`alert-${type}`);
    alertEl.style.display = 'block';
    setTimeout(() => {
        alertEl.style.display = 'none';
        alertEl.classList.remove(`alert-${type}`);
    }, 6000);
}

function newToast(message, type, tcolor, delay) {

    //get the toast wrapper
    var containerWrapper = document.getElementById("toastwrapper");

    // Create the toast element
    var toast = document.createElement("div");
    toast.classList.add("toast", "align-items-center", "text-bg-primary", "border-0", "bg-" + type);
    toast.setAttribute("role", "alert");
    toast.setAttribute("aria-live", "assertive");
    toast.setAttribute("aria-atomic", "true");

    // Create the toast content wrapper
    var wrapper = document.createElement("div");
    wrapper.classList.add("d-flex");
    toast.appendChild(wrapper);

    // Create the toast body
    var body = document.createElement("div");
    body.classList.add("toast-body", "text-" + tcolor);
    body.textContent = message;
    wrapper.appendChild(body);

    // Create the close button
    var closeButton = document.createElement("button");
    closeButton.type = "button";
    closeButton.classList.add("btn-close", "btn-close-white", "me-2", "m-auto");
    closeButton.setAttribute("data-bs-dismiss", "toast");
    closeButton.setAttribute("aria-label", "Close");
    wrapper.appendChild(closeButton);


    // Append the toast element to the wrapper
    containerWrapper.appendChild(toast);

    // Show the toast message
    var bootstrapToast = new bootstrap.Toast(toast);
    bootstrapToast.show();


    // Set a timeout to remove the toast element after a delay
    setTimeout(function () {
        toast.remove();
    }, delay);

}