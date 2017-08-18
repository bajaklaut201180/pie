<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title ?></h1> 
        </div>
        <div class="col-lg-12">
            <form action="<?= base_url('admin/banner/updates'); ?>" name="bannerForm" method="POST" role="form" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <button type="submit" class="btn btn-submit">Update Banner</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='javascript:window.history.go(-1);'">Cancel</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3>PERSONAL INFORMATION</h3><br />
                                <div class="form-group hidden">
                                    <label for="id-banner">ID Banner</label>
                                    <input class="form-control" id="id-banner" name="id_banner" type="text" size="30" value="<?= $banner['banner_id']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Banner Name</label>
                                    <input class="form-control" name="name_banner" value="<?= $banner['banner_name']; ?>" required="" />
                                </div>
                                <div class="form-group">
                                    <label>Banner Caption</label>
                                    <input class="form-control" name="caption_banner" value="<?= $banner['banner_caption'] ?>" required="" />
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input class="form-control" name="url" value="<?= $banner['url']; ?>" required="" />
                                </div>
                                <div class='form-group'>
                                    <span class="btn btn-default btn-file btn-upload">
                                        <?php 
                                            if(!empty($banner['banner_image'])){ 
                                        ?>
                                            <p>
                                                <?= $banner['banner_image']; ?>
                                                <input type="file" name="foto_banner" accept="jpg|jpeg|png" />
                                            </p>
                                            <img src="<?= base_url(), 'assets/images/banner/thumbs/' .$banner['banner_image']; ?>" />
                                        <?php 
                                            }else {
                                        ?>
                                            <p>
                                                <input type="file" name="foto_banner" accept="jpg|jpeg|png" />
                                            </p>
                                             <img src="<?= base_url(), 'assets/images/icon/no-image.png'; ?>" />
                                        <?php
                                            } 
                                        ?>
                                        <p class="help-block"><strong>Recomended Size: <?= $this->width .'px' .' * ' .$this->height .'px'; ?></strong></p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <h3>FLAG</h3><br />
                                <div class='form-group'>
                                    <label for="name_section">Status</label><br />
                                    <input type="radio" class="active-flag" name="flag" value="1" <?php echo($banner['flag']==1)?"checked":""; ?> /><label><span class="green-flag"></span>Active</label><br />
                                    <input type="radio" class="inactive-flag" name="flag" value="2" <?php echo($banner['flag']==2)?"checked":""; ?> /><label><span class="red-flag"></span>Inactive</label><br />
                                    <input type="radio" class="delete-flag" name="flag" value="3" <?php echo($banner['flag']==3)?"checked":""; ?> /><label><span class="black-flag"></span>Delete</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>DESCRIPTION</h3><br />
                                <div class="form-group">
                                    <textarea id="moxEditors" class="ckeditor" name="description_banner"><?= $banner['banner_description']; ?></textarea>
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
	//CKEDITOR.replace( '#moxEditors', {} );
    var objEditor = CKEDITOR.instances['#moxEditors'];
    q = objEditor.getData();
</script>