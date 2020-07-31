

    <h1 class="text-white">Daily report</h1>




<div class="table-responsive-sm">
    <table class="table table-striped table-bordered table-success mt-5">




        <?php
        if(Session::get('role') == 'admin')
        {
            echo '<thead class="thead-dark">
            <tr>
                <th scope="col">ReportId</th>
                <th scope="col">Username</th>
                <th scope="col">Content</th>
                <th scope="col">Date</th>
            </tr>
            </thead>';
            foreach ($this->reportsAdminList as $key => $value) {
                echo '<tbody>';
                echo '<tr>';
                echo '<th scope="row">' . $value['reportid'] . '</th>';
                echo '<td>' . $value['login'] . '</td>';
                echo '<td>' . $value['content'] . '</td>';
                echo '<td>' . $value['createdAt'] . '</td>';
                echo '</tr>';
                echo '</tbody>';
            }
        }
        else {
            echo '<thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Content</th>
                <th scope="col">Date</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>';
            foreach ($this->reportsEmployeeList as $key => $value) {
                echo '<tbody>';
                echo '<tr>';
                echo '<th scope="row">' . ++$key . '</th>';
                echo '<td>' . $value['content'] . '</td>';
                echo '<td>' . $value['createdAt'] . '</td>';
                echo '<td>
                    <a class="text-info" href="' . URL . 'report/edit/' . $value['reportid'] . '">Edit</a> 
                    </td>
                    <td>
                    <a class="text-danger" href="' . URL . 'report/delete/' . $value['reportid'] . '">Delete</a>
                </td>';
                echo '</tr>';


            }
            echo'<td>
                    <a class="text-dark" href="' . URL . 'report/createSave/'.'">+ADD</a>
                </td>';

            echo '</tbody>';
        }
        ?>
    </table>
</div>
