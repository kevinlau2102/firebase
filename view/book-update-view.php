<?php

/**
 * @author 2072030 - Kevin Laurence
 */

?>

<form method='post' enctype="multipart/form-data">
    <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type='text' class="form-control" name='txtISBN' placeholder="ISBN" readonly id="isbn">
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type='text' class="form-control" name='txtTitle' placeholder="Title" required id="title">
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type='text' class="form-control" name='txtAuthor' placeholder="Author" required id="author">
    </div>
    <div class="form-group">
        <label for="publisher">Publisher</label>
        <input type='text' class="form-control" name='txtPublisher' placeholder="Publisher" required id="publish">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="txtDescription" class="form-control" rows="6" cols="30" required id="description"></textarea>
    </div>
    <div class="form-group">
        <label for="year">Publish Year</label>
        <input type='text' class="form-control" name='txtYear' placeholder="Publish Year" required id="year">
    </div>
    <div class="form-group">
        <label for="genre">Genre</label>
        <select required id="select" class="form-control" name="optgenre">
            <option selected>--Please select genre--</option>
        </select>
    </div>
    <div class="form-group">
        <label for="coverId" class="form-label">Cover</label>
        <input type="file" name="fileCover" id="coverId" class="form-control" accept="image/png, image/jpeg">
    </div>
    <div class="row">
        <div class="col-md"><input type='submit' id="btnUpdateBook" class="btn btn-primary" value="Update Book" name='btnSubmit'></div>
        <div class="col-md-10">
            <p id="progress">Upload is 0% done</p>
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</form>

<script type="module">
    import {
        getDatabase,
        ref,
        child,
        get,
        update,
        onValue
    } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-database.js";

    import {
        getStorage,
        ref as sRef,
        uploadBytesResumable,
        getDownloadURL,
        deleteObject
    } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-storage.js";

    function fetchBook(id, callback) {
        const dbRef = ref(getDatabase());
        get(child(dbRef, ApiService.dbVersion + "/" + ApiService.bookCollection + "/" + id)).then((snapshot) => {
            if (snapshot.exists()) {
                callback(snapshot.val());
            }
        });
    }

    function updateBook(id, cover, isbn, title, author, publisher, description, publishYear, genre, file = null) {
        const db = getDatabase();
        const storage = getStorage();
        const storageRef = sRef(storage, ApiService.dbVersion + "/" + isbn);
        var imgUrl = "";
        if (file != null) {
            const uploadTask = uploadBytesResumable(storageRef, file);
            uploadTask.on('state_changed',
                (snapshot) => {
                    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    var progressNum = Math.round(progress);
                    $(".progress-bar").width(progress + "%");
                    $(".progress-bar").animate({
                        innerHTML: progressNum + "%"
                    }, {
                        queue: false
                    });
                    var pro = document.getElementById("progress");
                    pro.innerHTML = 'Upload is ' + progressNum + '% done';
                },
                (error) => {
                    console.log("Upload failed");
                },
                () => {
                    var pro = document.getElementById("progress");
                    var num = "100";
                    pro.innerHTML = 'Upload is ' + num + '% done';
                    getDownloadURL(uploadTask.snapshot.ref).then((downloadURL) => {
                        imgUrl = downloadURL;
                        update(ref(db, ApiService.dbVersion + "/" + ApiService.bookCollection + "/" + id), {
                            cover: cover,
                            isbn: isbn,
                            title: title,
                            author: author,
                            publisher: publisher,
                            description: description,
                            publish_year: publishYear,
                            genre: genre,
                            imgUrl: imgUrl
                        });
                    });
                    if (num == "100") {
                        const myTimeout = setTimeout(show, 1000);

                        function show() {
                            alert("Uploaded successfully");
                            window.location = "index.php?ahref=book";
                        }
                    }
                });

        } else {
            update(ref(db, ApiService.dbVersion + "/" + ApiService.bookCollection + "/" + id), {
                cover: cover,
                isbn: isbn,
                title: title,
                author: author,
                publisher: publisher,
                description: description,
                publish_year: publishYear,
                genre: genre
            });
        }
    }

    $(document).ready(function() {
        const db = getDatabase();
        const genreRef = ref(db, ApiService.dbVersion + "/" + ApiService.genreCollection);
        onValue(genreRef, (snapshot) => {
            var select = document.getElementById("select");
            snapshot.forEach(function(childSnap) {
                var opt = document.createElement('option');
                opt.value = childSnap.val().name;
                opt.innerHTML = childSnap.val().name;
                select.appendChild(opt)
            });
        });

        let url = window.location.search;
        let allParam = new URLSearchParams(url);
        let idBook = allParam.get('bid');
        let oldCover = "";
        fetchBook(idBook, books => {
            document.getElementById('isbn').value = books.isbn;
            document.getElementById('title').value = books.title;
            document.getElementById('author').value = books.author;
            document.getElementById('publish').value = books.publisher;
            document.getElementById('description').value = books.description;
            document.getElementById('year').value = books.publish_year;
            document.getElementById('select').value = books.genre;
            oldCover = books.cover;
        });


        $('#btnUpdateBook').click(function() {
            let isbn = $("#isbn").val();
            let title = $("#title").val();
            let author = $("#author").val();
            let publisher = $("#publish").val();
            let description = $("#description").val();
            let publishYear = $("#year").val();
            let genre = $("#select option:selected").val();
            if ($('#coverId')[0].files.length === 0) {
                let cover = oldCover;
                updateBook(idBook, cover, isbn, title, author, publisher, description, publishYear, genre);
            } else {
                let cover = document.querySelector("#coverId").files[0].name;
                let file = document.querySelector("#coverId").files[0];
                updateBook(idBook, cover, isbn, title, author, publisher, description, publishYear, genre, file);
            };
            // setTimeout(function() {
            //     window.location = "index.php?ahref=book";
            // }, 1000);
            return false;
        });
    });
</script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>