<?php
class UserLoginController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Access the database connection using $this->db
        // Use the connection for database operations
        // Get the absolute path of the current directory
        $currentDir = __DIR__;

        // Construct the file path to the view file
        $viewFilePath = $currentDir . '/../views/user_login.php';
        
        // Include the view file
        include $viewFilePath;
    }

    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        var_dump($_POST);
        $stmt = $this->db->prepare('SELECT * FROM pemilih WHERE nim=?');
        $stmt->bind_param('s',$username);
        $stmt->execute();
    
        // Get the result set from the executed statement
        $user = $stmt->get_result()->fetch_assoc();
        var_dump(password_verify($password,$user['password']));
        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, authentication successful
    
                // Store the user information in the session or any other authentication mechanism
                // For example, you can store the user ID in the session:
                $_SESSION['id_pemilih'] = $user['id_pemilih'];
    
                // Redirect to the dashboard page or any other authorized page
                SweetAlert::setAlert("Selamat!","Kamu Berhasil Login", "success");
                header('Location: /evoting2/user/index');
                exit();
            } else {
                // Password is incorrect, authentication failed
                // Handle the error, e.g., show an error message to the user
                $error = 'Username Atau Password Tidak Valid';
                SweetAlert::setAlert("Oops!","$error", "error");
                header('Location: /evoting2/');
                exit();
            }
        } else {
            // User not found, authentication failed
            // Handle the error, e.g., show an error message to the user
            $error = 'Username Atau Password Tidak Valid';
            SweetAlert::setAlert("Oops!","$error", "error");
            header('Location: /evoting2/');
            exit();
        }
    }
    public function changePassword () {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];

        $stmt = $this->db->prepare('SELECT * FROM pemilih WHERE nim=?');
        $stmt->bind_param('s',$username);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();
        if(!$user || !password_verify($password,$user['password'])) {
            $error = 'User atau Password tidak valid';
            SweetAlert::setAlert("Oops!","$error", "error");
            header('Location: /evoting2/');
            exit();
        } else {
            $hashed_password = password_hash($newPassword,PASSWORD_DEFAULT);
            $updatePassword = $this->db->prepare('UPDATE pemilih SET password=?');
            $updatePassword->bind_param('s',$hashed_password);
            $updatePassword->execute();
            SweetAlert::setAlert("Selamat!","Password berhasil diubah", "success");
            header('Location: /evoting2/');
            exit();
        }
    }
}
?>
