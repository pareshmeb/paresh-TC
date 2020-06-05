<?php
require_once('database/rb.php');
 R::setup( 'sqlite:database/dbfile.db' );
/*$post = R::dispense( 'post' );
    $post->title = 'My holiday';
    $id = R::store( $post );*/
 $bottles = R::find( 'post');
 foreach( $bottles as $b ) {
    echo "* #{$b->title}: {$b->title}<br />";
    }
echo '<html><head><body>Hi I am here</body></head></html>';


