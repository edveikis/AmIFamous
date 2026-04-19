<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Breach Results - Am I Famous?</title>

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
            padding: 40px 20px;
        }

        .page {
            max-width: 860px;
            margin: 0 auto;
        }

        .hero {
            text-align: center;
            margin-bottom: 28px;
        }

        .hero h1 {
            font-size: 2.1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .hero p {
            color: #94a3b8;
            font-size: 1rem;
            line-height: 1.6;
        }

        .search-card,
        .results-card {
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .search-card {
            padding: 20px;
            margin-bottom: 22px;
        }

        .search-form {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-form input {
            flex: 1;
            min-width: 240px;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(2, 6, 23, 0.9);
            color: #e2e8f0;
            outline: none;
            transition: 0.2s ease;
        }

        .search-form input::placeholder {
            color: #64748b;
        }

        .search-form input:focus {
            border-color: rgba(59, 130, 246, 0.6);
        }

        .search-form button {
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            background: #3b82f6;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .search-form button:hover {
            background: #2563eb;
        }

        .results-card {
            padding: 24px;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .results-title h2 {
            font-size: 1.45rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .results-title p {
            color: #94a3b8;
            line-height: 1.6;
        }

        .email-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(59, 130, 246, 0.14);
            color: #93c5fd;
            font-size: 0.9rem;
            font-weight: 600;
            word-break: break-all;
        }

        .results-summary {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .stat-box {
            background: rgba(2, 6, 23, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            padding: 16px 18px;
            min-width: 150px;
        }

        .stat-box .label {
            color: #94a3b8;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .stat-box .value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .breach-section-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 14px;
        }

        .breach-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .breach-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 16px 18px;
            background: rgba(2, 6, 23, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
        }

        .breach-name {
            font-size: 1rem;
            font-weight: 600;
        }

        .breach-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            font-size: 0.82rem;
            font-weight: 700;
            white-space: nowrap;
        }

        @media (max-width: 640px) {
            body {
                padding: 24px 16px;
            }

            .hero h1 {
                font-size: 1.8rem;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form button {
                width: 100%;
            }

            .results-header {
                flex-direction: column;
            }

            .breach-item {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="hero">
            <h1>Search Results</h1>
            <p>Check whether an email address appears in known breach datasets.</p>
        </div>

        <div class="search-card">
            <form action="/breaches" method="POST" class="search-form">
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email address"
                    value="<?= htmlspecialchars($email) ?>"
                    required />
                <button type="submit">Check Again</button>
            </form>
        </div>

        <div class="results-card">
            <div class="results-header">
                <div class="results-title">
                    <h2>This email was found in <?= $breach_count ?> breaches</h2>
                    <p>Results for the searched email address are shown below.</p>
                </div>

                <div class="email-pill"><?= htmlspecialchars($email) ?></div>
            </div>

            <?php if ($breach_count > 0) : ?>
                <div class="breach-section-title">Matched breaches</div>

                <div class="breach-list">
                    <?php foreach ($breaches as $breach) : ?>
                        <div class="breach-item">
                            <div class="breach-name"><?= htmlspecialchars($breach['breach_name']) ?></div>
                            <div class="breach-badge">Found</div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</body>

</html>