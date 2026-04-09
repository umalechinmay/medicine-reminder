<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

/* Background */
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #11998e, #38ef7d);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Floating glow */
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

/* Card */
.card {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(20px);
    padding: 35px;
    width: 350px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    color: white;
    text-align: center;
    animation: fadeIn 1s ease;
}

/* Title */
.card h1 {
    margin-bottom: 20px;
}

/* Input group */
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

/* Labels */
.input-group label {
    position: absolute;
    left: 12px;
    top: 12px;
    color: gray;
    font-size: 14px;
    transition: 0.3s;
}

/* Floating effect */
.input-group input:focus + label,
.input-group input:valid + label {
    top: -8px;
    left: 8px;
    font-size: 11px;
    color: #d4ffd4;
}

/* Eye icon */
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

/* Link */
a {
    color: #eaffea;
    text-decoration: none;
}

/* Message */
.success {
    color: #ccffcc;
    margin-top: 10px;
}
.error {
    color: #ffcccc;
    margin-top: 10px;
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
    <h1>📝 Register</h1>

    <form method="POST" onsubmit="return validateForm()">

        <div class="input-group">
            <input type="text" name="username" required>
            <label>👤 Username</label>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="pass1" required>
            <label>🔑 Password</label>
            <span class="eye" onclick="togglePass('pass1')">👁</span>
        </div>

        <div class="input-group">
            <input type="password" id="pass2" required>
            <label>🔁 Confirm Password</label>
            <span class="eye" onclick="togglePass('pass2')">👁</span>
        </div>

        <button id="registerBtn">Register</button>

    </form>

    <p style="margin-top:15px;">
        Already have account? <a href="index.php">Login</a>
    </p>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $u = $_POST['username'];
    $p = $_POST['password'];

    // check if user exists
    if(file_exists("users.txt")){
        $users = file("users.txt");
        foreach($users as $user){
            list($storedUser,) = explode(",", trim($user));
            if($u == $storedUser){
                echo "<p class='error'>Username already exists</p>";
                exit();
            }
        }
    }

    file_put_contents("users.txt", "$u,$p\n", FILE_APPEND);
    echo "<p class='success'>Registered Successfully 🎉</p>";
}
?>

</div>

<script>
function togglePass(id){
    let field = document.getElementById(id);
    field.type = field.type === "password" ? "text" : "password";
}

function validateForm(){
    let p1 = document.getElementById("pass1").value;
    let p2 = document.getElementById("pass2").value;

    if(p1 !== p2){
        alert("Passwords do not match!");
        return false;
    }

    let btn = document.getElementById("registerBtn");
    btn.innerText = "Creating...";
    return true;
}
</script>

</body>
</html>