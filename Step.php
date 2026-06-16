<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細画面</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="bg-light">

    <!-- Header -->
    <header class="bg-primary text-white py-4 shadow">
        <div class="container">
            <h1 class="h3">詳細画面</h1>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-info text-white">
                <h4 class="mb-0">災害対策</h4>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>内容</th>
                            <th>状態</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>防災バッグを準備する</td>
                            <td>未完了</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>避難所を確認する</td>
                            <td>未完了</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>緊急連絡先を登録する</td>
                            <td>未完了</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>非常食を備蓄する</td>
                            <td>未完了</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="Category.php" class="btn btn-secondary">
                        戻る
                    </a>

                    <a href="Login.php" class="btn btn-danger">
                        ログアウト
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>
</html>