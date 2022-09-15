<?php

    include ('includes/header.html');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        
                
        $errors = array();
            
                
        if (!empty($_POST['naslov'])) {
             $fn = trim($_POST['naslov']);
        } else {
            $errors[] = 'Prosim vnesite naslov filma!';
        }
                
                
        if (is_uploaded_file ($_FILES['image']['tmp_name'])) {
            
                    
            $temp = 'slike/' . md5($_FILES['image']['name']);
                
                    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $temp)) {
            
                echo '<p>Datoteka je bila nalozena!</p>';
                
                        
                $i = $_FILES['image']['name'];
                
            } else { 
                $errors[] = 'Datoteke ni bilo mozno prestaviti.';
                $temp = $_FILES['image']['tmp_name'];
            }
            
        } else { 
                    
            $errors[] = 'Ni datoteke za nalaganje.';
            $temp = NULL;
        }
                
            
                
        if (is_string($_POST['zanr'])) {
            $z = $_POST['zanr'];
        } else {
                    
            $errors[] = 'Prosim vnesite zanr!';
        }

        if (is_string($_POST['reziser'])) {
            $rez = $_POST['reziser'];
        } else {
                    
            $errors[] = 'Prosim vnesite reziserja!';
        }

        if (is_string($_POST['opis'])) {
            $o = $_POST['opis'];
        } else {
                    
            $errors[] = 'Prosim vnesite opis!';
        }
                
        if (is_numeric($_POST['imdb']) && ($_POST['imdb'] > 0)) {
            $im = (int) $_POST['imdb'];
        } else {
                    
            $errors[] = 'Prosim vnesite oceno imdb.';
        }

        if (is_numeric($_POST['rotten']) && ($_POST['rotten'] > 0)) {
            $ro = (int) $_POST['rotten'];
        } else {
                    
            $errors[] = 'Prosim vnesite oceno Rotten Tomatoes.';
        }

        if($_POST['izid_datum']) {
            $iz = $_POST['izid_datum'];
        } else {
            $errors[] = 'Prosim vnesite datum!';
        }

        if (is_numeric($_POST['dolzina']) && ($_POST['dolzina'] > 0)) {
            $da = (int) $_POST['dolzina'];
        } else {
                    
            $errors[] = 'Prosim vnesite dolzino filma';
        }


            
            
                
                
                
        if (empty($errors)) { 
            
            
            $q = 'INSERT INTO film (naslov, zanr, reziser, opis, imdb_ocena, rotten_ocena, izid_datum, dolzina_cas, image_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare($dbc, $q);
            mysqli_stmt_bind_param($stmt, 'ssssiisis', $fn, $z, $rez, $o, $im, $ro, $iz, $da, $i);
            mysqli_stmt_execute($stmt);
                    
            
            if (mysqli_stmt_affected_rows($stmt) == 1) {
            
                
                echo "<div class=\"alert alert-success\" role=\"alert\">Film je bil dodan</div>";
                
                
                $id = mysqli_stmt_insert_id($stmt); 
                rename ($temp, "slike/$id");
                
                
                $_POST = array();
                
            } else { 
                echo "<div class=\"alert alert-danger\" role=\"alert\">Prislo je do napake pri dodajanju filma.</div>"; 
            }
                    
            mysqli_stmt_close($stmt);
                    
        } 
                
        
        if ( isset($temp) && file_exists ($temp) && is_file($temp) ) {
            unlink ($temp);
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


<h1>Dodaj film</h1>

<form enctype="multipart/form-data" action="add.php" method="post">

    <input type="hidden" name="MAX_FILE_SIZE" value="524288" />

    <div class="mb-3">
        <label for="vnesiNaslov" class="form-label">Naslov:</label>
        <input type="text" class ="form-control" name="naslov" size="30" maxlength="60" value="<?php if (isset($_POST['naslov'])) echo htmlspecialchars($_POST['naslov']); ?>" />
    </div>

    <div class="mb-3">
        <label for="vnesiSliko" class="form-label">Slika:</label>
        <input class="form-control" type="file" name="image" />
    </div>

    <div class="mb-3">
        <label for="vnesiZanr" class="form-label">Zanr:</label>
        <input class="form-control" type="text" name="zanr" size="30" maxlength="60" value="<?php if (isset($_POST['zanr'])) echo htmlspecialchars($_POST['zanr']); ?>" />
    </div>

    <div class="mb-3">
        <label for="vnesiReziser" class="form-label">Reziser:</label>
        <input class="form-control" type="text" name="reziser" size="30" maxlength="60" value="<?php if (isset($_POST['reziser'])) echo htmlspecialchars($_POST['reziser']); ?>" />
    </div>

    <div class="mb-3">
        <label for="vnesiOpis" class="form-label">Opis:</label>  
        <textarea class="form-control" name="opis" cols="40" rows="5"><?php if (isset($_POST['opis'])) echo $_POST['opis']; ?></textarea> 
    </div>

    <div class="mb-3">
        <label for="vnesiImdb" class="form-label">Imdb:</label>   
        <input class="form-control" type="text" name="imdb" size="10" maxlength="10" value="<?php if (isset($_POST['imdb'])) echo $_POST['imdb']; ?>" /> 
    </div>

    <div class="mb-3">
        <label for="vnesiRotten" class="form-label">Rotten Tomatoes:</label>
        <input class="form-control" type="text" name="rotten" size="10" maxlength="10" value="<?php if (isset($_POST['rotten'])) echo $_POST['rotten']; ?>" />    
    </div>

    <div class="mb-3">
        <label for="vnesiDatum" class="form-label">Datum izida:</label>
        <input class="form-control" type="date" name="izid_datum" value="<?php if (isset($_POST['izid_datum'])) echo $_POST['izid_datum']; ?>" />
    </div>

    <div class="mb-3">
        <label for="vnesiDolzino" class="form-label">Dolzina (v minutah):</label>
        <input class="form-control" type="text" name="dolzina" size="10" maxlength="10" value="<?php if (isset($_POST['dolzina'])) echo $_POST['dolzina']; ?>" />
    </div>
            
                    
                    
    <div>
        <button class="btn btn-primary" type="submit" value="Submit">Dodaj</button>
    </div>

</form>



<?php

    include ('includes/footer.html');

?>