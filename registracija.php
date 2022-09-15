<?php

    include ('includes/header.html');


    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $trimmed = array_map('trim', $_POST);

        
        $im = mysqli_real_escape_string ($dbc, $trimmed['ime']);
        $pr = mysqli_real_escape_string ($dbc, $trimmed['priimek']);
       
       


        $em = mysqli_real_escape_string ($dbc, $trimmed['email']);

        if(preg_match ('/^\w{4,20}$/', $trimmed['geslo'])) {
            if($trimmed['geslo'] == $trimmed['geslo2']) {
                $pass = mysqli_real_escape_string($dbc, $trimmed['geslo']);
            } else {
                echo '<div class = "alert alert-danger" role="alert">Gesli se ne ujemata!</div>';
            }
        }

        if(empty($errors) && $em && $pass) {

            $q = "SELECT id FROM uporabnik WHERE email='$em'";
            if(!$q) 

                echo '<div class = "alert alert-danger" role="alert">Ups</div>';
                $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

                if(mysqli_num_rows($r) == 0) {
                    $q = "INSERT INTO uporabnik (ime, priimek, email, geslo) VALUES ('$im', '$pr', '$em', SHA1('$pass'))";
                    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

                    if(mysqli_affected_rows($dbc) == 1) {
                        echo '<div class="alert alert-success" role="alert">Registracija je bila uspešna!</div>';
                        include ('includes/footer.html');
                        exit();


                    } else {
                        echo '<div class="alert alert-danger" role="alert">Prišlo je do napake pri registraciji. Prosim poskusite kasneje!</div>';

                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Uporabnik je ze registriran!</div>';
                }


            
                

        } else {
            echo '<div class="alert alert-danger" role="alert">Prislo je do napake. Prosim poskusite se enkrat!</div>';
        }

        mysqli_close($dbc);
    }

?>

<h1>Registracija</h1>
<form action="registracija.php" method="post">
    <fieldset>
        <div class="form-group">
            <label>Ime:</label> <input type="text" class="form-control" name="ime" size="30" maxlength="60" value="<?php if (isset($trimmed['ime'])) echo $trimmed['ime']; ?>" />
        </div>

        <div class="form-group">
            <label>Priimek:</label> <input type="text" class="form-control" name="priimek" size="30" maxlength="60" value="<?php if (isset($trimmed['priimek'])) echo $trimmed['priimek']; ?>" />
        </div>
        
        <div class="form-group">
            <label>Email:</label> <input type="text" class="form-control" name="email" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" />
        </div>
        
        <div class="form-group">
            <label>Geslo:</label> <input type="password" class="form-control" name="geslo" size="20" maxlength="20" value="<?php if (isset($trimmed['geslo'])) echo $trimmed['geslo']; ?>" />
        </div>

        <div class="form-group">
            <label>Ponovite geslo:</label> <input type="password" class="form-control" name="geslo2" size="20" maxlength="20" value="<?php if (isset($trimmed['geslo2'])) echo $trimmed['geslo2']; ?>" />
        </div>
    </fieldset>

	<div align="center"><input type="submit" name="submit" value="Register" class="btn btn-primary" /></div>

</form>




<?php

    include ('includes/footer.html');

?>