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
                <div class="panel-heading text-right"></div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 15%;">Date</th>
                                <th class="text-center" style="width: 20%;">Database Name</th>
                                <th class="text-center" style="width: 20%;">Name Rows</th>
                                <th class="text-center" style="width: 15%;">Log Action</th>
                                <th class="text-center" style="width: 20%;">Log Description</th>
                                <th class="text-center" style="width: 10%;">Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($log as $row => $value){ 
                            ?>
                                <tr class="<?= ($value['log_id'] %2)?'even':'odd'; ?>">
                                    <td><?= date('d F Y', strtotime($value['log_date'])); ?></td>
                                    <td><?= $value['log_db']; ?></td>
                                    <td><?= $value['log_name']; ?></td>
                                    <td><?= $value['log_action']; ?></td>
                                    <td><?= $value['log_desc']; ?></td>
                                    <td><?= $value['log_admin_id']; ?></td>
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
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>