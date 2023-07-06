<?php
class AdminLoginController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Access the database connection using $this->db
        if (isset($_SESSION['user_id'])) {
            // User is already logged in, redirect to the dashboard or any other authorized page
            header('Location: /evoting2/admin/index');
            exit();
        }
        
        // Use the connection for database operations
        // Get the absolute path of the current directory
        $currentDir = __DIR__;

        // Construct the file path to the view file
        $viewFilePath = $currentDir . '/../views/admin_login.php';
        
        // Include the view file
        include $viewFilePath;
    }

    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $stmt = $this->db->prepare('SELECT * FROM admin WHERE username=?');
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
                $_SESSION['user_id'] = $user['id_admin'];
    
                // Redirect to the dashboard page or any other authorized page
                SweetAlert::setAlert("Selamat!","Kamu Berhasil Login", "success");
                header('Location: /evoting2/admin/index');
                exit();
            } else {
                // Password is incorrect, authentication failed
                // Handle the error, e.g., show an error message to the user
                $error = 'Username atau Password Tidak Valid';
                SweetAlert::setAlert("Oops!","$error", "error");
                header('Location: /evoting2/admin/login');
                exit();
            }
        } else {
            // User not found, authentication failed
            // Handle the error, e.g., show an error message to the user
            $error = 'Username atau Password Tidak Valid';
            SweetAlert::setAlert("Oops!","$error", "error");
            header('Location: /evoting2/admin/login');
            exit();
        }
    }

    public function changePassword() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];

        $stmt = $this->db->prepare('SELECT * FROM admin WHERE username=?');
        $stmt->bind_param('s',$username);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();
        if(!$user || !password_verify($password,$user['password'])) {
            $error = 'User atau Password tidak valid';
            SweetAlert::setAlert("Oops!","$error", "error");
            header('Location: /evoting2/admin/login');
            exit();
        } else {
            $hashed_password = password_hash($newPassword,PASSWORD_DEFAULT);
            $updatePassword = $this->db->prepare('UPDATE admin SET password=?');
            $updatePassword->bind_param('s',$hashed_password);
            $updatePassword->execute();
            SweetAlert::setAlert("Selamat!","Password berhasil diubah", "success");
            header('Location: /evoting2/admin/login');
            exit();
        }
    }
    
}
?>
