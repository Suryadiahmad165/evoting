<?php

class DashboardAdmin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Access the database connection using $this->db
        if (!isset($_SESSION['user_id'])) {
            
            SweetAlert::setAlert("Oops!","Kamu Belum Melakukan Login, Harap Lakukan Login Terlebih dahulu ya!", "error");

            header('Location: /evoting2/admin/login');
            exit();
        }

        $suara = new Suara($this->db);
        $result = $suara->getSuara();

// Now you can work with the $result as needed

        
        // Get the absolute path of the current directory
        $currentDir = __DIR__;

        // Construct the file path to the view file
        $viewFilePath = $currentDir . '/../views/dashboard_admin.php';

        // Render the view and pass the graph image to it
        include $viewFilePath;
    }
}

?>
