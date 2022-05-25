<?php

/**
 * @author 2072030 - Kevin Laurence
 */

?>

<form method='post' enctype="multipart/form-data">
    <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type='text' class="form-control" name='txtISBN' placeholder="ISBN" autofocus required id="isbn">
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
        <textarea id="description" name="txtDescription" class="form-control" rows="6" cols="30"></textarea>
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
        <input type="file" name="fileCover" id="coverId" class="form-control" accept="image/png, image/jpeg" required>
    </div>
    <input type='submit' id='btnSaveBook' class="btn btn-primary" value="Add Book" name='btnSubmit'>
    </div>
</form>
<table id="tableBook" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">Cover</th>
            <th scope="col">ISBN</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Publisher</th>
            <th scope="col">Description</th>
            <th scope="col">Publish Year</th>
            <th scope="col">Genre</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <thead>
        <tr>
        </tr>
    </thead>
</table>

<script type="module">
    import {
        getDatabase,
        ref,
        set,
        push,
        onValue,
        remove,
        get
    } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-database.js";

    import {
        getStorage,
        ref as sRef,
        uploadBytes,
        getDownloadURL,
        deleteObject
    } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-storage.js";

    function saveBook(cover, isbn, title, author, publisher, description, publishYear, genre, file) {
        const db = getDatabase();
        const storage = getStorage();
        const storageRef = sRef(storage, ApiService.dbVersion + "/" + isbn);
        var imgUrl = "";
        uploadBytes(storageRef, file).then((snapshot) => {
            getDownloadURL(snapshot.ref).then((url) => {
                imgUrl = url;
                push(ref(db, ApiService.dbVersion + "/" + ApiService.bookCollection), {
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
        });
    }

    function fetchAllBook(callback) {
        const db = getDatabase();
        const bookRef = ref(db, ApiService.dbVersion + "/" + ApiService.bookCollection);
        onValue(bookRef, (snapshot) => {
            let objArr = [];
            snapshot.forEach(function(childSnap) {
                let book = {
                    'id': childSnap.key,
                    'cover': childSnap.val().cover,
                    'isbn': childSnap.val().isbn,
                    'title': childSnap.val().title,
                    'author': childSnap.val().author,
                    'publisher': childSnap.val().publisher,
                    'description': childSnap.val().description,
                    'publish_year': childSnap.val().publish_year,
                    'genre': childSnap.val().genre,
                    'imgUrl': childSnap.val().imgUrl
                };
                objArr.push(book);
            });
            callback(objArr);
        });
    }

    fetchAllBook(books => {
        $('#tableBook').DataTable().clear();
        $('#tableBook').DataTable().rows.add(books).draw();
    })
    $('#tableBook').DataTable({
        columns: [{
                data: 'null',
                render: function(data, type, row) {
                    return '<img src="' + row.imgUrl + '" style="width:100%">';
                }
            },
            {
                data: 'isbn'
            },
            {
                data: 'title'
            },
            {
                data: 'author'
            },
            {
                data: 'publisher'
            },
            {
                data: 'description'
            },
            {
                data: 'publish_year'
            },
            {
                data: 'genre'
            },

            {
                data: 'null',
                render: function(data, type, row) {
                    return '<button onclick="upBook(\'' + row.id + '\')" class="btn btn-warning"><i data-fa-symbol="edit" class="fas fa-edit fa-fw"></i></button>' +
                        " " + '<button onclick="delBook(\'' + row.id + '\',\'' + row.isbn + '\')" class="btn btn-danger"><i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i></button>'
                }
            }
        ]
    });

    window.delBook = function delBook(id,isbn) {
        deleteBook(id, isbn);
    }
    window.upBook = function upBook(id) {
        editBook(id);
    }
    function editBook(id) {
        window.location = "index.php?ahref=upbook&bid=" + id;
    }

    function deleteBook(id,isbn) {
        const db = getDatabase();
        const storage = getStorage();
        const confirmation = window.confirm("Are you sure want to delete this data?");
        if (confirmation) {
            remove(ref(db, ApiService.dbVersion + "/" + ApiService.bookCollection + "/" + id));
            deleteObject(sRef(storage, ApiService.dbVersion + "/" + isbn));
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

        $('#btnSaveBook').click(function() {
            let isbn = $("#isbn").val();
            let title = $("#title").val();
            let author = $("#author").val();
            let publisher = $("#publish").val();
            let description = $("#description").val();
            let publishYear = $("#year").val();
            let cover = document.querySelector("#coverId").files[0].name;
            let file = document.querySelector("#coverId").files[0];
            let genre = $("#select option:selected").val();
            saveBook(cover, isbn, title, author, publisher, description, publishYear, genre, file);
            return false;
        });
    });

    
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>