<?php
class DataDPTController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index()
    {
        // Access the database connection using $this->db
        // Use the connection for database operations
        if (!isset($_SESSION['user_id'])) {
            
            SweetAlert::setAlert("Oops!","Kamu Belum Melakukan Login, Harap Lakukan Login Terlebih dahulu ya!", "error");

            header('Location: /evoting2/admin/login');
            exit();
        }
            // Prepare and execute the SELECT query to fetch DPT data
            $stmt = $this->db->prepare('SELECT * FROM pemilih');
            $stmt->execute();
    
            // Fetch all rows from the result set
            $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
            // Construct the file path to the view file
            $viewFilePath = __DIR__ . '/../views/data_dpt.php';
    
            // Include the view file and pass the data as a variable
            include $viewFilePath;
    }
    

    public function deleteData(){
        $id = $_POST['id'];

        $stmt = $this->db->prepare('DELETE FROM pemilih WHERE id_pemilih=?');
        $stmt->bind_param('i',$id);
        $stmt->execute();
        SweetAlert::setAlert("Berhasil!","Kamu Berhasil Menghapus Data DPT", "success");
        header('Location: /evoting2/admin/datadpt');
        exit();
    }
    
    public function getEditPage() {
        $id = $_POST['id'];
    
        $stmt = $this->db->prepare('SELECT * FROM pemilih WHERE id_pemilih=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        // // Construct the file path to the view file
         $viewFilePath = __DIR__ . '/../views/edit_data_dpt.php';
        include $viewFilePath;
    }
    
    public function updateDataDPT(){
        $id = $_POST['id'];
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        
        $stmt = $this->db->prepare('UPDATE pemilih SET nim=?, nama=? WHERE id_pemilih=?');
        $stmt->bind_param("ssi", $nim, $nama, $id);
        $stmt->execute();
        
        SweetAlert::setAlert("Berhasil!","Kamu Berhasil Mengubah Data DPT", "success");
        header('Location: /evoting2/admin/datadpt');
        exit();
    }
    
}
?>
