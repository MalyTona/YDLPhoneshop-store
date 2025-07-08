import "./bootstrap";
import "preline";

// Function to initialize all event listeners
function initializeHeaderEvents() {
    // Mobile hamburger menu toggle functionality
    const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
    const navbarCollapse = document.getElementById(
        "navbar-collapse-with-animation"
    );
    const hamburgerIcon = document.getElementById("hamburger-icon");
    const closeIcon = document.getElementById("close-icon");

    if (mobileMenuToggle && navbarCollapse && hamburgerIcon && closeIcon) {
        // Remove existing event listeners to prevent duplicates
        const newMobileMenuToggle = mobileMenuToggle.cloneNode(true);
        mobileMenuToggle.parentNode.replaceChild(
            newMobileMenuToggle,
            mobileMenuToggle
        );

        // Get the new elements after replacement
        const finalMobileMenuToggle =
            document.getElementById("mobile-menu-toggle");
        const finalHamburgerIcon = document.getElementById("hamburger-icon");
        const finalCloseIcon = document.getElementById("close-icon");

        finalMobileMenuToggle.addEventListener("click", function () {
            const isHidden = navbarCollapse.classList.contains("hidden");

            if (isHidden) {
                // Show menu
                navbarCollapse.classList.remove("hidden");
                finalHamburgerIcon.classList.add("hidden");
                finalCloseIcon.classList.remove("hidden");
                finalMobileMenuToggle.setAttribute("aria-expanded", "true");
            } else {
                // Hide menu
                navbarCollapse.classList.add("hidden");
                finalHamburgerIcon.classList.remove("hidden");
                finalCloseIcon.classList.add("hidden");
                finalMobileMenuToggle.setAttribute("aria-expanded", "false");
            }
        });
    }

    // Mobile search toggle functionality
    const mobileSearchToggle = document.getElementById("mobile-search-toggle");
    const mobileSearchBar = document.getElementById("mobile-search-bar");
    const mobileSearchInput = document.getElementById("mobile-search-input");

    if (mobileSearchToggle && mobileSearchBar && mobileSearchInput) {
        // Remove existing event listeners to prevent duplicates
        const newMobileSearchToggle = mobileSearchToggle.cloneNode(true);
        mobileSearchToggle.parentNode.replaceChild(
            newMobileSearchToggle,
            mobileSearchToggle
        );

        const finalMobileSearchToggle = document.getElementById(
            "mobile-search-toggle"
        );

        finalMobileSearchToggle.addEventListener("click", function () {
            if (mobileSearchBar.classList.contains("hidden")) {
                mobileSearchBar.classList.remove("hidden");
                mobileSearchInput.focus();
            } else {
                mobileSearchBar.classList.add("hidden");
            }
        });
    }

    // Desktop search clear button functionality
    const desktopSearchInput = document.getElementById("desktop-search-input");
    const clearDesktopBtn = document.getElementById("clear-desktop-search");

    if (desktopSearchInput && clearDesktopBtn) {
        desktopSearchInput.addEventListener("input", function () {
            if (this.value.length > 0) {
                clearDesktopBtn.style.display = "flex";
            } else {
                clearDesktopBtn.style.display = "none";
            }
        });
    }

    // Handle search form submissions
    document.querySelectorAll('form[action="/search"]').forEach((form) => {
        form.addEventListener("submit", function (e) {
            const searchInput = this.querySelector('input[name="q"]');
            if (!searchInput.value.trim()) {
                e.preventDefault();
                searchInput.focus();
            }
        });
    });

    // Close mobile search when clicking outside
    document.addEventListener("click", function (e) {
        const searchBar = document.getElementById("mobile-search-bar");
        const searchToggle = document.getElementById("mobile-search-toggle");

        if (
            searchBar &&
            searchToggle &&
            !searchBar.contains(e.target) &&
            !searchToggle.contains(e.target)
        ) {
            searchBar.classList.add("hidden");
        }
    });

    // Close mobile menu when clicking on navigation links
    document
        .querySelectorAll("#navbar-collapse-with-animation a[wire\\:navigate]")
        .forEach((link) => {
            link.addEventListener("click", function () {
                const navbarCollapse = document.getElementById(
                    "navbar-collapse-with-animation"
                );
                const hamburgerIcon = document.getElementById("hamburger-icon");
                const closeIcon = document.getElementById("close-icon");
                const mobileMenuToggle =
                    document.getElementById("mobile-menu-toggle");

                if (
                    navbarCollapse &&
                    hamburgerIcon &&
                    closeIcon &&
                    mobileMenuToggle
                ) {
                    navbarCollapse.classList.add("hidden");
                    hamburgerIcon.classList.remove("hidden");
                    closeIcon.classList.add("hidden");
                    mobileMenuToggle.setAttribute("aria-expanded", "false");
                }
            });
        });
}

// Clear desktop search function
function clearDesktopSearch() {
    const input = document.getElementById("desktop-search-input");
    const clearBtn = document.getElementById("clear-desktop-search");
    if (input && clearBtn) {
        input.value = "";
        input.focus();
        clearBtn.style.display = "none";
    }
}

// Initialize on page load
document.addEventListener("DOMContentLoaded", initializeHeaderEvents);

// Re-initialize after Livewire navigation
document.addEventListener("livewire:navigated", initializeHeaderEvents);

// Fallback for older Livewire versions
if (typeof Livewire !== "undefined") {
    Livewire.hook("message.processed", () => {
        setTimeout(initializeHeaderEvents, 100);
    });
}
