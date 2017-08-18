<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title;  ?></h1> 
        </div>
        <div class="col-lg-12">
            <form action="<?php echo base_url('admin/' .$this->url .'/view'); ?>" method="POST" role="form" class="form-horizontal">
                <div class="col-lg-8">
                    <h3>PERSONAL INFORMATION</h3><br />
                    <div class="form-group">
                        <div class="col-sm-8 hidden">
                            <input type="text" class="form-control" id="id_section" name="id_section" value="<?= $section['section_id']; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="section">Section Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="section" name="name_section" value="<?= $section['section_name']; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="parent">Parent</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="parent" name="parent_section">
                                <option>-- Select Parent Below It --</option>
                                <option value="0" <?php echo ($section['section_parent']==0)?'selected':''; ?>>[parent]</option>
                                <?php 
                                    foreach ($sectionCategory as $key => $value) {
                                ?>
                                        <option value="<?= $value['section_id']; ?> " <?php echo ($section['section_parent']==$value['section_id'])?'selected':'' ?>><?= $value['section_name']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3>FLAG</h3><br /> 
                    <div class="radio">
                        <label><input type="radio" class="active-flag" name="flag" value="1" <?php echo ($section['flag']==1)?'checked':''; ?> /><strong>Active</strong></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" class="inactive-flag" name="flag" value="2" <?php echo ($section['flag']==2)?'checked':''; ?> /><strong>Inactive</strong></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" class="delete-flag" name="flag" value="3" <?php echo ($section['flag']==3)?'checked':''; ?> /><strong>Delete</strong></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>