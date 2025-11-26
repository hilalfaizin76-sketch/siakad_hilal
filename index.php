<?php
session_start();
$_SESSION['isLogin'] = false;

if (isset($_POST["btnLogin"])) {

    $tuser = $_POST['tuser'];
    $tpass = $_POST['tpass'];

    require_once("config.php");
    $sql = "SELECT * FROM users WHERE username='$tuser' AND password=MD5('$tpass')";
    $hasil = $db->query($sql);

    if ($hasil->num_rows > 0) {

        $data = $hasil->fetch_assoc();

        $_SESSION['isLogin'] = true;
        $_SESSION['user']    = $tuser;
        $_SESSION['level']   = $data['level'];

        if ($_SESSION['level'] == "admin") {
            header("Location: admin/");
            exit;
        }

        if ($_SESSION['level'] == "dosen") {
            header("Location: dosen/");
            exit;
        }

        if ($_SESSION['level'] == "mhs") {
            header("Location: mahasiswa/");
            exit;
        }
    } else {
        $error = "Username atau Password Salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login SI Akademik</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    height: 100vh;
    margin: 0;
    background: linear-gradient(135deg, #4b6cb7, #182848);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Poppins', sans-serif;
}

.login-card {
    width: 380px;
    background: rgba(255, 255, 255, 0.12);
    padding: 30px;
    border-radius: 15px;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    color: white;
    animation: fadeIn 0.6s ease-out;
}

.login-card h3 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
}

.input-group-text {
    background: rgba(255,255,255,0.2);
    border: none;
    color: #fff;
}

.form-control {
    background: rgba(255,255,255,0.15);
    border: none;
    color: white;
}

.form-control::placeholder {
    color: rgba(255,255,255,0.7);
}

.btn-primary {
    background: #00c6ff;
    border: none;
    font-weight: bold;
}

.btn-primary:hover {
    background: #0097cc;
}

.alert {
    text-align: center;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-15px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>
</head>

<body>

<div class="login-card">
    <h3><i class="bi bi-person-circle"></i> Login Sistem</h3>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger py-2"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="post">

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" class="form-control" placeholder="Username" name="tuser" required/>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" class="form-control" placeholder="Password" name="tpass" required/>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox"/>
                <label class="form-check-label">Remember me</label>
            </div>
        </div>

        <button type="submit" name="btnLogin" class="btn btn-primary w-100 py-2">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </button>

    </form>
</div>

</body>
</html>
