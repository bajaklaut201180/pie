<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title; ?> List</h1> </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <?php
                    $this->load->view('admin/template/add.php');
                ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="moxTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%;">No</th>
                                <th class="text-center" style="width: 20%;">Section Name</th>
                                <th class="text-center" style="width: 40%;">Section Parent</th>
                                <th class="text-center" style="width: 10%;">Flag</th>
                                <th class="text-center" style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($section as $row => $value){ 
                            ?>
                                <tr class="<?= ($value['unique_id'] %2)?'even':'odd'; ?>">
                                    <td><?= $row+1 ?></td>
                                    <td><?= $value['section_name']; ?></td>
                                    <td><?= $value['section_parent']; ?></td>
                                    <td class="text-center"><span class="<?= ($value['flag']==1)?'green-flag':'red-flag'; ?>"></span></td>
                                    <td class="text-center"><button class="btn btn-primary" onclick="location.href='<?= base_url('admin/' .$this->url .'/view/' .$value['section_id']); ?>'">View</button><button class="btn btn-danger confirmation" onclick="deleteItem(<?= $value['section_id']; ?>)">Delete</button></td>
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

<script type="text/javascript">
    function deleteItem(id) {

       if(confirm('Are you sure to delete this item?'))
       {
            window.location.href = "<?= base_url(),'admin/' .$this->url .'/delete/' ?>" +id;
       }
       else
       {
        
       }
    }
</script>
<script>
    $(document).ready(function() {
        $('#moxTable').DataTable({
            responsive: true
        });
    });
</script>