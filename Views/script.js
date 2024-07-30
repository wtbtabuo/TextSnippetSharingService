document.getElementById('pasteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const text = document.getElementById('pasteText').value;
    const language = document.getElementById('languageSelect').value;
    const retention = document.getElementById('retentionSelect').value;
    const title = document.getElementById('titleInput').value;
    const uid = uuid.v4();

    if (text.trim() === '') {
        alert('Please enter some text!');
    } else {
        console.log(`UID: ${uid}`); // UUIDを出力
        console.log(`Title: ${title}`);
        console.log(`Text: ${text}`);
        console.log(`Selected Language: ${language}`);
        console.log(`Retention Period: ${retention}`);
        alert(`Text submitted successfully! UUID: ${uid}`);
    }
});
