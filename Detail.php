<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <h1>詳細画面</h1>
    <p>ここに詳細な情報が表示されます。</p>

    <form action="save.php" method="POST">

        <div>
            <input type="checkbox" id="item1" name="items[]" value="1">
            <label for="item1">項目1</label>
        </div>

        <div>
            <input type="checkbox" id="item2" name="items[]" value="2">
            <label for="item2">項目2</label>
        </div>

        <div>
            <input type="checkbox" id="item3" name="items[]" value="3">
            <label for="item3">項目3</label>
        </div>

        <div>
            <input type="checkbox" id="item4" name="items[]" value="4">
            <label for="item4">項目4</label>
        </div>

        <div>
            <input type="checkbox" id="item5" name="items[]" value="5">
            <label for="item5">項目5</label>
        </div>

        <a href="Step.php" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-primary">登録</button>

    </form>

</body>

</html>