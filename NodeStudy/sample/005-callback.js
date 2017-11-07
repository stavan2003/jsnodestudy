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
    cb(result); // ---> Worker which calls back to its manager once its task is complete
  }, 3000);
  return result;
}

function businessLogic(){
  console.log('inside businessLogic');
  var response = query(10, function callback(data){
    console.log('response real :' + data);
  });
  console.log('response :' + response);
}

// function businessLogic(){
//   console.log('inside businessLogic');
//   var response = query(10, (data) => { ----> Alternative notation
//     console.log('response real :' + data);
//   });
//   console.log('response :' + response);
// }


businessLogic();
console.log('Done');

/*

We do not want to write separate callbacks for wach business logic. i.e. we do not want to keep callback separate from the business logic.
So we bind them together using annonymous functions.

 inside businessLogic
 inside query
 response :0
 Done
 Processing the DB Call and return after 3 sec
 Timeout executed
 response real :-10

 */

/*

 Testing asynchronous code with Mocha could not be simpler! Simply invoke the callback when your test is complete.
 By adding a callback (usually named done) to it(), Mocha will know that it should wait for this function to be called to complete the test.

describe("Configuration setup", function () {
  it("loads local configuration default", function (done) {
    var config = require("../config")();
    config.mode.should.equal("local");
    done(); // tell mocha that we're done and it can process next test
  });
});

*/