<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login - Am I Famous?</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0f172a, #020617);
            color: #e2e8f0;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        p {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #cbd5e1;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(2, 6, 23, 0.9);
            color: #e2e8f0;
            outline: none;
            transition: 0.2s ease;
        }

        input::placeholder {
            color: #64748b;
        }

        input:focus {
            border-color: rgba(59, 130, 246, 0.6);
        }

        .btn {
            margin-top: 8px;
            padding: 12px 18px;
            border: none;
            border-radius: 10px;
            background: #3b82f6;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn:hover {
            background: #2563eb;
        }

        .footer-note {
            margin-top: 18px;
            color: #64748b;
            font-size: 0.85rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h1>Login</h1>

        <form action="/admin/login" method="POST">
            <div class="field">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="admin@example.com"
                    required />
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required />
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>

</html>