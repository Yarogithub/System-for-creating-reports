<div class="table-responsive w-100">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Lista <b>Uzytkowników</b></h2></div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#myUserModal" ><button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Dodaj</button></a>
                </div>
            </div>
        </div>
        <table id="userTable" style="width: 100%" class="table table-striped table-bordered">

            <thead>
            <tr>
                <th>Id</th>
                <th>Adres mailowy</th>
                <th>Rola</th>
                <th>Imie</th>
                <th>Nazwisko</th>
<!--                <th>Numer telefonu</th>-->
<!--                <th>Kod pocztowy</th>-->
<!--                <th>Kraj</th>-->
<!--                <th>Miejscowość</th>-->
                <th>Stawka godzinowa</th>
                <th>Akcje</th>
            </tr>
            </thead>

            <tbody>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
                <td></td>
                <td></td>
            </tbody>

        </table>
    </div>
</div>

<div id="myUserModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form class="needs-validaion" id="userAddForm" action="<?php echo URL; ?>User/create" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Dodawanie: Użytkownika</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Adres mailowy</label>
                        <input type="text" name="login" class="form-control"  placeholder="Adres mailowy">
                        <div class="invalid-feedback" id="loginError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hasło</label>
                        <input type="password" name="password" class="form-control" placeholder="Hasło">
                        <div class="invalid-feedback" id="passwordError">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="userRole">Rola</label>
                        <select class="form-control custom-select" name="role" id="userRole">
                            <option value="admin" name="admin">administrator</option>
                            <option value="employee" name="employee">pracownik</option>
                        </select>
                        <div class="invalid-feedback" id="roleError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Imie</label>
                        <input type="text" name="name" class="form-control"  placeholder="Imie">
                        <div class="invalid-feedback" id="nameError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nazwisko</label>
                        <input type="text" name="lastName" class="form-control"  placeholder="Nazwisko">
                        <div class="invalid-feedback" id="lastNameError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Numer telefonu</label>
                        <input type="text" name="phoneNumber" class="form-control"  placeholder="Numer telefonu">
                        <div class="invalid-feedback" id="phoneNumberError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kod pocztowy</label>
                        <input type="text" name="postalCode" class="form-control"  placeholder="Kod pocztowy">
                        <div class="invalid-feedback" id="postalCodeError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kraj</label>
                        <input type="text" name="country" class="form-control"  placeholder="Kraj">
                        <div class="invalid-feedback" id="countryError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Miejscowość</label>
                        <input type="text"  name="city" class="form-control"  placeholder="Miejscowość">
                        <div class="invalid-feedback" id="cityError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Stawka godzinowa</label>
                        <input type="text" id="hourlyRate" name="hourlyRate" class="form-control"  placeholder="Stawka godzinowa">
                        <div class="invalid-feedback" id="hourlyRateError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dział</label>
                        <select class="form-control" name="departmentId" >
                            <?php
                            $departments = $this->departments;
                            foreach ($departments as $value): ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="divisionIdEditError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Stanowisko</label>
                        <select class="form-control" name="positionId" >
                            <?php
                            $positions = $this->positions;
                            foreach ($positions as $value): ?>
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

