<h1 class="text-white">User: Edit</h1>



<form method="post" action="<?php echo URL;?>user/editSave/<?php echo $this->user['userid']; ?>">
    <div class="form-group">
        <label class="text-white" for="Username">Username</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">@</div>
            </div>
            <input type="text" name="login" class="form-control" id="Username" placeholder="Username" value="<?php echo $this->user['login']; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="text-white" for="Passowrd">Password</label>
            <input type="password" name="password" class="form-control" id="Passowrd" placeholder="Password">
    </div>
    <div class="form-group">
        <label class="text-white" for="Role">Role</label>
        <select class="form-control" name="role" id="Role">
            <option value="employee" <?php if($this->user['role'] == 'default') echo 'selected'; ?>>Employee</option>
            <option value="admin" <?php if($this->user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<!--<label>Login</label><input type="text" name="login" value="--><?php //echo $this->user['login']; ?><!--" /><br />-->

