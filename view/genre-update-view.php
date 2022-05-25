<?php
/**
 * @author Kevin Laurence - 2072030
 */
?>

<form method='post' action="">
    <div class="form-group">
        <label for="genreId" class="form-label">Genre Id</label>
        <input type='text' class="form-control" name='txtId' placeholder="Genre Id" id="genreId" readonly>
    </div>
    <div class="form-group">
        <label for="nameId" class="form-label">Genre Name</label>
        <input type='text' class="form-control" name='txtName' placeholder="Genre Name" autofocus id="nameId">
    </div>
    <div class="form-group">
        <input type='submit' id="btnUpdateGenre" value="Submit Data" class="btn btn-primary" name='btnSubmit'>
    </div>
</form>
<script type="module">
    import {
        getDatabase,
        ref,
        child,
        get,
        update
    } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-database.js";

    function fetchGenre(id, callback) {
        const dbRef = ref(getDatabase());
        get(child(dbRef, ApiService.dbVersion + "/" + ApiService.genreCollection + "/" + id)).then((snapshot) => {
            if (snapshot.exists()) {
                callback(snapshot.val());
            }
        });
    }

    function updateGenre(id, name) {
        const db = getDatabase();
        update(ref(db, ApiService.dbVersion + "/" + ApiService.genreCollection + "/" + id), {
            name: name
        });
    }

    $(document).ready(function() {
        let url = window.location.search;
        let allParam = new URLSearchParams(url);
        let idGenre = allParam.get('gid');
        fetchGenre(idGenre, genres => {
            document.getElementById('genreId').value = idGenre;
            document.getElementById('nameId').value = genres.name;
        });

        $('#btnUpdateGenre').click(function() {
            let name = $('#nameId').val();
            updateGenre(idGenre, name);
            window.location = "index.php?ahref=genre";
            return false;
        });
    });
</script>