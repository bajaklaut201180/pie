<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Update <?= $banner['banner_name']; ?></h1> 
            </div>
        </div>
        <div class="col-lg-12">
            <form action="<?= base_url('admin/banner/updates'); ?>" name="bannerForm" method="POST" role="form" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <button type="submit" class="btn btn-primary">Update Banner</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='<?= base_url('admin/banner'); ?>'">Cancel</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
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
                                            } 
                                        ?>
                                        <p class="help-block"><strong>Recomended Size: <?= $this->width .'px' .' * ' .$this->height .'px'; ?></strong></p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class='form-group'>
                                    <label for="name_section">Status</label><br />
                                    <input type="radio" name="flag" value="1" <?php echo($banner['flag']==1)?"checked":""; ?> /><label><span class="green-flag"></span>Active</label><br />
                        <input type="radio" name="flag" value="2" <?php echo($banner['flag']==2)?"checked":""; ?> /><label><span class="red-flag"></span>Inactive</label><br />
                        <input type="radio" name="flag" value="3" <?php echo($banner['flag']==3)?"checked":""; ?> /><label><span class="black-flag"></span>Delete</label>
                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea id="moxEditors" class="ckeditor" name="description_banner"><?= $banner['banner_description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-heading text-left">
                                    <h1>Additional Image</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-right">
                                    <button onclick="location.href ='<?= base_url('admin/banner_additional/add/' .$banner['banner_id']); ?>'" type="button" class="btn btn-primary">Add Additional Banner</button>
                                </div>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 10%;">No</th>
                                                <th class="text-center" style="width: 30%;">Banner Name</th>
                                                <th class="text-center" style="width: 40%;">Banner Image</th>
                                                <th class="text-center" style="width: 20%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($banner_additional as $row => $value){
                                            ?>
                                                <tr class="<?= ($value['unique_id'] %2)?'even':'odd'; ?>">
                                                    <td class="hidden"><?php echo $row['banner_additional_id'] ?></td>
                                                    <td><?= $row+1 ?></td>
                                                    <td><?= $value['banner_additional_name']; ?></td>
                                                    <td class="text-center"><img src="<?= base_url('assets/images/banner/additional/thumbs/' .$value['banner_additional_image']); ?>" /></td>
                                                    
                                                    <td class="text-center"><button class="btn btn-primary" onclick="location.href='<?= base_url('admin/' .$this->url .'_additional' .'/view/' .$value['banner_additional_id']); ?>'" type="button">View</button><button class="btn btn-danger confirmation" type="button" onclick="deleteItem(<?= $value['banner_additional_id']; ?>)">Delete</button></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
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
    function deleteItem(id) {

       if(confirm('Are you sure to delete this item?'))
       {
            window.location.href = "<?= base_url(),'admin/' .$this->url .'/delete_additional/' ?>" +id;
       }
       else
       {
        
       }
    }
</script>
<script type="text/javascript">
	//CKEDITOR.replace( '#moxEditors', {} );
    var objEditor = CKEDITOR.instances['#moxEditors'];
    q = objEditor.getData();
</script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>