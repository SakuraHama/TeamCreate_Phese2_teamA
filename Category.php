<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>項目選択画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow-lg p-4 rounded-4">

            <h1 class="text-center mb-4">
                項目選択画面
            </h1>

            <!-- 災害対策 -->
            <div class="form-check mb-3">
                <a class="btn btn-primary" href="Step.php? id=1&category=disaster">災害対策</a>
                    
                <p class="text-muted ms-4">
                    防災用品や避難所情報など～
                </p>

            </div>

            <!-- 住居準備 -->
            <div class="form-check mb-3">
                <a class="btn btn-primary" href="Step.php? id=2&category=location">住居準備</a>

                <p class="text-muted ms-4">
                    部屋探し、契約、住所登録など～
                </p>

            </div>

            <!-- 家具準備 -->
            <div class="form-check mb-3">
                <a class="btn btn-primary" href="Step.php? id=3&category=furniture">家具準備</a>

                <p class="text-muted ms-4">
                    家電購入など～
                </p>

            </div>


            <!-- Logout Button -->
            <button onclick="location.href='Login.php'" class="btn btn-danger w-100">
                ログアウト
            </button>

        </div>

    </div>

</body>

</html>