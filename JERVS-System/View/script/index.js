document.getElementById("loginForm").addEventListener("submit", function (e){
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../../Controller/login.php",{
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const messageBox = document.getElementById("message");
        
        if(data.success){//if login success go to admin
            messageBox.innerText = "Login Successful";
            
            window.location.href = "dashboard.php";
        }else{
            messageBox.innerText = "Login failed: " + data.message;
        }
    })
    .catch(error => {
        console.log("An error occured in ", error);
    })
});