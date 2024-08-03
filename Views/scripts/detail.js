document.addEventListener('DOMContentLoaded', function() {
    // URLからUIDを取得
    const urlParams = new URLSearchParams(window.location.search);
    const uid = urlParams.get('uid');

    // GETリクエストでデータを取得
    fetch(`http://127.0.0.1:8000/api/textSnippet/text?uid=${uid}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // 取得したデータを表示
        document.getElementById('title').innerText = data.title;
        document.getElementById('text').innerText = data.text;
        document.getElementById('language').innerText = data.language;
        document.getElementById('retention').innerText = data.retention;
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('There was an error retrieving the data.');
    });
});
