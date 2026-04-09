<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

/* Background */
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0f9b0f, #1db954);
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    padding: 15px 20px;
    color: white;
    align-items: center;
}

.logout {
    text-decoration: none;
    background: rgba(255,255,255,0.2);
    padding: 8px 12px;
    border-radius: 8px;
    color: white;
}

/* Container */
.container {
    padding: 20px;
    max-width: 500px;
    margin: auto;
}

/* Glass Card */
.card {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(15px);
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 15px;
    color: white;
    box-shadow: 0 8px 30px rgba(0,0,0,0.2);
}

/* Form */
input, button {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: none;
    border-radius: 10px;
}

button {
    background: #00c853;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #00e676;
}

/* Reminder list */
.reminder {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

/* Delete button */
.delete-btn {
    background: #ff5252;
    padding: 5px 10px;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    font-size: 12px;
}

/* Mobile */
@media(max-width:480px){
    .container {
        padding: 10px;
    }
}

</style>
</head>

<body>

<div class="header">
    <h2>💊 Hello, <?php echo $_SESSION['user']; ?></h2>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="container">
    <button onclick="testNotification()">🔔 Test Notification</button>

    <!-- Add Reminder -->
    <div class="card">
        <h3>➕ Add Reminder</h3>

        <form action="save.php" method="POST">
            <input type="text" name="medicine" placeholder="Medicine Name" required>
            <input type="time" name="time" required>
            <button>Add</button>
        </form>
    </div>

    <!-- Reminders -->
    <div class="card">
        <h3>⏰ Your Reminders</h3>

<?php
if(file_exists("data.txt")){
    $file = file("data.txt");

    foreach($file as $index => $line){
        echo "
        <div class='reminder'>
            <span>$line</span>
            <a href='delete.php?id=$index' class='delete-btn'>Delete</a>
        </div>";
    }
}
?>

    </div>

</div>
<script src="js/scripts.js"></script>
</body>
</html>