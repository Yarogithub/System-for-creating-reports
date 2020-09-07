<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>User <b>List</b></h2></div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#myUserModal" ><button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Add New</button></a>
                </div>
            </div>
        </div>
        <table id="userTable" style="width: 100%" class="table table-striped table-bordered">

            <thead>
            <tr>
                <th>UserId</th>
                <th>Email/login</th>
                <th>Role</th>
                <th>Action</th>
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

<div id="myUserModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form class="needs-validaion" id="userAddForm" action="<?php echo URL; ?>user/create" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">User: Add</h4>
                    <button type="button" name="close" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email/login</label>
                        <input type="text" id="email" name="login" class="form-control"  placeholder="Email">
                        <div class="invalid-feedback" id="loginError">
                        </div>
                    </div>
                    <div class="form-group">

                        <label>Password</label>
                        <input type="password" id="addPassword" name="password" class="form-control">
                        <div class="invalid-feedback" id="passwordError">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="userRole">Role</label>
                        <select class="form-control custom-select" name="role" id="userRole">
                            <option value="admin" name="admin">admin</option>
                            <option value="employee" name="employee">employee</option>
                        </select>
                        <div class="invalid-feedback" id="roleError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" id="userSave" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
     </div>
</div>

<div id="myUserEditModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">User: Edit</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id">
                        <label>Email/login</label>
                        <input type="text" name="login" id="loginEdit" class="form-control">
                        <div class="invalid-feedback" id="loginEditError">
                        </div>
                    </div>
                    <div class="form-group">

                        <label>Password</label>
                        <input type="password" name="password"  class="form-control" id="password">
                        <div class="invalid-feedback" id="passwordEditError">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userRoleEdit">Role</label>
                        <select class="form-control setRole" id="userRoleEdit" name="role" >
                            <option value="admin" name="admin">admin</option>
                            <option value="employee" name="employee">employee</option>
                        </select>
                        <div class="invalid-feedback" id="roleEditError">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" id="userEdit" value="Save">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="myUserDeleteModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">User: Delete</h4>
                    <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Do you really want to delete these user? This process cannot be undone.</p>
                        <input type="hidden" id="deleteId">
                    </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-danger" id="userDelete" value="Delete">
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
                    {
                        "data": '',
                        "defaultContent": "<a class=\"add\" title=\"Add\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE03B;</i></a>\n" +
                            "<a href=\"#\" class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#myUserEditModal\" id=\"Editbutton\"><i class=\"material-icons\">&#xE254;</i></a>\n" +
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
                        })

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
        $('#loginEdit').val(login);
        $('.setRole').val(role).change();

    });

    $(document).on('click', '#userEdit', function (e) {

        var login = $('input#loginEdit').val();

        var id = $('input#id').val();

        var password = $('input#password').val();

        var role = $('select.setRole').val();


             e.preventDefault();


            $.ajax({
                type: 'POST',
                url: "<?php echo URL; ?>user/edit/" + id,
                data: {
                    'login': login,
                    'password': password,
                    'role': role
                },
                success: function (data) {
                    $('#myUserEditModal').modal('toggle');
                    $('#userTable').DataTable().ajax.reload();
                },
                error: function (data) {

                    // me.data('requestRunning',false);


                    var error = JSON.parse(data.responseText);
                    var errors = error.errors;
                    var emailError = errors.login;
                    var passwordError = errors.password;
                    var roleError = errors.role;

                    $.each(errors, function (index, value) {

                        $('input[name="' + index + '"]').addClass("is-invalid");
                        $('select[name="' + index + '"]').addClass("is-invalid");

                        $('#' + index + "EditError").html(value);
                    })

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

    $(document).on('click', '#userDelete',
        function () {

            var frm = $('#myUserDeleteModal');


            var id = $('input#deleteId').val();


            frm.submit(function (e) {

                e.preventDefault();


                $.ajax({
                    type: 'POST',
                    url: "<?php echo URL; ?>user/delete/" + id,
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