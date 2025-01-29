document.addEventListener("DOMContentLoaded", function () {
    // Mobile Menu
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener("click", function () {
            const isExpanded = mobileMenuButton.getAttribute("aria-expanded") === "true";
            mobileMenuButton.setAttribute("aria-expanded", !isExpanded);
            mobileMenu.classList.toggle("hidden");
        });
    }

    // Profile Dropdown Menu
    const profileButton = document.getElementById("user-menu-button");
    const profileMenu = document.getElementById("profile-menu");

    if (profileButton && profileMenu) {
        profileButton.addEventListener("click", function () {
            const isExpanded = profileButton.getAttribute("aria-expanded") === "true";
            profileButton.setAttribute("aria-expanded", !isExpanded);
            profileMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function (event) {
            if (!profileButton.contains(event.target) && !profileMenu.contains(event.target)) {
                profileMenu.classList.add("hidden");
                profileButton.setAttribute("aria-expanded", "false");
            }
        });
    }

    // Dashboard Flyout Menu with Animation
    const dashboardMenuButton = document.getElementById("dashboard-menu-button");
    const flyoutMenu = document.getElementById("dashboard-flyout-menu");

    if (dashboardMenuButton && flyoutMenu) {
        dashboardMenuButton.addEventListener("click", function () {
            const isExpanded = dashboardMenuButton.getAttribute("aria-expanded") === "true";
            dashboardMenuButton.setAttribute("aria-expanded", !isExpanded);

            if (!isExpanded) {
                flyoutMenu.classList.remove("hidden");
                flyoutMenu.classList.add("opacity-0", "-translate-y-2");

                setTimeout(() => {
                    flyoutMenu.classList.remove("opacity-0", "-translate-y-2");
                    flyoutMenu.classList.add("opacity-100", "translate-y-0");
                }, 10);
            } else {
                flyoutMenu.classList.remove("opacity-100", "translate-y-0");
                flyoutMenu.classList.add("opacity-0", "-translate-y-2");

                setTimeout(() => {
                    flyoutMenu.classList.add("hidden");
                }, 200);
            }
        });

        document.addEventListener("click", function (event) {
            if (!dashboardMenuButton.contains(event.target) && !flyoutMenu.contains(event.target)) {
                flyoutMenu.classList.remove("opacity-100", "translate-y-0");
                flyoutMenu.classList.add("opacity-0", "-translate-y-2");

                setTimeout(() => {
                    flyoutMenu.classList.add("hidden");
                }, 200);
                
                dashboardMenuButton.setAttribute("aria-expanded", "false");
            }
        });
    }
});
