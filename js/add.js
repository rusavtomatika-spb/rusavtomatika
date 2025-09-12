
 $(document).ready(function(){

$("#add").click(function(event){

 var el=event.target.id;

 var o1 =  $("#add"); 

	//show_compare1(o1);
	read_cookie_compare();
	call_compare_php('', '', '', '');
	//alert(mod);
}); 
  
});

/*
function show_compare1(o)
{

var coit=$(o).attr('idm');   // model passed
$("#add-text").html("");

var mo=jQuery.inArray( coit, compare );
if( mo >-1) $("#add-text").html("така€ модель уже есть в списке");

else
 {
  if(compare.length<compare_list_max  )
  {
   compare.push(coit);
   write_cookie_compare();
   postponed_mod=""; 
    $("#add-text").html(coit+" успешно добавлена в ¬аш список сравнени€");
$("#add").attr('idm','');
setTimeout( function() {$("#add-text").html('');}, 2000);
setTimeout( function() {if (compare.length==compare_list_max) {out();};}, 2000);
  }
  else
  {
  postponed_mod= coit;
   $("#add-text").html("¬ списке может быть максимум "+compare_list_max+ " продукта. „тобы добавить "+coit+" удалите любой продукт из списка");
  }
  //alert(postponed_mod); 
 }

}
*/


var act  = '';
  var act_m  = '';
  

  
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
		  
 this.element.siblings('.hint').css({'display':'none'});
 
 var name = this.element.siblings('.hint').text();
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
		  .attr( "placeholder", "выберите "+name+"Е" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
       //   .attr( "title", "ќткрыть список" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
		
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " не найдено" )
          .tooltip( "open" );
		   $(this).siblings('.hint').css({'display':''});
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
	
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();

      }
    });
  })( jQuery );
  
  $(document).ready(function(){
  $(function() {
    $( "#combobox" ).combobox();
	    $( "#type" ).combobox();
		    $( "#diagonal" ).combobox();

  });
  
  $('body').on('mouseleave', '.custom-combobox', function() {
  
  if ($(this).prev('select').val() != '') {


    } else {
if ($('.ui-autocomplete:visible').size() == 0) {

  };
  };
  
  
  });
$('body').on('mouseleave', '.ui-autocomplete', function() {


});

$('body').on('click', '.ui-corner-all', function() {
com('0');

});
  
    $(".body").on("keydown","input", function(e) {
 if (e.keyCode == 13) {
com('0');

  };
  });  

$('body').on('click', '#plusik', function() {


com('1');


});


$('body').on('click', '.page.href', function() {
var page = $('.page').index(this);
list(page);
$('.page').addClass('href');
$(this).removeClass('href');
});

$('body').on('click', '#closebut', function() {
$('#compare_head #show-to-add').hide();
var scr = $('#compare_head').position().top;
$('body').scrollTop(scr);
});

    });

comblock = 0;	


	
function com(full) {
if (comblock != 1) {
comblock = 1;
$('body').css('cursor','progress');
var type = $('select#type').val();
var diagonal = $('select#diagonal').val();

if (type != '') {

var all = "type="+type+"&diagonal="+diagonal+"&full="+full;


 $.ajax({
 type: "POST",
 url: "/ajax/com.php",
 data: all,

success: function(html) {
if (full == 1) {
$('#show-to-add').html(html);
 $('#show-to-add').css({'display':''});
} else {
$('#dobavlenie').html('&nbsp;&nbsp;('+html+')');
};
comblock = 0;
$('body').css('cursor','auto');
bind_recalc_valute();

 },
error: 
function(html) {
$('#show-to-add').html(html);
 $('#show-to-add').css({'display':''});
comblock = 0;
$('body').css('cursor','auto');
 }
 });
 } else {
 $('#show-to-add').html('¬ыберите тип устройства');
 $('#show-to-add').css({'display':''});
 comblock = 0;
 $('body').css('cursor','auto');
 };
};
}

function list(page) {

var cou = $('.localpage').size();

for (var i = 0; i < cou; i++) {

if (i == page) {
q = i;
setTimeout( function() {
$('.localpage').eq(q).fadeIn(300);
if ($('.localpage').eq(q).children('.line').size() > 5) {$('#pagescontain').css({'height':'370'});} else {$('#pagescontain').css({'height':'185'});};
}, 10);

} else {

$('.localpage').eq(i).fadeOut(300);
};

}


/*


if ((i < p*10) && (i >= p*10-10)) {
$('div.line').eq(i).fadeIn(300);


} else {$('div.line').eq(i).fadeOut(300);};


*/
}	

function show_compare1(o)
{
//alert("compare");
var x=$(o).position().left;
var y=$(o).position().top;
$("#compare").css('left', x);
$("#compare").css('top', y);
$("#compare span.com-block").replaceWith("<span class='zakazbut' onclick='reloa()'>—равнить</span>");
var coit=$(o).attr('idm');   // model passed
$("#compare_message").html("");

var mo=jQuery.inArray( coit, compare );
if( mo >-1) $("#compare_message").html("така€ модель уже есть в списке");

else
 {
  if(compare.length<compare_list_max  )
  {
   compare.push(coit);
   write_cookie_compare();
   postponed_mod=""; 
    $("#compare_message").html(coit+" успешно добавлена в ¬аш список сравнени€");

  }
  else
  {
  postponed_mod= coit;
   $("#compare_message").html("¬ списке может быть максимум "+compare_list_max+ " продукта. „тобы добавить "+coit+" удалите любой продукт из списка");
  }
  //alert(postponed_mod); 
 }
$("#compare_body").html(print_compare());
$("#compare").show();
}
