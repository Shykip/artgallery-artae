<?php

class Database {

    public $connection;

    function __construct() {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "artae";
    
        // Create connection
        $this->connection = new mysqli($servername, $username, $password, $database);
    
        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Checking if the user with correct username and password exists in database
    function userAuthentication($username, $password) {

        $encryptedPass = md5($password);

        $query = "SELECT * FROM users WHERE BINARY username = '$username' and password = '$encryptedPass'";
        $result = $this->connection->query($query); 

        if ($result) {
            while ($row = mysqli_fetch_array($result)) {

                $query = "UPDATE users SET active = '1' WHERE BINARY username = '$username'";
                $result = $this->connection->query($query);
                return true;
            }
        }

        return false;
    }

    // Checking if user is admin or not
    function userUserRole($username) {

        $query = "SELECT * FROM users WHERE BINARY username = '$username' and admin = '1'";
        $result = $this->connection->query($query); 

        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                return true;
            }
        }

        return false;
    }

    // Returns the active user name
    function getActiveUser() {

        $query = "SELECT * FROM users WHERE BINARY active = '1'";
        $result = $this->connection->query($query);

        if ($result) {
            while ($row = mysqli_fetch_array($result)) {

                return $row['username'];
            }
        }

        return null;
    }

    function setUserOffline($username) {

        $query = "UPDATE users SET active = '0' WHERE BINARY username = '$username'";
        $result = $this->connection->query($query);
    }

    // Registering new user in database
    function userRegister($username, $password) {

        $encryptedPass = md5($password);

        $query = "INSERT INTO users (username, password) VALUES('$username', '$encryptedPass')";
        $this->connection->query($query);
    }

    // Delete row from images table
    function itemDelete($id) {

        $query = "DELETE FROM images WHERE id = '$id'";
        $result = mysqli_query($this->connection, $query);
    }

    // Returns uploader of the item
    function getUploader($id) {

        $query = "SELECT * FROM images WHERE id = '$id'";
        $result = $this->connection->query($query);

        if ($result) {
            while ($row = mysqli_fetch_array($result)) {

                return $row['user'];
            }
        }

        return null;
    }

    // Inserting Image Info in database
    function imageInsert($title, $description, $date, $user, $destination) {
        $escaped_string = mysqli_real_escape_string($this->connection, $description);
        $query = "INSERT INTO images (title, description, date, user, destination) VALUES('$title', '$escaped_string', '$date', '$user', '$destination')";
        $this->connection->query($query);
    }

    function closeConnection() {
        mysqli_close($this->connection);
    }

}

?>