$(function () {

	//头部定位边线
	$( window ).scroll( function () {
		if ( $( this ).scrollTop() > 0 ) {
			$( '#top-fixed' ).addClass( 'fixed' );
		} else {
			$( '#top-fixed' ).removeClass( 'fixed' );
		}
	} );

	//搜索按钮
	$( '.sech-btn' ).hover( function () {
		$( this ).addClass( 'sech-btn-cur' );
	}, function () {
		$( this ).removeClass('sech-btn-cur');
	} );

	$('.ask-btn').hover( function () {
		$( this ).addClass( 'ask-btn-cur' );
	}, function (){
		$( this ).removeClass( 'ask-btn-cur' );
	} );


	//注册出弹框
	$( '.register' ).click( function () {
		var obj = $( '#register' );
		dialog( obj );

		obj.find( 'input[type=submit]' ).hover( function () {
			$( this ).addClass( 'reg-btn-cur' );
		}, function () {
			$( this ).removeClass( 'reg-btn-cur' );
		} );

		return false;
	} );

	$( '#login-now' ).click( function () {
		$( '#register' ).fadeOut();
		dialog( $( '#login' ) );

		return false;
	} );


	//登录弹出框
	$( '.login' ).click( function () {
		var obj = $( '#login' );
		dialog( obj );

		obj.find( 'input[type=submit]' ).hover( function () {
			$( this ).addClass( 'login-btn-cur' );
		}, function () {
			$( this ).removeClass( 'login-btn-cur' );
		} );

		return false;
	} );

	$( '#regis-now' ).click( function () {
		$( '#login' ).fadeOut();
		dialog( $( '#register' ) );

		return false;
	} );


	//关闭弹出框
	$( '.close-window' ).click( function () {
		$( this ).parent().parent().fadeOut();
		$( '#background' ).fadeOut();

		return false;
	} );


	//问题分类下拉
	$( '.ask-cate' ).hover( function () {
		$( this ).find('ul').show();
	}, function () {
		$( this ).find('ul').hide();
	} );


});


/**********函数**********/

/**
 * 弹出框
 */
function dialog (obj) {
	obj.css( {
		left : ( $( window ).width() - obj.width() ) / 2,
		top : $( document ).scrollTop() + ( $( window ).height() - obj.height() ) / 2
	} ).fadeIn();

	$( '#background' ).css( {
		opacity : 0.3,
    	filter : 'Alpha(Opacity = 30)',
		'height' : $( document ).height()
	} ).show();
}