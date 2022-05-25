<?php

/**
 * @author 2072030 - Kevin Laurence
 */

?>

<form id="formGenre" method='post' action="">
    <div class="form-group">
        <label for="txtName" class="form-label">Genre Name</label>
        <input type='text' class="form-control" name='txtName' placeholder="Genre Name" autofocus required id="txtName">
    </div>
    <div class="form-group">
        <input id="btnSaveGenre" type='submit' value="Submit Data" class="btn btn-primary" name='btnSubmit'>
    </div>
</form>

<table class="table table-striped" id="tableGenre">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<script type="module">
    import {
        getDatabase, ref, set, push, onValue, remove
    } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-database.js";

    function saveGenre(name) {
        const db = getDatabase();
        push(ref(db, ApiService.dbVersion + "/" + ApiService.genreCollection), {
            name: name
        });

    }

    function fetchAllGenre(callback) {
        const db = getDatabase();
        const genreRef = ref(db, ApiService.dbVersion + "/" + ApiService.genreCollection);
        onValue(genreRef, (snapshot) => {
            let objArr = [];
            snapshot.forEach(function(childSnap) {
                let genre = {
                    'id': childSnap.key,
                    'name': childSnap.val().name
                };
                objArr.push(genre);
            });
            callback(objArr);
        });
    }

    fetchAllGenre(genres => {
        $('#tableGenre').DataTable().clear();
        $('#tableGenre').DataTable().rows.add(genres).draw();
    })
    $('#tableGenre').DataTable({
        columns: [{
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'null',
                render: function(data, type, row) {
                    return '<button onclick="upGenre(\''+ row.id +'\')" class="btn btn-warning"><i data-fa-symbol="edit" class="fas fa-edit fa-fw"></i></button>'
                    + " " + '<button onclick="delGenre(\'' + row.id + '\')" class="btn btn-danger"><i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i></button>'
                }
            }
        ]
    });

    window.delGenre = function delGenre(id) {
        deleteGenre(id);
    }
    window.upGenre = function upGenre(id) {
        editGenre(id);
    }
    function deleteGenre(id) {
        const db = getDatabase();
        const confirmation = window.confirm("Are you sure want to delete this data?");
        if (confirmation) {
            remove(ref(db, ApiService.dbVersion + "/" + ApiService.genreCollection + "/" + id));
        }
    }
    function editGenre(id) {
        window.location = "index.php?ahref=upgenre&gid=" + id;
    }

    $(document).ready(function() {
        $('#btnSaveGenre').click(function() {
            let name = $("#txtName").val();
            saveGenre(name);
            return false;
        });
    });
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>