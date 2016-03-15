<?php include('templates/header.php'); 

if(Cookie::exists('username')){
    $user =  Cookie::get('username');
    echo '<div style="display: none;" id="user_name">'.$user.'</div>';
}

?>
<div class="container lead-container">




<div style="display: none;" id="theme_id">0</div>
<div style="display: none; margin-top: 30%;" id="open">
<!-- <h1><span class="glyphicon glyphicon-hand-down gly-rotate-45" aria-hidden="true"></span> Select a theme!</h1> -->
<h1><span class="glyphicon glyphicon-hand-down gly-spin" aria-hidden="true"></span> Select a theme</h1>
</div>
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
                        <option value="0">Please select the theme/floor...</option>
                        <?php
                        $themes = Suggestion::getThemes();
                        foreach ($themes as $theme) {
                            echo '<option value="'.$theme->id.'">'.$theme->themeName.'</option>';    
                        }
                        ?>
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
                        <button type="submit" onclick="setData()" class="btn btn-default pull-right">Submit Name</button>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row">
                <div class=" col-xs-4">
                    <div class="form-group">
                    <button style="display: none;" type="submit" id="annon" onclick="giveName()" class="btn btn-danger  pull-right">I want to win a prize</button>
                    <button style="display: none;" type="submit" id="named" onclick="goAnnon()" class="btn btn-warning  pull-right">Go back to anonymity</button>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="sr-only" for="username">Enter your name</label>
                        <div class="input-group">
                            <input type="text" style="display: none;" class="form-control" id="username" placeholder="Enter your name" value="<?php echo $user; ?>">
                            <span class="input-group-btn">
                                <button style="display: none;" id="clearButton" class="btn btn-warning" onclick="clearName()" type="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </span>
                        </div>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-xs-2">
                    <div class="form-group">
                        <button id="added" style="display: none;" type="submit" class="btn btn-success pull-right">Submitted! <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div>
    </div>
</div> <!-- END footer form -->

<!--erro Modal-->
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- upvote Modal-->
<div class="modal fade custom" id="upvoteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Please confirm your upvote</h4>
      </div>
      <div class="modal-body">
        <p>You are about to upvote "<span id="msg"></span>".<br>Are you sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">No, cancel</button>
        <button type="button" id="updateButton" class="btn btn-default">Yes, upvote!</button>
      </div>
    </div>
  </div>
</div>

<?php include('templates/footer.php'); ?>
<script src="js/global.js"></script>
<script src="js/names.js"></script>