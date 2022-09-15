<?php

    include ('includes/header.html');


           

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        
                
        $errors = array();

                

        if($_POST['datum']) {
            $da = $_POST['datum'];
        } else {
            $errors[] = 'Prosim vnesite datum!';
        }

        if($_POST['ura']) {
            $ur = $_POST['ura'];
        } else {
            $errors[] = 'Prosim vnesite uro!';
        }
             
        if (empty($errors)) { 
            
            
            $selected_val = $_POST['Film'];
            $insert = 'INSERT INTO projekcija (TK_film, datum, ura) VALUES (?, ?, ?)';
            $stmt = mysqli_prepare($dbc, $insert);
            mysqli_stmt_bind_param($stmt, 'iss', $selected_val, $da, $ur);
            mysqli_stmt_execute($stmt);
                    
            
            if (mysqli_stmt_affected_rows($stmt) == 1) {
            
                echo "<div class=\"alert alert-success\" role=\"alert\">Projekcija je bila dodana</div>";
                
                $_POST = array();
                
            } else { 
                echo "<div class=\"alert alert-danger\" role=\"alert\">Prislo je do napake pri dodajanju projekcije.</div>";
            }
                    
            mysqli_stmt_close($stmt);
                    
        } 
                
                
                
    }

    if ( !empty($errors) && is_array($errors) ) {
        echo "
        <div class=\"alert alert-danger\" role=\"alert\">Prišlo je do napake: </div> <br />
        ";

        foreach ($errors as $msg) {
            echo " - $msg<br />\n";
        }
        echo "<div class=\"alert alert-danger\" role=\"alert\">Prosim poskusite ponovno. </div>";
    }
        
?>

<h1>Dodaja projekcijo</h1>

<form enctype="multipart/form-data" action="dodajProjekcije.php" method="post">

    <input type="hidden" name="MAX_FILE_SIZE" value="524288" />

    <div class="mb-3">
        <label for="izberiFilm" class="form-label">Film:</label>
        <select class="form-control" name="Film">
            <?php
                $q1="SELECT film.naslov AS naslov, film.id AS id_film FROM film";
                $r1 = mysqli_query ($dbc, $q1);

                while ($row1 = mysqli_fetch_array ($r1, MYSQLI_ASSOC)) {
                    echo "<option value=\"{$row1['id_film']}\">{$row1['naslov']}</option>";
                }       
            ?>
            
        </select>
    </div>

    <div class="mb-3">
        <label for="vnesiDatum" class="form-label">Datum projekcije:</label>
        <input class="form-control" type="date" name="datum" value="<?php if (isset($_POST['datum'])) echo $_POST['datum']; ?>" />
    </div>
    
    <div class="mb-3">
        <label for="vnesiDatum" class="form-label">Datum projekcije:</label>
        <input class="form-control" type="time" name="ura" value="<?php if (isset($_POST['ura'])) echo $_POST['ura']; ?>" />
    </div>
        

        
          
            
    <div>
        <button class="btn btn-primary" type="submit" value="Submit">Dodaj</button>
    </div>

</form>


<?php

    include ('includes/footer.html');

?>