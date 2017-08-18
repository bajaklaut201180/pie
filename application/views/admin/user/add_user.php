<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add <?= $title;  ?></h1> 
        </div>
        <div class="col-lg-12">
            <form action="<?= base_url('admin/' .$this->url .'/add'); ?>" name="userform" method="POST" role="form" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <button type="submit" class="btn btn-submit">Add <?= $title; ?></button>
                        <button type="button" class="btn btn-warning" onclick="location.href='javascript:window.history.go(-1);'">Cancel</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3>PERSONAL INFORMATION</h3><br />
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" />
                                </div>
                                <div class="form-group">
                                    <label>Privileges</label>
                                    <div>
                                        <select class="form-control" onchange="trigger_cbox(this.value)">
                                            <option>Choose privileges bellow it</option>
                                            <?php
                                                foreach($privileges as $row => $value) {
                                            ?>
                                                <option value="<?= $value['privileges_id'] ;?>"><?= $value['privileges_name']; ?></option>
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
                                        <input type="text" class="form-control" id="username" name="username" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div>
                                        <input type="password" class="form-control" id="password" name="password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="retype">Retype Password</label>
                                    <div>
                                        <input type="password" class="form-control" id="retype" name="retype" onchange="match_password()" />
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
                                                    <td class="text-center"><input type="checkbox" name="status[]" value="<?= $value['section_id']; ?>,1" disabled="" /></td>
                                                    <td class="text-center"><input type="checkbox" name="status[]" value="<?= $value['section_id']; ?>,2" disabled="" /></td>
                                                    <td class="text-center"><input type="checkbox" name="status[]" value="<?= $value['section_id']; ?>,3" disabled="" /></td>
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
                                    <input type="radio" class="active-flag" name="flag" value="1" checked="" /><label><span class="green-flag"></span>Active</label><br />
                                    <input type="radio" class="inactive-flag" name="flag" value="2" /><label><span class="red-flag"></span>Inactive</label><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#retype").keyup(match_password());
    });
</script>