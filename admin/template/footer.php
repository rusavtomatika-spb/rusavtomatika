<script> 
//console.log(params);
	
            $(document).ready(function() { 
                $("#search,#brands").on("keyup", function() { 
                    var value = $(this).val().toLowerCase(); 
                    $("#list tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                }); 
            }); 
            $(document).ready(function() { 
				let params = (window.location.search);
                $("#brands,#types,#series").change(function() { 
                    var value = $(this).val().toLowerCase(); 
                    var el_id = this.id; 
//                    $("#list tr").filter(function() { 
//                        $(this).toggle($(this).text() 
//                        .toLowerCase().indexOf(value) > -1) 
//                    }); 
					//let allDots = await (fetch(window.location.search));
					//alert(allDots);
					window.location.href = 'https://www.rusavto.moisait.net/admin?'+el_id+'='+value;
                }); 
            }); 
	  function clearSearch() {
    document.getElementById('search').value = '';
  }
$(document).ready(function(){   
    $("input[type=text]").change(function() {
           $(this).css("background","#E7FFD9");
    });
});
        </script>
<? if (!defined('admin')) exit; ?>
</div>
</body>

</html>