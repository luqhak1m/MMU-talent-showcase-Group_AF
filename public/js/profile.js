function enableEditing() {
    const inputs=document.querySelectorAll('#profile-field-div input, #profile-field-div select, #profile-field-div textarea, #profile-field-div button[type="submit"]');
    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
    });
}