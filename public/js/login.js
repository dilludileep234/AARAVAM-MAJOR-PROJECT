const wrapper = document.querySelector(".wrapper");
const registerLink = document.querySelector(".register-link");
const loginLink = document.querySelector(".login-link");

registerLink.onclick = () => {
    wrapper.classList.add("active");
    clearErrors();
};

loginLink.onclick = () => {
    wrapper.classList.remove("active");
    clearErrors();
};

function clearErrors() {
    const alertError = document.querySelector(".alert-error");
    if (alertError) {
        alertError.style.display = 'none';
    }
    const loginBox = document.querySelector(".form-box.login");
    if (loginBox) {
        loginBox.classList.remove("shake");
    }
}
