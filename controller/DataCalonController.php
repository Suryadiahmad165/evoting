<?php
class DataCalonController {
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
        $stmt = $this->db->prepare('SELECT * FROM calon');
        $stmt->execute();
        
        // Fetch all rows from the result set
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        // Use the connection for database operations
        // Get the absolute path of the current directory
        $currentDir = __DIR__;

        // Construct the file path to the view file
        $viewFilePath = $currentDir . '/../views/data_calon.php';
        
        // Include the view file
        include $viewFilePath;
    }

    public function deleteCalon() {
        $id = $_POST['id'];
        $filePath = $_SERVER['DOCUMENT_ROOT'] . $_POST['foto'];


        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                $stmt = $this->db->prepare('DELETE FROM calon WHERE id_calon=?');
                $stmt->bind_param('i',$id);
                $stmt->execute();
                SweetAlert::setAlert("Berhasil!","Kamu Berhasil Menghapus Data Calon", "success");
                header("Location: /evoting2/admin/datacalon");
                exit();
            } else {
                $error = "Tidak bisa menghapus file ini.";
                SweetAlert::setAlert("Oops!","$error", "error");
                header("Location: /evoting2/admin/datacalon");
                exit();
            }
        } else {
            $error = "File tidak tersedia.";
            SweetAlert::setAlert("Oops!","$error", "error");
            header("Location: /evoting2/admin/datacalon");
            exit();
        }
        

    }
    public function getEditPage() {
        $id = $_POST['id'];
    
        $stmt = $this->db->prepare('SELECT * FROM calon WHERE id_calon=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        // // Construct the file path to the view file
         $viewFilePath = __DIR__ . '/../views/edit_data_calon.php';
        include $viewFilePath;
    }
    public function updateDataCalon()
    {
        $nimketua = $_POST['nimketua'];
        $nimwakil = $_POST['nimwakil'];
        $namawakil = $_POST['namawakil'];
        $namaketua = $_POST['namaketua'];
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];
        $foto = $_FILES['foto'];
        $fotoLama = $_POST['existingFoto'];
        $id = $_POST['id'];
    
        $stmt = $this->db->prepare("SELECT * FROM calon WHERE id_calon=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    
        $user = $stmt->get_result()->fetch_assoc();
    
        if (!$user) {
            $error = "Data Calon tidak ditemukan.";
            SweetAlert::setAlert("Oops!", "$error", "error");
            header("Location: /evoting2/admin/datacalon");
            exit();
        } else {
            $fotoLamaPath = $_SERVER['DOCUMENT_ROOT'] . $fotoLama;
            if (file_exists($fotoLamaPath)) {
                if (!empty($foto) && $foto['error'] !== UPLOAD_ERR_NO_FILE) {
                    // Delete the old file
                    unlink($fotoLamaPath);
    
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
                            $error = "File upload failed.";
                            SweetAlert::setAlert("Oops!", "$error", "error");
                            header("Location: /evoting2/admin/datacalon");
                            exit();
                        }
                    } else {
                        // Error occurred during file upload
                        $error = "An error occurred during file upload.";
                        SweetAlert::setAlert("Oops!", "$error", "error");
                        header("Location: /evoting2/admin/datacalon");
                        exit();
                    }
                } else {
                    // Keep the old file
                    $data = $fotoLama;
                }
    
                $updateData = $this->db->prepare('UPDATE calon SET nim_calon_ketua=?, nim_calon_wakil_ketua=?, nama_calon_ketua=?, nama_calon_wakil_ketua=?, visi=?, misi=?, gambar=? WHERE id_calon=?');
                $updateData->bind_param('sssssssi', $nimketua, $nimwakil, $namaketua, $namawakil, $visi, $misi, $data, $id);
                $updateData->execute();
    
                SweetAlert::setAlert("Berhasil!", "Data Calon berhasil diubah", "success");
                header("Location: /evoting2/admin/datacalon");
                exit();
            } else {
                $error = "File tidak tersedia.";
                SweetAlert::setAlert("Oops!", "$error", "error");
                header("Location: /evoting2/admin/datacalon");
                exit();
            }
        }
    }
    
    
}
?>
