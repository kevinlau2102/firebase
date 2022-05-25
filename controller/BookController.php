<?php
/**
 * @author 2072030 - Kevin Laurence
 */
class BookController
{

    public function index()
        {
    //     $deleteCommand = filter_input(type: INPUT_GET, var_name: 'delcom');
    //     if (isset($deleteCommand) && $deleteCommand == 1) {
    //         $bookIsbn = filter_input(type: INPUT_GET, var_name: 'bisbn');
    //         $result = $this->bookDao->deleteBook($bookIsbn);
    //         if ($result) {
    //             echo '<div class="bg-success">Data successfully deleted</div>';
    //         } else {
    //             echo '<div class="bg-danger">Error on delete data</div>';
    //         }
    //     }

    //     $submitPressed = filter_input(type: INPUT_POST, var_name: 'btnSubmit');
    //     if (isset($submitPressed)) {
    //         $isbn = filter_input(type: INPUT_POST, var_name: 'txtISBN');
    //         $title = filter_input(type: INPUT_POST, var_name: 'txtTitle');
    //         $author = filter_input(type: INPUT_POST, var_name: 'txtAuthor');
    //         $publisher = filter_input(type: INPUT_POST, var_name: 'txtPublisher');
    //         $description = filter_input(type: INPUT_POST, var_name: 'txtDescription');
    //         $genre = filter_input(type: INPUT_POST, var_name: 'optgenre');
    //         $year = filter_input(type: INPUT_POST, var_name: 'txtYear');
    //         $trimmedIsbn = trim($isbn);
    //         $trimmedTitle = trim($title);
    //         $trimmedAuthor = trim($author);
    //         $trimmedPublisher = trim($publisher);
    //         $trimmedDesc = trim($description);


    //         if (empty($trimmedIsbn) or empty($trimmedTitle) or empty($trimmedAuthor) or empty($trimmedPublisher) or empty($trimmedDesc) or empty($year) or empty($genre)) {
    //             echo '<div class="bg-error">Please fill all field</div>';
    //         } else {
    //             $book = new Book();
    //             $book->setIsbn($trimmedIsbn);
    //             $book->setTitle($trimmedTitle);
    //             $book->setAuthor($trimmedAuthor);
    //             $book->setPublisher($trimmedPublisher);
    //             $book->setDescription($trimmedDesc);
    //             $book->setPublishYear($year);
    //             $book->getGenre()->setId($genre);

    //             if (isset($_FILES['fileCover']['name'])) {
    //                 $directory = 'uploads/';
    //                 $fileExtension = pathinfo($_FILES['fileCover']['name'], flags: PATHINFO_EXTENSION);
    //                 $newFileName = $trimmedIsbn . '.' . $fileExtension;
    //                 $targetFile = $directory . $newFileName;
    //                 if ($_FILES['fileCover']['size'] > 1024 * 2048) {
    //                     echo '<div>Upload error. File size exceed 2MB.</div>';
    //                     $result = $this->bookDao->addBook($book);
    //                 } else {
    //                     move_uploaded_file($_FILES['fileCover']['tmp_name'], $targetFile);
    //                     $book->setCover($newFileName);
    //                     $result = $this->bookDao->addBook($book);
    //                 }
    //             } else {
    //                 $result = $this->bookDao->addBook($book);
    //             }
    //         }
    //         if ($result) {
    //             echo '<div class="bg-success">Book successfully added</div>';
    //         } else {
    //             echo '<div class="bg-error">Error on add book</div>';
    //         }
    //     }
    //     $response = Utility::curl_get(ApiService::ALL_GENRE_URL, array());
    //     $genreOption = json_decode($response);
    //     $response = Utility::curl_get(ApiService::ALL_BOOK_URL, array());
    //     $books = json_decode($response);

        include_once 'view/book-view.php';
    }
    public function updateBook()
    {
        // $bookIsbn = filter_input(type: INPUT_GET, var_name: 'bisbn');
        // if (isset($bookIsbn) && $bookIsbn != '') {
        //     $bookup = $this->bookDao->fetchBook($bookIsbn);
        // }


        // $submitPressed = filter_input(type: INPUT_POST, var_name: 'btnSubmit');
        // if (isset($submitPressed)) {
        //     $isbn = filter_input(type: INPUT_POST, var_name: 'txtISBN');
        //     $title = filter_input(type: INPUT_POST, var_name: 'txtTitle');
        //     $author = filter_input(type: INPUT_POST, var_name: 'txtAuthor');
        //     $publisher = filter_input(type: INPUT_POST, var_name: 'txtPublisher');
        //     $description = filter_input(type: INPUT_POST, var_name: 'txtDescription');
        //     $genre = filter_input(type: INPUT_POST, var_name: 'optgenre');
        //     $year = filter_input(type: INPUT_POST, var_name: 'txtYear');
        //     $trimmedIsbn = trim($isbn);
        //     $trimmedTitle = trim($title);
        //     $trimmedAuthor = trim($author);
        //     $trimmedPublisher = trim($publisher);
        //     $trimmedDesc = trim($description);

        //     if (empty($trimmedIsbn) or empty($trimmedTitle) or empty($trimmedAuthor) or empty($trimmedPublisher) or empty($trimmedDesc) or empty($year) or empty($genre)) {
        //         echo '<div class="bg-error">Please fill all field</div>';
        //     } else {
        //         if (empty($_FILES['fileCover']['name'])) {
        //             $newFileName = $bookup->getCover();
        //         } else {
        //             unlink('uploads/' . $bookup->getCover());
        //             $directory = 'uploads/';
        //             $fileExtension = pathinfo($_FILES['fileCover']['name'], flags: PATHINFO_EXTENSION);
        //             $newFileName = $trimmedIsbn . '.' . $fileExtension;
        //             $targetFile = $directory . $newFileName;
        //             if ($_FILES['fileCover']['size'] > 1024 * 2048) {
        //                 echo '<div>Upload error. File size exceed 2MB.</div>';
        //             } else {
        //                 move_uploaded_file($_FILES['fileCover']['tmp_name'], $targetFile);
        //             }
        //         }
        //         $bookup->setIsbn($trimmedIsbn);
        //         $bookup->setTitle($trimmedTitle);
        //         $bookup->setAuthor($trimmedAuthor);
        //         $bookup->setPublisher($trimmedPublisher);
        //         $bookup->setDescription($trimmedDesc);
        //         $bookup->setPublishYear($year);
        //         $bookup->getGenre()->setId($genre);
        //         $bookup->setCover($newFileName);
        //         $result = $this->bookDao->updateBook($bookup);
        //         if ($result) {
        //             header(header: 'location:index.php?ahref=book');
        //         } else {
        //             echo '<div class="bg-danger">Error on add data</div>';
        //         }
        //     }
        // }
        // $genreOption = $this->bookDao->fetchGenreName();
        include_once 'view/book-update-view.php';
    }
}
