<?php
//echo 'test';

class Designer
{
	
	// все записи дизайнеров
	public function getAll($sort_by_rating = false) {

		$a = array();

		if ($sort_by_rating) {
			$arr_rating = array('rating5', 'rating4', 'rating3','rating2', 'rating1');

			foreach ($arr_rating as $rating) {
				$param = array(
		            'posts_per_page' => 1000,
		            'post_type' => ST_Designers::POST_TYPE,
		            'orderby'   => 'rand',  
		            'order'     => 'DESC',
		            'tax_query' => array(                
		                array(
		                    'taxonomy' => ST_Designers::CATEGORY_TAXONOMY_SLUG,
		                    'field'    => 'slug',                    
		                    'terms'    => $rating //  рейтинг
		                )         
		            ),    
		        );

				$a = array_merge($a, get_posts($param)); 
			}
		}
		else {
			$param = array(
	            'posts_per_page' => 1000,
	            'post_type' => ST_Designers::POST_TYPE,
	            'orderby'   => 'rand',  
	            'order'     => 'DESC',
	            /*'tax_query' => array(                
	                array(
	                    'taxonomy' => ST_Designers::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',                    
	                    'terms'    => 'rating5, rating4, rating3' //  специальность
	                )         
	            ), */   
	        );

			$a = get_posts($param); 
		}	 

		//printArray($a);

		return $a;
	}

	public function getOne($id = null) {

		$arr = [];

		if( $id ) {
			
		}

		return $arr;

	}

	// получим thumb записи
	public function getThumb($id = null, $alt = null) {
		if ($id) {			
            $thumbnail = get_the_post_thumbnail( $id, array(460, 460), array('alt' => $alt) );
		}
		else
			$thumbnail = '';

		return $thumbnail;
	}

	// получим изображение имиджа, если оно есть
	// id - ID записи
	// alt - alt картинки
	public function getImage($id = null, $alt = null) 
	{
		if ($id) {
			$value = get_field( "image_img", $id);

			if ($value) {
				$src = wp_get_attachment_image( $value['id'], array(400, 400) );
				return $src;
			}
			else
				return false;
		}
		else
			return false;
		
        //printArray($value);
	}

	// сформируем массив дизайнеров
	public function getDesigners($sort_by_rating = false, $sort_dir = 'DESC') {
		
		$arr = [];
		$rating_parent_cat = 510; //id родительской категории Рейтинг дизайнера 

		foreach( $this->getAll(true) as $k => $v) {

			$cats = get_the_terms( $v->ID , ST_Designers::CATEGORY_TAXONOMY_SLUG);
			$rating = '';
			foreach ($cats as $cat) {
				if ($cat->parent == $rating_parent_cat) {
					$rating = $cat->name;
				}
			}

			$arr[] = [
				'id'	=> $v->ID,
				'name'  => $v->post_title,
				'url'	=> $v->post_name,				
				'thumb' => $this->getThumb($v->ID, $v->post_title),
				'rating'=> $rating    
			];
		}

		if($sort_by_rating){
		   $arr = sortDesigners($arr, $sort_dir);
        }

		return $arr;
	}


	public function sortDesigners($arr, $sort_dir = 'DESC'){

        $arr_sort = [];

        if($sort_dir == 'DESC'){
            for($i = 5; $i > 0; $i--){
                foreach($arr as $k => $v){
                    if($v['rating']['slug'] == 'rating'.$i)
                        $arr_sort[] = $v;
                }
            }
        }
        else
        {
            for($i = 1; $i < 6; $i++){
                foreach($arr as $k => $v){
                    if($v['rating']['slug'] == 'rating'.$i)
                        $arr_sort[] = $v;
                }
            }
        }


        $arr = $arr_sort;

        //printArray($arr);

	    return $arr;
    }

	public function getRating($id = null){

		if ($id) {			
			$rating_parent_cat = 510;
			$cats = get_the_terms( $id , ST_Designers::CATEGORY_TAXONOMY_SLUG);
			$rating = '';

			foreach ($cats as $cat) {
				if ($cat->parent == $rating_parent_cat) {
					$rating = ['slug' => $cat->slug, 'name' => $cat->name];
				}
			}
		}

		return $rating;
	}

}

