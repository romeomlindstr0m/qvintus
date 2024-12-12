document.addEventListener("DOMContentLoaded", () => {
    const notificationComponent = document.getElementById("notification");

    if (notificationComponent) {
        notificationComponent.classList.remove("hidden");
        setTimeout(() => {
            notificationComponent.classList.add("hidden");
        }, 5000);
    }
});