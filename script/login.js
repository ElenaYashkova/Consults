window.addEventListener("load", function () {
    let auth = document.querySelector(".Auth");
    let reg = document.querySelector(".Register");
    let resend = document.querySelector(".Resend");
    let btnBack=resend.querySelector(".btnBack");

    let showRegBtn = document.querySelector("#showReg");
    showRegBtn.addEventListener("click",function (e) {
        if(e.target.tagName = "a"){
            auth.style.display = "none";
            reg.style.display = "block";
        }
    });
    let showLoginBtn = document.querySelector(".showLogin");
    showLoginBtn.addEventListener("click",function (e) {
        if(e.target.tagName = "a"){
            reg.style.display = "none";
            resend.style.display = "none";
            auth.style.display = "block";
        }
    });

    let showResendBtn = document.querySelector("#resend");
    showResendBtn.addEventListener("click", function (e) {
        if(e.target.tagName = "a"){
            auth.style.display = "none";
            resend.style.display = "block";
        }
    });

    btnBack.addEventListener("click",function (evt) {
        auth.style.display = "block";
        resend.style.display = "none";
    })
});