document.addEventListener('DOMContentLoaded', function () {
    const showMoreButton = document.getElementById('show-more-comments');
    if (showMoreButton) {
        showMoreButton.addEventListener('click', function() {
            document.querySelectorAll('.comentario.oculto').forEach(function(comment) {
                comment.style.display = 'block';
            });
            showMoreButton.style.display = 'none';
        });
    }
});
