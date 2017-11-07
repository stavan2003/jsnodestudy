
window.onload = function () {
    
/**
 * Callback hell. Call tweets --> friends --> videos in sequence
 * The errors are all over the place and the sucess calls as well. Refactor it in async3-callbackhell-improved.js
 * 
 */
    function handleError(jqXHR, textStatus, error){
        console.log(error);
    }

    $.ajax({
        method:"GET",
        url:"data/tweets.json",
        success:callbackTweets,
        error:handleError,
    })

    function callbackTweets(data){
        console.log(data);
        // once the tweets are received, fire another ajax request to get the friends
        $.ajax({
            method:"GET",
            url:"data/friends.json",
            success:callbackFriends,
            error:handleError,
        });
    }

    function callbackFriends(data){
        console.log(data);
        // once the friends are received, fire another ajax request to get the videos
        $.ajax({
            method:"GET",
            url:"data/videos.json",
            success:callbackVideos,
            error:handleError,
        })
    }

    function callbackVideos(data){
        // Process the videos finally in the thord callback
        console.log(data);
    }

}