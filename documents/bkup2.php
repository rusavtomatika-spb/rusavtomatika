<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Система резервного копирования</title>
    <style>
        :root {
            --primary: #2563eb;
            --success: #10b981;
            --background: #f8fafc;
        }

        body {
            font-family: 'Segoe UI', system-ui;
            background: var(--background);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .backup-form {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        h1 {
            color: #1e293b;
            margin-top: 0;
            font-size: 1.8rem;
        }

        .form-group {
            margin: 1.5rem 0;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #475569;
            font-weight: 500;
        }

        select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
        }

        .checkbox-group {
            width: auto;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
        }

        select:focus, input[type="checkbox"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }

        .checkbox-group {
            display: grid;
            gap: 1rem;
            padding: 1rem;
            background: #f9fafb;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        input[type="checkbox"] {
            width: 1.2rem;
            height: 1.2rem;
            accent-color: var(--success);
        }

        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1.05rem;
            cursor: pointer;
            transition: transform 0.1s, opacity 0.2s;
            width: 100%;
            margin-top: 1rem;
        }

        button:hover {
            opacity: 0.9;
        }

        button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <form class="backup-form" method="POST" action="/backup-handler.php">
        <h1>Создание резервной копии</h1>
        
        <div class="form-group">
            <label for="site">Выберите сайт:</label>
            <select id="site" name="site" required>
                <option value="">-- Выберите сайт --</option>
                <option value="site1">rusavto.moisait.net</option>
                <option value="site2">weintek.net</option>
            </select>
        </div>

        <div class="form-group">
            <label>Выберите действия:</label>
            <div class="checkbox-group">
                <label class="checkbox-item">
                    <input type="checkbox" name="actions[]" value="files" required>
                    Бэкап файлов
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" name="actions[]" value="database">
                    Бэкап базы данных
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" name="actions[]" value="both">
                    Оба варианта
                </label>
            </div>
        </div>

        <button type="submit">Создать резервную копию</button>
    </form>
</body>
</html>