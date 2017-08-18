<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title; ?></h1> 
        </div>
        <div class="col-lg-12">
            <form action="<?= base_url('admin/' .$this->url .'/add'); ?>" name="bannerForm" method="POST" role="form" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <button type="submit" class="btn btn-submit"><?= $title; ?> </button>
                        <button type="button" class="btn btn-warning" onclick="location.href='javascript:window.history.go(-1);'">Cancel</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3>PERSONAL INFORMATION</h3><br />
                                <div class="form-group">
                                    <label>Banner Name</label>
                                    <input class="form-control" name="name_banner" required="" />
                                </div>
                                <div class="form-group">
                                    <label>Banner Caption</label>
                                    <input class="form-control" name="caption_banner" required="" />
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input class="form-control" name="url" required="" />
                                </div>
                                <div class='form-group'>
                                    <span class="btn btn-default btn-file btn-upload">
                                     Browse<input type="file" name="foto_banner" accept="jpg|jpeg|png" />
                                    </span>
                                    <p class="help-block"><strong>Recomended Size: <?= $this->width .'px' .' * ' .$this->height .'px'; ?></strong></p>
                                </div>
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
                        <div class="row">
                            <div class="col-md-12">
                                <h3>DESCRIPTION</h3><br />
                                <div class="form-group">
                                    <textarea id="moxEditors" class="ckeditor" name="description_banner"></textarea>
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