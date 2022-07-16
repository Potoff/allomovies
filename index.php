<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Allomovies</title>
</head>

<body>
    <?php

    function loadClass(string $class)
    {
        if ($class === "DotEnv") {
            require_once "./config/$class.php";
        } else if (str_contains($class, "Controller")) {
            require_once "./Controller/$class.php";
        } else {
            require_once "./Entity/$class.php";
        }
    }

    spl_autoload_register("loadClass");

    $movieController = new MovieController();
    $movies = $movieController->getAll();

    $categoryController = new CategoryController();
    ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#"><i class="bi bi-film fs-1 m-3"></i>AlloMovies
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./views/movies.php">Ajouter un film</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container d-flex flex-column align-items-center">
        <h1>Allo Movies</h1>
        <h3>Découvrez et partagez des films !</h3>
        <img class="logo" src="https://cdn.pixabay.com/photo/2016/02/01/18/59/filmstrip-1174228_960_720.png" alt="Logo My Movies">

        <?php
        //    foreach ($movies as $key => $value){

        //    }
        ?>

        <section class="container d-flex justify-content-center">
            <?php
            foreach ($movies as $movie) :
                $category = $categoryController->get($movie->getCategory_id())
            ?>
                <div class="card mx-3" style="width: 18rem;">
                    <img src="<?= $movie->getImage_url() ?>" class="card-img-top" alt="<?= $movie->getTitle() ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $movie->getTitle() ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $movie->getRelease_date() ?> - <?= $movie->getDirector() ?></h6>
                        <p class="card-text"><?= $movie->getDescription() ?></p>
                        <footer class="blockquote-footer" style="color: <?= $category->getColor() ?>"><?= $category->getName() ?></footer>
                        <a href="#" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="./views/delete.php?id=<?= $movie->getId() ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>