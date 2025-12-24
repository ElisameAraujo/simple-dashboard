document.addEventListener("DOMContentLoaded", function () {
    const spotlight = document.getElementById("spotlight");
    const inputFake = document.querySelector(".search-box");
    const inputReal = document.getElementById("search-input");

    function openSpotlight() {
        if (!spotlight.open) {
            spotlight.showModal();
            setTimeout(() => inputReal?.focus(), 50);
        }
    }

    // Abrir ao clicar no input fake
    inputFake?.addEventListener("click", openSpotlight);

    // Abrir com Ctrl+K
    document.addEventListener("keydown", function (e) {
        const isFormInput = ["INPUT", "TEXTAREA", "SELECT"].includes(document.activeElement.tagName);
        if (isFormInput) return;

        if (e.ctrlKey && e.key.toLowerCase() === "k") {
            e.preventDefault();
            openSpotlight();
        }
    });
});
