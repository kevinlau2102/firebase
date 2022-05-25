<?php
/**
 * @author 2072030 - Kevin Laurence
 */
class GenreController
{

    public function index()
    {
        // $deleteCommand = filter_input(type: INPUT_GET, var_name: 'delcom');
        // if (isset($deleteCommand) && $deleteCommand == 1) {
        //     $genreId = filter_input(type: INPUT_GET, var_name: 'gid');
        //     $deleteData = array();
        //     $deleteData['genreId'] = $genreId;
        //     $response = Utility::curl_post(ApiService::DELETE_GENRE_URL, $deleteData);
        //     $result = json_decode($response);
        //     if ($result->status) {
        //         echo '<div class="bg-success">' . $result->message . '</div>';
        //     } else {
        //         echo '<div class="bg-danger">' . $result->message . '</div>';
        //     }
        // }


        // $submitPressed = filter_input(type: INPUT_POST, var_name: 'btnSubmit');
        // if (isset($submitPressed)) {
        //     $name = filter_input(type: INPUT_POST, var_name: 'txtName');
        //     $trimName = trim($name);
        //     if (empty($trimName)) {
        //         echo '<div class="bg-error">Please fill genre name </div>';
        //     } else {
        //         $sendData = array();
        //         $sendData['genreName'] = $trimName;
        //         $response = Utility::curl_post(ApiService::ADD_GENRE_URL, $sendData);
        //         $result = json_decode($response);
        //         if ($result->status) {
        //             echo '<div class="bg-success">' . $result->message . '</div>';
        //         } else {
        //             echo '<div class="bg-danger">' . $result->message . '</div>';
        //         }
        //     }
        // }
        // $response = Utility::curl_get(ApiService::ALL_GENRE_URL,array());
        // $genres = json_decode($response);
        include_once 'view/genre-view.php';
    }
    public function updateIndex()
    {
        // // FETCH ONE GENRE
        // $genreId = filter_input(type: INPUT_GET, var_name: 'gid');
        // if (isset($genreId) && $genreId != '') {
        //     /** @var $genre Genre */
        //     $genre = $this->genreDao->fetchGenre($genreId);
        // }

        // $submitPressed = filter_input(type: INPUT_POST, var_name: 'btnSubmit');
        // if (isset($submitPressed)) {
        //     $name = filter_input(type: INPUT_POST, var_name: 'txtName');
        //     $trimName = trim($name);
        //     if (empty($trimName)) {
        //         echo '<div class="bg-error">Please fill genre name </div>';
        //     } else {
        //         $updateData = array();
        //         $updateData['genreId'] = $genre;
        //         $updateData['genreName'] = $trimName;
        //         $response = Utility::curl_post(ApiService::UPDATE_GENRE_URL, $updateData);
        //         $result = json_decode($response);
        //         if ($result->status) {
        //             header(header: 'location:index.php?ahref=genre');
        //         } else {
        //             echo '<div class="bg-danger">' . $result->message . '</div>';
        //         }
        //     }
        // }
        include_once 'view/genre-update-view.php';
    }
}
