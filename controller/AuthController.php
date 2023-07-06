<?php
class AuthController {
    public function logout() {
        // Start the session
        session_start();
        
        // Destroy the session and unset all session variables
        session_unset();
        session_destroy();
        
        // Redirect the user to the login page or any other desired page
        header('Location: /evoting2/admin/login');
        exit();
    }
}
?>