<div class="col-4" id="movie-<?php echo $movie['id']; ?>">
    <div class="card">
        <img src="<?php echo $movie['posterUrl']; ?>" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title"><?php echo $movie['title']; ?></h5>
            <p class="card-text"><?php echo substr($movie['plot'], 0, 100).'...'; ?></p>
            <a href="movie.php?movie_id=<?php echo $movie['id']; ?>" class="btn btn-primary">Read More</a>
        </div>
    </div>  
</div>
