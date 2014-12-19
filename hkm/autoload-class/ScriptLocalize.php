<?php
/**
 * Created by PhpStorm.
 * User: Hesk
 * Date: 13年12月16日
 * Time: 下午4:39
 */
if (!class_exists('ScriptLocalize')) {
    class ScriptLocalize
    {
        var $islogin_facebook = false;
        var $user_id = false;

        /**
         * $ curl ipinfo.io/8.8.8.8
         * {
         * "ip": "8.8.8.8",
         * "hostname": "google-public-dns-a.google.com",
         * "loc": "37.385999999999996,-122.0838",
         * "org": "AS15169 Google Inc.",
         * "city": "Mountain View",
         * "region": "CA",
         * "country": "US",
         * "phone": 650
         * }
         *
         * @jsexample
         * $.get("http://ipinfo.io", function(response) {
         * console.log(response.city);
         * }, "jsonp");
         *
         * @source http://stackoverflow.com/questions/409999/getting-the-location-from-an-ip-address
         *
         * echo $details->country; // -> "Mountain View"
         * @return mixed
         */
        function get_user_meta_info()
        {
            $ip = $_SERVER['REMOTE_ADDR'];
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
            return $details;
        }

        function facebookconfig()
        {
            $fb_access_token_dp = get_option('dp_fb_access_token');
            $facebook = new Facebook(AppConfig::GetKeyArray());
            $facebook->setAccessToken($fb_access_token_dp);
            $this->user_id = $facebook->getUser();
        }

        function render()
        {
            return array(
                "domain" => site_url(),
                "AppID" => AppConfig::GetAppId(),
                "languageCode" => "en_US",
                "fblogin" => $this->user_id
            );
        }
    }
}