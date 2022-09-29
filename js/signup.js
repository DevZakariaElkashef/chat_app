const form = document.querySelector(".signup form");
const continueBtn = document.querySelector("form input[type='submit']");
const errorText = document.querySelector("form .error-text");
const successText = document.querySelector('#success');

form.onsubmit = (e) =>{
    e.preventDefault();
}


continueBtn.onclick = () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    window.location.href = 'http://localhost/chat_application/login.php';
                } else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}