<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゲーム一覧</title>
    <link rel="stylesheet" href="css/List.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
</head>
<body>
    <?php
    require 'db-connect.php';
            $pdo = new PDO($connect, USER, PASS);

                echo '<main class="wrapper">';
                echo    '<section class="head">';
                echo        '<h1 style="border: solid light;">ゲーム一覧</h1>';
                echo    '</section>';
                echo    '<section class="body">';
                echo '<section class="selects" style="text-align: right;">';
                echo '<form action="GamesList.php" method="post">';
                echo    '<button class="search" type ="submit">検索</button>';
                echo    '<select name="keyword" class="input-box-option" style="padding: 5px;">';
                echo    '<option selected value=0>選んでください</option>';
                             $cate =[
                               1 => 'アクション',
                               2 => 'アドベンチャー',
                               3 => 'スポーツ',
                               4 => 'ホラー',
                               5 => 'オープンワールド'
                               ];
                           foreach($cate as $CateId => $CateName){
                               echo  '<option value="'.$CateId.'">'.$CateName.'</option>';
                           }
                echo        '</select>';
                echo '</form>';
                echo '</section>';
                $delete = "return confirm('削除しますか？')";
                echo '<table><thead><tr><th width="8%"></th><th  width="18%">ゲーム名</th><th  width="10%">カテゴリ</th><th width="20%">ゲーム説明</th><th  width="10%">動作</th></tr></thead>';
                if(isset($_POST['keyword']) && $_POST['keyword'] != 0){
                    $sql=$pdo->prepare('SELECT Games. * , category_name FROM Games INNER JOIN Categories ON Games.category_id = Categories.category_id WHERE Games.category_id = ?');
                    $sql->execute([$_POST['keyword']]);
                    echo '<tbody>';
                        foreach ($sql as $row) {
                            echo '<tr>';
                                $category=$row['category_name'];
                                $id=$row['game_name'];
                                $path="./img/{$category}";
                                $path1="./img/{$category}/{$id}";
                                if(!file_exists($path)){
                                    mkdir("./img/{$category}", 0777);
                                }
                                if(!file_exists($path1)){
                                    mkdir("./img/{$category}/{$id}", 0777);
                                }
                                echo '<td style="text-align: center; word-break: break-word">';
                                $imageDirectory = 'img/' . $category . '/'.$id.'/';
                            
                                // 画像ファイルを取得
                                $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                            
                                if (!empty($images)) {
                                    foreach ($images as $image) {
                                        $fileName = basename($image);
                                        echo '<a style="cursor:zoom-in;" href="' . $image . '" data-lightbox="group"><img src="' . $image . '" alt="' . $fileName . '" width="65" height="65"></a>';
                                    }
                                } else {
                                    echo 'No images';
                                }
                                echo '</td>';
                                echo '<td style="text-align: center; word-break: break-word">'.$row['game_name'].'</td>';
                                echo '<td style="text-align: center; word-break: break-word">'.$row['category_name'].'</td>';
                                echo '<td style="word-break: break-word">'.$row['game_explain'].'</td>';
                                echo '<td class="center">';
                                    echo '<form action="GamesUpdate.php" method="post">';
                                        echo '<input type="hidden" name="id" value="'.$row['game_id'].'">';
                                        echo '<button class="up" type ="submit">更新</button>';
                                    echo '</form>';
                                    echo '<form action="GamesDeleteFinish.php" method="post">';
                                        echo '<input type="hidden" name="delcategory" value="'.$row['category_name'].'">';
                                        echo '<input type="hidden" name="delname" value="'.$row['game_name'].'">';
                                        echo '<input type="hidden" name="delid" value="'.$row['game_id'].'">';
                                        echo '<button onclick="'.$delete.'" class="del" type ="submit">削除</button>';
                                    echo '</form>';
                            echo '</td></tr>';
                        }
                    echo '</tbody>';
                }else{
                    echo '<tbody>';
                        foreach ($pdo->query('SELECT Games. * , category_name FROM Games INNER JOIN Categories ON Games.category_id = Categories.category_id') as $row) {
                            echo '<tr>';
                                $category=$row['category_name'];
                                $id=$row['game_name'];
                                $path="./img/{$category}";
                                $path1="./img/{$category}/{$id}";
                                if(!file_exists($path)){
                                    mkdir("./img/{$category}", 0777);
                                }
                                if(!file_exists($path1)){
                                    mkdir("./img/{$category}/{$id}", 0777);
                                }
                                echo '<td style="text-align: center; word-break: break-word">';
                                $imageDirectory = 'img/' . $category . '/'.$id.'/';
                            
                                // 画像ファイルを取得
                                $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                            
                                if (!empty($images)) {
                                    foreach ($images as $image) {
                                        $fileName = basename($image);
                                        echo '<a style="cursor:zoom-in;" href="' . $image . '" data-lightbox="group"><img src="' . $image . '" alt="' . $fileName . '" width="65" height="65"></a>';
                                    }
                                } else {
                                    echo 'No images';
                                }
                                echo '</td>';
                                echo '<td style="text-align: center; word-break: break-word">'.$row['game_name'].'</td>';
                                echo '<td style="text-align: center; word-break: break-word">'.$row['category_name'].'</td>';
                                echo '<td style="word-break: break-word">'.$row['game_explain'].'</td>';
                                echo '<td class="center">';
                                    echo '<form action="GamesUpdate.php" method="post">';
                                        echo '<input type="hidden" name="id" value="'.$row['game_id'].'">';
                                        echo '<button class="up" type ="submit">更新</button>';
                                    echo '</form>';
                                    echo '<form action="GamesDeleteFinish.php" method="post">';
                                        echo '<input type="hidden" name="delcategory" value="'.$row['category_name'].'">';
                                        echo '<input type="hidden" name="delname" value="'.$row['game_name'].'">';
                                        echo '<input type="hidden" name="delid" value="'.$row['game_id'].'">';
                                        echo '<button onclick="'.$delete.'" class="del" type ="submit">削除</button>';
                                    echo '</form>';
                            echo '</td></tr>';
                        }
                    echo '</tbody>';
                }
                echo '</table>';
            echo '</section>';
            echo '<section class="foot">';
            echo     '<form action="GamesRegister.php" method="post">';
            echo         '<button class="register" type="submit">登録</button>';
            echo     '</form>';
            echo '</section>';
            echo '</main>';
        ?>
    </main>
</body>
</html>