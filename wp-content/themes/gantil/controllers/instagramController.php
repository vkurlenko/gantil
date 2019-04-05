<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.10.2018
 * Time: 12:49
 */

class instagramController
{
    public $client_id    = 'fe77a006d8214fd2b5361b87853d4ae5';
    public $access_token = '262976242.54da896.f70ae59f103f43cc86c43f33c6f47ee9';//'8501086899.fe77a00.167faac7e8fd4c94971e5be0942db113';
    public $user_id      = '262976242'; // Цифры идущие до первой точки в ACCESS_TOKEN
    public $count = 100;

    /**
     * получим все посты аккаунта в виде массива
     */
    public function getPosts()
    {
        $filename = 'https://api.instagram.com/v1/users/' . $this->user_id . '/media/recent/?client_id=' . $this->client_id . '&access_token=' . $this->access_token . '&count='.$this->count;
//echo $filename; die;
        $res = file_get_contents($filename);

        //echo $res; die;

        $res = json_decode($res, true);

        printArray($res);

        return $res;
    }

    /**
     * получим код скрытого div с каруселью картинок или видео плеером
     * $row - массив данных поста
     */
    public function getPostMedia($row)
    {
        $media = '';

        if(is_array($row['carousel_media']))
            $media = self::getCarousel($row);
        elseif(is_array($row['videos']))
            $media = self::getVideo($row);

        return $media;
    }

    /**
     * получим карусель поста
     * $row - массив данных поста
     */
    public function getCarousel($row)
    {
        $carousel = '<div style="display:none">';

        foreach($row['carousel_media'] as $k => $image){
            if( $k == 0 )
                continue;

            $carousel .=  ' <a class="grouped_elements" rel="group_'.$row['id'].'" href="' . $image['images']['standard_resolution']['url'] . '">
                            <img src="' . $image['images']['thumbnail']['url'] . '" />
                        </a>';
        }

        $carousel .= '</div>';

        $carousel .= '<i class="fa fa-clone" aria-hidden="true"></i>';

        return $carousel;
    }

    /**
     * получим видео поста
     * $row - массив данных поста
     */
    public function getVideo($row)
    {
        $video = '<div style="display:none">';

        $poster = $row['images']['standard_resolution']['url'];

        $video .=  ' <div id="video_'.$row['id'].'">
                        <video src="' . $row['videos']['standard_resolution']['url'] . '" controls poster="'.$poster.'" width="100%"></video>
                    </div>';

        $video .= '</div>';

        $video .= '<i class="fa fa-video-camera" aria-hidden="true"></i>';

        return $video;
    }

    /**
     * получим код вывода поста
     * $post - массив данных поста
     */
    public function getPost($post)
    {
        $html = '';

        if(is_array($post['videos']))
            $href = '#video_' . $post['id'];
        else
            $href = $post['images']['standard_resolution']['url'];

        $html .= '  <a class="grouped_elements" rel="group_'.$post['id'].'" href="' . $href . '" >
                        <img src="' . $post['images']['low_resolution']['url'] . '">
                        <div class="over"></div>
                    </a>';

        return $html;
    }

    /**
     * получим код вывода кол-ва лайков и комментов поста
     * $post - массив данных поста
     */
    public function getPostInfo($post)
    {
        $html = '';

        $html .= '
            <a href="'.$post['link'].'" target=_blank><i class="fa fa-instagram fa-2x"></i></a>
            <span><i class="fa fa-heart-o "></i>&nbsp;'.$post['likes']['count'].'
            &nbsp;&nbsp;
            <i class="fa fa-comment-o "></i>&nbsp;'.$post['comments']['count'].'</span>';

        return $html;
    }
}