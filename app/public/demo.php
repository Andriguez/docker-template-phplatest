<?php

/*require_once '../db.php';

$db = DB::getInstance();

$statements = [
    "create table if not exists USERS (user_id INT AUTO_INCREMENT, username VARCHAR(50), PRIMARY KEY(user_id))",
    "insert INTO USERS (username) values ('Wim Wiltenburg')",
];

foreach ($statements as $statement) {
    $db->exec($statement);
}

$users = $db->query("select * from USERS");
foreach ($users as $user) {
    var_dump($user);
}*/
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $name = $_GET["name"];
    $birthdayStr = $_GET["birthdate"];
    $birthdate = date("F j, Y",strtotime($birthdayStr));
    echo "name = ".$name." and birthdate = ".$birthdate;
}

?>

<!--<html>
<form action="/formdemo.php" method="POST">
    <label for="firstname">First name:</label><br>
    <input type="text" id="firstname" name="firstname" value="John"><br>
    <label for="lastname">Last name:</label><br>
    <input type="text" id="lastname" name="lastname" value="Doe"><br><br>
    <input type="submit" value="Submit">
</form>
</html>-->


