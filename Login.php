<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";";


$user_name = filter_input(INPUT_POST, "user_name");

$password = filter_input(INPUT_POST, "password");

session_start();
if (isset($_POST['loginbtn'])) {
    try {

        $result = [];
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        // PDOの動作オプションを指定する

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // SQL文の準備と実行

        $sql = "SELECT * FROM USER where uname = :user_name";

        $sta = $pdo->prepare($sql);

        $sta->bindParam(':user_name', $user_name, PDO::PARAM_STR);

        $sta->execute();
        // SQL実行結果の処理
        $result = $sta->fetch(PDO::FETCH_ASSOC);
        $message = "";
        if ($user_name != "" && $password != "") {
            if ($result != false) {
                if (password_verify($password, $result["PASS"])) {
                    $message = "認証に成功しました。";
                    $_SESSION['id'] = $result['USER_NO'];
                    header('Location: Category.php');
                } else {
                    $message = "ユーザー名、またはパスワードが違います。";
                }
            } else {
                $message = "ユーザー名、またはパスワードが違います。";
            }
        } else {
            $message = "ユーザー情報を入力してください。";
        }
        // PDOオブジェクトを破棄
        $sta = null;
        $pdo = null;
    } catch (PDOException $e) {
        exit("DBエラー" . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <!-- Logo -->
            <div class="logo text-center ">

                <img src="images/logo_transparent.png"
                    class="logo-img"
                    alt="Life Step">
                    <h1 class="text-primary h2">暮らすてっぷ</h1>
                <p class="text-muted mt-2">
                    一歩ずつ、あたらしい毎日へ
                </p>

            </div>

            <form action="Login.php" method="POST">

                <div class="mb-4">

                    <label class="form-label">ユーザー名</label><br>
                    <input type="text" placeholder="ユーザー名" class="form-control" name="user_name" required>

                </div>

                <div class="mb-4 position-relative">

                    <label class="form-label">パスワード</label><br>
                    <input type="password" placeholder="パスワード" class="form-control " name="password" id="pass" required>

                    <span id="eye" class="position-absolute top-50 end-0 m-1 fa fa-eye-slash"></span>
                </div>


                <button type="submit" name="loginbtn" class="btn btn-login">ログイン</button>

                <?php if (isset($message)) { ?>

                    <div class="alert alert-danger mt-3 text-center">

                        <?= $message ?>

                    </div>

                <?php } ?>
            </form>
            <a href="create_account.php" class="btn btn-register mt-3 w-100">
                <strong>新規登録</strong><br>
                <small>アカウントをお持ちでない方はこちらへ</small>
            </a>

        </div>

    </div>

    <script>
        $(function() {
            $('#eye').on('click', function() {
                var pass = $("#pass").attr('type');
                if (pass === "text") {
                    $("#pass").attr('type', 'password');
                    $("#eye").removeClass("fa-eye").addClass('fa-eye-slash');
                } else {
                    $("#pass").attr('type', 'text');
                    $("#eye").removeClass("fa-eye-slash").addClass('fa-eye');
                }
            });
        });
    </script>
</body>

</html>