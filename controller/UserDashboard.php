<?php
class UserDashboard {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Access the database connection using $this->db
        // Check if the user is logged in
        if (isset($_SESSION['id_pemilih'])) {
            // User is logged in, proceed with displaying the dashboard
                    // Get the ID of the logged-in pemilih
                $pemilihId = $_SESSION['id_pemilih'];
                
                // Check if the pemilih has already voted
                $stmt = $this->db->prepare('SELECT COUNT(*) AS vote_count FROM pemilihan WHERE id_pemilih = ?');
                $stmt->bind_param('i', $pemilihId);
                $stmt->execute();
                
                // Get the result of the vote count query
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $voteCount = $row['vote_count'];
                
                if ($voteCount > 0) {
                    // Pemilih has already voted, handle accordingly          
                    SweetAlert::setAlert("Oops!", "Kamu Telah Melakukan Vote Sebelumnya", "error");
                    header("Location: /evoting2/");
                } else {
                    // Pemilih has not voted yet, proceed to pages
                    // Fetch the candidates from the database
                    $stmt = $this->db->prepare('SELECT * FROM calon');
                    $stmt->execute();
                    
                    // Fetch all rows from the result set
                    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
                    $currentDir = __DIR__;
        
                    // Construct the file path to the view file
                    $viewFilePath = $currentDir . '/../views/user_dashboard.php';
                }
            
            // Include the view file
            include $viewFilePath;
            
        } else {
            // User is not logged in, redirect to the login page or display an error message
            
            SweetAlert::setAlert("Oops!","Kamu Belum Melakukan Login, Harap Lakukan Login Terlebih dahulu ya!", "error");
            header('Location: /evoting2/');
            exit();
        }
    }

    public function vote() {
        // Check if the user is logged in
        if (isset($_SESSION['id_pemilih'])) {
            // User is logged in, proceed with vote recording and counting
            
            // Check if the form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                // Get the candidate ID from the form submission
                $candidateId = $_POST['id'];
                
                // Get the ID of the logged-in pemilih
                $pemilihId = $_SESSION['id_pemilih'];
                
                // Check if the pemilih has already voted
                $stmt = $this->db->prepare('SELECT COUNT(*) AS vote_count FROM pemilihan WHERE id_pemilih = ?');
                $stmt->bind_param('i', $pemilihId);
                $stmt->execute();
                
                // Get the result of the vote count query
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $voteCount = $row['vote_count'];
                
                if ($voteCount > 0) {
                    // Pemilih has already voted, handle accordingly
                    SweetAlert::setAlert("Oops!", "Kamu Telah Melakukan Vote Sebelumnya", "error");
                    header("Location: /evoting2/");
                } else {
                    // Pemilih has not voted yet, proceed with vote recording and counting
                    
                    // Add the vote to the pemilihan table
                    $insertStmt = $this->db->prepare('INSERT INTO pemilihan (id_calon, id_pemilih) VALUES (?, ?)');
                    $insertStmt->bind_param('ii', $candidateId, $pemilihId);
                    $insertStmt->execute();
                    SweetAlert::setAlert("Terima Kasih!","Kamu Berhasil Melakukan Vote", "success");
                    header("Location: /evoting2/");
                }
            }
        }
    }
    
    
}

?>
