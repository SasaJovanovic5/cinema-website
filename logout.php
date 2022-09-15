<?php

    include ('includes/header.html');

    if(!isset($_SESSION['id'])) {
        $url  ='index.php';
        header("Location: $url");
        exit();

    } else {
        $_SESSION = array();
        session_destroy();
        setcookie (session_name(), '', time()-3600);
        $url = 'index.php';
        header("Location: $url");
        exit();
    }

?>





<?php

    include ('includes/footer.html');

?>