document.addEventListener('DOMContentLoaded', function() {
    // Optional: Add click functionality for mobile
    const menuItems = document.querySelectorAll('.menu-item');
    
    menuItems.forEach(item => {
        const title = item.querySelector('.menu-title');
        
        title.addEventListener('click', () => {
            // Remove active class from all other items
            menuItems.forEach(otherItem => {
                if(otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle active class on clicked item
            item.classList.toggle('active');
        });
    });
});