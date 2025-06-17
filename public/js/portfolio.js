

function editMode(){
    const containers = document.querySelectorAll('.talent-container');
    containers.forEach(container => {
        container.classList.add("edit-mode");
    });
}