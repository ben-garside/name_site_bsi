<?php include('templates/header.php'); 
?>


    
<div class="footer"> <!-- Start the footer form -->
    <div class="container">
        <div class="foot-form">
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
                    <label class="sr-only" for="theme">Disabled select menu</label>
                    <select id="theme" class="form-control">
                        <option value="1">templatePlaceholder1</option>
                        <option value="2">templatePlaceholder2</option>
                        <option value="3">templatePlaceholder3</option>
                        <option value="4">templatePlaceholder4</option>
                        <option value="5">templatePlaceholder5</option>
                    </select>   
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="sr-only" for="name">Disabled select menu</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name suggestion here">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-xs-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Submit Name</button>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row">
                <div class=" col-xs-4">
                    <div class="form-group">
                    <label class="sr-only" for="annon">be anonymous?</label>
                    <input class="pull-left" id="annon" data-on-text="Enter anonymously" data-off-text="I am spartacus!" type="checkbox" name="my-checkbox" checked>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="sr-only" for="username">Enter your name</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your name" disabled>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div>
    </div>
</div> <!-- END footer form -->
<?php include('templates/footer.php'); ?>
<script src="js/names.js"></script>