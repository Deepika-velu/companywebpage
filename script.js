function validateForm() {

    let inputs = document.querySelectorAll(
        "form input"
    );

    for (let input of inputs) {

        if (input.value.trim() === "") {
            alert("Please fill all the fields!");
            input.focus();
            return false;
        }
    }

    return true;
}