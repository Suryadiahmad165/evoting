<?php
    class SweetAlert {

        public static function setAlert ($JudulAlert, $pesan, $icon){
            $_SESSION['flash'] = [
                'judul' => $JudulAlert,
                'pesan' => $pesan,
                'icon' => $icon
            ];
        }
        public static function Alert() {
            if (isset($_SESSION['flash'])) {
                echo "
                    Swal.fire(
                        '{$_SESSION['flash']['judul']}',
                        '{$_SESSION['flash']['pesan']}',
                        '{$_SESSION['flash']['icon']}'
                    );";
                unset($_SESSION['flash']);
            }
            
        }


    }
?>