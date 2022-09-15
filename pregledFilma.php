<?php
    include ('includes/header.html');

    $row = FALSE;

    if(isset($_GET['fid']) && filter_var($_GET['fid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
    
        $fid = $_GET['fid'];

        if(isset($_POST['nova_ocena']) && isset($_POST['nov_komentar'])) {
            $upb = $_SESSION['id'];
            $nova_ocena = $_POST['nova_ocena'];
            $nov_komentar = $_POST['nov_komentar'];
            $q4 = "INSERT INTO film_komentar (TK_film, TK_uporabnik, ocena, komentar) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $q4);
            mysqli_stmt_bind_param($stmt, 'iiis', $fid, $upb, $nova_ocena, $nov_komentar);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) == 1) {
            
                // izpis obvestila
                echo "<div class=\"alert alert-success\" role=\"alert\">Komentar je bil dodan</div>";
        
        
                $_POST = array();
        
            } else { // izpis obvestila o napaki
                echo "<div class=\"alert alert-danger\" role=\"alert\">Prislo je do napake pri dodajanju komentarja.</div>"; 
            }
            
            mysqli_stmt_close($stmt);
        }

        
        $q = "SELECT naslov, zanr, reziser, opis, imdb_ocena, rotten_ocena, izid_datum, dolzina_cas, image_name FROM film WHERE id = '$fid'";
        $q2 ="SELECT uporabnik.ime AS ime, film_komentar.id AS komentar_id, film_komentar.ocena AS ocena, film_komentar.komentar AS komentar, film_komentar.TK_film AS TK_film FROM uporabnik, film_komentar WHERE TK_film = '$fid' AND uporabnik.id = film_komentar.TK_uporabnik";

        if(isset($_POST['delete'])) {
            $id_komentar = $_POST['komentar_id'];
            $q3 = "DELETE FROM film_komentar WHERE id='$id_komentar'";
            $r3 = mysqli_query ($dbc, $q3);
        }
        

        $r = mysqli_query ($dbc, $q);

        if(mysqli_num_rows($r) == 1) {

            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
            
            
            

            echo "<h1><b>{$row['naslov']}</b></h1><br/>";

            echo "
                <div class=\"row\">
                    <div class=\"col\">
            ";



            if($image = @getimagesize ("slike/$fid")) {
                echo "<img width=\"400\" height=\"550\" src=\"show_image.php?image=$fid&name=" . urlencode($row['image_name']) . "\" $image[3] alt=\"{$row['naslov']}\" />";
            } else {
                echo "<h2>Slika ni na voljo</h2>";
            }

            echo "</div>";

            echo "
                <div class=\"col\">
                    <b>Zanr: </b> {$row['zanr']}<br/>
                    <b>Reziser: </b> {$row['reziser']}<br/>
                    <p><b>Opis:</b> {$row['opis']}</p><br/>
                    <b>Imdb: </b> {$row['imdb_ocena']}<br/>
                    <b>Rotten Tomatoes: </b> {$row['rotten_ocena']}<br/>
                    <b>Izid: </b> {$row['izid_datum']}<br/>
                    <b>Dolzina: </b> {$row['dolzina_cas']} minut<br/>
                </div>
                </div>
            ";

           

        }

        $r2 = mysqli_query ($dbc, $q2);
        echo "<div class=\"row\"><h3>Komentarji</h3></div>";
        echo "<div class=\"row\">
                <table class=\"table\">";
        
        
        
        while ($row2 = mysqli_fetch_array ($r2, MYSQLI_ASSOC)) {
           
           
            echo "
                \t<tr>
                    <td>{$row2['ime']}</td>
                    <td>{$row2['ocena']}</td>
                    <td>{$row2['komentar']}</td>
                
            ";

            if(isset($_SESSION['id'])) {
            

                if(@$_SESSION['admin_nivo'] == 'true') {
                    echo "
                        <td>
                        <form action=\"pregledFilma.php?fid={$row2['TK_film']}\" method=\"post\">
                        <input type=\"hidden\" name=\"delete\" value=\"yes\" />
                        <input type=\"hidden\" name=\"komentar_id\" value=\"{$row2['komentar_id']}\" />
                        <div class=\"text-center mt-3\"><input type=\"submit\" class=\"btn btn-danger\" value=\"Izbrisi zapis\" /></div></form>
                        </td>
                        </tr>\n
                        
                
                    ";
                } else {
                    echo "
                    </tr>\n
                    
            
                    ";
                }
    
            } else {
                echo "
    
                </tr>\n
                
                ";
            }
        
    
        }



        echo "</table></div>";

        if(isset($_SESSION['id'])) {
            
?>
            
            <div class="row"><h5>Dodaj komentar</h5></div>
            <form action="pregledFilma.php?fid=<?php echo $fid ?>" method="post">
                
                    <div class="form-group mb-3">
                        <label for="vnesiOceno" class="form-label">Ocena:</label>
                        <input class ="form-control" type="text" name="nova_ocena" size="10" maxlength="10" value="<?php if (isset($_POST['nova_ocena'])) echo $_POST['nova_ocena']; ?>" />
                    </div>
            
                    <div class="form-group mb-3">
                        <label for="vnesiKomentar" class="form-label">Komentar:</label>
                        <textarea class ="form-control" name="nov_komentar" cols="40" rows="5"><?php if (isset($_POST['nov_komentar'])) echo $_POST['nova_komentar']; ?></textarea>
                    </div>
                    
                
            
                <div align="center"><input type="submit" name="submit" value="Dodaj komentar" class="btn btn-primary" /></div>
            
            </form>
            
            
<?php   
            
           

        } else {
            echo '

                <p>Če želite komentirati se prijavite!</p>
            
            ';
        }










        mysqli_close($dbc);
    }

?>

<?php 


    include ('includes/footer.html');


?>