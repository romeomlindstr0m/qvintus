document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        const notification = document.querySelector(".notification-container");
        if (notification) {
            notification.classList.add("opacity-0", "translate-y-2");

            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    }, 5000);
});