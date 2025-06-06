document.getElementById("addUserForm").addEventListener("submit", function(e){
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../../Controller/add_member.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        const feedback = document.getElementById("addUserMessage");

        if(data.success){
            feedback.innerText = "Member added Successfully";
            feedback.style.color = "green";

            window.location.reload;
        }else{
            feedback.innerText = "Member adding failed: " + data.message;
            feedback.style.color = "red";
        }
    })
    .catch(error => {
        console.log("An error occured in ", error);
    });
});
//button for adding
document.getElementById("openAddMemberBtn").addEventListener("click", function () {
  const panel = document.getElementById("addMemberPanel");
  // Toggle visibility
  panel.style.display = panel.style.display === "none" ? "block" : "none";
});
