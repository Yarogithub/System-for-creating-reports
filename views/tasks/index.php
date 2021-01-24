<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Lista <b>Zadań</b></h2></div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#addtask" ><button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Dodaj</button></a>
                </div>
            </div>
        </div>
        <table id="taskTable" style="width: 100%" class="table table-striped table-bordered">
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

<div id="addtask" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form class="needs-validaion" id="taskAddForm" action="<?php echo URL; ?>Task/create" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Dodawanie: Zadania</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nazwa Zadania</label>
                        <input type="text" name="name" class="form-control"  placeholder="Nazwa">
                        <div class="invalid-feedback" id="nameError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="divisionId">Dział</label>
                        <select class="form-control setRole" id="divisionId" multiple="multiple"  name="departmentsId[]" >
                            <?php
                            $departments = $this->departments;
                            foreach ($departments as $value): ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="divisionIdEditError">
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

<div id="taskEdit" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="taskEditForm" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Edytowanie: Zadania</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nazwa Zadania</label>
                        <input type="hidden" name="id">
                        <input type="text" name="name" class="form-control"  placeholder="Nazwa">
                        <div class="invalid-feedback" id="EditError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="departmentsId">Dział</label>
                        <select class="form-control setDepartments"  multiple="multiple"  name="departmentsId[]" >
                            <?php
                            $departments = $this->departments;
                            foreach ($departments as $value): ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="divisionIdEditError">
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

<div id="taskDelete" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="taskDeleteForm" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Usuwanie: Zadania</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Jesteś pewien, że chcesz usunąć to zadanie. Ta akcja nie może zostać cofnięta.</p>
                        <input type="hidden" id="deleteTaskId">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                        <input type="submit" class="btn btn-danger" value="Usuń">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#taskTable").DataTable({
            ajax: '<?php echo URL; ?>Task/getJSON',

            columns: [
                {"data": "id"},
                {"data": "name"},
                {
                    "data": '',
                    "defaultContent": "<a class=\"add\" title=\"Add\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE03B;</i></a>\n" +
                        "<a href=\"#\" class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#taskEdit\" id=\"Editbutton\"><i class=\"material-icons\">&#xE254;</i></a>\n" +
                        "<a class=\"delete\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#taskDelete\"><i class=\"material-icons\">&#xE872;</i></a>"
                }
            ]
        });
    });

    $(document).on('submit','#taskAddForm',function (e) {

        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                $('#addtask').modal('toggle');
                $('#taskTable').DataTable().ajax.reload();
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

        var getID = $('input[name="id"]').val();

        $(".setDepartments option:selected").prop("selected",false);


        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Task/editJSON/" + getID,
            data: '',
            success: function (data) {

                var department = JSON.parse(data);
                var departments = department.data;
                $.each(departments, function (index, value) {
                    $(".setDepartments option[value='" + value.id + "']").prop("selected", true);
                });


            },
            error: function (data) {

            },
        });

    });

    $(document).on('submit', '#taskEditForm', function (e) {

        e.preventDefault();

        var id = $('input[name="id"]').val();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Task/edit/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#taskEdit').modal('toggle');
                $('#taskTable').DataTable().ajax.reload();
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

        $('#deleteTaskId').val(id);

    });

    $(document).on('submit', '#taskDeleteForm', function (e) {

        e.preventDefault();

        var id = $('#deleteTaskId').val();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>Task/delete/" + id,
            data: form.serialize(),
            success: function (data) {
                $('#taskDelete').modal('toggle');
                $('#taskTable').DataTable().ajax.reload();
            },
            error: function (data) {

            },
        });

    });


</script>