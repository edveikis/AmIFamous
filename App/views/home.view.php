<?php

use Framework\Session;

?>


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
            padding: 20px;
        }

        .wrapper {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .admin-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 16px;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        }

        .admin-panel span {
            font-size: 0.9rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .panel-actions {
            display: flex;
            gap: 10px;
        }

        .panel-btn {
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .dashboard-btn {
            background: rgba(59, 130, 246, 0.15);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.25);
        }

        .dashboard-btn:hover {
            background: rgba(59, 130, 246, 0.25);
        }

        .logout-btn {
            background: rgba(239, 68, 68, 0.12);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .container {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
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

    <div class="wrapper">
        <div class="container">
            <h1>Am I Famous?</h1>

            <p>
                Check if your email address is in a data breach
            </p>

            <form method="POST" action="/breaches">
                <input
                    name="email"
                    type="email"
                    placeholder="Enter your email address"
                    required />

                <button>
                    Check
                </button>
            </form>
        </div>

        <?php if (Session::has('user')): ?>
            <div class="admin-panel">
                <span>Admin Controls</span>

                <div class="panel-actions">
                    <a href="/dashboard" class="panel-btn dashboard-btn">
                        Dashboard
                    </a>

                    <a href="/admin/logout" class="panel-btn logout-btn">
                        Logout
                    </a>
                </div>
            </div>
        <?php endif ?>
    </div>

</body>

</html>