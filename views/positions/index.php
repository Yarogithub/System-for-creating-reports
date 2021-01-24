<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Lista <b>Stanowisk</b></h2></div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#addposition" ><button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Dodaj</button></a>
                </div>
            </div>
        </div>
        <table id="positionTable" style="width: 100%" class="table table-striped table-bordered">
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

<div id="addposition" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form class="needs-validaion" id="positionAddForm" action="<?php echo URL; ?>Position/create" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Dodawanie: Stanowiska</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nazwa Stanowiska</label>
                        <input type="text" name="name" class="form-control"  placeholder="Nazwa">
                        <div class="invalid-feedback" id="nameError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <input type="submit" class="btn btn-primary" value="Dodaj">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="positionEdit" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="positionEditForm" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Edytowanie: Stanowiska</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nazwa Stanowiska</label>
                        <input type="hidden" name="id">
                        <input type="text" name="name" class="form-control"  placeholder="Nazwa">
                        <div class="invalid-feedback" id="EditError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <input type="submit" class="btn btn-primary"  value="Zapisz">
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<div id="positionDelete" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="positionDeleteForm" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Usuwanie: Stanowiska</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Jesteś pewien, że chcesz usunąć to stanowisko. Ta akcja nie może zostać cofnięta.</p>
                        <input type="hidden" id="deletePositionId">
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
        $("#positionTable").DataTable({
            ajax: '<?php echo URL; ?>Position/getJSON',

            columns: [
                {"data": "id"},
                {"data": "name"},
                {
                    "data": '',
                    "defaultContent": "<a class=\"add\" title=\"Add\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE03B;</i></a>\n" +
                        "<a href=\"#\" class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#positionEdit\" id=\"Editbutton\"><i class=\"material-icons\">&#xE254;</i></a>\n" +
                        "<a class=\"delete\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#positionDelete\"><i class=\"material-icons\">&#xE872;</i></a>"
                }
            ]
        });
    });

    $(document).on('submit','#positionAddForm',function (e) {

        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                $('#addposition').modal('toggle');
                $('#positionTable').DataTable().ajax.reload();
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

    $(document).on('submit', '#positionEditForm', function (e) {

        e.preventDefault();

        var id = $('input[name="id"]').val();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Position/edit/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#positionEdit').modal('toggle');
                $('#positionTable').DataTable().ajax.reload();
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

        $('#deletePositionId').val(id);

    });

    $(document).on('submit', '#positionDeleteForm', function (e) {

        e.preventDefault();

        var id = $('#deletePositionId').val();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Position/delete/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#positionDelete').modal('toggle');
                $('#positionTable').DataTable().ajax.reload();
            },
            error: function (data) {

            },
        });

    });


</script>