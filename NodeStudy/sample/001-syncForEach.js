/**
 * Created by stavan.shah on 10/2/2017.
 */


var fruits = ['apple', 'bannana', 'mango'];

function callback(x){
  console.log(x);
}

fruits.forEach(callback);

console.log('Done');

// Worker which calls back to its manager once its task is complete

function query(arg){
  var result = 0;
  console.log('inside query');
  return result;
}

function businessLogic(){
  console.log('inside businessLogic');
  var response = query(10);
  console.log('response :' + response);
}

businessLogic();

/* Sync Execution -
 inside businessLogic
 inside query
 response :0

Lets take complex example of query taking more time - refer to 003-callback.js
 */