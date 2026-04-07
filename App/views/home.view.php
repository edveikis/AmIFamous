<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Am I Famous?</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a, #020617);
            color: #e2e8f0;
        }

        .container {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        p {
            font-size: 0.95rem;
            color: #94a3b8;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input {
            padding: 14px;
            border-radius: 10px;
            border: 1px solid #1e293b;
            background: #020617;
            color: #e2e8f0;
            outline: none;
            transition: 0.2s;
        }

        input::placeholder {
            color: #475569;
        }

        input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        button {
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #3b82f6;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #2563eb;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Am I Famous?</h1>
        <p>Check if your email address is in a data breach</p>
        <form>
            <input type="email" placeholder="Enter your email address" required />
            <button type="submit">Check</button>
        </form>
    </div>
</body>

</html>