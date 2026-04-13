<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Import Dataset - Am I Famous</title>

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
            background: linear-gradient(135deg, #0f172a, #020617);
            color: #e2e8f0;
            padding: 40px;
        }

        .wrapper {
            max-width: 700px;
            margin: 0 auto;
        }

        .topbar {
            margin-bottom: 24px;
        }

        .topbar h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .topbar p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .card {
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .file-box {
            background: rgba(2, 6, 23, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .file-box .label {
            color: #94a3b8;
            font-size: 0.85rem;
            margin-bottom: 6px;
        }

        .file-box .value {
            font-size: 1rem;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .section h2 {
            font-size: 1rem;
            margin-bottom: 14px;
            font-weight: 600;
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 0.9rem;
            color: #cbd5e1;
            font-weight: 500;
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

        .hint {
            color: #64748b;
            font-size: 0.82rem;
            margin-top: -2px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-secondary {
            background: rgba(15, 23, 42, 0.75);
            color: #e2e8f0;
            border-color: rgba(255, 255, 255, 0.08);
        }

        .btn-secondary:hover {
            background: rgba(30, 41, 59, 0.9);
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            .topbar h1 {
                font-size: 1.6rem;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="topbar">
            <h1>Import Dataset</h1>
        </div>

        <div class="card">
            <div class="file-box">
                <div class="label">Selected file</div>
                <div class="value">linkedin_2012_dump.csv</div>
            </div>

            <form action="" method="POST">
                <div class="section">
                    <h2>Field Mapping</h2>
                    <div class="field-group">
                        <div class="field">
                            <label for="email_field">Email field</label>
                            <input
                                type="text"
                                id="email_field"
                                name="email_field"
                                placeholder="example: email" />
                        </div>

                        <div class="field">
                            <label for="password_field">Password field</label>
                            <input
                                type="text"
                                id="password_field"
                                name="password_field"
                                placeholder="example: password_hash" />
                        </div>

                        <div class="field">
                            <label for="username_field">Username field</label>
                            <input
                                type="text"
                                id="username_field"
                                name="username_field"
                                placeholder="example: username" />
                        </div>

                        <p class="hint">
                            Leave fields empty if they do not exist in the dataset.
                        </p>
                    </div>
                </div>

                <div class="section">
                    <h2>Breach Details</h2>
                    <div class="field-group">
                        <div class="field">
                            <label for="breach_name">Breach name</label>
                            <input
                                type="text"
                                id="breach_name"
                                name="breach_name"
                                placeholder="example: LinkedIn 2012"
                                required />
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Start Import</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>