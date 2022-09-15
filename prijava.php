<?php

    include ('includes/header.html');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(!empty($_POST['email'])) {
            $em = mysqli_real_escape_string ($dbc, $_POST['email']);
        } else {
            $em = FALSE;
            echo '<div class="alert alert-danger" role="alert">Vnesite email naslov!</div>';

        }

        if(!empty($_POST['geslo'])) {
            $ps = mysqli_real_escape_string ($dbc, $_POST['geslo']);
        } else {
            $ps = FALSE;
            echo '<div class="alert alert-danger" role="alert">Vnesite geslo naslov!</div>';
        }

        if($em && $ps) {
            $q = "SELECT id, ime, admin_nivo FROM uporabnik WHERE (email='$em' AND geslo=SHA1('$ps'))";
            $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

            if(@mysqli_num_rows($r) == 1) {


                $_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC);
                mysqli_free_result($r);
                mysqli_close($dbc);
                $url = 'index.php';
                header("Location: $url");
                exit();
            } else {
                echo '<div class="alert alert-danger" role="alert">Vneseni podatki so napacni!</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Poskusite se enkrat.</div>';
        }

        mysqli_close($dbc);

    }

?>

<h1>Login</h1>
<form action="prijava.php" method="post">
	<fieldset>
        <div class="form-group">
            <label>Email:</label> <input type="text" name="email" size="20" maxlength="60" class="form-control" />
        </div>

        <div class="form-group">
            <label>Geslo:</label> <input type="password" name="geslo" size="20" maxlength="20" class="form-control"  />
        </div>
        <div align="center"><input type="submit" name="submit" value="Login" class="btn btn-primary" /></div>
	</fieldset>
</form>




<?php

    include ('includes/footer.html');

?>