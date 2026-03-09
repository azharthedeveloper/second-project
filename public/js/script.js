// public/js/script.js

// Jab poora page load ho jaye tab JS chalega
document.addEventListener("DOMContentLoaded", function () {
    console.log("Website successfully load ho gayi hai!");

    // Example: Navbar links par click karne ka event
    const navLinks = document.querySelectorAll(".nav-links a");

    navLinks.forEach(function (link) {
        link.addEventListener("click", function () {
            // Aap isme aur bhi functionality add kar sakte hain
            console.log("Aapne '" + this.innerText + "' par click kiya.");
        });
    });
});