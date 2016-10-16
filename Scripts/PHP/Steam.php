<?php
require("constants.php");

class SteamUser {
    /**
    * Steam User ID
    */
    public $UID;

    /**
    * Steam User login
    */
    public $login;

    /**
    * User's real name
    */
    public $name;

    /**
     * User's avatar
     */
    public $avatar;

    /**
    *Time they played
    */
    public $timetotal;

    private function call($interface,$method,$version, array $data = null)
    {
        $httpData = http_build_query($data);
        $options = ['http' =>
            [
                'method'    => 'POST',
                'header'    => 'Content-type: application/x-www-form-urlencoded',
                'content'   => $httpData
            ]
        ];
        $context = stream_context_create($options);
        $post = file_get_contents('http://api.steampowered.com/'.$interface.'/'.$method.'/'.$version.'/', false, $context);
        return $post;
    }

    public function GetPlayerSummaries($UID) {
        return $this->call("ISteamUser",__METHOD__,"v002", [
            'key' => APIKEY,
            'steamids' => $UID
        ]);
    }
//http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=XXXXXXXXXXXXXXXXXXXXXXX&steamids=76561197960435530
    
}