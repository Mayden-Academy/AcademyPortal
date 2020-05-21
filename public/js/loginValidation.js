let isValidEmail = (inputEmail) => {
    let email = inputEmail.trim()
    // email regex from http://emailregex.com - "Email Address Regular Expression That 99.99% Works."
    let regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regEx.test(email)
}

let validateEmail = (cleanedEmailInput, cleanedPasswordInput) => {
    let userEmailWarning = document.getElementById('userEmailWarning')
    if (isValidEmail(cleanedEmailInput)) {
        userEmailWarning.classList.remove('error')
        return {'userEmail' : cleanedEmailInput, 'password': cleanedPasswordInput}
    } else {
        return false
    }
}

let jsonRequest = async (path, data) => {
    let response =  await fetch(`./api/${path}`,
        {
            credentials: "same-origin",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            method: "POST",
            body: JSON.stringify(data)
        })
        .then(data => data.json())
        return response;
}

let loginForm = document.getElementById('loginForm')
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault()
    let response = false
    let cleanedEmailInput = encodeURI(document.getElementById('userEmail').value)
    let cleanedPasswordInput = encodeURI(document.getElementById('password').value)
    let validInputs = validateEmail(cleanedEmailInput, cleanedPasswordInput)
    if (validInputs) {
        response = await jsonRequest('login', validInputs)
    } 
    if (response && response['success'] === true) {
        window.location.href = "./admin"
    } else {
        let responseMessage = 'Incorrect email or password'
        document.getElementById("error-message").textContent = responseMessage
    }
})

