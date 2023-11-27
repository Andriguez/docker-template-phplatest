<?php
require_once("dbconfig.php");

try{
    $connection = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected succesfully";
} catch (PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}
?>
<!DOCTYPE html>
<head>
    <title>Guestbook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<?php

if ($_SERVER['REQUEST_METHOD']=== 'POST') {

    $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

    $name=($_POST["firstname"]);
    $email=($_POST["email"]);
    $message=($_POST["message"]);

    $stmt = $connection->prepare("INSERT INTO posts
    (name, email, message, posted_at, ip_address)
    VALUES
    (:name, :email, :message, now(), :ip_address)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':ip_address', $_SERVER['REMOTE_ADDR']);

    $stmt->execute();
}
?>
<h2>GuestBook</h2>
<form class="form border-3 p-3 bg-secondary" method="POST">
    <div class="m-3">
        <div class="form-field">
            <label class="form-label" for="name">Name:</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="what's your name?"/>
        </div>
        <div class="form-field">
            <label class="form-label" for="email">Email address:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="what's your email?"/>
        </div>
        <div class="mb-3">
            <label class="form-label" for="message">Message:</label>
            <textarea class="form-control" name="message" id="message" rows="5"></textarea>
        </div>
        <div class="form-field col-auto">
            <label>&nbsp;</label>
            <input type="submit" value ="Send"/>
        </div>
    </div>
</form>
 <?php
$sql = "SELECT * FROM posts";
$result = $connection->query($sql);

foreach ($result as $row){ ?>
    <div class="col d-flex justify-content-center">
        <div class="border border-5 p-2 m-3">
            <div class="card bg-light" style="width: 40rem;">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
                <div class="card-body">
                    <h2 class="fw-normal"><?= $row['name'] ?></h2>
                    <p><?= $row['message']?>.</p>
                    <p><strong>Email:</strong> <?= $row['email'] ?></p>
                    <p><strong>IpAddress:</strong> <em><?= $row['ip_address']?></em></p>
                    <p><small><em><?= $row['posted_at']?></em></small></p>
                </div>
            </div>

        </div>
    </div>
<?php } ?>
</body>
 </html>

