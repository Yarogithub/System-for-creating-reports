<h1>Report: Edit</h1>


<form method="post" action="<?php echo URL;?>report/editSave/<?php echo $this->report['reportid']; ?>">
    <label>Report</label><textarea name="content" ><?php echo $this->report['content'];
        ?></textarea>" <br />
    <label>&nbsp;</label><input type="submit" />
</form>

