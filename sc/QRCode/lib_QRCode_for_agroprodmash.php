<?php
if (isset($_GET['qr'])) {
    handleQRCode($_GET['qr']);
}

function handleQRCode($qr_code) {
    ?>
    <style>
        .popGreetings_wrapper{
    width: 100%;
    min-height: 100%;
    background-color: rgba(0,0,0,0.5);
    overflow: hidden;
    position: fixed;
    top: 0px;
    z-index: 100;
        }
    #popGreetings{
width: 100%;
    position: absolute;
    height: 100%;
    display: block;
    min-height: 100%;
    min-width: 100%;
    z-index: 200;
    }
    .qr_innter{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    height: 600px;
    width: 600px;
    background: white;
    border-radius: 20px;
    box-shadow: rgba(0,0,0,0.5) 10px 10px;
    z-index: 500;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    }
    .popGreetings_wrapper-close{
        height: 100%;
    width: 100%;
    position: absolute;
    cursor: pointer;
    }
    .qr_cancel{
    height: 50px;
    width: 50px;
    position: absolute;
    right: 25px;
    top: 25px;
    cursor: pointer;
    }
    @media only screen and (max-width: 650px){
        .qr_innter{
    position: relative;
    top: auto;
    left: auto;
    margin: 25px;
    transform: translateY(0);
    height: 600px;
    width: auto;
    border-radius: 10px;
    box-shadow: rgba(0,0,0,0.5) 10px 10px           
        }
        
    }
       
    </style>
    <div class="popGreetings_wrapper" style="display: none"><div  id="popGreetings"></div></div>
    <div id="height"></div>
    <script>
        $(document).ready(function () {
            $.ajax({
                type: "POST",
                url: "/ajax/greetings_newYear2019.php",
                data: "qr=<?= $qr_code ?>",
                success: function (html) {
                    if (html != "") {
                        $("#popGreetings").html(html);
                           $(".popGreetings_wrapper").show('fast');
                           $(".popGreetings_wrapper-close").click(function() {
                           $(".popGreetings_wrapper").hide(700)});
                
               
                        $(".qr_cancel").click(function() {
                           $(".popGreetings_wrapper").hide(700)});
                       
                    }

                }
            });
        });
    </script>

<? } ?>






