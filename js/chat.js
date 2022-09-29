const form = document.querySelector('.typing-area');
const inputFeild = document.querySelector(".typing-area input[name='message']");
const searchBtn = document.querySelector('.typing-area button');
const chatBox  = document.querySelector('.chat-box');


form.onsubmit = (e) =>{
    e.preventDefault();
}



searchBtn.onclick = () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/chat.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
               inputFeild.value = "";
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}


chatBox.onmouseenter = () => {
    chatBox.classList.add('active');
}


chatBox.onmouseleave = () => {
    chatBox.classList.remove('active');
}



setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains('active')){
                    scrollToButton()

                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);

 


function scrollToButton() {
    chatBox.scrollTop = chatBox.scrollHeight;
}