<?php 
require_once('includes/header.php');
require_once('includes/functions.php');

$movies = json_decode(file_get_contents('./assets/movies-list-db.json'), true)['movies'];

if (!isset($_GET['movie_id'])) {
    echo "ID film inexistent.";
    exit;
}

$movie_id = (int) $_GET['movie_id'];

$filtered = array_filter($movies, function($movie) use ($movie_id) {
    return $movie['id'] == $movie_id;
});

$movie = array_shift($filtered);

if (!$movie) {
    
    ?>
    
    <div class="container text-center" style="padding: 100px;">
        <h2>Eroare</h2>

        <?php
        echo "Filmul nu a fost găsit.";
        ?>
        <br>
        <a href="movies.php" class="btn btn-primary" style="margin: 25px;">Înapoi la lista de filme</a>
    </div>

    <?php
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $movie['title']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid">
    <div class="row align-items-center">
    
        <div class="col-md-3 text-center">
            <img src="<?php echo $movie['posterUrl']; ?>" alt="<?php echo $movie['title']; ?>" style="max-width:300px;">
        </div>

        <div class="col-md-9" style="padding-top: 50px; padding-bottom: 100px;">
        
        <?php 
        $age = check_old_movie($movie['year']);
        ?> 

        <div class="row">
            <div class="col-auto">
                <p>
                <h4><?php echo $movie['year']; ?></h4>
                <?php if ($age !== false): ?>
                    <span class="badge bg-danger">Old movie: <?php echo $age; ?> years</span>
                <?php endif; ?>
                </p>
            </div>
            <div classs="col-auto">
                <?php
                    $fav_movies=array(); //ori e array gol

                    $movie_favorites_filename='./assets/movie-favorites.json';
                    $fav_stats=json_decode(file_get_contents($movie_favorites_filename), true);
                    
                    if(!$fav_stats) $fav_stats=array();
                    
                    if (isset($_COOKIE["fav_movies"])){
                        $fav_movies=json_decode($_COOKIE["fav_movies"], true); //ori e lista de filme
                    }

                    if(isset($_POST['fav'])){ //daca nu este setat nu se schimba valoarea
                        if($_POST['fav']==='1' && !in_array($_GET['movie_id'], $fav_movies)){ // '1' este string //verificam ca sa nu adaugam filmul de doua ori la faves
                            $fav_movies[]=$_GET['movie_id'];

                            if (array_key_exists($_GET['movie_id'], $fav_stats)){
                                $fav_stats[$_GET['movie_id']]++;
                            } else {
                                $fav_stats[$_GET['movie_id']]=1;
                            }

                        } elseif($_POST['fav']==='0' && in_array($_GET['movie_id'], $fav_movies)) {
                            if(($key=array_search($_GET['movie_id'], $fav_movies)) !== false) {
                                unset($fav_movies[$key]);
                                if (isset($fav_stats[$_GET['movie_id']]) && $fav_stats[$_GET['movie_id']] > 0) {
                                    $fav_stats[$_GET['movie_id']]--;
                                }
                            }
                        }
                    setcookie("fav_movies", json_encode($fav_movies), time()+(86400*30*12));  //86400=1day //86400*30*12=1year
                    file_put_contents(
                        $movie_favorites_filename,
                        json_encode($fav_stats)
                    );
                    }
                ?>

                <form action="" method="post">
                    <input 
                        name="fav" 
                        type="hidden" 
                        value="<?php echo(in_array($_GET['movie_id'], $fav_movies)) ? "0":"1"; ?>">

                    <button type="submit" class="btn position-relative <?php echo(in_array($_GET['movie_id'], $fav_movies)) ? "btn-light":"btn-danger"; ?>">
                        <?php echo(in_array($_GET['movie_id'], $fav_movies)) ? "Delete from favourites":"Add to favourites"; ?>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $current_movie_fav_stats= (isset($fav_stats[$_GET['movie_id']])) ? $fav_stats[$_GET['movie_id']]: 0; ?>
                            <span class="visually-hidden"><?php echo $current_movie_fav_stats; ?></span>
                        </span>

                    </buttton>
                </form>
            </div>
        </div>

        <h1><strong><?php echo $movie['title']; ?></strong></h1>
        <p><strong>Director:</strong> <?php echo $movie['director']; ?></p>
        <p><strong>Year:</strong> <?php echo $movie['year']; ?></p>
        <p><strong>Runtime:</strong> <?php runtime_prettier($movie['runtime']); ?></p>

        <p><strong>Actors:</strong></p>
            <ul>
                <?php
                    $actors = explode(',', $movie['actors']);
                    foreach ($actors as $actor) {
                        echo '<li>' . trim($actor) . '</li>';
                    }
                ?>
            </ul>

        <p><strong>Genres:</strong> <?php echo implode(', ', $movie['genres']); ?></p>
        <p><strong>Plot:</strong> <?php echo $movie['plot']; ?></p>
            <?php 
            include('includes/movie-reviews.php');
            ?>
        <a href="movies.php">&laquo; Înapoi la listă</a>

        </div>
    </div>
    </div>
</body>
</html>
    
<?php 
include('includes/footer.php');
?>