function checkOrientation() {
    const isPanier = window.location.href.includes("uc=admin_connection");
    const isNarrow = window.innerWidth <= 900;
    const rotateDevice = document.getElementById("rotate-device");

    if (isPanier && isNarrow) {
        rotateDevice.style.display = "flex";
    } else {
        rotateDevice.style.display = "none";
    }
}

window.addEventListener("load", checkOrientation);
window.addEventListener("resize", checkOrientation);
window.addEventListener("orientationchange", checkOrientation);