<div id="myUserEditModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="userEdit" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Edycja: Użytkownika</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id">
                        <label>Adres mailowy</label>
                        <input type="text" id="email" name="login" class="form-control"  placeholder="Adres mailowy">
                        <div class="invalid-feedback" id="loginError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hasło</label>
                        <input type="password" id="addPassword" name="password" class="form-control" placeholder="Hasło">
                        <div class="invalid-feedback" id="passwordError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Rola</label>
                        <select class="form-control setRole" name="role">
                            <option value="admin" name="admin">administrator</option>
                            <option value="employee" name="employee">pracownik</option>
                        </select>
                        <div class="invalid-feedback" id="roleError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Imie</label>
                        <input type="text" id="name" name="name" class="form-control"  placeholder="Imie">
                        <div class="invalid-feedback" id="nameError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nazwisko</label>
                        <input type="text" id="lastName" name="lastName" class="form-control"  placeholder="Nazwisko">
                        <div class="invalid-feedback" id="lastNameError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Numer telefonu</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"  placeholder="Numer telefonu">
                        <div class="invalid-feedback" id="phoneNumberError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kod pocztowy</label>
                        <input type="text" id="postalCode" name="postalCode" class="form-control"  placeholder="Kod pocztowy">
                        <div class="invalid-feedback" id="postalCodeError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kraj</label>
                        <input type="text" id="country" name="country" class="form-control"  placeholder="Kraj">
                        <div class="invalid-feedback" id="countryError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Miejscowość</label>
                        <input type="text" id="city" name="city" class="form-control"  placeholder="Miejscowość">
                        <div class="invalid-feedback" id="cityError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Stawka godzinowa</label>
                        <input type="text" name="hourlyRate" class="form-control"  placeholder="Stawka godzinowa">
                        <div class="invalid-feedback" id="hourlyRateError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="departmentsId">Dział</label>
                        <select class="form-control setDepartments" name="departmentId" >
                            <?php
                            $departments = $this->departments;
                            foreach ($departments as $value): ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="divisionIdEditError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="departmentsId">Stanowisko</label>
                        <select class="form-control setPosition" name="positionId" >
                            <?php
                            $positions = $this->positions;
                            foreach ($positions as $value): ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="divisionIdEditError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <input type="submit" class="btn btn-primary" value="Zapisz">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="myUserDeleteModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form id="userDelete" action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Usuwanie: Użytkownika</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Czy na pewno chcesz usunąć tego użytkownika.</p>
                        <input type="hidden" id="deleteId">
                    </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <input type="submit" class="btn btn-danger"  value="Usuń">
                </div>
            </form>
        </div>
    </div>
</div>




