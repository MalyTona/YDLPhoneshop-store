// Enhanced search functionality
document.addEventListener("DOMContentLoaded", () => {
    // Mobile search toggle
    const mobileSearchToggle = document.getElementById("mobile-search-toggle");
    const mobileSearchBar = document.getElementById("mobile-search-bar");
    const mobileSearchInput = document.getElementById("mobile-search-input");

    if (mobileSearchToggle && mobileSearchBar) {
        mobileSearchToggle.addEventListener("click", () => {
            mobileSearchBar.classList.toggle("hidden");
            if (!mobileSearchBar.classList.contains("hidden")) {
                mobileSearchInput.focus();
            }
        });
    }

    // Desktop search clear functionality
    const desktopSearchInput = document.getElementById("desktop-search-input");
    const clearDesktopSearch = document.getElementById("clear-desktop-search");

    if (desktopSearchInput && clearDesktopSearch) {
        desktopSearchInput.addEventListener("input", function () {
            if (this.value.length > 0) {
                clearDesktopSearch.style.display = "flex";
            } else {
                clearDesktopSearch.style.display = "none";
            }
        });
    }

    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
    const navbarCollapse = document.getElementById(
        "navbar-collapse-with-animation"
    );
    const hamburgerIcon = document.getElementById("hamburger-icon");
    const closeIcon = document.getElementById("close-icon");

    if (mobileMenuToggle && navbarCollapse) {
        mobileMenuToggle.addEventListener("click", () => {
            navbarCollapse.classList.toggle("hidden");
            hamburgerIcon.classList.toggle("hidden");
            closeIcon.classList.toggle("hidden");
        });
    }
});

// Clear desktop search function
function clearDesktopSearch() {
    const desktopSearchInput = document.getElementById("desktop-search-input");
    const clearDesktopSearch = document.getElementById("clear-desktop-search");

    if (desktopSearchInput) {
        desktopSearchInput.value = "";
        desktopSearchInput.focus();
        clearDesktopSearch.style.display = "none";
    }
}
