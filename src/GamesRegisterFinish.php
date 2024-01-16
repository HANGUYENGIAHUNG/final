<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゲーム登録完了画面</title>
    <link rel="stylesheet" href="css/Finish.css">
    <script src="./script/Register.js"></script>
</head>
<body>
<?php
    require 'db-connect.php';
    ?>
    <main class="wrapper">
        <section class="body">
        <?php
                $categories = array(
                    1 => 'アクション',
                    2 => 'アドベンチャー',
                    3 => 'スポーツ',
                    4 => 'ホラー',
                    5 => 'オープンワールド',
                );
                $key=$_POST['category'];
                $category=$categories[$key];
                $name=$_POST['name'];
                $path="./img/{$category}";
                $path1="./img/{$category}/{$name}";
                if(!file_exists($path)){
                    mkdir("./img/{$category}", 0777);
                }
                if(!file_exists($path1)){
                    mkdir("./img/{$category}/{$name}", 0777);
                }
                $target_dir = $path1."/";


                    $currentFile = $_FILES['files']['tmp_name'];
                    $currentTarget = $target_dir . basename($_FILES['files']['name']);

                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($currentTarget, PATHINFO_EXTENSION));

                    if (file_exists($currentTarget)) {
                        $uploadOk = 0;
                    }

                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "PNG") {
                        $uploadOk = 0;
                    }

                    if ($uploadOk == 1) {
                        move_uploaded_file($currentFile, $currentTarget);
                    }
                if($uploadOk == 0){
                    echo '<label>写真なしで</label>';
                }
                echo '<label>追加に成功しました</label>';
                $pdo = new PDO($connect, USER, PASS);
                $sql=$pdo->prepare('insert into Games(category_id,game_name,game_explain) value (?,?,?)');
                $sql->execute([$_POST['category'],$_POST['name'],$_POST['explain']]);
                ?>
                
        </section>
        <section class="foot">
            <form action="GamesList.php" method="post">
                <button class="register" type="submit">ゲーム一覧へ</button>
            </form>
        </section>
    </main>
    <?php
    ?>
</body>
</html>
