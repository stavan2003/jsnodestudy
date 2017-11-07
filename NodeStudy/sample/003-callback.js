/**
 * Created by stavan.shah on 10/2/2017.
 */
// Worker which calls back to its manager once its task is complete

function query(arg){
  var result = 0;
  console.log('inside query');
  //REST call or DB Query - say it takes 3 seconds to execute
  setTimeout(function(){
    console.log('Processing the DB Call and return after 3 sec');
    result = arg * -1;
    console.log('Timeout executed');
  }, 3000);
  return result;
}

function businessLogic(){
  console.log('inside businessLogic');
  var response = query(10);
  console.log('response :' + response);
}

businessLogic();
console.log('Done');

/*
 inside businessLogic
 inside query
 response :0
 Done
 Processing the DB Call and return after 3 sec
 Timeout executed

 However the DB call was supposed to take the 'arg' and manipulate in some way which is not done.
 Goto 004-callback.js
 */