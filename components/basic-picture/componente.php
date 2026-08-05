<?php
    $props= isset($props) ? $props : [];
    $image = isset($props['image']) ? $props['image'] : '';
    $title = isset($props['title']) ? $props['title'] : '';
    $priority = isset($props['priority']) ? $props['priority'] : false;
    $desktop = isset($props['desktop']) ? $props['desktop'] : 'medium';
    $tablet = isset($props['tablet']) ? $props['tablet'] : 'medium';
    $mobile = isset($props['mobile']) ? $props['mobile'] : 'thumbnail_mobile';
    
    if($image != '') {
        $pictureCode = '';
        if($image != '') {
            $mediaQuery = [];
            if($mobile != '') {
                $mediaQuery['(max-width:640px)'] = $mobile;
            }
            if($tablet != '') {
                $mediaQuery['(max-width:1024px)'] = $tablet;
            }
            $data = array(
                'lazy' => false,
                'priority' => $priority,
                'class' => !$priority ? 'lazy' : '',
                'type' => $desktop,
                'mediaQuery' => $mediaQuery
            );
            if($title != '') {
                $data['title'] = $title;
            }
            $pictureCode = $this->getPicture($image, $data);
        }
        echo $pictureCode;
    }    
?>