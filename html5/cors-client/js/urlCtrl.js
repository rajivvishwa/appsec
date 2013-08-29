function urlCtrl($scope) {
	$scope.urls = [
		{"urlId":"local",
		 "urlIs":"../cors-server/test.json",
		 "status":"Allowed"},
		{"urlId":"ricardohbin.com",
		 "urlIs":"http://ricardohbin.com/cors/testcors.php",
		 "status":"Allowed"},
		{"urlId":"twitter",
		 "urlIs":"http://api.twitter.com/help/test.json",
		 "status":"Not Allowed"}
	];
}	