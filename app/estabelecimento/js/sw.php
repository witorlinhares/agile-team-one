<?php
header("Content-type: application/javascript");
include('../../../_core/_includes/config.php');
$insubdominiourl = isset($_GET['$insubdominiourl']) ? mysqli_real_escape_string( $db_con, $_GET['insubdominiourl'] ) : '';

var_dump("Subdominio URL: ".$insubdominiourl);
?>

self.addEventListener('install', function(e) {
 e.waitUntil(
   caches.open('fox-store').then(function(cache) {
     return cache.addAll([
       '<?php echo $app['url']; ?>'
     ]);
   })
 );
});

self.addEventListener('fetch', function(e) {
  console.log(e.request.url);
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});
