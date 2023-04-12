function sanitizeInput(input) {
    // Remove any HTML tags from the input
    var sanitizedInput = input.replace(/<\/?[^>]+(>|$)/g, "");

    // Convert any special characters to HTML entities
    sanitizedInput = sanitizedInput.replace(/&/g, "&amp;");
    sanitizedInput = sanitizedInput.replace(/</g, "&lt;");
    sanitizedInput = sanitizedInput.replace(/>/g, "&gt;");
    sanitizedInput = sanitizedInput.replace(/"/g, "&quot;");
    sanitizedInput = sanitizedInput.replace(/'/g, "&#x27;");
    sanitizedInput = sanitizedInput.replace(/\//g, "&#x2F;");
    // Return the sanitized input

    return sanitizedInput;
}