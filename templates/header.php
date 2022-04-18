<?php

    require_once("config/globals.php");
    require_once("vendor/autoload.php");


    use \classes\Dao\UserDAOMysql;

    $userDao = new UserDAOMysql($pdo);

    $userData = $userDao->verifyToken();
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento Estoque</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="<?=$BASE_URL?>">Gerenciamento</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        
                        <?php if(!$userData):?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?=$BASE_URL?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$BASE_URL?>contact.php">Contato</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$BASE_URL?>login.php">Login</a>
                            </li>
                        <?php else:?>
                           

                            <li class="nav-item dropdown">
                                <a class="nav-link active dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?=$userData->getName()?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item" href="#">Minha Conta</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?=$BASE_URL?>logout.php">Logout</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="<?=$BASE_URL?>">Painel</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="<?=$BASE_URL?>contact.php">Estoque</a>
                            </li>
                        
                        <?php endif?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
