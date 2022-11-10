function closetabs(ids) {
	var x = ids;
	y = x.split(",");

	for(var i = 0; i < y.length; i++) {
	//console.log(y[i]);
	document.getElementById(y[i]).style.display = 'none';
	document.getElementById("id"+y[i]).classList.remove('nav-tab-active');
	}
}

function newtab(id) {
	var x = id;
	console.log(x);
	document.getElementById(x).style.display = 'block';
	document.getElementById("id"+x).classList.add('nav-tab-active');
	document.getElementById('hidden_tab_value').value=x;
}

(function( $ ) {
    'use strict';
    $( function() {
        $('.cf7pp-stripe-connect-notice').on('click', '.notice-dismiss', function(event, el){
            var $notice = $(this).parent('.notice.is-dismissible');
            var dismiss_url = $notice.attr('data-dismiss-url');
            if (dismiss_url) {
                $.get(dismiss_url);
            }
        });
    });
})(jQuery);