<script type="text/javascript">

    $(document).ready(function () {
            $("#userTable").DataTable({
                ajax: '<?php echo URL; ?>User/listJsonUsers',

                columns: [
                    {"data": "userid"},
                    {"data": "login"},
                    {"data": "role"},
                    {"data": "name"},
                    {"data": "lastName"},
                    {"data": "hourlyRate"},
                    {
                        "data": '',
                        "defaultContent": "<a href=\"#\" class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#myUserEditModal\" id=\"Editbutton\"><i class=\"material-icons\">&#xE254;</i></a>\n" +
                            "<a class=\"delete\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#myUserDeleteModal\"><i class=\"material-icons\">&#xE872;</i></a>"
                    }
                ]
            });
    });





    $(document).on('click','#userSave',function () {

        var frm = $('#userAddForm');


        frm.submit(function (e) {

            e.preventDefault();

            var me = $(this);

            if(me.data('requestRunning')){
                return;
            }

            me.data('requestRunning',true);



            $.ajax({
                    type: frm.attr('method'),
                    url: frm.attr('action'),
                    data: frm.serialize(),
                    success: function (data) {
                        $('#myUserModal').modal('toggle');
                        $('#userTable').DataTable().ajax.reload();
                        $('input').attr('name', 'login').val('');
                        $('input').attr('name', 'password').val('');
                    },
                    error: function (data) {

                        me.data('requestRunning',false);

                        console.log('asdas');
                        var error = JSON.parse(data.responseText);
                        var errors = error.errors;
                        var emailError = errors.login;
                        var passwordError = errors.password;
                        var roleError = errors.role;

                        $.each(errors, function (index, value) {

                            $('input[name="' + index + '"]').addClass("is-invalid");
                            $('select[name="' + index + '"]').addClass("is-invalid");

                            $('#' + index + "Error").html(value);
                        });

                        if (emailError === undefined)
                        {
                            $('input[name="login"]').removeClass("is-invalid");
                        }

                        if(passwordError===undefined){
                            $('input[name="password"]').removeClass("is-invalid");
                        }

                        if(roleError===undefined){
                            $('select[name="role"]').removeClass("is-invalid");
                        }
                    },
                });

        });

    });

    $('button[name="close"]').on('click',function () {

            $('input').attr('name', 'login').removeClass("is-invalid");
            $('input').attr('name', 'password').removeClass("is-invalid");
            $('select').attr('name', 'role').removeClass("is-invalid");

            $('#myUserModal').modal('toggle');

    });

    $(document).on('click', '.edit', function () {

        var parent = $(this).parents('tr');
        var td = parent.find('td');
        var id = td[0].textContent;
        var login = td[1].textContent;
        var role = td[2].textContent;


        $('#id').val(id);
        $('input[name="login"]').val(login);
        $('.setRole').val(role).change();

        var getID = $('#id').val();

        $(".setPosition option:selected").prop("selected",false);
        $(".setDepartments option:selected").prop("selected",false);


        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>User/editJSON/" + getID,
            data: '',
            success: function (data) {

                var Data = JSON.parse(data);
                var departments = Data.data.department;
                var positions = Data.data.position;
                var users = Data.data.user[0];
                $.each(departments, function (index, value) {
                    $(".setDepartments option[value='" + value.id + "']").prop("selected", true);
                });

                $.each(positions, function (index, value) {
                    $(".setPosition option[value='" + value.id + "']").prop("selected", true);
                });

                $.each(users, function (index, value) {
                    $('input[name="' + index + '"]').val(value);
                });


            },
            error: function (data) {

            },
        });

    });

    $(document).on('submit', '#userEdit', function (e) {

        e.preventDefault();

        var id = $('#id').val();

        var form = $(this);

            $.ajax({
                type: 'POST',
                url: "<?php echo URL; ?>User/edit/" + id,
                data: form.serialize(),
                success: function (data) {
                    $('#myUserEditModal').modal('toggle');
                    $('#userTable').DataTable().ajax.reload();
                },
                error: function (data) {

                    var error = JSON.parse(data.responseText);
                    var errors = error.errors;
                    var emailError = errors.login;
                    var passwordError = errors.password;
                    var roleError = errors.role;

                    $.each(errors, function (index, value) {

                        $('input[name="' + index + '"]').addClass("is-invalid");
                        $('select[name="' + index + '"]').addClass("is-invalid");

                        $('#' + index + "EditError").html(value);
                    });

                    if (emailError === undefined)
                    {
                        $('input[name="login"]').removeClass("is-invalid");
                    }

                    if(passwordError===undefined){
                        $('input[name="password"]').removeClass("is-invalid");
                    }

                    if(roleError===undefined){
                        $('select[name="role"]').removeClass("is-invalid");
                    }

                },
            });

    });

    $(document).on('click', '.delete', function () {

        var test = $(this).parents('tr');
        var tds = test.find('td');

        var id = tds[0].textContent;

        $('#deleteId').val(id);

    });

    $(document).on('submit', '#userDelete',
        function (e) {

            e.preventDefault();

            var id = $('#deleteId').val();

                $.ajax({
                    type: 'POST',
                    url: "<?php echo URL; ?>User/delete/" + id,
                    data: '',
                    success: function (data) {
                        $('#myUserDeleteModal').modal('toggle');
                        $('#userTable').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        console.log('An error occurred.');
                        console.log(data);
                    },
                });


            });









</script>













<!--<table class="table table-striped table-bordered table-success mt-5">-->
<!--    --><?php
//    echo '<thead class="thead-dark">
//            <tr>
//                <th scope="col">UserId</th>
//                <th scope="col">Username</th>
//                <th scope="col">Role</th>
//                <th scope="col">Edit</th>
//                <th scope="col">Delete</th>
//            </tr>
//            </thead>';
//    foreach($this->userList as $key => $value)
//    {
//        echo '<tbody>';
//        echo '<tr>';
//        echo '<th scope="row">' . $value['userid'] . '</th>';
//        echo '<td>' . $value['login'] . '</td>';
//        echo '<td>' . $value['role'] . '</td>';
//        echo '<td>
//                    <a class="text-info" href="' . URL . 'user/edit/' . $value['userid'] . '">Edit</a>
//                    </td>
//                    <td>
//                    <a class="text-danger" href="' . URL . 'user/delete/' . $value['userid'] . '">Delete</a>
//                    </td>';
//        echo '</tr>';
//    }
//    echo'<td>
//                    <a class="text-dark" href="' . URL . 'user/createSave/'.'">+ADD</a>
//                </td>';
//
//    echo '</tbody>';
//    ?>
<!--</table>-->