<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка изображений на FTP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        .info-box { background: #f4f4f4; padding: 20px; border-radius: 5px; }
        .server-info { background: #e8f4f8; padding: 10px; margin-bottom: 20px; border-left: 4px solid #4CAF50; }
        .ip { font-size: 24px; color: #333; font-weight: bold; }
        .details { margin-top: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .alert { padding: 12px; border-radius: 4px; margin:15px;}
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 4px; }
        .upload-item { margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #ddd; }
        .thumbnail { width: 85px; height: auto; border: 1px solid #ccc; margin-right: 15px; vertical-align: middle; }
        .path { word-break: break-all; cursor: pointer; color: #4CAF50; font-weight: bold; }
    </style>
</head>
<body>
    <div class="info-box">
        
        <h2>Загрузка изображений</h2>
        
        <form id="uploadForm" enctype="multipart/form-data">
            <label for="subdir">Подкаталог для загрузки:</label><br>
            <input type="text" id="subdir" name="subdir" required placeholder="например, events/2024"><br><br>
            
            <label for="files">Выберите изображения (можно несколько):</label><br>
            <input type="file" id="files" name="files[]" multiple required><br><br>
            
            <button type="submit">Отправить на сервер</button>
        </form>

        <div id="progress" class="alert"></div>

        <div id="results"></div>
        
        <p><small><?php echo date('Y-m-d H:i:s'); ?></small></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="upload.js"></script>
</body>
</html>