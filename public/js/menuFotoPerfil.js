document.addEventListener('DOMContentLoaded', function() {
    const profileImage = document.querySelector('.profile-image');
    const dropdownContent = document.querySelector('.dropdown-content');

    profileImage.addEventListener('click', function(event) {
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        event.stopPropagation(); // Prevenir propagación para que no se cierre inmediatamente
    });

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.profile-menu')) {
            dropdownContent.style.display = 'none';
        }
    });
});
