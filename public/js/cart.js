document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cart-item-card').forEach(function(card) {
        const itemId = card.dataset.itemId;
        const offerText = card.querySelector('[data-field="cart_offer_details"]');
        const offerTextarea = card.querySelector('[data-field="cart_offer_details_edit"]');
        const editButton = card.querySelector('.edit-button');
        const saveButton = card.querySelector('.save-button');
        const cancelButton = card.querySelector('.cancel-button');
        const deleteButton = card.querySelector('.delete-button'); 

        // Function to toggle between view and edit mode
        function toggleEditMode(isEditing) {
            if (isEditing) {
                offerText.classList.add('hidden');
                offerTextarea.classList.remove('hidden');
                editButton.classList.add('hidden');
                saveButton.classList.remove('hidden');
                cancelButton.classList.remove('hidden');
                offerTextarea.focus(); 
                deleteButton.classList.add('hidden'); 
            } else {
                offerText.classList.remove('hidden');
                offerTextarea.classList.add('hidden');
                editButton.classList.remove('hidden');
                saveButton.classList.add('hidden');
                cancelButton.classList.add('hidden');
                deleteButton.classList.remove('hidden');
            }
        }

        toggleEditMode(false);

        // Event listener for Edit button
        editButton.addEventListener('click', function(e) {
            e.preventDefault(); 
            toggleEditMode(true);
        });

        // Event listener for Cancel button
        cancelButton.addEventListener('click', function(e) {
            e.preventDefault();
            offerTextarea.value = offerText.textContent; 
            toggleEditMode(false);
        });

        // Event listener for Save button
        saveButton.addEventListener('click', async function(e) {
            e.preventDefault();

            const newOfferDetails = offerTextarea.value;
            
            offerText.textContent = newOfferDetails;
            toggleEditMode(false);


            const baseUrl = window.BASE_URL || '/talent-portal/public/'; 

            // Send data to PHP backend via Fetch API
            try {
                const response = await fetch(`${baseUrl}index.php?page=cart&action=update_item_offer_details`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `item_id=${encodeURIComponent(itemId)}&offer_details=${encodeURIComponent(newOfferDetails)}`
                });

                if (response.ok) {
                    try {
                        const result = await response.json();

                    } catch (jsonError) {
                        console.error('JSON parsing error:', jsonError);

                        offerTextarea.value = offerText.textContent; 
                        offerText.textContent = offerTextarea.value;
                    }
                } else {
                    console.error('Network response was not ok:', response.status, response.statusText);

                    offerTextarea.value = offerText.textContent; 
                    offerText.textContent = offerTextarea.value;
                }
            } catch (error) {
                console.error('Fetch error:', error);

                offerTextarea.value = offerText.textContent; 
                offerText.textContent = offerTextarea.value;
            }
        });
    });
});
