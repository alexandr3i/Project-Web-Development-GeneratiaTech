<?php require_once('includes/header.php');?>
<?php require_once('includes/functions.php');?>
<?php
$data = json_decode(file_get_contents('./assets/movies-list-db.json'), true);
$movies = $data['movies'];
?>

<?php if (isset($_GET['s']) && strlen ($_GET['s']) >= 3) { ?>
    <h1>Search results for: <strong><?php echo  $_GET['s'];?></strong></h1>
    <?php include ('includes/search-form.php'); ?>

    <?php $filtered_movies = array_filter($movies, 'find_movies_by_title'); ?>

    <?php if (count($filtered_movies) === 0) { ?>
        <p>No results</p>
    <?php } else { ?>
        <div class="row movies-list mt-5">
            <?php foreach ($filtered_movies as $movie) {
                include('includes/archive-movie.php');
            } ?>
        </div>
    <?php } ?>

<?php } elseif (isset($_GET['s']) && strlen ($_GET['s']) < 3) { ?>
    <h1>No results!</h1>
    <p>Search too short!</p>
    <?php include('includes/search-form.php'); ?>

<?php } else { ?>
    <h1>No results!</h1>
    <p>Try something else</p>
    <?php include('includes/search-form.php'); ?>
<?php } ?>

<?php include('includes/footer.php');?>