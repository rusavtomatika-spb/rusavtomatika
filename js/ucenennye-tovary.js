var blockpass = 0;
var blocksender = 0;
var blocksend = 0;
var blockreg = 0;
var block = 0;

function check_text(element){

var text = $(element).val();
if (text == '') {$(element).addClass('noright');} else {$(element).removeClass('noright');};
}

function check_phone(element){

var phone = $(element).val();
myArray = phonecheck(phone);
if ((myArray == null) & (phone != '')) {$(element).addClass('noright');} else {$(element).removeClass('noright');
};
}

function phonecheck(phone) { //Связанная функция

myRe = /^([0-9\+\-\(\)\s]{0,})$/i;
myArray = myRe.exec(phone);

if (myArray != null) {
meRe1 = /[\+\-\(\)\s]/gi;
var mysrting = phone.replace(meRe1, '');

meRe2 = /^[0-9]{8,13}$/i;
myArray = meRe2.exec(mysrting);
};
return(myArray);
}

function check_email(element){

var email = $(element).val();
myArray1 = mailcheck(email);
if ((myArray1 == null) &(email != '')) {$(element).addClass('noright');} else {$(element).removeClass('noright');};
}

function mailcheck(email) { //Связанная функция
myRe = /(\w+)@([a-zA-Z0-9.-]+).([a-zA-Z0-9]+)/i;
myArray1 = myRe.exec(email);
return(myArray1);
}

function change_row(id, type='edit') {
if (id !="row-undefined") {
if (block != 1) {
block = 1;
var row = $('#row-'+id);
var name = $(row).find('input[name="name"]').val();	
var description = $(row).find('textarea').val();	
var price = $(row).find('input[name="price"]').val();
var count = $(row).find('input[name="count"]').val();	
var sys_name = $(row).find('.rotate').attr('sys_name');	
var id = id;

$.post( "/ajax/ucenennye-tovary-edit.php", {id:id, name:name, description:description, price:price, count:count, sys_name:sys_name, type:type  })
  .done(function(html) {
	  if (html == 'ok') {
		  if (type=='edit') {
	row_update(row,id,name,description,price,count,sys_name);
	  } else {
		  $(row).remove();
	  };
	  } else if (html.indexOf('added') > -1) {
		var  str_to_replace = "added-";
		var  srt_New = '';
		var  id_new = html.replace(str_to_replace, srt_New);
		
	row_update(row,id_new,name,description,price,count,sys_name);
	$(row).removeClass('newElement');
	$('#add').show();	
	  } else {
		alert(html);
	  };
	  block = 0;
  })
  .fail(function() {
    alert('Ошибка');
		block = 0;
  });	
};  
}
}


function row_update(row,id,name,description,price,count,sys_name) { //Связанная функция

	$(row).find('input[name="name"]').prev('div').show().empty();
	$(row).find('input[name="name"]').prev('div').html(name);	
	$(row).find('input[name="price"]').prev('div').show().empty();
	$(row).find('input[name="price"]').prev('div').html(price);	
	$(row).find('input[name="count"]').prev('div').show().empty();
	$(row).find('input[name="count"]').prev('div').html(count);	
	$(row).find('textarea').prev('div').show().empty();
	$(row).find('textarea').prev('div').html(description);		
	$(row).find('input, textarea').hide();
	$(row).attr({'id':'row-'+id});	 
	$(row).find('.rotate').attr({'data-id':id});	
	$(row).find('.rotate').attr({'sys_name':'sale-'+id}); 
	$(row).find('.finish').hide();	
	$('#row-'+id).find('.cancel').hide();		 	
	$('#row-'+id).find('.delete').hide();		
	$(row).find('.start').show();
	$(row).bind('click', '.start', function() {
		start(id);
	});
}


function start(id) {

	  $('#row-'+id).find('div').hide();
	  $('#row-'+id).find('input, textarea').show();
	  $('#row-'+id).find('input, textarea').prop("disabled", false);
	  $('#row-'+id).find('.star').hide();	  
	  $('#row-'+id).find('.finish').show();
	  $('#row-'+id).find('.cancel').show();	 	
	  $('#row-'+id).find('.delete').show();	 	  
	
}

