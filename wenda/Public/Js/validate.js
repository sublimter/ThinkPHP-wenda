var validate = {
	account : false,
	username : false,
	pwd : false,
	pwded : false,
	verify : false,
	loginAccount : false,
	loginPwd : false
};

var msg = '';
$(function () {
	//点击更换验证码
	$( '#verify-img' ).click( function () {
		$(this).attr('src',CONTROL+'verify/'+Math.random());
	} );

	var register = $( 'form[name=register]' );

	register.submit( function () {
		var isOK = validate.account && validate.username && validate.pwd && validate.pwded && verify;

		if ( isOK ) {
			return true;
		}

		$( 'input[name=account]', register ).trigger('blur');
		$( 'input[name=username]', register ).trigger('blur');
		$( 'input[name=pwd]', register ).trigger('blur');
		$( 'input[name=pwded]', register ).trigger('blur');
		$( 'input[name=verify]', register ).trigger('blur');
		return false;
	} );

	//验证帐号
	$( 'input[name=account]', register ).blur( function () {
		var account = $( this ).val();
		var span = $( this ).next();

		if ( account == '' ) {
			msg = '帐号不能为空';
			span.html( msg ).addClass('error');
			validate.account = false;
			return;
		}

		if ( !/^[a-zA-Z]\w{6,19}$/g.test(account) ) {
			msg = '帐号以字母开头7-20位的字母，数字，下划线';
			span.html( msg ).addClass('error');
			validate.account = false;
			return;
		}

		$.post(CONTROL + 'checkAccount', {account : account}, function (status) {
			if (status) {
				msg = '';
				span.html( msg ).removeClass('error');
				validate.account = true;
			} else {
				msg = '帐号已存在';
				span.html( msg ).addClass('error');
				validate.account = false;
			}
		}, 'json');
	} );

	//验证用户名
	$( 'input[name=username]', register ).blur( function () {
		var username = $( this ).val();
		var span = $( this ).next();

		if ( username == '' ) {
			msg = '用户名不能为空';
			span.html( msg ).addClass('error');
			validate.username = false;
			return;
		}

		if ( !/^[\u4e00-\u9fa5|\w]{2,14}$/g.test(username) ) {
			msg = '必须是2-14个字符：字母，数字，下划线或中文';
			span.html( msg ).addClass('error');
			validate.username = false;
			return;
		}

		$.post(CONTROL + 'checkUsername', {username : username}, function (status) {
			if (status) {
				msg = '';
				span.html( msg ).removeClass('error');
				validate.username = true;
			} else {
				msg = '用户名已存在';
				span.html( msg ).addClass('error');
				validate.username = false;
			}
		}, 'json');
	} );

	//验证密码
	$( 'input[name=pwd]', register ).blur( function () {
		var pwd = $( this ).val();
		var span = $( this ).next();

		if ( pwd == '' ) {
			msg = '密码不能为空';
			span.html( msg ).addClass('error');
			validate.pwd = false;
			return;
		}

		if ( !/^\w{6,20}$/g.test(pwd) ) {
			msg = '密码必须由6-20个字母，数字，下划线组成';
			span.html( msg ).addClass('error');
			validate.pwd = false;
			return;
		}

		msg = '';
		validate.pwd = true;
		span.html( msg ).removeClass('error');
	} );

	//确认密码
	$( 'input[name=pwded]', register ).blur( function () {
		var pwded = $( this ).val();
		var span = $( this ).next();

		if ( pwded == '' ) {
			msg = '请确认密码';
			span.html( msg ).addClass('error');
			validate.pwded = false;
			return;
		}

		if ( pwded != $( 'input[name=pwd]', register ).val() ) {
			msg = '两次密码不一致';
			span.html( msg ).addClass('error');
			validate.pwded = false;
			return;
		}

		msg = '';
		span.html( msg ).removeClass('error');
		validate.pwded = true;
	} );

	//验证码
	$( 'input[name=verify]', register ).blur( function () {
		var verify = $( this ).val();
		var span = $( this ).next().next();

		if ( verify == '' ) {
			msg = '请输入验证码';
			span.html( msg ).addClass('error');
			validate.verify = false;
			return;
		}

		$.post(CONTROL + 'checkVerify', {verify : verify}, function (status) {
			if (status) {
				msg = '';
				span.html( msg ).removeClass('error');
				validate.verify = true;
			} else {
				msg = '验证码错误';
				span.html( msg ).addClass('error');
				validate.verify = false;
			}
		}, 'json');

	} );

	var login = $( 'form[name=login]' );

	login.submit( function () {
		if (validate.loginAccount && validate.loginPwd) {
			return true;
		}

		$( 'input[name=account]', login ).trigger('blur');
		$( 'input[name=pwd]', login ).trigger('blur');
		return false;

	} );

	$( 'input[name=account]', login ).blur( function () {
		var account = $( this ).val();
		var span = $( '#login-msg' );

		if (account == '') {
			span.html( '请填入帐号' );
			validate.loginAccount = false;
			return;
		}

	} );

	$( 'input[name=pwd]', login ).blur( function () {
		var account = $( 'input[name=account]', login ).val();
		var pwd = $( this ).val();
		var span = $( '#login-msg' );

		if (pwd == '') {
			span.html( '请填写密码' );
			validate.loginPwd = false;
			return;
		}

		if (account == '') {
			span.html( '请填入帐号' );
			validate.loginAccount = false;
			return;
		}

		var data = {
			account : account,
			password : pwd
		};

		$.post(CONTROL + 'checkLogin', data, function (status) {
			if (status) {
				span.html( '' );
				validate.loginAccount = true;
				validate.loginPwd = true;
			} else {
				span.html( '帐号或密码不正确' );
				validate.loginAccount = false;
				validate.loginPwd = false;
			}
		}, 'json');

	} );

});