function password_show_hide_reg() {
    var x = document.getElementById("passwordreg");
    var show_eye = document.getElementById("show_eye_reg");
    var hide_eye = document.getElementById("hide_eye_reg");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

function password_show_hide_log() {
    var x = document.getElementById("passwordlog");
    var show_eye = document.getElementById("show_eye_log");
    var hide_eye = document.getElementById("hide_eye_log");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}