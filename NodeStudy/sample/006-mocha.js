// Testing async code with Mocha using callbacks and promises
//
// Testing async code with Mocha using callbacks is pretty straight forward, all you need to do is pass the done function
// down the callback chain and ensure it is executed after your last assertion:

describe('sample tests:', function() {
  it('callback', function(done) {
    http.get('http://www.example.com', function(res) {
      assert.equal(200, res.statusCode);
      done();
    });
  });
});

//   Let’s try this same test but using promises instead. First we have to wrap the http.get() call inside a promise:

var http = require('http');

var httpRequest = {
    get: url => {
    return (new Promise(function(resolve, reject) {
      http.get(url, res => {
        resolve(res);
    });
    }));
}
};

module.exports = httpRequest;

//   And then we would write our test in a very similar way as we wrote the one with the callback:
var reqp = require('../request-promise');

describe('sample tests:', function() {
  it('promise', function(done) {
    reqp.get('http://www.example.com/').then(function(res) {
      assert.equal(200, res.statusCode);
      done();
    })
  });
});

//   So far the test should pass and everything is great, but what would happen if we try to hit a non existing url?
//  Let’s change the url we’re passing to the module’s get() to something we know will return a 404 error, and the test should fail:
//   Wait, what? We were expecting it to fail but we also did expect a more meaningful message comparing the expected status code
//  and the actual one we received from the server, instead we got that timeout error that’s just too generic to be of any help.
//  Error of timeout 2000s exceeded
//   The problem was that I assumed working with promises in Mocha would follow a similar approach to working with callbacks,
//    but the right way is actually a bit different and, in my opinion, more elegant.
//    Instead of passing and calling the done() callback to the promise’s resolve method we only need to return the promise and Mocha’s api will take care of the rest.
//
var reqp = require('../request-promise');

describe('sample tests:', function() {
  it('promise correct', function() {
    return reqp.get('http://www.example.com/404').then(function(res) {
      assert.equal(200, res.statusCode);
    })
  });
});


//   If we run this test now, we’ll get a much more helpful failure report:
//
//   As more libraries convert their APIs to work with promises instead of callbacks , your tests will most likely need to reflect these changes. I hope this post saves you a bit of head scratching trying to figure out why what seems like the most intuitive way is not working as expected.