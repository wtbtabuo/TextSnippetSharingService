document.getElementById('pasteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const text = document.getElementById('pasteText').value.trim();
    const language = document.getElementById('languageSelect').value;
    let retention = document.getElementById('retentionSelect').value;
    const title = document.getElementById('titleInput').value.trim();
    const uid = uuid.v4();

    // 入力チェック
    if (text === '') {
        alert('Please enter some text!');
    } else if (title === '') {
        alert('Please enter a title!');
    } else if (language === '') {
        alert('Please select a language!');
    } else if (retention === '') {
        alert('Please select a retention period!');
    } else {
        // Retentionを処理
        if (retention === '15min') {
            retention = new Date(Date.now() + 15 * 60000).toISOString().slice(0, 19); // 15分後
        } else if (retention === '1hour') {
            retention = new Date(Date.now() + 60 * 60000).toISOString().slice(0, 19); // 1時間後
        } else if (retention === '1day') {
            retention = new Date(Date.now() + 24 * 60 * 60000).toISOString().slice(0, 19); // 1日後
        } else if (retention === 'forever') {
            retention = null; // 'keep forever'の場合はnullに設定
        }

        const data = {
            uid: uid,
            title: title,
            text: text,
            language: language,
            retention: retention
        };

        fetch('http://127.0.0.1:8000/api/textSnippet', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert('Text submitted successfully!');
            // detail.htmlに遷移
            window.location.href = `http://localhost:5500/Views/detail.html?uid=${uid}`;
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('There was an error submitting the text.');
        });
    }
});
