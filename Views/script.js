document.getElementById('pasteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const text = document.getElementById('pasteText').value;
    if (text.trim() === '') {
        alert('Please enter some text!');
    } else {
        // Here you would handle the text, e.g., send it to a server
        console.log(text);
        alert('Text submitted successfully!');
    }
});
