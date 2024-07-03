<?php
class SessionManager {
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($clientType) {
        $_SESSION['client_type'] = $clientType;
    }

    public static function logout() {
        self::startSession();
        if (isset($_SESSION['client_type'])) {
            $clientType = $_SESSION['client_type'];

            $path=BASE_PATH.$clientType;            
            session_unset();
            //session_destroy();
            echo "<script>
            localStorage.removeItem('client_type');
            window.location.href = '$path/login.php';
            </script>";
            exit();
        }
    }

    public static function checkSession() {
        self::startSession();
        if (!isset($_SESSION['client_type'])) {
            echo "<script>
            var clientType = localStorage.getItem('client_type');
            if(clientType!='0')
            {
                if (clientType) 
                {
                    window.location.href = '" . BASE_PATH . "' + clientType + '/login.php';
                } 
                else 
                {
                    window.location.href = 'login.php';
                }
            }
            else
            {
                window.location.href = 'login.php';
            }
            </script>";
            exit();

        }
    }
}
?>
