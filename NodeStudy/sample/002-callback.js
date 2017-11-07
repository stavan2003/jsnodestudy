/**
 * Created by stavan.shah on 10/2/2017.
 */

// Callback is a function that calls back or invokes another function
// after having finished running

var list = [1, 2, 4, 5, 6, 7];

function callback(argList){
  var newList = [];
  for(var i=0; i<argList.length; i++){
    if (argList[i]<5){
      newList.push(argList[i]);
    }
  }
  console.log('--------------');
  return newList;
}

function filter(list, callback){
  console.log('Calling a callback');
  return callback(list);
}

var filtered = filter(list, callback);
console.log('Start');
console.log(filtered);
console.log('Done');

