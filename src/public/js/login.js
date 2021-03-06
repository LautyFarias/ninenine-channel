(() => {
    const $submitButton = document.getElementById("submit-button"),
        $background = document.getElementById("background"),
        toggleLoader = () => {
            $background.classList.toggle("deactive");
            $background.classList.toggle("active");
        };
    $submitButton.onclick = event => {
        event.preventDefault();
        toggleLoader();
        const email = document.getElementById("email-input").value,
            password = document.getElementById("password-input").value;
        fetch("/login", {
            headers: {
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify({
                "email": email,
                "password": password
            })
        })
            .then(res => res.json())
            .then(res => {
                if (res.response === true) {
                    window.location.href = "/";
                } else {
                    swal("Oops!", "This is not Ok :(", "error");
                }
            })
            .finally(() => {
                setTimeout(toggleLoader(), 2000);
            });
    };
})();
