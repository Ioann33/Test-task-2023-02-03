<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= Route::url()?>">FQS</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php if (\Facade\Auth::User()):?>
                                <a class="nav-link active" aria-current="page" href="<?= Route::url('index', 'profile')?>">Profile</a>
                            <?php endif;?>
                        </ul>
                        <?php if (\Facade\Auth::User()):?>
                            <a class="nav-link active" aria-current="page" href="<?= Route::url('auth', 'logout')?>">Logout</a>
                        <?php else:?>
                            <a class="nav-link active" role="button" aria-current="page" href="<?= Route::url('index', 'register')?>">Register</a>
                            <a class="nav-link active" role="button" aria-current="page" href="<?= Route::url('index', 'logIn')?>">Login</a>
                        <?php endif;?>
                    </div>
                </div>
            </nav>
        </header>
        <main class="content">
            <?php include_once 'vendor'.DIRECTORY_SEPARATOR.self::VIEWS_DIR.DIRECTORY_SEPARATOR. $pageTemplate. '.php'?>
        </main>
    </body>
</html>
