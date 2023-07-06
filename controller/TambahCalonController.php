<?php
class TambahCalonController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Access the database connection using $this->db
        // Use the connection for database operations
        // Get the absolute path of the current directory
        if (!isset($_SESSION['user_id'])) {
            
            SweetAlert::setAlert("Oops!","Kamu Belum Melakukan Login, Harap Lakukan Login Terlebih dahulu ya!", "error");

            header('Location: /evoting2/admin/login');
            exit();
        }
        $currentDir = __DIR__;

        // Construct the file path to the view file
        $viewFilePath = $currentDir . '/../views/tambah_calon.php';
        
        // Include the view file
        include $viewFilePath;
    }

    public function store() {
        $nimketua = $_POST['nimketua'];
        $nimwakil = $_POST['nimwakil'];
        $namawakil = $_POST['namawakil'];
        $namaketua = $_POST['namaketua'];
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];
        $foto = $_FILES['foto'];
        
    // Check if a file was uploaded successfully
    if ($foto['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file name
        $tmpFilePath = $foto['tmp_name'];

        // Generate a unique file name to avoid conflicts
        $fileName = uniqid() . '_' . $foto['name'];

        // Specify the directory to which the file will be uploaded
        $uploadDir = 'public/image/upload/';

        // Create the file path by concatenating the upload directory and the file name
        $filePath = $uploadDir . $fileName;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($tmpFilePath, $filePath)) {
            // File upload was successful
            $data = "/evoting2/$filePath";
        } else {
            // File upload failed
            echo "File upload failed.";
        }
    } else {
        // Error occurred during file upload
        echo "An error occurred during file upload.";
    }

    $stmt = $this->db->prepare('INSERT INTO calon (nim_calon_ketua, nim_calon_wakil_ketua, nama_calon_ketua, nama_calon_wakil_ketua, visi, misi, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('sssssss', $nimketua, $nimwakil, $namaketua, $namawakil, $visi, $misi, $data);
    $stmt->execute();

    SweetAlert::setAlert("Berhasil!","Kamu Berhasil Menambahkan Data Calon", "success");
    header('Location: /evoting2/admin/tambahcalon');

    }
}
?>
