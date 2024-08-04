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
        const codeElement = document.getElementById('text');
        codeElement.textContent = data.textSnippet.code;

        const languageClass = `language-${data.textSnippet.code_language}`;
        // const languageClass = 'plaintext';
        codeElement.classList.add(languageClass);

        document.getElementById('title').innerText = "Title: " + data.textSnippet.title;
        document.getElementById('retention').innerText = "Delete Time: " + data.textSnippet.expired_at;

        hljs.highlightElement(codeElement);
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('There was an error retrieving the data.');
    });
});