$(document).ready(function() {
	
var manager_auth = $.cookie('llp');
	
if ($.cookie('llp')) {
	
	$.post( "/ajax/ucenennye-tovary-edit.php")
  .done(function(html) {
    $('#sale-content').empty();
	$('#sale-content').html(html);	
  })
  .fail(function() {
    alert('Ошибка');
  });
  
  
  $('body').on('click', '.start', function() {
	  
	  var id = $(this).parent('.rotate').attr('data-id');
	  start(id);
  });
  
   $('body').on('click', '.finish', function() {
	  
	  var id = $(this).parent('.rotate').attr('data-id');
	  change_row(id);
  }); 
  
    
 $('body').on('click', '.cancel', function() {
	  
	var id = $(this).parent('.rotate').attr('data-id');
	var row = $('#row-'+id); 
	$('#row-'+id).find('div').show();
	$(row).find('input, textarea').hide();
	$(row).find('.finish').hide();	
	$('#row-'+id).find('.cancel').hide();		 	
	$('#row-'+id).find('.delete').hide();		
	$(row).find('.start').show();	
			  
  });
  
 $('body').on('click', '.delete', function() {
	  
	  var id = $(this).parent('.rotate').attr('data-id');
		  change_row(id, 'delete');
  }); 
  
  $('body').on('click','#add', function() {
	  $(".sale tr:last-child").clone()              
		.addClass("newElement")       // изменим текст внутри нее
		.appendTo(".sale"); 
	$('.newElement').attr({'id':'row-0'});
	$('.newElement').find('.rotate').attr({'data-id':'0'});	
	$('.newElement').find('.rotate').attr({'sys_name':'new'});	 
	$('#add').hide();
	  $('.newElement').find('div').hide();
	  $('.newElement').find('input, textarea').show();
	  $('.newElement').find('input, textarea').prop("disabled", false);
	  $('.newElement').find('.star').hide();	  
	  $('.newElement').find('.finish').show();	 
	  $('.newElement').find('td:first-child').empty(); 
	  $('.newElement').find('td:first-child').text('new'); 	  
 	  //$('.newElement').find('.finish').bind('click', function() { 		  change_row('0'); 	  });	
  });
  
}	else {
	
	var auform = '<div class="back-form-container" id="enter" style="display: block;"><div id="float-containter"><div class="registration float" style="display: inherit;"><span class="h2"><span class="e-link">Войти</span><span class="active">Регистрация</span></span><div class="registration-content"><div class="note"></div> <form class="reg-form" method="post"> <input type="text" name="user" placeholder="Логин"> <input type="text" name="email" placeholder="E-mail"> <input type="password" name="pw" placeholder="Пароль"> <input type="submit" value="Зарегистрироваться">  </form> <div class="reg-after-note"></div> </div></div> <div class="enter float"><span class="h2"><span class="active">Войти</span><span class="r-link">Регистрация</span></span> <div class="enter-content"> <div class="note"></div> <form class="ent-form" method="post"> <input type="text" name="user" placeholder="Логин"> <input type="password" name="pw" placeholder="Пароль"> <input type="submit" value="Войти"> </form> <div class="ent-after-note"></div></div></div> <div class="lost float"><span class="h2"><span class="p-link">Изменить пароль</span><span class="active">Вспомнить логин</span></span><div class="lost-content"><div class="note"></div> <form class="lost-form" method="post"><input type="text" name="email" placeholder="E-mail"><input type="submit" value="Отправить"></form> <div class="lost-after-note"></div> </div></div><div class="pass float"><span class="h2"><span class="active">Изменить пароль</span><span class="l-link">Вспомнить логин</span></span><div class="pass-content"><div class="note"></div> <form class="pass-form" method="post"><input type="text" name="user" placeholder="Логин"><input type="submit" value="Отправить"></form> <div class="pass-after-note"></div> </div></div><div class="close"></div> </div></div>';
	
	$('#sale-content').html(auform);	
	
	$('body').on('click', '.r-link', function() {
	$('.enter.float').css({'display':''});
	$('.registration.float').css({'display':'inherit'});	
}); 

$('body').on('click', '.e-link', function() {
	$('.enter.float').css({'display':'inherit'});
	$('.registration.float').css({'display':''});	
}); 

$('body').on('click', '.l-link', function() {
	$('.lost.float').css({'display':'inherit'});
	$('.pass.float').css({'display':''});	
}); 

$('body').on('click', '.p-link', function() {
	$('.pass.float').css({'display':'inherit'});
	$('.lost.float').css({'display':''});	
}); 

$('body').on('click', '#lostlogin', function() {
	$(this).parents('.float').hide();
	$('.lost.float').show();		
});
	
$('body').on('click', '#forgotpass', function() {
	$(this).parents('.float').hide();
	$('.pass.float').show();		
});

$('body').on('click', 'a[href="#enter"]', function() {
into('#enter');
});

$('body').on('focusout','input[name="phone"]', function() { check_phone(this)});
$('body').on('focusout','input[name="email"]', function() { check_email(this)});
$('body').on('focusout','input[name="question"]', function() { check_text(this)});
$('body').on('focusout','input[name="name"]', function() { check_text(this)});
	
//Обработка форм регистрации и авторизации
$('body').on('submit', '.reg-form, .ent-form', function(e) {
e.preventDefault();	
var  block = 0;
var err = '';
var err1 = '';
var err2 = '';
var form = $(this);

var name = $(form).find('input[name="user"]').val();
var pass = $(form).find('input[name="pw"]').val();	

var es = $(form).children('input[name="email"]').size();

if (es > 0) {
var email = $(form).find('input[name="email"]').val();	

if ((email != '') && (email != 'undefined')) {myArray = mailcheck(email);if (myArray == null) {$(form).find('input[name="email"]').addClass('noright');block=1; err = 'e-mail';} else {block=0;$(form).find('input[name="email"]').removeClass('noright'); err='';};
} else {$(form).find('input[name="email"]').addClass('noright');block=1; err = 'e-mail';};
};

if ((email=='') || (email=='undefined')) {var t = 'login';} else {var t = 'reg';};

if ((pass=='') || (pass=='undefined')) {$(form).find('input[name="pw"]').addClass('noright');block=1; err1 = 'pass';} else { $(form).find('input[name="pw"]').removeClass('noright'); err1=''; };
if ((name=='') || (name=='undefined')) {$(form).find('input[name="user"]').addClass('noright');block=1; err2 = 'name';} else { $(form).find('input[name="user"]').removeClass('noright'); err2='';};

if ((err+err1+err2 == '') && (blockreg == 0)) {
	blockreg = 1;
 $.ajax({
	
 type: "POST",
 url: "/ajax/auth.php",
 data: "AUTH_USER="+name+"&AUTH_PW="+pass+"&EMAIL="+email+"&t="+t,

success: function(htmll) {

var pattern = '759_';
$(form).parents('.float').find('.note').empty();
if (htmll == '104') {
	$(form).parents('.float').find('.note').html('Забыли пароль? <span id="forgotpass">Изменить пароль</span>');	
}
else if ((htmll == '301') || (htmll == '302') ||  (htmll == '303') || (htmll == '450')) {
	$(form).parents('.float').find('.note').text('Возникла неполадка (№'+htmll+'). Попробуйте повторить позже.');	
}
else if ((htmll == '404')) {
	$(form).parents('.float').find('.note').html('Пользователь не найден. Забыли логин? <span id="lostlogin">Вспомнить&nbsp;логин</span> ');	
}
else if ((htmll == '606')) {
	$(form).parents('.float').find('.note').text('К сожалению, формат данных не распознан');	
}
else if ((htmll == '222')) {
	$(form).parents('.float').find('.note').text('Логин уже занят');	
}
else if ((htmll == '221')) {
	$(form).parents('.float').find('.note').text('Пользователь с email '+email+' уже зарегистрирован.');	
}
else if (htmll == '609') {
	
var    formData = "";
       cookieExp = new Date();                       
       cookieExp.setMonth(cookieExp.getMonth()-1);  
     document.cookie = 'llp='+formData+'; expires='+cookieExp.toGMTString()+'; path=/;';
	 
} 
else if (htmll.search(pattern) != -1 ) {
var hash = htmll.replace(pattern,'');	

       cookieExp = new Date();                      
       cookieExp.setMonth(cookieExp.getMonth()+1);  
     document.cookie = 'llp='+hash+'; expires='+cookieExp.toGMTString()+'; path=/;';
	   location.reload(true);
} else {
	
	$(form).parents('.float').find('.note').text('Ошибка '+htmll);	

};
blockreg = 0;
},
 error: function(){
	error_handling(form);
}

 });
} else {
if 	(err+err1+err2 != '') { var note = 'Заполните, пожалуйста все поля';};
$(form).parents('.float').find('.note').text(note);		
};
return false;	
});	
	

//Обработка форм восстановления пароля и напоминания логина
$('body').on('submit', '.pass-form, .lost-form', function(e) {
e.preventDefault();	

var err = '';
var err2 = '';
var form = $(this);

var name = $(form).find('input[name="user"]').val();

var es = $(form).children('input[name="email"]').size();

if (es > 0) {
var email = $(form).find('input[name="email"]').val();	

if ((email != '') && (email != 'undefined')) {myArray = mailcheck(email);if (myArray == null) {$(form).find('input[name="email"]').addClass('noright');blockpass=1; err = 'e-mail';} else {blockpass=0;$(form).find('input[name="email"]').removeClass('noright'); err='';};
} else {$(form).find('input[name="email"]').addClass('noright');blockpass=1; err = 'e-mail';};
};

if ((email=='') || (email=='undefined')) {var t = 'login';} else {var t = 'reg';};
if (es == 0) {
if ((name=='') || (name=='undefined')) {$(form).find('input[name="user"]').addClass('noright');blockpass=1; err2 = 'name';} else { $(form).find('input[name="user"]').removeClass('noright'); err2=''; blockpass=0; };
};
if (blockpass != 1) {
blockpass = 1;
 $.ajax({
	
 type: "POST",
 url: "/ajax/lost.php",
 data: "AUTH_USER="+name+"&EMAIL="+email+"&t="+t,
 
success: function(htmll) {

$(form).parents('.float').find('.note').empty();
if (htmll == '104') {
	$(form).parents('.float').find('.note').html('Забыли логин? <span class="l-link">Вспомнить логин</span>');	
}
else if (htmll == '105') {
	$(form).parents('.float').find('.note').html('Забыли e-mail? <span class="ask-help">Написать в тех.поддержку</span>');	
}
else if ((htmll == '301') || (htmll == '302') ||  (htmll == '303') ) {
	$(form).parents('.float').find('.note').text('Возникла неполадка (№'+htmll+'). Попробуйте повторить позже.');	
}
else if ((htmll == '606') || (htmll == '450')) {
	$(form).parents('.float').find('.note').text('К сожалению, формат данных не распознан.');	
}
else if ((htmll == '555')) {
	$(form).parents('.float').find('.note').text('Письмо для восстановления пароля выслано на Ваш e-mail.');	
}
else if ((htmll == '556')) {
	$(form).parents('.float').find('.note').text('Письмо с логином выслано на Ваш e-mail.');	
} else {
	$(form).parents('.float').find('.note').text(htmll);
	$(form).children('input').remove();	
};

 },
 error: function(){
	error_handling(form);
  }

 });
} else {
if 	(err+err2 != '') { var note = 'Заполните, пожалуйста все поля';};
$(form).parents('.float').find('.note').text(note);		
};
return false;	
});	
//	
};

	
});