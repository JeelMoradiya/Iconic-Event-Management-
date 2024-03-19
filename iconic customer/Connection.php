<?php
final class Connection extends mysqli {
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "iconic_v2";

    public function __construct() {
        parent::__construct($this->hostname, $this->username, $this->password, $this->database);
    }

    public function close() {
        $this->close();
    }
}

$conn = new Connection();
?>