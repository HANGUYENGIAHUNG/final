<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
		<title>ゲーム登録画面</title>
        <link rel="stylesheet" href="css/Register.css">
        <script src="./script/Register.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
    <?php
    require 'db-connect.php';
    ?>
        <div class="wrapper">
            <section class="head">
                <h2>ゲーム登録</h2>
            </section>
            <form action = "GamesRegisterFinish.php" method = "post" enctype="multipart/form-data">
                <section class="body">
                    <div class="image">
                        <label>画像：</label>
                        <span id="imagePreviews" width=""></span>
                        <input type="button" id="loadFileXml" value="画像" class="imageButton" onclick="document.getElementById('fileInput').click();" />
                        <input type="file" style="display:none;" name="files" id="fileInput" onchange="previewImages()">
                    </div>
                    <div>
                        <label>ゲーム名：</label>
                        <input name="name" class="input-box" type="text" style="padding: 5px;" placeholder="ゲーム名を入力してください" maxlength="30" required="required">
                    </div>
                    <div>
                    <label>カテゴリ：</label>
                        <select name="category" class="input-box-option" style="padding: 5px;" required="required">
                          <option selected value="">選んでください</option>
                          <?php
                          $cate =[
                            1 => 'アクション',
                            2 => 'アドベンチャー',
                            3 => 'スポーツ',
                            4 => 'ホラー',
                            5 => 'オープンワールド',
                            ];
                        foreach($cate as $CateId => $CateName){
                            echo  '<option value="'.$CateId.'">'.$CateName.'</option>';
                        }
                          ?>
                        </select>
                    </div>
                    <div class="explain">
                        <label>ゲーム説明：</label>
                        <br>
                        <textarea name="explain" class="input-box-explain" style="padding: 5px;" placeholder="ゲームの説明を入力してください" required="required" cols="70" rows="8" name="explain" maxlength="300"></textarea>
                    </div>
                </section>
                <section class="foot">
                    <button class="register back" onclick="location.href='GamesList.php'" type="submit">戻る</button>
                    <button class="register regis" type="submit">登録</button>
                </section>
            </form>
        </div>
        <?php
?>
    </body>
</html>