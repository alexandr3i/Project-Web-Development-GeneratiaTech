<?php 
$conn=db_connect();

$review_data=array(
    'show_reviews_form' => false
);

if (!$conn) {
        die("Eroare la conectare: " .  mysqli_connect_error());
}

$sql="CREATE TABLE IF NOT EXISTS reviews(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    film_id bigint(20) UNSIGNED NOT NULL,
    nume tinytext NOT NULL,
    email varchar(100) NOT NULL,
    mesaj TEXT NOT NULL
)"; 

if (mysqli_query($conn, $sql)){

    $review_data['show_reviews_form'] = true; // Setam ca trebuie sa afisam formularul de review
    $sql="SELECT nume, email, mesaj FROM reviews WHERE film_id = " . $_GET['movie_id'];
    $review_list= mysqli_query($conn, $sql); //apelam deja review-urile existente

    $review_data['count'] = mysqli_num_rows($review_list); //numaram review-urile existente
    if ($review_data['count'] > 0) {
        $review_data['reviews'] = mysqli_fetch_all($review_list, MYSQLI_ASSOC); //le punem intr-un array
    } else {
        $review_data['reviews'] = array(); //daca nu sunt review-uri, initializam ca array gol
        $review_data['alert'] = 'success';
        $review_data['message'] = 'Fii primul care lasă un review pentru acest film!'; 
    }
    
    if(isset($_POST['gdpr'])){ //ne am conectat la baza de date
        if(in_array($_POST['email'], array_column($review_data['reviews'], 'email'))){
            $review_data['show_reviews_form'] = false; // Daca email-ul exista deja in baza de date, nu mai afisam formularul
            $review_data['alert'] = 'danger';
            $review_data['message'] = 'Se pare că ai mai lăsat un review pentru acest film. Nu poți să lași mai multe review-uri pentru același film.';    
        }else{

        $sql="INSERT INTO reviews (film_id2, nume, email, mesaj) 
        VALUES ('" . $_GET['movie_id'] . "', '" . $_POST['nume'] . "', '" . $_POST['email'] . "', '" . $_POST['mesaj'] . "')";

        if (mysqli_query($conn, $sql)){
            $review_data['show_reviews_form'] = false; // Daca review-ul a fost adaugat, nu mai afisam formularul
            $review_data['alert'] = 'success';
            $review_data['message'] = 'Review adaugat cu succes!';
        }else{
            $review_data['alert'] = 'danger';
            $review_data['message'] = 'Eroare la adaugarea review-ului';
        }
        }
    } 

} 
if (isset($review_data['message'])&& isset($review_data['alert'])) {?>
    <div class="alert alert-<?php echo $review_data['alert']; ?>" role="alert" style ="margin-right: 750px; display: flex; justify-content: center; align-items: center;">
        <?php echo $review_data['message'];?>
    </div>
<?php }
if ($review_data['show_reviews_form'] == true) {
?>

<form method="POST" action="">
    <input type="hidden" name="film_id" value="<?php echo $movie['id']; ?>">

    <label for="nume_<?php echo $movie['id']; ?>">Preume:</label><br>
    <input type="text" id="nume_<?php echo $movie['id']; ?>" name="nume" required><br>

    <label for="email_<?php echo $movie['id']; ?>">Email:</label><br>
    <input type="email" id="email_<?php echo $movie['id']; ?>" name="email" required><br>

    <label for="mesaj_<?php echo $movie['id']; ?>">Mesajul review-ului:</label><br>
    <textarea id="mesaj_<?php echo $movie['id']; ?>" name="mesaj" rows="4" required></textarea><br>

    <label>
        <input type="checkbox" name="gdpr" required>
        Sunt de acord cu procesarea datelor cu caracter personal
    </label><br>

    <button type="submit">Trimite Review</button>
</form>
<?php } 

$sql="SELECT nume, mesaj FROM reviews WHERE film_id = " . $_GET['movie_id'];
$review_list= mysqli_query($conn, $sql); //apelam deja review-urile existente
if (mysqli_num_rows($review_list) > 0) {
    echo "<h2>Review-uri pentru " . $movie['title'] . "</h2>";
    while ($row = mysqli_fetch_assoc($review_list)) {
        echo "<p><strong>" . ($row['nume']) . ":</strong> " . ($row['mesaj']) . "</p>";
    }
}
?>