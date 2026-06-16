<?php 
    require_once __DIR__ . "/def.php";
    $dsn = "mysql:host=" .DB_HOST. "; dbname=". DB_NAME. "; charset=" .DB_CHARSET. ";";

    $user_name = filter_input(INPUT_POST,"user_name");

    $password = filter_input(INPUT_POST,"password");
    $password_check = filter_input(INPUT_POST,"password_check");

    
    if(isset($_POST['createbtn'])){
        try{
    
        $pdo = new PDO($dsn,DB_USER,DB_PASS);
        // PDOの動作オプションを指定する

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // SQL文の準備と実行
        
        // SQL実行結果の処理
        $message = "";
        if($user_name != "" && $password != "" && $password_check != ""){
            if($password == $password_check){
                $password = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO USER (UNAME,PASS) VALUES(:user_name,:password);";
                $sta = $pdo->prepare($sql);

                $sta ->bindParam(':user_name',$user_name,PDO::PARAM_STR);
                $sta ->bindParam(':password',$password,PDO::PARAM_STR);

                $sta->execute();
                $message = "登録が完了しました。";
            }else{
                $message = "パスワードが確認と異なります。";
            }
        }else{
            $message = "ユーザー情報を入力してください。";
        }
        // PDOオブジェクトを破棄
        $sta = null;
        $pdo = null;
        }catch(PDOException $e){
            exit("DBエラー".$e->getMessage());
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント作成画面</title>
</head>

<body>
    <form action="create_account.php" method="POST">
        <div class="">
            <h1>アカウント作成</h1>

            <label>ユーザー名</label>
            <input type="text" placeholder="ユーザー名を入力" name="user_name">

            <label>パスワード</label>
            <input type="password" placeholder="パスワードを入力" name="password">

            <label>確認</label>
            <input type="password" placeholder="パスワードを入力" name="password_check">

            <input class="btn" type="submit" name="createbtn" value="作成">
            <?php 
                if(isset($message)){
                    echo($message);
                }
            ?>
        </div>
    </form>
    <a href="Login.php"><button>戻る</button></a>
</body>

</html>