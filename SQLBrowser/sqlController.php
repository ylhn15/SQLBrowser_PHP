<?php

function createUsersTable($conn)
{
    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP NOT NULL DEFAULT NOW()
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table users created successfully \n";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $conn->close();
}

function insertUser($firstname, $lastname, $email)
{
    $conn = connect();
    $sql = "INSERT INTO users(firstname, lastname, email)
        VALUES ('$firstname', '$lastname', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo buildTable(getAllUsers($conn));

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function connect()
{
    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function main()
{
    $conn = connect();
    echo buildTable(getAllUsers($conn));
    $conn->close();
}

function parseResults($result)
{
    $array = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $user = array('ID' => $row["id"], 'First name' => $row["firstname"], 'Last name' => $row["lastname"], 'E-Mail' => $row["email"], 'Registration date' => $row["reg_date"]);
            array_push($array, $user);
        }
    } else {
        echo "<h4> No entries found - 0 results </h4>";
    }
    return $array;
}

function getAllUsers($conn)
{
    $sql = "SELECT * FROM users;";
    $result = $conn->query($sql);
    return parseResults($result);
}

function getUsersWithSearchterm($searchterm)
{
    $conn = connect();
    $sql = "SELECT id, firstname, lastname, email FROM users WHERE firstname like '%$searchterm%' OR lastname like '%$searchterm%' OR email like '%$searchterm%';";
    $result = $conn->query($sql);
    return parseResults($result);
}

function deleteUserWithId($id)
{
    $conn = connect();
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo buildTable(getAllUsers($conn));
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
}

function buildTable($array)
{
    // start table
    if(is_array($array[0])) {
        $html = '<table class="table">';
        // header row
        $html .= '<tr>';
        foreach($array[0] as $key=>$value){
            if(strcmp($key, "ID") == 0) {
                $html .= '<th style="display:none;">' . htmlspecialchars($key) . '</th>';
            } else {
                $html .= '<th>' . htmlspecialchars($key) . '</th>';
            }
        }
        $html .= '<th> </th>';
        $html .= '</tr>';

        // data rows
        foreach( $array as $key=>$value){
            $html .= '<tr>';
            foreach($value as $key2=>$value2){
                if(strcmp($key2, "ID") == 0) {
                    $html .= '<td style="display:none;">' . htmlspecialchars($value2) . '</td>';
                } else {
                    $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                }
            }
            $html .= '<td>
                <button type="button" class="btn btn-danger deleteButton" id="deleteButton">
                <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
                </td>';
            $html .= '</tr>';
        }

        // finish table and return it

        $html .= '</table>';
        return $html;
    }
}
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
    case 'insert':
        insertUser($_POST['firstname'],$_POST['lastname'],$_POST['email']);
        break;
    case 'delete':
        deleteUserWithId($_POST['id']);
        break;
    case 'search':
        $array = getUsersWithSearchterm($_POST['searchterm']);
        echo buildTable($array);
        break;
    }

}
?>
