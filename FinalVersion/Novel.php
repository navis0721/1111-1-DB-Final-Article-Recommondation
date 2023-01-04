<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width", initial-scale=1.>
        <title>小說系統</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="header.css"/>
        <!-- <script type="text/javascript" src="data.js" ></script> -->
    </head>
    <body>
        <section id="Row1" class="Row1">
            <div id="header" class="header">
                <h1 id="title" class="title"><a href="Novel.html">Novel Recommend</a></h1>
                <a href="wordcloud.html" class="btn">依類型分</a>
                <a href="survey.html" class="btn">問卷填寫</a>
                <?php session_start(); ?>
                <?php 
                    if(!empty($_SESSION['username'])) {
                        $state = '登出';
                        $href = 'logout.php';
                    }else{
                        $state = '登入';
                        $href = 'login2.php';
                    }
                ?>
                <a href=<?php echo $href; ?> class="btn"><?php echo $state; ?></a>
                
            </div>
        </section>
        <section class="Row2">
            <section class="Column1">
                <form action="bookSearch.php" method="post">
                <h2 class="content">你現在的emotion😀</h3>
                <div class="emoArea">
                    <span class="emo">😀</span>
                    <input type="range" min="0" max="100" step="1" id="happy" class="emo_range"
                       onchange="document.getElementById('rangeText1').innerHTML=value" name="happy_score">
                    <span class="rangeText" id="rangeText1">50</span>
                    <!-- </form> -->
                </div>
                <div class="emoArea">
                    <!-- <form action="booklist.php" method="post"> -->
                    <span class="emo">😭</span>
                    <input type="range" min="0" max="100" step="1" id="sad" class="emo_range"
                            onchange="document.getElementById('rangeText2').innerHTML=value" name="sad_score">
                    <span class="rangeText" id="rangeText2">50</span>
                    <!-- </form> -->
                </div>
                <div class="emoArea">
                    <!-- <form action="booklist.php" method="post"> -->
                    <span class="emo">😡</span>
                    <input type="range" min="0" max="100" step="1" id="mad" class="emo_range"
                        onchange="document.getElementById('rangeText3').innerHTML=value" name="angry_score">
                    <span class="rangeText" id="rangeText3">50</span>
                    <!-- </form> -->
                </div>
                <!-- <form action="booklist.php" method="post"> -->
                <button id="btn3" class="submit" name="score_btn">Submit</button>
                </form>
            </section>
            
            <section class="Column2">
                <section class="Row2_1">
                    <form action="booklist.php" method="post">
                        <div class="RankR1"><h2 class="rankTitle">Emotion Rank</h2></div>
                        <div class="RankR2">
                            <button class="emoLink" name="happy" value="#">😀 Happy排行榜</button>
                            <button class="emoLink" name="sad" value="#">😭 Sad排行榜</button>
                            <button class="emoLink" name="angry" value="#">😡 Mad排行榜</button>
                        </div>
                    </form>
                </section>
                <section class="Row2_2">
                    <h2 class="userTitle">使用者心得</h2>
                    <div class="show" id="show">
                        <?php require_once 'Connect.php'; ?>
                        <?php 
                            $sql = "SELECT * from TestForComment";
                            $result = mysqli_query($dbConnection, $sql);
                            if ($result) {
                                if (mysqli_num_rows($result)>0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $datas[] = $row;
                                    }
                                }
                                mysqli_free_result($result);
                            }
                        ?>
                        <?php foreach ($datas as $key => $row) :?>
                            <div class="message">👤: <?php echo $row['Comment']; ?></div>
                        <?php endforeach; ?>
                    </div>
                    <form action="comment.php" method="post">
                    <div class="inputArea">
                        <input type="text" id="userInput" class="userInput" placeholder="輸入文字" name="Comment">
                        <button class="textSubmit" >Submit</button>
                    </div>
                    </form>
                    
                </section>
            </section>
            
        </section>
            
        <script>
            function post(){
                var content = document.createElement("div");
                var messageBox = document.getElementById("show");
                var input = document.getElementById("userInput");
                content.className="message";
                content.innerHTML="👤: " + input.value;
                input.value="";
                messageBox.appendChild(content);
            }
        </script>
    </body>
    
</html>