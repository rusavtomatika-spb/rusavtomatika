<?php


namespace abacus\admin\classes;


use abacus\admin\classes\Config;

class Auth
{
    public static function show_panel()
    {
        ?>
        <form>
            <div class="box">
                Name <input type="text" value="" id="auth_name" placeholder="ololosha">
                Password <input type="password" value="" id="auth_password">
                <button type="submit" class="button" id="button_login">Log in</button>
            </div>
        </form>
        <script>
            document.querySelector("#button_login").onclick = function () {
                document.cookie = "admin=" + document.getElementById("auth_name").value +
                    '@' + document.getElementById("auth_password").value +
                    ';path=/; max-age=2678400;secure;samesite'
            }
        </script>
        <?php
    }

    public static function check_user()
    {

        $success = false;
        if (isset($_COOKIE["admin"]) and $_COOKIE["admin"] != "") {
            $admin = explode("@", $_COOKIE["admin"]);
            if (is_array($admin) and isset($admin[0]) and isset($admin[1])) {
                if (isset(Config::$users[$admin[0]])) {
                    if (Config::$users[$admin[0]] == $admin[1]) {
                        $success = true;
                    } else {
                        $admin[1] = md5($admin[1]);
                        if (Config::$users[$admin[0]] == $admin[1]) {
                            $success = true;
                            setcookie('admin',
                                $admin[0] . '@' . $admin[1],
                                time() + (86400 * 30),
                                "/","",true);
                        }
                    }
                }
            }
            return $success;
        }
    }
}