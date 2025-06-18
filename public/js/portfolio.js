
console.log("in js");
let editModeFlag=false;

function editMode(){
    const containers = document.querySelectorAll('.talent-container');
    const add_button=document.getElementById("add-talent-button");
    console.log(add_button);
    if(editModeFlag){
        console.log("editmode true");
        editModeFlag=false;
        containers.forEach(container => {
            container.classList.remove("edit-mode");
        });
        add_button.classList.remove("disabled-link");
        add_button.onclick=null;

        return;
    }
    console.log("editmode false");
    editModeFlag=true;
    containers.forEach(container=>{
        container.classList.add("edit-mode");
    });
    
    add_button.classList.add("disabled-link");
    add_button.onclick=function(e){
        e.preventDefault(); //prevent navigation on a element
    };

}

function previewMedia(event) { // preview media after user uploads something within the add talent form
    const file_input=event.target;
    const preview_container=document.getElementById('new-media-preview');
    preview_container.innerHTML='';

    if(!file_input.files.length){
        return;
    }
        
    const file=file_input.files[0];
    const url=URL.createObjectURL(file);
    const type=file.type;

    if(type.startsWith('image/')) {
        const img=document.createElement('img');
        img.src=url;
        preview_container.appendChild(img);
    }else if(type.startsWith('video/')) {
        const video = document.createElement('video');
        video.src=url;
        video.controls=true;
        preview_container.appendChild(video);
    }else if(type.startsWith('audio/')) {
        const audio = document.createElement('audio');
        audio.src=url;
        audio.controls=true;
        preview_container.appendChild(audio);
    }else {
        preview_container.textContent = 'Unsupported media type';
    }
}

document.addEventListener('DOMContentLoaded', function(){
    const talent_cards=document.querySelectorAll('.talent-search-result-card');
    talent_cards.forEach(card=>{
        card.addEventListener('click', function(e){
            e.preventDefault();

            // get the custom html tags for edit and view
            const view_url=card.getAttribute('data-view-url');
            const edit_url=card.getAttribute('data-edit-url');

            if(editModeFlag){
                window.location.href=edit_url; // if in edit mode go to the edit talent form
            }else{
                window.location.href=view_url; // if not in edit mode go to the view talent
            }
        });
    });

    const mediaInput = document.getElementById('Content');
    if(mediaInput){
        mediaInput.addEventListener('change', function(event){
            previewMedia(event);
        });

        if(mediaInput.files.length>0){
            previewMedia({ target: mediaInput });
        }
    }
});