/*

 READY States :
 0 - Request not initialized
 1 - Request is setup
 2 - Request is sent
 3 - Request under process
 4 - Request is complete

 */

window.onload = function () {
  //Traditional
  //method :
  var http = new XMLHttpRequest();       //init - 0
  http.onreadystatechange = function () {  // under process - 3
    if (http.readyState == 4 && http.status == 200) { //complete - 4
      //console.log(JSON.parse(http.response));
    }
  }
  http.open("GET", "data/tweets.json", true); //setup - 1 true/false --> sync/async request
  http.send(); //2
  console.log("this is executed first and response shown afterwards for async requests");


  //Jquery method
  $.get("data/tweets.json", function (data) {
    // Jquery method go grab the tweets data, pass that to a new thread outside of this JS and then when the data is ready and
    // the thread comes back with the data --> fire the callback function with that data. We can then do something with the data.
    console.log(data);
  });

}

