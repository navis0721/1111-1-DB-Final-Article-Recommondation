<?php
    require_once 'Connect.php';
?>

<?php
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM TestForLogin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($dbConnection,$sql);
    if (mysqli_num_rows($result) == 1) {
        echo "<script>alert('此帳號已存在'); location.href = 'register.html';</script>";
    }
    elseif(mysqli_affected_rows($dbConnection)==0) {
        $sql = "INSERT INTO  TestForLogin (username, password) VALUES ('$username', '$password') ";
        $result = mysqli_query($dbConnection,$sql);
        if (mysqli_affected_rows($dbConnection)>0) {
            echo "<script>alert('註冊成功！'); location.href = 'login2.html';</script>";
        }
        elseif(mysqli_affected_rows($dbConnection)==0) {
            echo "無資料新增";
        }
        else {
            echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($dbConnection);
        }
    }
    mysqli_close($dbConnection); 
?>