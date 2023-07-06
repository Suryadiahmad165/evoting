<?php
class TambahDPTController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Access the database connection using $this->db
        // Use the connection for database operations
        if (!isset($_SESSION['user_id'])) {
            
            SweetAlert::setAlert("Oops!","Kamu Belum Melakukan Login, Harap Lakukan Login Terlebih dahulu ya!", "error");

            header('Location: /evoting2/admin/login');
            exit();
        }
        // Get the absolute path of the current directory
        $currentDir = __DIR__;

        // Construct the file path to the view file
        $viewFilePath = $currentDir . '/../views/tambah_dpt.php';

        // Include the view file
        include $viewFilePath;
    }

    public function store() {
        // Retrieve the form data
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $id_prodi = 1;

        $hashedPassword = password_hash($nim,PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('INSERT INTO pemilih (nim, nama, password, id_prodi) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('sssi', $nim, $nama, $hashedPassword, $id_prodi); 
        $stmt->execute();
        
    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
      SweetAlert::setAlert("Berhasil!","Kamu Berhasil Menambahkan Data DPT", "success");
      header('Location: /evoting2/admin/datadpt');
    } else {
    
        SweetAlert::setAlert("Gagal!","Data DPT Gagal Ditambahkan", "error");
        // Redirect to the index page or display a success message
        header('Location: /evoting2/admin/datadpt');
        // exit();
}
    
}
}

?>
