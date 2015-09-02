$(function () {
	$( '.ask-filter li' ).click( function () {
		var index = $( this ).index();
		$( this ).addClass( 'cur' ).siblings().removeClass( 'cur' );
		$( '.list-filter' ).hide().eq( index ).show();
	} );
});