document.addEventListener('DOMContentLoaded', function () {
    const userProfile = document.getElementById('userProfile');
    const userDropdown = document.getElementById('userDropdown');

    if (userProfile && userDropdown) {
        // Toggle dropdown on profile click
        userProfile.addEventListener('click', function (e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!userProfile.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });

        // Prevent closing when clicking inside the dropdown
        userDropdown.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    }
});
