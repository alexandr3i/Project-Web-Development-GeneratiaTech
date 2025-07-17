
<?php
$current_file = basename($_SERVER['PHP_SELF']);
if (!in_array($current_file, ['index.php', 'contact.php'])) {
    $movies=json_decode(file_get_contents('./assets/movies-list-db.json'), true)['movies'];
}    

$genres=json_decode(file_get_contents('./assets/movies-list-db.json'), true)['genres'];
include('functions.php');

$menu_items = [
    ['name' => 'Home', 'link' => 'index.php'],
    ['name' => 'Movies', 'link' => 'movies.php'],
    ['name' => 'Genres', 'link' => 'genres.php'],
    ['name' => 'Contact', 'link' => 'contact.php']
];

if (isset($_COOKIE["fav_movies"])){
    $fav_movies=json_decode($_COOKIE["fav_movies"], true);
    if(!empty($fav_movies)){
        $menu_items =[
        ['name' => 'Home', 'link' => 'index.php'],
        ['name' => 'Movies', 'link' => 'movies.php'],
        ['name' => 'Genres', 'link' => 'genres.php'],
        ['name' => 'Contact', 'link' => 'contact.php'],
        ['name' => 'Favorites', 'link' => 'movies.php?page=favorites']
        ];
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angheluta Andrei-Alexandru</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="background-color: beige;">
    <?php
    define("LOGO", "AAA");
    ?>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                AAA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($menu_items as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_file === $item['link']) ? 'active' : ''; ?>"
                            href="<?php echo $item['link']; ?>">
                                <?php echo $item['name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <?php include ('includes/search-form.php'); ?>
            </div>
        </div>
    </nav>
  