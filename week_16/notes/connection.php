<?php
define('SITEURL', 'http://localhost/helpers/notes/');
class Connection {
    public $mysqli;

    public function __construct($host, $username, $password, $database) {
        $this->mysqli = new mysqli($host, $username, $password, $database);

        if ($this->mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $this->mysqli->connect_error);
        }
    }

    public function getNotes() {
        $statement = "SELECT * FROM notes ORDER BY create_date";
        $res = $this->mysqli->query($statement);

        if ($res === false) {
            error_log("Error executing query: " . $this->mysqli->error);
            return false;
        }

        if ($res->num_rows === 0) {
            return [];
        }

        $notes = mysqli_fetch_all($res, MYSQLI_ASSOC);
        mysqli_free_result($res);

        return $notes;
    }

    public function addNotes($data) {
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';

        $statement = $this->mysqli->prepare('INSERT INTO notes(title, description, create_date) VALUES (?,?, ?)');
        if ($statement === false) {
            error_log("Error preparing statement: " . $this->mysqli->error);
            return false;
        }

        $start_time = time();
        $start_time_dt = new DateTime('@' . $start_time);
        $start_time_formatted = $start_time_dt->format('Y-m-d H:i:s');

        $statement->bind_param('sss', $title, $description, $start_time_formatted);

        $res = $statement->execute();
        if ($res === false) {
            error_log("Error executing statement: " . $statement->error);
            return false;
        }

        header('LOCATION:' . SITEURL);
        return true;
    }

    public function getNoteById($id) {
        $statement = $this->mysqli->prepare("SELECT * FROM notes WHERE id = ?");
        if ($statement === false) {
            error_log("Error preparing statement: " . $this->mysqli->error);
            return false;
        }

        $statement->bind_param('i', $id);

        $res = $statement->execute();
        if ($res === false) {
            error_log("Error executing statement: " . $statement->error);
            return false;
        }

        $res = $statement->get_result();
        if ($res->num_rows === 0) {
            return false;
        }

        $note = $res->fetch_assoc();
        mysqli_free_result($res);

        return $note;
    }

    public function updateNotes($data) {
        $id=$data['id'];
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';

        if (empty($title) || empty($description)) {
            return false;
        }

        $statement = $this->mysqli->prepare("UPDATE notes SET title = ?, description = ? WHERE id = ?");
        if ($statement === false) {
            error_log("Error preparing statement: " . $this->mysqli->error);
            return false;
        }

        $statement->bind_param('ssi', $title, $description, $id);

        $res = $statement->execute();
        if ($res === false) {
            error_log("Error executing statement: " . $statement->error);
            return false;
        }

        header('LOCATION:' . SITEURL);
        return true;
    }
    public function remove($id){
        $statement = $this->mysqli->prepare("DELETE FROM `notes` WHERE id = ?");
        $statement->bind_param('i', $id);

        $res = $statement->execute();
        if ($res === false) {
            error_log("Error executing statement: " . $statement->error);
            return false;
        }

        header('LOCATION:' . SITEURL);
        return true;
    }
}
return new connection('localhost', 'root', '', 'notes');
?>