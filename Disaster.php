<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>災害対策 — Life Step</title>

    <link rel="stylesheet" href="disaster.css">

</head>

<body>

<header class="site-header">
    <a href="category.html" class="logo">
        <i class="ti ti-arrow-left"></i>
        Life Step
    </a>

    <span class="user-text">
        こんにちは、<strong>ユーザー</strong> さん
    </span>

    <a href="Login.php">
        <button class="logout-btn">ログアウト</button>
    </a>
</header>

<div class="container disaster-container">

    <div class="page-title-wrap">
        <span class="shield-icon">
            <i class="ti ti-shield"></i>
        </span>

        <div>
            <h1>災害対策</h1>
            <p class="page-subtitle disaster-subtitle">
                防災用品や避難所情報など
            </p>
        </div>
    </div>

    <div class="progress-bar-wrap">
        <div class="progress-bar-fill" id="progress-fill"></div>
    </div>

    <p class="progress-text">
        <span id="done-count">0</span> /
        <span id="total-count">0</span>
        完了
    </p>

    <ul class="step-list" id="step-list">

        <li class="step-item" data-id="1">
            <input type="checkbox" id="step1" onchange="updateProgress()">

            <div>
                <label for="step1">避難場所を確認する</label>
                <p class="step-desc">
                    自宅近くの避難所の場所と経路を調べておく
                </p>
            </div>
        </li>

        <li class="step-item" data-id="2">
            <input type="checkbox" id="step2" onchange="updateProgress()">

            <div>
                <label for="step2">防災リュックを準備する</label>
                <p class="step-desc">
                    水・食料・救急用品・懐中電灯・電池など3日分
                </p>
            </div>
        </li>

        <li class="step-item" data-id="3">
            <input type="checkbox" id="step3" onchange="updateProgress()">

            <div>
                <label for="step3">飲料水を備蓄する</label>
                <p class="step-desc">
                    1人1日3リットルを目安に最低3日分
                </p>
            </div>
        </li>

        <li class="step-item" data-id="4">
            <input type="checkbox" id="step4" onchange="updateProgress()">

            <div>
                <label for="step4">家族の連絡方法を決める</label>
                <p class="step-desc">
                    災害用伝言ダイヤル（171）の使い方を確認
                </p>
            </div>
        </li>

        <li class="step-item" data-id="5">
            <input type="checkbox" id="step5" onchange="updateProgress()">

            <div>
                <label for="step5">ハザードマップを確認する</label>
                <p class="step-desc">
                    市区町村のハザードマップで自宅周辺のリスクを把握
                </p>
            </div>
        </li>

    </ul>

    <div class="detail-btn-wrap">
        <a href="step_detail.html?category_id=1" class="btn btn-primary detail-btn">
            ステップ詳細を見る
        </a>
    </div>

</div>

</body>
</html>