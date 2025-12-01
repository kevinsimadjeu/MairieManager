const toggle = document.getElementById("toggleActe");
        const submenu = document.getElementById("submenuActe");

        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            submenu.style.display =
                submenu.style.display === "block" ? "none" : "block";}
    )
    
    const menuToggle = document.getElementById("menuToggle");
    const sidebar = document.querySelector(".sidebar");

    menuToggle.addEventListener("click", () => {
        sidebar.classList.toggle("show");});