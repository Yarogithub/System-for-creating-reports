<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Lista <b>Działów</b></h2></div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#addDepartment" ><button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Add New</button></a>
                </div>
            </div>
        </div>
        <table id="departmentTable" style="width: 100%" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Nazwa Filaru</th>
                <th>Akcja</th>
            </tr>
            </thead>
            <tbody>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tbody>
        </table>
    </div>
</div>

<div id="addDepartment" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form class="needs-validaion" id="departmentAddForm" action="<?php echo URL; ?>Department/create" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Dodawanie: Działu</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nazwa Działu</label>
                        <input type="text" name="name" class="form-control"  placeholder="Nazwa Działu">
                        <div class="invalid-feedback" id="nameError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="divisionId">Filar</label>
                        <select class="form-control"  name="divisionId" >
                            <?php
                            $divisions = $this->divisions;
                            foreach ($divisions as $value): ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="divisionIdEditError">
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

<div id="editDepartment" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form class="needs-validaion" id="departmentEditForm" action="<?php echo URL; ?>Department/create" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Edytowanie: Działu</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nazwa Działu</label>
                        <input type="hidden" name="departmentId">
                        <input type="text" name="name" class="form-control"  placeholder="Nazwa Działu">
                        <div class="invalid-feedback" id="nameError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="divisionId">Filar</label>
                        <select class="form-control setDivision" name="divisionId" >
                            <?php
                            $divisions = $this->divisions;
                            foreach ($divisions as $value): ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="divisionIdEditError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <input type="submit" id="userSave" class="btn btn-primary" value="Zapisz">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteDepartment" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="departmentDeleteForm" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Usuwanie: Działu</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Jesteś pewien, że chcesz usunąć ten Dział. Ta akcja nie może zostać cofnięta.</p>
                        <input type="hidden" id="deleteDepartmentID">
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
        $("#departmentTable").DataTable({
            ajax: '<?php echo URL; ?>Department/getJSON',

            columns: [
                {"data": "id"},
                {"data": "name"},
                {"data": "divisionName"},
                {
                    "data": '',
                    "defaultContent": "<a class=\"add\" title=\"Add\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE03B;</i></a>\n" +
                        "<a href=\"#\" class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#editDepartment\" id=\"Editbutton\"><i class=\"material-icons\">&#xE254;</i></a>\n" +
                        "<a class=\"delete\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#deleteDepartment\"><i class=\"material-icons\">&#xE872;</i></a>"
                }
            ]
        });
    });

    $(document).on('submit','#departmentAddForm',function (e) {

        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                $('#addDepartment').modal('toggle');
                $('#departmentTable').DataTable().ajax.reload();
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
        var divisionName = td[2].textContent;


        $('input[name="name"]').val(name);
        $('input[name="departmentId"]').val(id);

        var getID = $('input[name="departmentId"]').val();

        $(".setDivision option:selected").prop("selected",false);


        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Department/editJSON/" + getID,
            data: '',
            success: function (data) {
                var division = JSON.parse(data);
                var divisions = division.data;
                $.each(divisions, function (index, value) {
                    $(".setDivision option[value='" + value.id + "']").prop("selected", true);
                });
            },
            error: function (data) {

            },
        });
    });

    $(document).on('submit', '#departmentEditForm', function (e) {

        e.preventDefault();

        var id = $('input[name="departmentId"]').val();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Department/edit/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#editDepartment').modal('toggle');
                $('#departmentTable').DataTable().ajax.reload();
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

        $('#deleteDepartmentID').val(id);

    });

    $(document).on('submit', '#departmentDeleteForm', function (e) {

        e.preventDefault();

        var id = $('#deleteDepartmentID').val();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Department/delete/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#deleteDepartment').modal('toggle');
                $('#departmentTable').DataTable().ajax.reload();
            },
            error: function (data) {

            },
        });

    });
</script>