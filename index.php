<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Premium Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

/* Background */
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0f9b0f, #1db954);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* Floating circles (premium feel) */
body::before, body::after {
    content: "";
    position: absolute;
    width: 300px;
    height: 300px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    filter: blur(80px);
}

body::before { top: -50px; left: -50px; }
body::after { bottom: -50px; right: -50px; }

/* Glass Card */
.card {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(20px);
    padding: 35px;
    width: 340px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    color: white;
    text-align: center;
    animation: fadeIn 1s ease;
}

/* Title */
.card h1 {
    margin-bottom: 25px;
    font-weight: 600;
}

/* Floating input group */
.input-group {
    position: relative;
    margin: 15px 0;
}

.input-group input {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    outline: none;
}

.input-group label {
    position: absolute;
    left: 12px;
    top: 12px;
    color: gray;
    font-size: 14px;
    transition: 0.3s;
    pointer-events: none;
}

/* Floating effect */
.input-group input:focus + label,
.input-group input:valid + label {
    top: -8px;
    left: 8px;
    font-size: 11px;
    color: #d4ffd4;
}

/* Password eye */
.eye {
    position: absolute;
    right: 10px;
    top: 12px;
    cursor: pointer;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: #00c853;
    border: none;
    border-radius: 10px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #00e676;
    transform: scale(1.05);
}

/* Loading effect */
button.loading {
    opacity: 0.7;
    pointer-events: none;
}

/* Link */
a {
    color: #d4ffd4;
    text-decoration: none;
}

/* Animation */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

/* Mobile */
@media (max-width: 480px) {
    .card {
        width: 90%;
        padding: 25px;
    }
}

</style>
</head>

<body>

<div class="card">
    <h1>🔐 Login</h1>

    <form method="POST" onsubmit="return loadingEffect()">

        <div class="input-group">
            <input type="text" name="username" required>
            <label>👤 Username</label>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="password" required>
            <label>🔑 Password</label>
            <span class="eye" onclick="togglePassword()">👁</span>
        </div>

        <button id="loginBtn">Login</button>

    </form>

    <p style="margin-top:15px;">
        New user? <a href="register.php">Register</a>
    </p>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $u = $_POST['username'];
    $p = $_POST['password'];

    if(file_exists("users.txt")){
        $users = file("users.txt");
        foreach($users as $user){
            list($storedUser, $storedPass) = explode(",", trim($user));

            if($u == $storedUser && $p == $storedPass){
                $_SESSION['user'] = $u;
                header("Location: dashboard.php");
                exit();
            }
        }
    }

    echo "<p style='color:#ffcccc;'>Invalid Login</p>";
}
?>

</div>

<script>
function togglePassword() {
    let pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}

function loadingEffect() {
    let btn = document.getElementById("loginBtn");
    btn.classList.add("loading");
    btn.innerText = "Logging in...";
    return true;
}
</script>

</body>
</html>