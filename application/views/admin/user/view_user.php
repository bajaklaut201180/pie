<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title;  ?></h1> 
        </div>
        <div class="col-lg-12">
            <form action="<?php echo base_url('admin/' .$this->url .'/view'); ?>" method="POST" role="form">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <button id="update-button" type="submit" class="btn btn-submit">Update <?= $this->title; ?></button>
                        <button type="button" class="btn btn-warning" onclick="location.href='javascript:window.history.go(-1);'">Cancel</button>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-8">
                            <h3>PERSONAL INFORMATION</h3><br />
                            <div class="form-group">
                                <div class="hidden">
                                    <input type="text" class="form-control" id="id_admin" name="id_admin" value="<?= $user['admin_id']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <div>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['admin_email']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <div>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $user['admin_phone']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Privileges</label>
                                <div>
                                    <select class="form-control" onchange="trigger_cbox(this.value)">
                                        <option>Choose privileges bellow it</option>
                                        <?php
                                            foreach($privileges as $row => $value) {
                                        ?>
                                            <option value="<?= $value['privileges_id'] ;?>" <?= ($value['privileges_id'] == $user['privileges_id'])?'selected':''; ?>><?= $value['privileges_name']; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['admin_username']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div>
                                    <input type="password" class="form-control" id="password" name="password" value="<?= $user['admin_password'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="retype">Retype Password</label>
                                <div>
                                    <input type="password" class="form-control" id="retype" name="retype" value="<?= $user['admin_password'] ?>" />
                                </div>
                                <div class="col-sm-2 password-notif"></div>
                            </div>
                            <br />
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Section Name</th>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Update</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($section as $row => $value) {
                                    ?>
                                            <tr>
                                                <td><?= $value['section_name']; ?></td>
                                                <td class="text-center"><input type="checkbox" name="status[]" value="<?= $value['section_id']; ?>,1" <?php echo($user['privileges_id'] == 3)?"":"disabled"; ?><?php echo($value['privileges_status_read'] == 1)?"checked":""; ?>  /></td>
                                                <td class="text-center"><input type="checkbox" name="status[]" value="<?= $value['section_id']; ?>,2" <?php echo($user['privileges_id'] == 3)?"":"disabled"; ?> <?php echo($value['privileges_status_update'] == 1)?"checked":""; ?> /></td>
                                                <td class="text-center"><input type="checkbox" name="status[]" value="<?= $value['section_id']; ?>,3" <?php echo($user['privileges_id'] == 3)?"":"disabled"; ?> <?php echo($value['privileges_status_delete'] == 1)?"checked":"" ?> /></td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <h3>FLAG</h3><br /> 
                            <div class='form-group'>
                                 <label for="name_section">Status</label><br />
                                <input type="radio" class="active-flag" name="flag" value="1" <?php echo($user['flag']==1)?"checked":""; ?> />
                                <label><span class="green-flag"></span>Active</label><br />
                                <input type="radio" class="inactive-flag" name="flag" value="2" <?php echo($user['flag']==2)?"checked":""; ?> />
                                <label><span class="red-flag"></span>Inactive</label><br />
                                <input type="radio" class="delete-flag" name="flag" value="3" <?php echo($user['flag']==3)?"checked":""; ?> />
                                <label><span class="black-flag"></span>Delete</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#password, #retype').on('keyup', function() {
        if($('#password').val() == $('#retype').val()) {
            $('.password-notif').html('Match').css('color', 'green');
            $('#update-button').removeAttr('disabled');
        }else {
            $('.password-notif').html('Not Matching').css('color', 'red'); 
            $('#update-button').attr('disabled', 'disabled');
        }
    });
</script>