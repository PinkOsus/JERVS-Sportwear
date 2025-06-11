const toggle = document.querySelector(".toggle");
const menu = document.querySelector(".nav-menu");
const overlay = document.createElement("div");
overlay.classList.add("overlay");
document.body.appendChild(overlay);

function toggleMenu() {
    menu.classList.toggle("active");
    overlay.classList.toggle("active");
    
    // Change icon
    if (menu.classList.contains("active")) {
        toggle.innerHTML = `<i class="fa fa-times"></i>`;
    } else {
        toggle.innerHTML = `<i class="fa fa-bars"></i>`;
    }
}

toggle.addEventListener("click", toggleMenu, false);

overlay.addEventListener("click", toggleMenu);

// Close menu when clicking a nav item
document.querySelectorAll(".nav-item a").forEach(item => {
    item.addEventListener("click", function() {
        if (window.innerWidth <= 768) {
            toggleMenu();
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Video Controls
    const video = document.getElementById('heroVideo');
    const playPauseBtn = document.getElementById('playPauseBtn');
    const muteBtn = document.getElementById('muteBtn');
    const loopBtn = document.getElementById('loopBtn');
    
    // Ensure video plays when loaded
    video.addEventListener('loadedmetadata', function() {
        video.play().catch(e => console.log('Autoplay prevented:', e));
    });
    
    // Play/Pause toggle
    playPauseBtn.addEventListener('click', function() {
        if (video.paused) {
            video.play();
            playPauseBtn.innerHTML = '<i class="fa fa-pause"></i>';
        } else {
            video.pause();
            playPauseBtn.innerHTML = '<i class="fa fa-play"></i>';
        }
    });
    
    // Mute toggle
    muteBtn.addEventListener('click', function() {
        video.muted = !video.muted;
        muteBtn.innerHTML = video.muted ? 
            '<i class="fa fa-volume-off"></i>' : 
            '<i class="fa fa-volume-up"></i>';
    });
    
    // Loop toggle
    loopBtn.addEventListener('click', function() {
        video.loop = !video.loop;
        loopBtn.classList.toggle('active');
        loopBtn.innerHTML = video.loop ? 
            '<i class="fa fa-repeat"></i> Looping' : 
            '<i class="fa fa-repeat"></i> Loop';
    });
    
    // Update play/pause button when video ends
    video.addEventListener('ended', function() {
        if (!video.loop) {
            playPauseBtn.innerHTML = '<i class="fa fa-play"></i>';
        }
    });
    
    // For mobile devices - ensure video plays when interacted with
    video.addEventListener('touchstart', function() {
        video.play();
    });
});

// Preview images for the same product slider
var prodImg = document.getElementById("prodImg");
var smallImg = document.getElementsByClassName("small-img");
smallImg[0].onclick = function () {
    prodImg.src = smallImg[0].src;
}
smallImg[1].onclick = function () {
    prodImg.src = smallImg[1].src;
}
smallImg[2].onclick = function () {
    prodImg.src = smallImg[2].src;
}
smallImg[3].onclick = function () {
    prodImg.src = smallImg[3].src;
}
