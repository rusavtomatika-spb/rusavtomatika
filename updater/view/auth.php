<style>
    .wrapper{
        position: fixed;
        top:50%;
        left: 50%;
        font-size: 20px;
        width: 300px;
        padding: 10px 10px 5px 10px;
        box-sizing: border-box;
        margin: -75px auto auto -150px;
        background: #ff8080;
        text-align: center;
    }
    input, button{display: block;padding: 8px 10px;width: 100%;margin: 10px 0;}
</style>
<div class="wrapper">
<form method="post">
    <input type="hidden" name="action" value="auth"/>
    Updater password: <input type="password" name="password" value=""/>
    <button type="submit">Go</button>

</form>
</div>
