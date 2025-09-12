var cur_ind=0;
var list_length=0;
var mouseoutside=0;
var search_bgcolor="#efefef";
var search_bgcolor_sel="#cccccc";
var mouse_in_basket=0;
var mouse_in_basket_sm=0;

var search_textcolor="black";



$(document).ready( function() {


$("#tete").keyup( function(e){
//alert(e.keyCode);
if(e.keyCode!=40 && e.keyCode!=38 ) sch();
});

 $("body").mouseup(function(){ 
        if(mouseoutside==1) { $("#sho").html(""); $("#sho").hide(); }
        if(mouse_in_basket==0 && mouse_in_basket_sm==0) { $("#slided").slideUp("fast"); basket_opened=0;}
		
    });
	
	$("#slided").hover(
function(){
mouse_in_basket=1;
},
function(){
//if(mouse_in_basket_sm==1) return;
mouse_in_basket=0;
$("#slided").slideUp("fast");
 basket_opened=0;

});

$("#basket_small").hover(
function(){
mouse_in_basket_sm=1;
},
function(){
mouse_in_basket_sm=0;

});


}); //---end document ready



function se_click()
{
alert( $("#tete").val());
if( $("#tete").val()=="поиск...") $("#tete").val("");

}


function sch()  // search and make list
{ 
var ww=$("#tete").val();
var out="";

var i=0;
if(ww!="")
{
$.each(models, function() {

var str=this.toLowerCase();


if (str.indexOf(ww.toLowerCase() ) >= 0)
{
out+="<div class=sel id=sel"+i+">"+this+"</div>";
i++;
}

});

list_length=i;
if(out!="")
{
$("#sho").html(out );
$("#sho").show();
}
else
$("#sho").hide();
}
else  {
   $("#sho").html("");
   list_length=0;
   cur_ind=0;
   $("#sho").hide();
   }
   
//----bind hover ------   
$(".sel").hover(
function(){
   $(".sel").css('background-color', search_bgcolor);
   $(this).css('background-color', search_bgcolor_sel);
    var mod=$(this).html();
	$("#tete").val(mod);  // model name into search field
 
    mouseoutside=0; 
},
function(){
    mouseoutside=1;
}
);   


 
 
$(".sel").click(function(event){

 var el=event.target.id;
    // el2=el.substr(3);
	 
	 
	 
 var mod=$("#"+el).html();
 $("#tete").val(mod);
 $("#sho").html("");
 $("#sho").hide(); 

   // window.location="http://www.rusavtomatika.com?hhh="+mod;
	
	//alert(mod);
}); 
   
}//--------------end func sch -----




$(document).keyup(function(e) {
 if (e.keyCode == 40) {

 if(cur_ind<=list_length+1 && list_length>0 )
   {
     
	cur_ind++;
	
	 if(cur_ind<list_length+1)
	 {
	 $(".sel").css('background-color', search_bgcolor);
	 $("#sel"+(cur_ind-1)).css('background-color', search_bgcolor_sel);
	  var mod=$("#sel"+(cur_ind-1)).html();
	  $("#tete").val(mod);  // model name into search field
	 
	 }
	 $("#sst").html("id"+cur_ind);
	 
	 
   }
 
 }
   else if (e.keyCode == 38) {
         
		 if( cur_ind > 1 )
		 {
		 
		 cur_ind--;
		 
		 $(".sel").css('background-color', search_bgcolor);
		 $("#sel"+(cur_ind-1)).css('background-color', search_bgcolor_sel);
		 var mod=$("#sel"+(cur_ind-1)).html();
	     $("#tete").val(mod);  // model name into search field
		 
		$("#sst").html("id"+cur_ind);
		 
		 }
		 	 
        }
		
	  if(e.keyCode == 13 )
   {

    if($("#tete").is(':focus')) {gotosearch();return;}
	else
	return;
	
	var sea=$("#tete").val();
	if(sea=="") return;
	$("#sho").html("");
	$("#sho").hide(); 
	cur_ind=0;
	list_length=0; 
	window.location="/weintek/"+sea+".php";
	
	
   }  ;	


});


function gotosearch()
{
var sea=$("#tete").val();
if(sea=="") return;
var res="";
var path="";

$.each(models, function() {

// var str=this.toLowerCase();
 var str=this;
 if (str==sea)
  res=str; 
 });
 

 //str.indexOf(ww.toLowerCase() )
 if(res.indexOf("MT") >=0 ) path="/weintek/";
 if(res.indexOf("SK") >=0 ) path="/samkoon/";
 if(res.indexOf("IFC") >=0 ) path="/ifc/"; 
 if(res.indexOf("ARCH") >=0 ) path="/aplex/"; 
 
 

   // alert(path);
    if(res=="") return;
	$("#sho").html("");
	$("#sho").hide(); 
	cur_ind=0;
	list_length=0; 
	window.location=path+res+".php";

}


function ddd(){

$("#sel"+(cur_ind-1)).css('background-color', ' #ffffcc;');
alert("grey");
}