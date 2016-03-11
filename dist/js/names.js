	words = [
	  {text: "sdvc", weight: 13},
	  {text: "Ipsdcasdcsum", weight: 10.5},
	  {text: "asdcasdc", weight: 9.4},
	  {text: "Sit", weight: 8},
	  {text: "Amet", weight: 6.2},
	  {text: "Consectetur", weight: 5},
	  {text: "Adipiscing", weight: 5}

	];



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
		console.log(e)
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
		setTimeout(function() { $( '#errorModal' ).modal('hide'); }, 1000);
	}
}

function reset()
{
	$( '#theme' ).val(0)
	$( '#name' ).val('')
	$( '#username' ).val('')
}

function flashAdded()
{
	$( '#added' ).fadeIn()
	updateCloud()
	setTimeout(function() { $( '#added' ).fadeOut(); }, 1000);
}


function updateCloud(){
	$( '#cloud' ).jQCloud('update', words);
}

function buildCloud()
{

	var height = $( document ).height() - 300;

	var myWords = [
	  {text: "Lorem", weight: 13},
	  {text: "Ipsum", weight: 10.5},
	  {text: "Dolor", weight: 9.4},
	  {text: "Sit", weight: 8},
	  {text: "Amet", weight: 6.2},
	  {text: "Consectetur", weight: 5},
	  {text: "Adipiscing", weight: 5}
	]

	$( '#cloud' ).jQCloud(myWords,{
		height: height,
		delay: 100,
		fontSize: {
    		from: 0.1,
    		to: 0.02
    	}
	});

}

(function(){
	buildCloud()
})();

