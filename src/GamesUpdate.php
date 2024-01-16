<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
		<title>ゲーム更新画面</title>
        <link rel="stylesheet" href="css/Update.css">
        <script src="./script/Update.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            function goBack() {
                location.href='GamesList.php';
            }
        </script>
	</head>
	<body>
    <?php
    require 'db-connect.php';
    ?>
        <div class="wrapper">
            <section class="head">
                <h2>ゲーム更新</h2>
            </section>
            <?php
                $l = "location.href='GamesList.php'";
                $file = "fileInput";
                $s = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,'$1');";
                $pdo=new PDO($connect, USER, PASS);
                $sql=$pdo->prepare('select Games. * , category_name from Games inner join Categories on Games.category_id = Categories.category_id where game_id=?');
	            $sql->execute([$_POST['id']]);
                foreach($sql as $row){
                    echo '<form action = "GamesUpdateFinish.php" method = "post" enctype="multipart/form-data">';
                    echo     '<input type="hidden" name="id" value="'.$row['game_id'].'">';
                    echo     '<input type="hidden" name="OldCategory" value="'.$row['category_id'].'">';
                    echo     '<input type="hidden" name="OldName" value="'.$row['game_name'].'">';
                    echo     '<section class="body">';
                    echo         '<div class="image">';
                    echo             '<label>画像：</label>';
                    $category=$row['category_name'];
                    $id=$row['game_name'];
                    $imageDirectory = 'img/' . $category . '/'.$id.'/';
                    $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    if (!empty($images)) {
                        foreach ($images as $image) {
                            $fileName = basename($image);
                        echo '<img src="' . $image . '" class="UpdatedImages" alt="' . $fileName . '" width="65" height="65">';
                        }
                    }else{
                        echo 'No images';
                    }
                    echo             '<label style="margin-left: 20px;">新しい画像：</label>';
                    echo             '<span id="imagePreviews" width=""></span>';
                    echo             '<input type="button" id="loadFileXml" value="画像" class="imageButton" onclick="document.getElementById(\'' . $file . '\').click();" />';
                    echo             '<input type="file" style="display:none;" name="files" id="fileInput" onchange="previewImages()">';
                    echo         '</div>';
                    echo         '<div>';
                    echo             '<label>ゲーム名：</label><input name="name" class="input-box" type="text" style="padding: 5px;" placeholder="ゲーム名を入力してください" value="'.$row['game_name'].'" required="required">';
                    echo         '</div>';
                    echo         '<div>';
                    echo         '<label>カテゴリ：</label>';
                    echo             '<select name="category" class="input-box-option" style="padding: 5px;">';
                    echo               '<option value="'.$row['category_id'].'" selected>'.$row['category_name'].'</option>';
                                        $cate =[
                                            1 => 'アクション',
                                            2 => 'アドベンチャー',
                                            3 => 'スポーツ',
                                            4 => 'ホラー',
                                            5 => 'オープンワールド',
                                        ];
                                        foreach($cate as $CateId => $CateName){
                    echo               '<option value="'.$CateId.'">'.$CateName.'</option>';
                                        }
                    echo             '</select>';
                    echo         '</div>';
                    echo         '<div class="explain">';
                    echo             '<label>ゲーム説明：</label><br><textarea name="explain" class="input-box-explain" style="padding: 5px;" placeholder="ゲーム説明を入力してください" required="required" cols="70" rows="8" name="explain" maxlength="200">'.$row['game_explain'].'</textarea>';
                    echo         '</div>';
                    echo     '</section>';
                    echo     '<section class="foot">';
                    echo         '<input type="button" value="戻る" class="register back" onclick="'.$l.'">';
                    echo         '<button class="register regis" type="submit">更新</button>';
                    echo     '</section>';
                    echo '</form>';
                }
            ?>
        </div>
        <?php
    ?>
    </body>
</html>
