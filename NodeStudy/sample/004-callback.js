/**
 * Created by stavan.shah on 10/2/2017.
 */
// Worker which calls back to its manager once its task is complete

function query(arg, cb){
  var result = 0;
  console.log('inside query');
  //REST call or DB Query - say it takes 3 seconds to execute
  setTimeout(function(){
    console.log('Processing the DB Call and return after 3 sec');
    result = arg * -1;
    console.log('Timeout executed');
    cb(result);
  }, 3000);
  return result;
}

function businessLogic(){
  console.log('inside businessLogic');
  var response = query(10, callback);
  console.log('response :' + response);
}

function callback(data){
  console.log('response real:' + data);
}

businessLogic();
console.log('Done');

/*

The manager function businessLogic needs to know when the response is complete
 inside businessLogic
 inside query
 response :0
 Done
 Processing the DB Call and return after 3 sec
 Timeout executed
 response real:-10

 However the DB call was supposed to take the 'arg' and manipulate in some way to return the new result.
 Here a function named "callback" is passed as an argument to the query function which calls it after its processing is complete.
 This function then returns the correct result. Can be better written using annonymous function in 005-callback.js

 */