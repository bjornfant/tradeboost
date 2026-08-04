<?php
// Use this namespace
use Steampixel\Route;
require_once(DIR_SYSTEM . 'route.php');
require_once(DIR_SYSTEM . 'database.php');

// Define a global basepath
define('BASEPATH','/');
// If your script lives in a subfolder you can use the following example
// Do not forget to edit the basepath in .htaccess if you are on apache
// define('BASEPATH','/api/v1');


Route::add('/', function() {
  include BASE_DIR . '/controller/index.php';
});

Route::add('/index.php', function() {
  include BASE_DIR . '/controller/index.php';
});


// Route with regexp parameter
// Be aware that (.*) will match / (slash) too. For example: /user/foo/bar/edit
// Also users could inject SQL statements or other untrusted data if you use (.*)
// You should better use a saver expression like /user/([0-9]*)/edit or /user/([A-Za-z]*)/edit
Route::add('/product/([A-Za-z0-9\-\_]+)/([A-Za-z0-9\-\_]+)', function($product_id,$product_name) {
  include BASE_DIR . '/controller/product.php';
});
Route::add('/product/([A-Za-z0-9\-\_]+)', function($product_id) {
  include BASE_DIR . '/controller/product.php';
});


Route::add('/shop/([A-Za-z0-9\-\_]+)/([A-Za-z0-9\-\_]+)', function($shop_id,$shop_name) {
  include BASE_DIR . '/controller/shop.php';
});
Route::add('/shop/([A-Za-z0-9\-\_]+)', function($shop_id) {
  include BASE_DIR . '/controller/shop.php';
});



Route::add('/manufacturer/([A-Za-z0-9\-\_]+)', function($manufacturer_id) {
  include BASE_DIR . '/controller/manufacturer.php';
});



Route::add('/group/([A-Za-z0-9\-\_]+)', function($product_group_url) {
  include BASE_DIR . '/controller/product_group.php';
});



Route::add('/price_realtime/silver', function() {
  $metal = "SI";
  include BASE_DIR . '/controller/commodity_price.php';
});
Route::add('/price_realtime/gold', function() {
  $metal = "AU";
  include BASE_DIR . '/controller/commodity_price.php';
});



Route::add('/products/goldbars', function() {
  $product_type = "bar";
  $metal = "AU";
  include BASE_DIR . '/controller/product_list.php';
});

Route::add('/products/silverbars', function() {
  $product_type = "bar";
  $metal = "SI";
  include BASE_DIR . '/controller/product_list.php';
});

Route::add('/products/goldcoins', function() {
  $product_type = "coin";
  $metal = "AU";
  include BASE_DIR . '/controller/product_list.php';
});

Route::add('/products/silvercoins', function() {
  $product_type = "coin";
  $metal = "SI";
  include BASE_DIR . '/controller/product_list.php';
});

Route::add('/products', function() {
  include BASE_DIR . '/controller/product_list.php';
});

Route::add('/about', function() {
  include BASE_DIR . '/controller/about.php';
});

Route::add('/css/base.css', function() {
  header('Content-Type: text/css');
  include BASE_DIR . '/view/css/base.css';
});

Route::add('/sitemap', function() {
  include BASE_DIR . '/controller/feeds/sitemap.php';
});
Route::add('/job/([A-Za-z0-9\-\_]+)', function($job_name) {
  include BASE_DIR . '/controller/jobs/job.php';
});


// Add a 404 not found route
Route::pathNotFound(function($path) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 404 Not Found');
  include BASE_DIR . '/controller/404.php';
});

// Add a 405 method not allowed route
Route::methodNotAllowed(function($path, $method) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 405 Method Not Allowed');
  echo 'Error 405 <br>';
  echo 'The requested path "'.$path.'" exists. But the request method "'.$method.'" is not allowed on this path!';
});

/*
// Get route example
Route::add('/contact-form', function() {
  navi();
  echo '<form method="post"><input type="text" name="test"><input type="submit" value="send"></form>';
}, 'get');

// Post route example
Route::add('/contact-form', function() {
  navi();
  echo 'Hey! The form has been sent:<br>';
  print_r($_POST);
}, 'post');

// Get and Post route example
Route::add('/get-post-sample', function() {
  navi();
  echo 'You can GET this page and also POST this form back to it';
  echo '<form method="post"><input type="text" name="input"><input type="submit" value="send"></form>';
  if (isset($_POST['input'])) {
    echo 'I also received a POST with this data:<br>';
    print_r($_POST);
  }
}, ['get','post']);


// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/foo/([0-9]*)/bar', function($var1) {
  navi();
  echo $var1.' is a great number!';
});

// Crazy route with parameters
Route::add('/(.*)/(.*)/(.*)/(.*)', function($var1,$var2,$var3,$var4) {
  navi();
  echo 'This is the first match: '.$var1.' / '.$var2.' / '.$var3.' / '.$var4.'<br>';
});

// Long route example
// By default this route gets never triggered because the route before matches too
Route::add('/foo/bar/foo/bar', function() {
  echo 'This is the second match (This route should only work in multi match mode) <br>';
});

// Trailing slash example
Route::add('/aTrailingSlashDoesNotMatter', function() {
  navi();
  echo 'a trailing slash does not matter<br>';
});

// Case example
Route::add('/theCaseDoesNotMatter',function() {
  navi();
  echo 'the case does not matter<br>';
});

// 405 test
Route::add('/this-route-is-defined', function() {
  navi();
  echo 'You need to patch this route to see this content';
}, 'patch');
*/






// Run the Router with the given Basepath
Route::run(BASEPATH);

// Enable case sensitive mode, trailing slashes and multi match mode by setting the params to true
// Route::run(BASEPATH, true, true, true);
