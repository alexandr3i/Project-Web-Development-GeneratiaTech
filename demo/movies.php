<?php 
include('includes/header.php');
?>

<?php 
if (isset($_GET['page']) && $_GET['page'] === 'favorites') {
    $movie_list = array_filter($movies, function($movie) use ($fav_movies) {
return in_array($movie['id'], $fav_movies);
});
    $title_before = 'Favorite';

} elseif(isset($_GET['genre']) && in_array($_GET['genre'], $genres)){
    $movie_list= array_filter($movies, 'find');
    $title_before=$_GET['genre'] .'';
}else{
    $movie_list= $movies;
    $title_before= '';
}
?>

<div class="container-fluid">
    <div class="row movies-list", style="margin-bottom: 100px;">
        <h1><?php echo $title_before; ?> Movies</h1>
        <?php
        foreach ($movie_list as $movie_key => $movie){
            include('includes/archive-movie.php');
        }
        ?>
    </div>
</div>

<?php include('includes/footer.php');?>