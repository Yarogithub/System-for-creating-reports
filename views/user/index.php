<h1 class="text-white">User</h1>



<div class="table-responsive-sm">
    <table class="table table-striped table-bordered table-success mt-5">
    <?php
    echo '<thead class="thead-dark">
            <tr>
                <th scope="col">UserId</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>';
        foreach($this->userList as $key => $value)
        {
            echo '<tbody>';
            echo '<tr>';
            echo '<th scope="row">' . $value['userid'] . '</th>';
            echo '<td>' . $value['login'] . '</td>';
            echo '<td>' . $value['role'] . '</td>';
            echo '<td>
                    <a class="text-info" href="' . URL . 'user/edit/' . $value['userid'] . '">Edit</a>
                    </td>
                    <td>
                    <a class="text-danger" href="' . URL . 'user/delete/' . $value['userid'] . '">Delete</a>
                    </td>';
            echo '</tr>';
        }
    echo'<td>
                    <a class="text-dark" href="' . URL . 'user/createSave/'.'">+ADD</a>
                </td>';

    echo '</tbody>';
    ?>
    </table>
</div>