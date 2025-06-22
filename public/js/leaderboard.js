document.addEventListener('DOMContentLoaded', function() {
    const filterDropdown = document.querySelector('.filter-dropdown');
    filterDropdown.addEventListener('change', function() {
        const selectedCategory = this.value;
        let url = '<?= BASE_URL ?>index.php?page=leaderboard';
        if (selectedCategory) {
            url += '&category=' + encodeURIComponent(selectedCategory);
        }
        window.location.href = url;
    });
});