window.addEventListener("load", function () {
    let auth = document.querySelector(".Auth");
    let reg = document.querySelector(".Register");

    let showRegBtn = document.querySelector("#showReg");
    showRegBtn.addEventListener("click",function (e) {
        if(e.target.tagName = "a"){
            auth.style.display = "none";
            reg.style.display = "block";
        }
    });
    let showLoginBtn = document.querySelector("#showLogin");
    showLoginBtn.addEventListener("click",function (e) {
        if(e.target.tagName = "a"){
            reg.style.display = "none";
            auth.style.display = "block";
        }
    });
});