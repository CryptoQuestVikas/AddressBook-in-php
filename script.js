document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contact-form');
    const contactList = document.getElementById('contact-list');
    const formMessage = document.getElementById('form-message');

    // Load contacts on page load
    loadContacts();

    contactForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;
        const email = document.getElementById('email').value;

        fetch('add_contact.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `name=${encodeURIComponent(name)}&phone=${encodeURIComponent(phone)}&email=${encodeURIComponent(email)}`
        })
        .then(response => response.text())
        .then(result => {
            formMessage.textContent = result;
            formMessage.style.color = '#5bc0de';
            contactForm.reset();
            loadContacts();
        })
        .catch(error => {
            formMessage.textContent = 'Error: ' + error;
            formMessage.style.color = '#d9534f';
        });
    });

    // Function to load contacts
    function loadContacts() {
        fetch('get_contacts.php')
        .then(response => response.text())
        .then(result => {
            contactList.innerHTML = result;
        })
        .catch(error => console.error('Error:', error));
    }

    // Function to delete contact
    window.deleteContact = function(contactId) {
        fetch('delete_contact.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `contact_id=${contactId}`
        })
        .then(response => response.text())
        .then(result => {
            alert(result);
            loadContacts();
        })
        .catch(error => console.error('Error:', error));
    };
});
