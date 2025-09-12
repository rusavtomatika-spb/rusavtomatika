
<div id='backup_call' class="panel has-background-white">
    <div class="panel-heading">
        Заказ звонка
    </div>
    <div class="p-4">
        <div id=backup_call_h> </div>
        <div id='backup_call_body'> </div>
        <div class='my-5 backup_call_block_phoneNumber'>
            <input type='text' class='input phoneNumber' name='phone' placeholder="+79998887766" />
        </div>
        <div id='backup_call_message'> </div>
        <div class="my-2 is-flex is-justify-content-center">
            <span class='zakazbut btn_send button is-success' onclick='backup_call_go()'>Звонок</span>  &nbsp &nbsp<span class='zakazbut btn_close button is-info' onclick='backup_call_hide()'>Закрыть</span>
        </div>
    </div>
</div>

<style>
    #backup_call {
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        border-radius: 6px;
        border: 1px solid #dcdcdc;
        padding: 0;
        margin: -5px 0 0;
        display: none;
        position: fixed;
        z-index: 1012;
        left: 0px;
        top: 0px;
        width: 400px;
    }


    #mes_backgr {
        position: absolute;
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 0px;
        z-index: 1011;
        display: none;
        background: black;
        padding: 0px;
    }
    @media(max-width: 480px){
        #backup_call {
            width: 300px;
        }

    }
</style>
