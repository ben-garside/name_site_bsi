function getNames(qty, theme, callback){
    var json = {};
    $.ajax({
        url: 'php/api/names.cloud.php',
        dataType: 'json',
        data: {qty: qty, theme: theme},
    })
    .done(function( e ) {
        if( e.status.code == 200){
            $(e.results).each(function(index, el) {
                el.handlers = {click: function() {
                                        upvote(el.text);
                                        }}
            });
            callback(e.results);
        }
    })
    .fail(function( e ) {
        return false;
    });
}

function upvote(name){
    $( '#upvoteModal #msg' ).html(name)
    $( '#upvoteModal' ).modal()
    $( '#updateButton' ).click(function(event) {
        addName(name, $( '#theme' ).val(), '+1')
        $( '#upvoteModal' ).modal('hide')

    });

}

function setData()
{
    var theme = $( '#theme' ).val()
    var name  = $( '#name' ).val()
    var username = $( '#username' ).val()
    if(theme == 0)
    {
        $( '#theme' ).parent().effect( "shake", {direction:'left',distance:10,times:10}, 2000 )
        showError('Please select a floor to name!', true)
        return;
    }
    if(!name)
    {
        $( '#name' ).parent().effect( "shake", {direction:'left',distance:10,times:10}, 2000 )
        showError('You need to provide an idea!', true)
        return;
    }
    if($('#named').is(":visible") && !username){
        $( '#username' ).parent().effect( "shake", {direction:'left',distance:10,times:10}, 2000 )
        showError('You must provide your name if you want to win! <br><br>Or click \'Go back to anonymity\'.', true)
        return;
    }
    addName(name, theme, username)
}

function addName(name, theme, user)
{
    $.ajax({
        url: 'php/api/names.add.php',
        dataType: 'json',
        data: {name: name, theme: theme, user: user},
    })
    .done(function( e ) {
        if (e.status.code == 200) {
            console.log('added OK')
            reset()
            flashAdded()
        }
        if (e.status.code == 401) {
            console.log('ERROR : ' + e.status.message.type)
            switch(e.status.message.type) {
                case 'LOGIC':
                    showError(e.status.message.msg, true)
                    break;
                case 'DATABASE':
                    showError(e.status.message.msg, false)
                    break;
                case 'PROFANITY':
                    showError('OK, well not really an error but it looks like you have used some naughty words...</p><br><p><strong>' + e.status.message.msg.clean + '</strong></p><br><p>It has been sent for moderation.', false)
                    reset()
                    flashAdded()
                    break;
            }
        }
    })
    .fail(function( e ) {
        showError(e.status + " : " + e.statusText + " <br><br>Please try again.", false)
    });
    
    
}

function showError(msg, dis)
{
    $( '#errorModal #msg' ).html('<p>' + msg + '</p>')
    $( '#errorModal' ).modal()
    if(dis)
    {
        setTimeout(function() { $( '#errorModal' ).modal('hide'); }, 2000);
    }
}

function reset()
{
    $( '#name' ).val('')
}

function flashAdded()
{
    $( '#added' ).fadeIn()
    updateCloud()
    setTimeout(function() { $( '#added' ).fadeOut(); }, 1000);
}


function updateCloud(){
    getNames(100, $( '#theme_id' ).text(), function( e ){
        newWords = getWords(e)
        var z = $.grep(newWords, function(el){return $.inArray(el, base_words) == -1}); 
        console.log(z)
        if(z.length > 0) {
            $( z ).each(function(index, item) {
                var item = /(.*)(?:_[0-9]*)$/g.exec(item)[1];
                $( e ).each(function(index, el) {
                    if(el.text == item) {
                        el.html.class = 'newWord';
                    }
                });
            });
            base_words = newWords
            $( '#cloud' ).jQCloud('update', e);
        }
    });
}

function getWords(words)
{   
    var word_list = []
    $(words).each(function(index, el) {
        word_list.push(el.text+"_"+el.weight)
    });
    return word_list
}

function setBase(words)
{   
    base_words = getWords(words)
}


function buildCloud(theme_id)
{
    $('#cloud').jQCloud('destroy');
    var height = $( document ).height() - 300;
    getNames(100, theme_id, function( e ){
        setBase( e )
        $( '#cloud' ).jQCloud(e,{
        afterCloudRender: function(){
                                $( '.newWord' ).animate({
                                    color: "#fff"
                                }, 3000 );
                            },
        height: height,
        delay: 100,
        fontSize: {
            from: 0.1,
            to: 0.02
        }
        })
    });
}

function goAnnon(){
    $('#username').val('').hide()
    $('#clearButton').hide()
    checkUsername()
}

function giveName() {
    if($( '#user_name' ).text() != '') {
        $('#username').val($( '#user_name' ).text())
    }
    $('#username').show()
    $('#clearButton').show()
    $('#named').show();
    $('#annon').hide();
}

function clearName() {
    $('#username').val('')
    $('#clearButton').prop('disabled', true);
}

function setDropdown(val) {
    $( '#theme' ).val(val)
}

function checkUsername() {
    if( $('#username').val() != '' ) {
        $('#clearButton').prop('disabled', false);
        $('#named').show();
        $('#username').show()
        $('#clearButton').show()
        $('#annon').hide();
    } else {
        $('#named').hide();
        $('#annon').show();
    }
}

(function(){
    if(QueryString.id > 0){
        $( '#theme_id' ).text(QueryString.id)
        buildCloud($( '#theme_id' ).text())
        setDropdown($( '#theme_id' ).text())
        setInterval(updateCloud, 5000)
    } else {
        $( '#open' ).show();
    }

    $('#username').keyup(function(event) {
        checkUsername();
    });

    $( '#theme' ).change(function(event) {
        var new_theme = $( '#theme' ).val()
        if(new_theme > 0){
            $( '#open' ).hide();
            $( '#theme_id' ).text(new_theme)
            buildCloud(new_theme)
            window.history.pushState("object or string", "Title", "names.php?id=" + new_theme);
        } else {
            $('#cloud').jQCloud('destroy');
            $('#cloud').html('');
            $( '#cloud' ).height(0)
            $( '#open' ).show();
            window.history.pushState("object or string", "Title", "names.php");
        }
    });

    checkUsername()

})();

