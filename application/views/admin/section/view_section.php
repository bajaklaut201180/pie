<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title;  ?></h1> 
        </div>
        <div class="col-lg-8">
            <div class="col-lg-12">
                <h3>PERSONAL INFORMATION</h3><br />
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2" for="inputEmail1">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputEmail1" placeholder="Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="inputPassword1">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputPassword1" placeholder="Password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="TextArea">Textarea</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="TextArea"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>First name</label>
                            <input type="text" class="form-control" placeholder="First" />
                        </div>
                        <div class="col-sm-3">
                            <label>Last name</label>
                            <input type="text" class="form-control" placeholder="Last" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Phone number</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" placeholder="000" />
                            <div class="help">area</div>
                        </div>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" placeholder="000" />
                            <div class="help">local</div>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="1111" />
                            <div class="help">number</div>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="123" />
                            <div class="help">ext</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1">Options</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="Option 1" />
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="Option 2" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <h3>FLAG</h3><br /> 
            <form>
                <div class="radio">
                    <label><input type="radio" name="flag" /><strong>Active</strong></label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="flag" /><strong>Inactive</strong></label>
                </div>
                <div class="radio disabled">
                    <label><input type="radio" name="flag" disabled="" /><strong>Delete</strong></label>
                </div>
            </form>
        </div>
    </div>
</div>