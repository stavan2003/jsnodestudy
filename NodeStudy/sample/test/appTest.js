/**
 * Created by stavan.shah on 9/30/2017.
 */

const assert = require('chai').assert;
const app = require('../app');

describe('App', function(){
  this.timeout(15000);
  it('App should return a string', function () {
      var result = app.fun1('hi','hello');
      assert.isString(result, "String not returned by the function");
    });

  function delayedMap(array, transform, callback) {
    setTimeout(function() {
      console.log('calling callback now after waiting for 5sec');
      callback(array.map(transform));
      console.log('call back execution complete');
    }, 5000);
  }

  it('eventually returns the results', function(done) {
    var input = [1, 2, 3];
    var transform = function(x) { return x * 2; };

    delayedMap(input, transform, function(result) {
      console.log('start assert');
      assert.deepEqual(result, [2, 4, 6]);
      console.log('end assert');
      done();
      console.log('move to next it');
    });
  });
  // it('App should return a number', function () {
  //   assert.isNumber(app(), "number not returned by the function");
  // });
  //
  // it('App should return an Array', function () {
  //   assert.isArray(app(), "Array not returned by the function");
  // });

});
/*

    // https://alisdair.mcdiarmid.org/simple-nodejs-tests-with-assert-and-mocha/
    // https://gist.github.com/soheilhy/867f76feea7cab4f8a84
    // describe creates a suite of test cases, and it implements a test case.
    // The first argument to it is an explanation of the test case, and the second parameter is the test case function to which
    // Mocha passes a done object.
    // done should be called whenever the test case is finished. Inside the test case function, you should implement your test.
    //
    //
    // If you want your asynchronous request to be completed before everything else happens,
    // you need to use the done parameter in your before request, and call it in the callback.

        before(function (done) {
          db.collection('user').remove({}, function (res) { done(); }); // It is now guaranteed to finish before 'it' starts.
        })

        it('test spec', function (done) {
        // execute test
        });

        after(function() {});

  // Mocha will then wait until done is called to start processing the following blocks.
 // Testing asynchronous code with Mocha could not be simpler! Simply invoke the callback when your test is complete.
 // By adding a callback (usually named done) to it(), Mocha will know that it should wait for this function to be called to complete the test.

         describe("Configuration setup", function () {
           it("loads local configuration default", function (done) {
             var config = require("../config")();
             config.mode.should.equal("local");
             done(); // tell mocha that we're done and it can process next test
           });
         });

    API Tests  : http://mherman.org/blog/2015/09/10/testing-node-js-with-mocha-and-chai/#.WdL92ltSypo

*/

