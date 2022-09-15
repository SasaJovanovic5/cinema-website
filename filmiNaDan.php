<?php

    include ('includes/header.html');



    $selected_val = $_GET['Datum']; 
    echo "<b>Izbran datum: </b>" .$selected_val; 
    $datum = strtotime($selected_val);


    $q="SELECT film.id AS film_id, film.naslov AS naslov, projekcija.ura AS ura, film.image_name AS image_name, projekcija.id AS projekcija_id FROM film, projekcija WHERE film.id = projekcija.TK_film AND projekcija.datum = '$selected_val' ORDER BY ura";

    $r = mysqli_query ($dbc, $q);

?>
<div class="row">

<?php

    while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {


        echo "
        <div class=\"col\">
            <div class=\"card\" style=\"width: 251;\">
        ";

            if($image = @getimagesize ("slike/{$row['film_id']}")) {
                echo "<img width=\"251\" height=\"397\" src=\"show_image.php?image={$row['film_id']}&name=" . urlencode($row['image_name']) . "\" $image[3] alt=\"{$row['naslov']}\" />";
            } else {
                echo "<div align=\"center\">No image available.</div>\n";
            }

        echo "
                <div class=\"card-body\">
                    <h5 class=\"card-title\"><a href=\"pregledFilma.php?fid={$row['film_id']}\">{$row['naslov']}</a></h5>
                    <p class=\"card-text\">{$row['ura']}</p>
                    <a href=\"izbira_sedeza.php?pid={$row['projekcija_id']}\" class=\"btn btn-primary\">Nakup</a>
                </div>
            </div>
	    </div>

        
        ";


        
    
    }


    echo "</div>";
    mysqli_close($dbc);
?>



<?php
    include ('includes/footer.html');
?>
