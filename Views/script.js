document.getElementById('pasteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const text = document.getElementById('pasteText').value;
    const language = document.getElementById('languageSelect').value;
    const retention = document.getElementById('retentionSelect').value;
    const title = document.getElementById('titleInput').value;
    if (text.trim() === '') {
        alert('Please enter some text!');
    } else {
        // テキスト、選択された言語、保持期間、タイトルの処理
        console.log(`Title: ${title}`);
        console.log(`Text: ${text}`);
        console.log(`Selected Language: ${language}`);
        console.log(`Retention Period: ${retention}`);
        alert('Text submitted successfully!');
    }
});
