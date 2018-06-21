window.addEventListener("load", function () {
    let auth = document.querySelector(".Auth");
    let reg = document.querySelector(".Register");
    let resend = document.querySelector(".Resend");

    let showRegBtn = document.querySelector("#showReg");
    showRegBtn.addEventListener("click",function () {
        auth.style.display = "none";
        reg.style.display = "block";
    });
    let showLoginBtn = document.querySelector("#showLogin");
    showLoginBtn.addEventListener("click",function () {
        reg.style.display = "none";
        auth.style.display = "block";

    });

    let showResendBtn = document.querySelector("#resend");
    showResendBtn.addEventListener("click", function () {
        auth.style.display = "none";
        resend.style.display = "block";
    });

    let back = document.querySelector("#back");
    back.addEventListener("click", function () {
        auth.style.display = "block";
        resend.style.display = "none";

    });
});