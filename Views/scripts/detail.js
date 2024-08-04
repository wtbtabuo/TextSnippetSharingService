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
        const expiredAt = data.textSnippet.expired_at;
        
        if (expiredAt !== null) {
            const expiredDate = new Date(expiredAt.replace(" ", "T"));
            const adjustedExpiredDate = new Date(expiredDate.getTime() + 9 * 60 * 60 * 1000);
            const now = new Date(Date.now());

            if (adjustedExpiredDate < now) {
                document.querySelector('section').innerHTML = "<p>Expired Retention Period</p>";
                return;
            }
        }

        const codeElement = document.getElementById('text');
        codeElement.textContent = data.textSnippet.code;
        const languageClass = `language-${data.textSnippet.code_language}`;
        codeElement.classList.add(languageClass);
        document.getElementById('title').innerText = "Title: " + data.textSnippet.title;
        document.getElementById('codeType').innerText = "code type: " + data.textSnippet.code_language;
        hljs.highlightElement(codeElement);
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('There was an error retrieving the data.');
    });
});
