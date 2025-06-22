document.addEventListener('DOMContentLoaded', () => {
    console.log("in js");

    const faqItems = document.querySelectorAll('.faq-item');
    const nextBtn = document.getElementById('next-button');
    const prevBtn = document.getElementById('previous-button');
    let current = 0;
    console.log(faqItems, nextBtn, prevBtn);
    console.log(current);


    function updateFAQDisplay() {
        faqItems.forEach((item, index) => {
            item.style.display = index === current ? 'block' : 'none';
        });
    }

    nextBtn.addEventListener('click', () => {
        console.log("clicked next");
        current = (current + 1) % faqItems.length;
        updateFAQDisplay();
    });

    prevBtn.addEventListener('click', () => {
        console.log("clicked previous");
        current = (current - 1 + faqItems.length) % faqItems.length;
        updateFAQDisplay();
    });
});
