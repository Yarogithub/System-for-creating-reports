
<?php if (Session::get('role') == 'admin'):?>
    <h1>Daily report</h1>
<?php else: ?>
    <h1>Daily report</h1>
    <form method="post" action="<?php echo URL; ?>report/create">
        <label>Report</label><textarea name="content"></textarea><br />
        <label>&nbsp;</label><input type="submit" />
    </form>
<?php endif; ?>


<table>

    <?php
    if(Session::get('role') == 'admin')
    {
        foreach ($this->reportsAdminList as $key => $value) {
            echo '<tr>';
            echo '<td>' . $value['reportid'] . '</td>';
            echo '<td>' . $value['login'] . '</td>';
            echo '<td>' . $value['content'] . '</td>';
            echo '<td>' . $value['createdAt'] . '</td>';
            echo '</tr>';
        }
    }
    else {
        foreach ($this->reportsEmployeeList as $key => $value) {
            echo '<tr>';
            echo '<td>' . ++$key . '</td>';
            echo '<td>' . $value['content'] . '</td>';
            echo '<td>' . $value['createdAt'] . '</td>';
            echo '<td>
				<a href="' . URL . 'report/edit/' . $value['reportid'] . '">Edit</a>
				<a href="' . URL . 'report/delete/' . $value['reportid'] . '">Delete</a>
			</td>';
            echo '</tr>';
        }
    }
    ?>
</table>