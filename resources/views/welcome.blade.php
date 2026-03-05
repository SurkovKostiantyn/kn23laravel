<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ласкаво просимо до Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 2rem 1rem;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background-color: white;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width: 48rem;
            width: 100%;
        }
        .header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e5e7eb;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #ef4444;
        }
        h2 {
            font-size: 1.75rem;
            color: #111827;
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 0.5rem;
        }
        h3 {
            font-size: 1.25rem;
            color: #374151;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
        }
        p {
            font-size: 1rem;
            line-height: 1.75rem;
            margin-bottom: 1rem;
            color: #4b5563;
        }
        .links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            color: white;
            background-color: #ef4444;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #dc2626;
        }
        .btn-outline {
            background-color: transparent;
            color: #ef4444;
            border: 1px solid #ef4444;
        }
        .btn-outline:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }
        pre {
            background-color: #1f2937;
            color: #f3f4f6;
            padding: 1.25rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }
        code {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        }
        :not(pre) > code {
            background-color: #f3f4f6;
            color: #ef4444;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.875em;
        }
        ul, ol {
            margin-bottom: 1.5rem;
            color: #4b5563;
            line-height: 1.75;
            padding-left: 1.5rem;
        }
        li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Привіт! 👋</h1>
            <p>Це ваша нова оновлена стартова сторінка Laravel. Додаток успішно працює!</p>
            
            <div class="links">
                <a href="https://laravel.com/docs" target="_blank" class="btn">Документація</a>
                <a href="https://laracasts.com" target="_blank" class="btn btn-outline">Laracasts</a>
            </div>
        </div>

        <div class="content">
            <h2>Інструкція: Як розгорнути Laravel на Vercel</h2>
            <p>Оскільки Vercel є платформою для "безсерверних" (serverless) застосунків, Laravel потребує невеликої адаптації. Ось що потрібно зробити, щоб розгорнути проєкт та коректно налаштувати статичні файли (CSS, JS).</p>

            <h3>1. Створіть точку входу для Vercel</h3>
            <p>Vercel очікує, що серверні функції/скрипти знаходяться у папці <code>api</code>. Створіть папку <code>api</code> в корені вашого проєкту і всередині неї файл <code>index.php</code> з таким вмістом:</p>
<pre><code>&lt;?php

// Підключаємо оригінальний файл index.php з папки public
require __DIR__ . '/../public/index.php';
</code></pre>

            <h3>2. Налаштування vercel.json (для статичних файлів)</h3>
            <p>Це ключовий крок для обробки статичних файлів (щоб підвантажувалися ваші CSS та JS). Створіть файл <code>vercel.json</code> у корені вашого проєкту з таким вмістом:</p>
<pre><code>{
    "version": 2,
    "builds": [
        {
            "src": "api/index.php",
            "use": "vercel-php@0.6.1"
        },
        {
            "src": "/public/**",
            "use": "@vercel/static"
        }
    ],
    "routes": [
        {
            "src": "/build/(.*)",
            "dest": "/public/build/$1"
        },
        {
            "src": "/(css|js|images|fonts)/(.*)",
            "dest": "/public/$1/$2"
        },
        {
            "src": "/(.*)",
            "dest": "/api/index.php"
        }
    ],
    "env": {
        "APP_ENV": "production",
        "APP_DEBUG": "false",
        "LOG_CHANNEL": "stderr",
        "CACHE_STORE": "array",
        "SESSION_DRIVER": "cookie",
        "QUEUE_CONNECTION": "sync"
    }
}</code></pre>

            <h3>3. Налаштування .env на Vercel</h3>
            <p>У дашборді Vercel в розділі <strong>Settings -> Environment Variables</strong> обов'язково додайте ваш ключ застосунку з локального <code>.env</code> файлу:</p>
            <ul>
                <li><code>APP_KEY</code> = <code>base64:ваш_ключ_із_локального_файлу_env</code></li>
                <li>Також не забудьте додати налаштування для бази даних (DB_CONNECTION, DB_HOST тощо), якщо використовуєте її.</li>
            </ul>

            <h3>4. Команда збірки (Build Command)</h3>
            <p>Оскільки Laravel використовує Vite, Vercel має зібрати ваші CSS та JS під час розгортання. У розділі <strong>Settings -> Build & Development Settings</strong> перевірте:</p>
            <ul>
                <li><strong>Build Command:</strong> <code>npm run build</code></li>
                <li><strong>Output Directory:</strong> залиште пустим або вкажіть <code>public</code></li>
            </ul>

            <h3>5. Розгортання (Деплой)</h3>
            <ol>
                <li>Зробіть комміт та пуш на GitHub.</li>
                <li>Перейдіть на Vercel та натисніть "Add New..." -> "Project".</li>
                <li>Імпортуйте ваш репозиторій з GitHub та натисніть "Deploy".</li>
            </ol>
            <p>Тепер при кожному новому пуші в гілку <code>main</code> ваш застосунок буде автоматично перезбиратись і оновлюватись на Vercel!</p>
        </div>
    </div>
</body>
</html>
