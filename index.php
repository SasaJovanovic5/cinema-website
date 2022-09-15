<?php

include ('includes/header.html');

?>


<div class="card text-center">
    <div class="card-body">
        <h5 class="card-title">Prepustite se magicnemu svetu kina.</h5>
        <form action="filmiNaDan.php" method="get">
            <div class="mb-3">
                <label>Izberite datum: </label>
                <div>
                    <select name="Datum">

                        <?php
                            $currentDate = date("Y-m-d");
                            $startdate=strtotime($currentDate);
                            $enddate=strtotime("+5day", $startdate);

                            while ($startdate < $enddate) {
                                $newDate = date("Y-m-d", $startdate);
                                //echo "<option>" . $newDate . "</option>";
                                echo "<option value=\"" . $newDate . "\">" . $newDate . "</option>";
                                $startdate = strtotime("+1 day", $startdate);
                            }
                        ?>
                    </select>
                </div>
            </div>
            <button class="btn btn btn-outline-warning" type="submit" value="submit">Isci</button>
        </form>
    </div>
  
</div>






<h4>Trenutno v kinu</h4> 

<?php 
    $danasnjidan = date("Y-m-d");

    $q="SELECT film.naslov AS naslov, projekcija.ura AS ura, film.id AS film_id, film.image_name AS image_name FROM film, projekcija WHERE film.id = projekcija.TK_film AND projekcija.datum = '$danasnjidan' ORDER BY ura";
    $q2="SELECT id As film_id, naslov, izid_datum, image_name AS image_name FROM film WHERE izid_datum > '$danasnjidan' ORDER BY izid_datum";

    
    $r = mysqli_query ($dbc, $q);
    echo "<div class=\"row\">";

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
                </div>
            </div>
	    </div>

        
        ";


    
    }
    echo "</div>";
    
    echo "<h4>Kmalu v kinu</h4><div class=\"row\">";
    
    $r2 = mysqli_query ($dbc, $q2);
    while ($row2 = mysqli_fetch_array ($r2, MYSQLI_ASSOC)) {

        echo "
        <div class=\"col\">
            <div class=\"card\" style=\"width: 251;\">
        ";

            if($image = @getimagesize ("slike/{$row2['film_id']}")) {
                echo "<img width=\"251\" height=\"397\" src=\"show_image.php?image={$row2['film_id']}&name=" . urlencode($row2['image_name']) . "\" $image[3] alt=\"{$row2['naslov']}\" />";
            } else {
                echo "<div align=\"center\">No image available.</div>\n";
            }

        echo "
                <div class=\"card-body\">
                    <h5 class=\"card-title\"><a href=\"pregledFilma.php?fid={$row2['film_id']}\">{$row2['naslov']}</a></h5>
                </div>
            </div>
	    </div>

        
        ";



        
    }

    echo "</div>";
    mysqli_close($dbc);
    include ('includes/footer.html');
    
?>



