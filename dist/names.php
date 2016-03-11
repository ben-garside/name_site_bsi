<?php include('templates/header.php'); 
?>
<div class="container">
<div id="cloud">
    
</div>
</div>
<div class="footer"> <!-- Start the footer form -->
    <div class="container">
        <div class="foot-form">
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
                    <label class="sr-only" for="theme">Disabled select menu</label>
                    <select id="theme" class="form-control">
                        <option value="0">Please select the floor you would like to name...</option>
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
                        <button type="submit" onclick="setData()" class="btn btn-default">Submit Name</button>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row">
                <div class=" col-xs-4">
                    <div class="form-group">
                    <p class="form-control-static">Enter your name for a chance to win an iPad! (optional)</p>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="sr-only" for="username">Enter your name</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your name">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-xs-2">
                    <div class="form-group">
                        <button id="added" style="display: none;" type="submit" class="btn btn-success">Submitted! <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div>
    </div>
</div> <!-- END footer form -->

<!--Modal-->
<div class="modal fade custom" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">There was an error</h4>
      </div>
      <div class="modal-body">
        <p id="msg">This is the error!</p>
      </div>
    </div>
  </div>
</div>
<?php include('templates/footer.php'); ?>
<script src="js/names.js"></script>