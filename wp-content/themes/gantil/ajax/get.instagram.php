<?php

require '../controllers/instagramController.php';

$insta = new instagramController();

$arr = $insta->getPosts();

//print_r($arr['data']);

foreach($arr['data'] as $post){
	if($post['id'] == $_GET['id']){
		$images = $insta->getCarousel($post['id'], $post);
	}
}

//print_r($images);
echo $images;
//echo $_GET['id'];
