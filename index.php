<?php

/**
 * @author 2072030 - Kevin Laurence
 */

include_once 'controller/GenreController.php';
include_once 'controller/BookController.php';

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Kevin Laurence (2072030)">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3829a87171.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <title>Document</title>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-app.js";
        import {
            getAnalytics
        } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries
        import {} from "https://www.gstatic.com/firebasejs/9.8.1/firebase-database.js"
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyCclmcPS-iNZF05UD50t1iB1pXtC7w5bW0",
            authDomain: "pwl-project-20212.firebaseapp.com",
            databaseURL: "https://pwl-project-20212-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "pwl-project-20212",
            storageBucket: "pwl-project-20212.appspot.com",
            messagingSenderId: "407446457091",
            appId: "1:407446457091:web:675b8e30833fedf4d5f736",
            measurementId: "G-LPLY95YW11"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);

        import {
            getDatabase,
            ref,
            set,
            push,
            onValue,
            remove
        } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-database.js";
        const database = getDatabase();
    </script>
    <script src="scripts/ApiService.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?ahref=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?ahref=genre">Genre Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?ahref=book">Book Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?ahref=about">About</a>
                    </li>
            </div>
        </div>
    </nav>
    <?php
    $menu = filter_input(type: INPUT_GET, var_name: 'ahref');

    switch ($menu) {
        case 'home':
            include_once 'view/home-view.php';
            break;
        case 'about':
            include_once 'view/about-view.php';
            break;
        case 'genre':
            $genreController = new GenreController();
            $genreController->index();
            break;
        case 'book':
            $bookController = new BookController();
            $bookController->index();
            break;
        case 'upgenre':
            $genreController = new GenreController();
            $genreController->updateIndex();
            break;
        case 'upbook':
            $bookController = new BookController();
            $bookController->updateBook();
            break;
        default:
            include_once 'view/home-view.php';
    }
    ?>
</body>

</html>