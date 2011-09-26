
if (App.hasOwnProperty('isAdmin') && App.isAdmin === 1) {
    require(
        [
            "jquery", "jquery/jquery-ui.min",
            "plugins/iphone-style-checkboxes",
            'admin'
        ]
        , function() {    
            $(function() {
                Admin.Run();
            });
        }
    );
} else {
    require(
        [
            "jquery", "http://connect.facebook.net/en_US/all.js",
            "jquery/jquery-ui.min",
            "plugins/jquery.colorbox", "plugins/jquery.qtip.min", "plugins/jquery.bgiframe",
            'game/init', 'game/level', 'game/gamble', 'game/colorbox', 'game/pagination', 
            'game/shop', 'game/inventory', 'game/surface', 'game/asproxy', 'game/streamer', 'game/ui'
        ]
        , function($) {    
            $(function() {
                
                //console.log(game);
                
                //Game.Run();
        
                //console.log(Game.Modules.length);
                /*
                for (var i = 0; i < Game.Modules.length; i++) {
                    //console.log(Game.Modules[i]);
                    (function() {
                        
                        Game.Modules[i].call();
                    })();
                }
                */
                FB.Canvas.setSize({height: 720});
                FB.init({
                    appId  : App.FBID,
                    status : true, // check login status
                    cookie : true, // enable cookies to allow the server to access the session
                    xfbml  : true, // parse XFBML
                    channelUrl : 'http://fbtest.invictus.hu/channel.html', // channel.html file
                    oauth  : true // enable OAuth 2.0
                });        
                /*
                FB.login(function(response) {
                    FB.api('/me', function(response) {
                        console.log('me', response);
                        Game.Run();
                    });                      
                });
                */
                
                console.log(Game.Modules.length);
                for (var i = 0; i < Game.Modules.length; i++) {
                    //console.log(Game.Modules[i]);
                    (function() {
                        
                        Game.Modules[i].call();
                    })();
                }
                
                setTimeout(function() 
                {
                    $('#prepage').fadeOut(1000, function(){
                      
                        $('#content').fadeIn(800);
                    });
                    
                },3000);
            });
        }
    );
    
}

