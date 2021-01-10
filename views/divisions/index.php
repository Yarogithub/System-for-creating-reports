<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Lista <b>Filarów</b></h2></div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#addDivision" ><button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Add New</button></a>
                </div>
            </div>
        </div>
        <table id="divisionTable" style="width: 100%" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
                <td></td>
                <td></td>
                <td></td>
            </tbody>
        </table>
    </div>
</div>

<div id="addDivision" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form class="needs-validaion" id="divisionAddForm" action="<?php echo URL; ?>Division/create" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Dodawanie: Filaru</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nazwa Filaru</label>
                        <input type="text" name="name" class="form-control"  placeholder="Nazwa">
                        <div class="invalid-feedback" id="nameError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <input type="submit" id="userSave" class="btn btn-primary" value="Dodaj">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="divisionEdit" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="divisionEditForm" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Edytowanie: Filaru</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nazwa Filaru</label>
                        <input type="hidden" name="id">
                        <input type="text" name="name" class="form-control"  placeholder="Nazwa">
                        <div class="invalid-feedback" id="EditError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary"  value="Save">
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<div id="divisionDelete" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="divisionDeleteForm" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Usuwanie: Filaru</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Jesteś pewien, że chcesz usunąć ten filar. Ta akcja nie może zostać cofnięta.</p>
                        <input type="hidden" id="deleteId">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                        <input type="submit" class="btn btn-danger" value="Usuń">
                    </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#divisionTable").DataTable({
            ajax: '<?php echo URL; ?>Division/getJSON',

            columns: [
                {"data": "id"},
                {"data": "name"},
                {
                "data": '',
                "defaultContent": "<a class=\"add\" title=\"Add\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE03B;</i></a>\n" +
                "<a href=\"#\" class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#divisionEdit\" id=\"Editbutton\"><i class=\"material-icons\">&#xE254;</i></a>\n" +
                "<a class=\"delete\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#divisionDelete\"><i class=\"material-icons\">&#xE872;</i></a>"
                }
            ]
        });
    });

    $(document).on('submit','#divisionAddForm',function (e) {

        e.preventDefault();

        var form = $(this);

        $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data) {
                    $('#addDivision').modal('toggle');
                    $('#divisionTable').DataTable().ajax.reload();
                    $('input').attr('name', 'name').val('');
                },
                error: function (data) {
                    var error = JSON.parse(data.responseText);
                    var errors = error.errors;
                    $.each(errors, function (index, value) {

                        $('input[name="' + index + '"]').addClass("is-invalid");
                        $('select[name="' + index + '"]').addClass("is-invalid");

                        $('#' + index + "Error").html(value);
                    });
                },
        });

    });

    $(document).on('click', '.edit', function () {

        var parent = $(this).parents('tr');
        var td = parent.find('td');
        var id = td[0].textContent;
        var name = td[1].textContent;

        $('input[name="id"]').val(id);
        $('input[name="name"]').val(name);

    });

    $(document).on('submit', '#divisionEditForm', function (e) {

        e.preventDefault();

        var id = $('input[name="id"]').val();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Division/edit/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#divisionEdit').modal('toggle');
                $('#divisionTable').DataTable().ajax.reload();
            },
            error: function (data) {
                var error = JSON.parse(data.responseText);
                var errors = error.errors;

                $.each(errors, function (index, value) {

                    $('input[name="' + index + '"]').addClass("is-invalid");

                    $('#' + index + "EditError").html(value);
                });
            },
        });

    });

    $(document).on('click', '.delete', function () {

        var test = $(this).parents('tr');
        var tds = test.find('td');

        var id = tds[0].textContent;

        $('#deleteId').val(id);

    });

    $(document).on('submit', '#divisionDeleteForm', function (e) {

        e.preventDefault();

        var id = $('#deleteId').val();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Division/delete/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#divisionDelete').modal('toggle');
                $('#divisionTable').DataTable().ajax.reload();
            },
            error: function (data) {

            },
        });

    });


</script>