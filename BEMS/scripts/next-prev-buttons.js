document.querySelectorAll('.next-tab').forEach(button => {
    button.addEventListener('click', function () {
        let nextTab = document.querySelector(this.getAttribute('data-next'));
        let nextTabInstance = new bootstrap.Tab(nextTab);
        nextTabInstance.show();
    });
});
document.querySelectorAll('.prev-tab').forEach(button => {
    button.addEventListener('click', function () {
        let prevTab = document.querySelector(this.getAttribute('data-prev'));
        let prevTabInstance = new bootstrap.Tab(prevTab);
        prevTabInstance.show();
    });
});

document.getElementById('addfloors').addEventListener('click', function () {
    addFloorGroup();
});