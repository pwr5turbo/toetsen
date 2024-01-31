<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "top2000";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM artist");
    $stmt->execute();

    $result = $stmt->fetchAll();

    $table = "<table id='artistTable'>";
    $table .= "<tr><td colspan='5' style='text-align: center;'><h1 onclick='dropdown()'>Toevoegen</h1></td></tr>";
    $table .= "<tr><th>Id</th><th>Name</th><th>Country</th><th>Delete</th><th>Edit</th></tr>";
    foreach($result as $row)
    {
        $table .= "<tr><td>" . $row["id"] . "</td>";
        $table .= "<td>" . $row["name"] . "</td>";
        $table .= "<td>" . $row["country"] . "</td>";
        $table .= "<td>" .'<a href="delete.php?id='.$row["id"].'"><i class="fa-solid fa-trash-can"></i><a>' . "</td>";
        $table .= "<td>" . '<a href="edit.php?id='.$row["id"].'"><i class="fa-solid fa-user-pen"></i></i></a>' . "</td></tr>";
    }
    $table .= "</table>";


} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}   

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['naam']) && isset($_GET['land'])) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $naam = $_GET['naam'];
        $land = $_GET['land'];

        $sql = "INSERT INTO artist (id, name, country) VALUES (NULL, :naam, :land)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':naam', $naam, PDO::PARAM_STR);
        $stmt->bindParam(':land', $land, PDO::PARAM_STR);
        $stmt->execute();

        echo "New record created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>artist toets 2</title>
    <script src="https://kit.fontawesome.com/7315431ee7.js" crossorigin="anonymous"></script>
    <script src="edit.js"></script>
    <link rel="stylesheet" href="crud.css">
</head>
<body>
    <div>
        <?php echo $table ?>
    </div>
    <div id="check">
        <h1>Error</h1>
    </div>
    <div id="toevoegen">
        <h1 onclick="hide()">Artiest toevoegen</h1>
        <div>
            <table>
                <tr>
                    <td><label for="naam">Naam:</label></td>
                    <td><input type="text" id="naam" name="naam" placeholder="Naam"></td>
                </tr>
                <tr>
                    <td><label for="land">Land:</label></td>
                    <td><input type="text" id="land" name="land" placeholder="Land"></td>
                </tr>
                <tr>
                    <td colspan="2"><button id="subButton" onclick="add()">Verstuur</button></td>
                </tr>
            </table>
        </div>
    </div>
    
</body>
</html>