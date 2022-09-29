const passField = document.querySelector(".form input[type='password']");
const showHideBtn = document.querySelector(".form .field i");

showHideBtn.onclick = ()=>{
    if(passField.type == "password"){
        passField.type = "text";
        showHideBtn.classList.add("active")
    }else{
        passField.type = "password";
        showHideBtn.classList.remove("active")

    }
}