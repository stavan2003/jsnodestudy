
window.onload = function () {
    
/**
 * Callback hell. Call tweets --> friends --> videos in sequence
 * The errors are all over the place and the sucess calls as well. Refactor it in async3-callbackhell-improved.js
 * 
 */
    $.ajax({
        method:"GET",
        url:"data/tweets.json",
        success:function(data){
            console.log(data);
            // once the tweets are received, fire another ajax request to get the friends
            $.ajax({
                method:"GET",
                url:"data/friends.json",
                success:function(data){
                    console.log(data);
                    // once the friends are received, fire another ajax request to get the videos
                    $.ajax({
                        method:"GET",
                        url:"data/videos.json",
                        success:function(data){
                            console.log(data);
                        },
                        error:function(jqXHR, textStatus, error){
                            console.log(error);
                        },
                    })
                },
                error:function(jqXHR, textStatus, error){
                    console.log(error);
                },
            })
        },
        error:function(jqXHR, textStatus, error){
            console.log(error);
        },
    })

}