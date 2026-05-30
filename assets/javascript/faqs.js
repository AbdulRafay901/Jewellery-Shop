// FAQS PAGE --- Start

document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const accordionItem = button.parentElement;
        const isOpen = accordionItem.classList.contains('active');


        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
            const icon = item.querySelector('i');
            icon.classList.remove('ri-subtract-line');
            icon.classList.add('ri-add-line');
        });


        if (!isOpen) {
            accordionItem.classList.add('active');
            const icon = button.querySelector('i');
            icon.classList.remove('ri-add-line');
            icon.classList.add('ri-subtract-line');
        }
    });
});


// FAQS PAGE --- End