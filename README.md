# Base
Library to convert integers to base62 strings, useful for shortURLs based on ID numbers in a database.

## Usage
### Install using composer...
	composer require "service-to/base"

### In a Laravel Controller
	Route::get('{shortcode}', function ($shortcode) {
		$base = new ServiceTo\Base();
		$article = new App\Article();
		return View::make("content")->withArticle($article->find($base->base2int($shortcode)));
	});

### In plain old PHP
	require_once("vendor/autoload.php");
	use ServiceTo\Base;

	function shorturl($url) {
		$myshortdomain = "http://short.long.urls.3.14159.xyz/";

		$base = new Base();
		$stmt = $pdo->prepare("INSERT INTO shorturls SET url=?");
		$stmt->bindValue(1, $url, PDO::PARAM_STR);
		$stmt->execute();

		return($myshortdomain . $base->int2base($stmt->lastInsertId()));
	}