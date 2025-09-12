<style>
    .wrapper{
        position: fixed;
        top:50%;
        left: 50%;
        font-size: 25px;
        width: 300px;
        padding: 20px 10px 20px 10px;
        box-sizing: border-box;
        margin: -75px auto auto -150px;
        background: #ff8080;
        text-align: center;
    }
    input, button{display: block;padding: 8px 10px;width: 100%;margin: 10px 0;}
</style>
<div class="wrapper">
    <b>Wrong password!</b><br>

    <a href='<? echo ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>'>Try again</a>
    <br>
</div>
