<?php
$id = $_GET["id"];
if (isset($id)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $naam = isset($_POST['naam']) ? htmlspecialchars($_POST['naam']) : '';
        $land = isset($_POST['land']) ? htmlspecialchars($_POST['land']) : '';
        $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';

        if (isset($naam) && isset($land)) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "top2000";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "UPDATE `artist` SET `name`=:naam, `country`=:land WHERE id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':naam', $naam, PDO::PARAM_STR);
                $stmt->bindParam(':land', $land, PDO::PARAM_STR);
                $stmt->execute();

                
                $response = array("success" => true, "redirect_url" => "CRUD.php");
                echo json_encode($response);
                exit(); 
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }

            $conn = null;
        }
    }
} else {
    echo "id isn't set";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit artist</title>
    <script src="edit.js"></script>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <input type="hidden" id="id" value=<?php echo $id ?> >
    <div>
        <h1>Artiest aanpassen</h1>
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
                    <td colspan="2"><button id="subButton" onclick="changetest()">Verstuur</button></td>
                </tr>
            </table>
        </div>
    </div>
    <div id="check">
        <h1>Error</h1>
    </div>
</body>
</html>
