$(document).ready(function() {
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = (evt.loaded / evt.total) * 100;
                        $('#progress').html(`Прогресс загрузки файлов на сервер... ${Math.round(percentComplete)}%`);
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                $('#progress').html('');
                let data = JSON.parse(response);
                if (data.success) {
                    let html = '';
                    data.files.forEach(file => {
                        html += `<div class="upload-item">
                            <img src="${file.path}" class="thumbnail" alt="${file.name}">
                            <span class="path" onclick="copyToClipboard('${file.path}')">${file.path}</span>
                        </div>`;
                    });
                    $('#results').html(html);
                } else {
                    $('#results').html(`<div class="error">Ошибка загрузки файлов.</div>`);
                }
            },
            error: function() {
                $('#results').html(`<div class="error">Ошибка сервера при обработке запроса.</div>`);
            }
        });
    });
});

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Путь скопирован в буфер обмена!');
    }, function(err) {
        console.error('Не удалось скопировать текст:', err);
    });
}