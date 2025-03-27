document.querySelectorAll(".thumbnail").forEach(img => {
    img.addEventListener("click", function () {
        document.getElementById("mainImage").src = this.src;
        document.querySelectorAll(".thumbnail").forEach(t => t.classList.remove("active"));
        this.classList.add("active");
    });
});
