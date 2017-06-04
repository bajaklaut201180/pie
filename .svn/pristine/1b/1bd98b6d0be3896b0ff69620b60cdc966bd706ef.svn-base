<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Additional Banner</h1> 
            </div>
        </div>
        
        <div class="col-lg-12">
            <form action="<?= base_url('admin/banner_additional/add/'); ?>" name="bannerForm" method="POST" role="form" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <button type="submit" class="btn btn-primary">Add additional Banner</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='javascript:window.history.go(-1);'">Cancel</button></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group hidden">
                                    <label for="id-banner">ID Banner</label>
                                    <input class="form-control" id="id-banner" name="id_banner" type="text" size="30" value="<?= $banner_id; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Banner Name</label>
                                    <input class="form-control" name="name_banner" required="" />
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input class="form-control" name="url" required="" />
                                </div>
                                <div class='form-group'>
                                    <span class="btn btn-default btn-file btn-upload">
                                     Browse<input type="file" name="foto_additional_banner" accept="jpg|jpeg|png" />
                                    </span>
                                    <p class="help-block"><strong>Recomended Size: <?= $this->width .'px' .' * ' .$this->height .'px'; ?></strong></p>
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