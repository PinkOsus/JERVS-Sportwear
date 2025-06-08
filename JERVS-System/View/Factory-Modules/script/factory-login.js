document.getElementById("loginForm-Member").addEventListener("submit", function (e){
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../../Controller/factory_login.php",{
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const messageBox = document.getElementById("message");
        
        if(data.success){//if login success go to admin
            messageBox.innerText = "Login Successful";
            messageBox.style.color = "green";

            window.location.href = "factory-system.php";
        }else{
            messageBox.innerText = "Login failed: " + data.message;
            messageBox.style.color = "red";
        }
    })
    .catch(error => {
        console.log("An error occured in ", error);
    })
});