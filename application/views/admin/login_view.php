<div class="vertical-center">
    <div class="container">
        <div class="form-login">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>LOGIN</strong></h3>
                </div> 
                <div class="panel-body">
                    <form method="POST" action="<?= base_url('admin/login/validate'); ?>">
                        <div class="form-group">
                            <input id="username" class="form-control" type="text" name="username" placeholder="<?php echo (form_error('username'))? strip_tags(form_error('username')): 'input username ...'; ?>" />
                        </div>
                        <div class="form-group form-relative">
                            <input id="password" class="form-control" type="password" name="password" placeholder="<?php echo (form_error('password')) ? strip_tags(form_error('password')): 'input password ...'; ?>" />
                            <i onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" class="fa fa-eye" aria-hidden="true"></i>
                            
                        </div>
                        <div class="form-group text-right">
                            <input class="btn btn-default" type="submit" name="submit" value="SUBMIT" />
                        </div>
                    </form>
                    <?php 
                        if(isset($this->session->userdata()['check_login'])){
                    ?>
                        <div id="errorMessage" class="alert alert-danger" role="alert"> 
                            <?= $this->session->userdata()['check_login']['message']; ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="panel-footer">
                    <p class="text-right">
                        <strong>Deliver Pie</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    InvalidInputHelper(document.getElementById("username"), {
      defaultText: "Please enter an username!",
    
      emptyText: "Please enter an username!",
    
      invalidText: function (input) {
        return 'The username "' + input.value + '" is invalid!';
      }
    });
</script>
<script type="text/javascript">
    function mouseoverPass(obj) {
        var obj = document.getElementById('password');
        obj.type = "text";
    }
    function mouseoutPass(obj) {
        var obj = document.getElementById('password');
        obj.type = "password";
    }
</script>
<script type="text/javascript">
    var errMess = document.getElementById('errorMessage')
    if(errMess){
        setTimeout(function(){
            $('#errorMessage').hide('slow'); 
        }, 1500);
    }
</script>