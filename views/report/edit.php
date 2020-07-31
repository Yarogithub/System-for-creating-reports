<h1 class="text-white">Report: Edit</h1>


<form method="post" action="<?php echo URL;?>report/editSave/<?php echo $this->report['reportid']; ?>">
    <div class="form-group">
    <label class="text-white" for="Report">Report</label>
    <textarea class="form-control" id="Report" rows="8"><?php echo $this->report['content'];
        ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

