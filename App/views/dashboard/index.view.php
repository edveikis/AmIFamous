<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Am I Famous?</title>

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

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .branding h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .branding p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .topbar-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
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
            transition: 0.2s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: rgba(15, 23, 42, 0.75);
            color: #e2e8f0;
            border-color: rgba(255, 255, 255, 0.08);
        }

        .btn-secondary:hover {
            background: rgba(30, 41, 59, 0.9);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .stat-card .label {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
        }

        .stat-card .sub {
            margin-top: 8px;
            color: #64748b;
            font-size: 0.85rem;
        }

        .panel-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .panel {
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .panel-header h2 {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .panel-header p {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
        }

        .badge-success {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
        }

        .db-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .db-card {
            background: rgba(2, 6, 23, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            padding: 18px;
            transition: 0.2s ease;
        }

        .db-card-inline {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .db-card:hover {
            border-color: rgba(59, 130, 246, 0.35);
            transform: translateY(-2px);
        }

        .db-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 12px;
        }

        .db-name {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .db-meta {
            color: #94a3b8;
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .status {
            padding: 7px 10px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
        }

        .status-imported {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
        }

        .status-processing {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
        }

        .db-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-link {
            background: rgba(15, 23, 42, 1);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #e2e8f0;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: 0.2s ease;
        }

        .action-link:hover {
            background: rgba(30, 41, 59, 1);
            border-color: rgba(59, 130, 246, 0.35);
        }

        .action-link.import {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }

        .action-link.import:hover {
            background: #2563eb;
            border-color: #2563eb;
        }

        .empty-state {
            border: 1px dashed rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 24px;
            text-align: center;
            color: #94a3b8;
            background: rgba(2, 6, 23, 0.45);
        }

        .footer-note {
            margin-top: 28px;
            color: #64748b;
            font-size: 0.85rem;
            text-align: center;
        }

        @media (max-width: 900px) {
            .panel-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .db-top {
                flex-direction: column;
            }

            .branding h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <div class="topbar">
            <div class="branding">
                <h1>Admin Dashboard</h1>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="label">Pending Datasets</div>
                <div class="value"><?= count($import_files) ?></div>
                <div class="sub">Waiting to be imported</div>
            </div>

            <div class="stat-card">
                <div class="label">Imported Breaches</div>
                <div class="value"><?= $imported_db_count ?></div>
                <div class="sub">Available for user searches</div>
            </div>

            <div class="stat-card">
                <div class="label">Total Records</div>
                <div class="value"><?= $imported_records_count ?></div>
                <div class="sub">Indexed across all datasets</div>
            </div>

            <div class="stat-card">
                <div class="label">Last import</div>
                <div class="value"></div>
                <div class="sub"></div>
            </div>
        </div>

        <div class="panel-grid">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2>Waiting for Import</h2>
                        <p>
                            Datasets detected in your import directory but not yet
                            processed.
                        </p>
                    </div>
                    <span class="badge badge-warning"><?= count($import_files) ?></span>
                </div>

                <div class="db-list">
                    <?php foreach ($import_files as $file) : ?>
                        <div class="db-card db-card-inline">
                            <div>
                                <div class="db-name"><?= $file ?></div>
                            </div>

                            <div class="db-actions">
                                <a href="/dashboard/import/<?= urlencode($file) ?>" class="action-link import">Import</a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
        </div>
    </div>
</body>

</html>