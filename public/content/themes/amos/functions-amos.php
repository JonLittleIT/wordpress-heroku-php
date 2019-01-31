<?php
/*--------------------- Create Author Box ----------------------------------- */

function amos_author_box(){
  $output = '<dl class="author_box dl-horizontal">';
    $output .= '<dt>'.get_avatar(get_the_author_meta( 'ID' ), 64).'</dt>';
    $output .= '<dd>';
      $output .= '<h5>'.__('About', 'amos').' '.get_the_author().'</h5>';
      $output .= '<p>'.get_the_author_meta('description').'</p>';
    $output .= '</dd>';
  $output .= '</dl>';

  return $output;
}


add_filter( 'vc_iconpicker-type-amosicons', 'vc_iconpicker_type_amosicons' );



function  vc_iconpicker_type_amosicons($icons){

 
$icons= array(

      'linea' => array (

            array("linea-basic-accelerator" => "linea-basic-accelerator"),
            array("linea-basic-alarm" => "linea-basic-alarm"),
            array("linea-basic-anchor" => "linea-basic-anchor"),
            array("linea-basic-anticlockwise" => "linea-basic-anticlockwise"),
            array("linea-basic-archive" => "linea-basic-archive"),
            array("linea-basic-archive-full" => "linea-basic-archive-full"),
            array("linea-basic-ban" => "linea-basic-ban"),
            array("linea-basic-battery-charge" => "linea-basic-battery-charge"),
            array("linea-basic-battery-empty" => "linea-basic-battery-empty"),
            array("linea-basic-battery-full" => "linea-basic-battery-full"),
            array("linea-basic-battery-half" => "linea-basic-battery-half"),
            array("linea-basic-bolt" => "linea-basic-bolt"),
            array("linea-basic-book" => "linea-basic-book"),
            array("linea-basic-book-pen" => "linea-basic-book-pen"),
            array("linea-basic-book-pencil" => "linea-basic-book-pencil"),
            array("linea-basic-bookmark" => "linea-basic-bookmark"),
            array("linea-basic-calculator" => "linea-basic-calculator"),
            array("linea-basic-calendar" => "linea-basic-calendar"),
            array("linea-basic-cards-diamonds" => "linea-basic-cards-diamonds"),
            array("linea-basic-cards-hearts" => "linea-basic-cards-hearts"),
            array("linea-basic-case" => "linea-basic-case"),
            array("linea-basic-chronometer" => "linea-basic-chronometer"),
            array("linea-basic-clessidre" => "linea-basic-clessidre"),
            array("linea-basic-clock" => "linea-basic-clock"),
            array("linea-basic-clockwise" => "linea-basic-clockwise"),
            array("linea-basic-cloud" => "linea-basic-cloud"),
            array("linea-basic-clubs" => "linea-basic-clubs"),
            array("linea-basic-compass" => "linea-basic-compass"),
            array("linea-basic-cup" => "linea-basic-cup"),
            array("linea-basic-diamonds" => "linea-basic-diamonds"),
            array("linea-basic-display" => "linea-basic-display"),
            array("linea-basic-download" => "linea-basic-download"),
            array("linea-basic-exclamation" => "linea-basic-exclamation"),
            array("linea-basic-eye" => "linea-basic-eye"),
            array("linea-basic-eye-closed" => "linea-basic-eye-closed"),
            array("linea-basic-female" => "linea-basic-female"),
            array("linea-basic-flag1" => "linea-basic-flag1"),
            array("linea-basic-flag2" => "linea-basic-flag2"),
            array("linea-basic-floppydisk" => "linea-basic-floppydisk"),
            array("linea-basic-folder" => "linea-basic-folder"),
            array("linea-basic-folder-multiple" => "linea-basic-folder-multiple"),
            array("linea-basic-gear" => "linea-basic-gear"),
            array("linea-basic-geolocalize-01" => "linea-basic-geolocalize-01"),
            array("linea-basic-geolocalize-05" => "linea-basic-geolocalize-05"),
            array("linea-basic-globe" => "linea-basic-globe"),
            array("linea-basic-gunsight" => "linea-basic-gunsight"),
            array("linea-basic-hammer" => "linea-basic-hammer"),
            array("linea-basic-headset" => "linea-basic-headset"),
            array("linea-basic-heart" => "linea-basic-heart"),
            array("linea-basic-heart-broken" => "linea-basic-heart-broken"),
            array("linea-basic-helm" => "linea-basic-helm"),
            array("linea-basic-home" => "linea-basic-home"),
            array("linea-basic-info" => "linea-basic-info"),
            array("linea-basic-ipod" => "linea-basic-ipod"),
            array("linea-basic-joypad" => "linea-basic-joypad"),
            array("linea-basic-key" => "linea-basic-key"),
            array("linea-basic-keyboard" => "linea-basic-keyboard"),
            array("linea-basic-laptop" => "linea-basic-laptop"),
            array("linea-basic-life-buoy" => "linea-basic-life-buoy"),
            array("linea-basic-lightbulb" => "linea-basic-lightbulb"),
            array("linea-basic-link" => "linea-basic-link"),
            array("linea-basic-lock" => "linea-basic-lock"),
            array("linea-basic-lock-open" => "linea-basic-lock-open"),
            array("linea-basic-magic-mouse" => "linea-basic-magic-mouse"),
            array("linea-basic-magnifier" => "linea-basic-magnifier"),
            array("linea-basic-magnifier-minus" => "linea-basic-magnifier-minus"),
            array("linea-basic-magnifier-plus" => "linea-basic-magnifier-plus"),
            array("linea-basic-mail" => "linea-basic-mail"),
            array("linea-basic-mail-multiple" => "linea-basic-mail-multiple"),
            array("linea-basic-mail-open" => "linea-basic-mail-open"),
            array("linea-basic-mail-open-text" => "linea-basic-mail-open-text"),
            array("linea-basic-male" => "linea-basic-male"),
            array("linea-basic-map" => "linea-basic-map"),
            array("linea-basic-message" => "linea-basic-message"),
            array("linea-basic-message-multiple" => "linea-basic-message-multiple"),
            array("linea-basic-message-txt" => "linea-basic-message-txt"),
            array("linea-basic-mixer2" => "linea-basic-mixer2"),
            array("linea-basic-mouse" => "linea-basic-mouse"),
            array("linea-basic-notebook" => "linea-basic-notebook"),
            array("linea-basic-notebook-pen" => "linea-basic-notebook-pen"),
            array("linea-basic-notebook-pencil" => "linea-basic-notebook-pencil"),
            array("linea-basic-paperplane" => "linea-basic-paperplane"),
            array("linea-basic-pencil-ruler" => "linea-basic-pencil-ruler"),
            array("linea-basic-pencil-ruler-pen" => "linea-basic-pencil-ruler-pen"),
            array("linea-basic-photo" => "linea-basic-photo"),
            array("linea-basic-picture" => "linea-basic-picture"),
            array("linea-basic-picture-multiple" => "linea-basic-picture-multiple"),
            array("linea-basic-pin1" => "linea-basic-pin1"),
            array("linea-basic-pin2" => "linea-basic-pin2"),
            array("linea-basic-postcard" => "linea-basic-postcard"),
            array("linea-basic-postcard-multiple" => "linea-basic-postcard-multiple"),
            array("linea-basic-printer" => "linea-basic-printer"),
            array("linea-basic-question" => "linea-basic-question"),
            array("linea-basic-rss" => "linea-basic-rss"),
            array("linea-basic-server" => "linea-basic-server"),
            array("linea-basic-server2" => "linea-basic-server2"),
            array("linea-basic-server-cloud" => "linea-basic-server-cloud"),
            array("linea-basic-server-download" => "linea-basic-server-download"),
            array("linea-basic-server-upload" => "linea-basic-server-upload"),
            array("linea-basic-settings" => "linea-basic-settings"),
            array("linea-basic-share" => "linea-basic-share"),
            array("linea-basic-sheet" => "linea-basic-sheet"),
            array("linea-basic-sheet-multiple" => "linea-basic-sheet-multiple"),
            array("linea-basic-sheet-pen" => "linea-basic-sheet-pen"),
            array("linea-basic-sheet-pencil" => "linea-basic-sheet-pencil"),
            array("linea-basic-sheet-txt" => "linea-basic-sheet-txt"),
            array("linea-basic-signs" => "linea-basic-signs"),
            array("linea-basic-smartphone" => "linea-basic-smartphone"),
            array("linea-basic-spades" => "linea-basic-spades"),
            array("linea-basic-spread" => "linea-basic-spread"),
            array("linea-basic-spread-bookmark" => "linea-basic-spread-bookmark"),
            array("linea-basic-spread-text" => "linea-basic-spread-text"),
            array("linea-basic-spread-text-bookmark" => "linea-basic-spread-text-bookmark"),
            array("linea-basic-star" => "linea-basic-star"),
            array("linea-basic-tablet" => "linea-basic-tablet"),
            array("linea-basic-target" => "linea-basic-target"),
            array("linea-basic-todo" => "linea-basic-todo"),
            array("linea-basic-todo-pen" => "linea-basic-todo-pen"),
            array("linea-basic-todo-pencil" => "linea-basic-todo-pencil"),
            array("linea-basic-todo-txt" => "linea-basic-todo-txt"),
            array("linea-basic-todolist-pen" => "linea-basic-todolist-pen"),
            array("linea-basic-todolist-pencil" => "linea-basic-todolist-pencil"),
            array("linea-basic-trashcan" => "linea-basic-trashcan"),
            array("linea-basic-trashcan-full" => "linea-basic-trashcan-full"),
            array("linea-basic-trashcan-refresh" => "linea-basic-trashcan-refresh"),
            array("linea-basic-trashcan-remove" => "linea-basic-trashcan-remove"),
            array("linea-basic-upload" => "linea-basic-upload"),
            array("linea-basic-usb" => "linea-basic-usb"),
            array("linea-basic-video" => "linea-basic-video"),
            array("linea-basic-watch" => "linea-basic-watch"),
            array("linea-basic-webpage" => "linea-basic-webpage"),
            array("linea-basic-webpage-img-txt" => "linea-basic-webpage-img-txt"),
            array("linea-basic-webpage-multiple" => "linea-basic-webpage-multiple"),
            array("linea-basic-webpage-txt" => "linea-basic-webpage-txt"),
            array("linea-basic-world" => "linea-basic-world"),
            array("linea-arrows-anticlockwise" => "linea-arrows-anticlockwise"), 

            array("linea-arrows-anticlockwise-dashed" => "linea-arrows-anticlockwise-dashed"), 

            array("linea-arrows-button-down" => "linea-arrows-button-down"), 

            array("linea-arrows-button-off" => "linea-arrows-button-off"), 

            array("linea-arrows-button-on" => "linea-arrows-button-on"), 

            array("linea-arrows-button-up" => "linea-arrows-button-up"), 

            array("linea-arrows-check" => "linea-arrows-check"), 

            array("linea-arrows-circle-check" => "linea-arrows-circle-check"), 

            array("linea-arrows-circle-down" => "linea-arrows-circle-down"), 

            array("linea-arrows-circle-downleft" => "linea-arrows-circle-downleft"), 

            array("linea-arrows-circle-downright" => "linea-arrows-circle-downright"), 

            array("linea-arrows-circle-left" => "linea-arrows-circle-left"), 

            array("linea-arrows-circle-minus" => "linea-arrows-circle-minus"), 

            array("linea-arrows-circle-plus" => "linea-arrows-circle-plus"), 

            array("linea-arrows-circle-remove" => "linea-arrows-circle-remove"), 

            array("linea-arrows-circle-right" => "linea-arrows-circle-right"), 

            array("linea-arrows-circle-up" => "linea-arrows-circle-up"), 

            array("linea-arrows-circle-upleft" => "linea-arrows-circle-upleft"), 

            array("linea-arrows-circle-upright" => "linea-arrows-circle-upright"), 

            array("linea-arrows-clockwise" => "linea-arrows-clockwise"), 

            array("linea-arrows-clockwise-dashed" => "linea-arrows-clockwise-dashed"), 

            array("linea-arrows-compress" => "linea-arrows-compress"), 

            array("linea-arrows-deny" => "linea-arrows-deny"), 

            array("linea-arrows-diagonal" => "linea-arrows-diagonal"), 

            array("linea-arrows-diagonal2" => "linea-arrows-diagonal2"), 

            array("linea-arrows-down" => "linea-arrows-down"), 

            array("linea-arrows-down-double" => "linea-arrows-down-double"), 

            array("linea-arrows-downleft" => "linea-arrows-downleft"), 

            array("linea-arrows-downright" => "linea-arrows-downright"), 

            array("linea-arrows-drag-down" => "linea-arrows-drag-down"), 

            array("linea-arrows-drag-down-dashed" => "linea-arrows-drag-down-dashed"), 

            array("linea-arrows-drag-horiz" => "linea-arrows-drag-horiz"), 

            array("linea-arrows-drag-left" => "linea-arrows-drag-left"), 

            array("linea-arrows-drag-left-dashed" => "linea-arrows-drag-left-dashed"), 

            array("linea-arrows-drag-right" => "linea-arrows-drag-right"), 

            array("linea-arrows-drag-right-dashed" => "linea-arrows-drag-right-dashed"), 

            array("linea-arrows-drag-up" => "linea-arrows-drag-up"), 

            array("linea-arrows-drag-up-dashed" => "linea-arrows-drag-up-dashed"), 

            array("linea-arrows-drag-vert" => "linea-arrows-drag-vert"), 

            array("linea-arrows-exclamation" => "linea-arrows-exclamation"), 

            array("linea-arrows-expand" => "linea-arrows-expand"), 

            array("linea-arrows-expand-diagonal1" => "linea-arrows-expand-diagonal1"), 

            array("linea-arrows-expand-horizontal1" => "linea-arrows-expand-horizontal1"), 

            array("linea-arrows-expand-vertical1" => "linea-arrows-expand-vertical1"), 

            array("linea-arrows-fit-horizontal" => "linea-arrows-fit-horizontal"), 

            array("linea-arrows-fit-vertical" => "linea-arrows-fit-vertical"), 

            array("linea-arrows-glide" => "linea-arrows-glide"), 

            array("linea-arrows-glide-horizontal" => "linea-arrows-glide-horizontal"), 

            array("linea-arrows-glide-vertical" => "linea-arrows-glide-vertical"), 

            array("linea-arrows-hamburger1" => "linea-arrows-hamburger1"), 

            array("linea-arrows-hamburger-2" => "linea-arrows-hamburger-2"), 

            array("linea-arrows-horizontal" => "linea-arrows-horizontal"), 

            array("linea-arrows-info" => "linea-arrows-info"), 

            array("linea-arrows-keyboard-alt" => "linea-arrows-keyboard-alt"), 

            array("linea-arrows-keyboard-cmd" => "linea-arrows-keyboard-cmd"), 

            array("linea-arrows-keyboard-delete" => "linea-arrows-keyboard-delete"), 

            array("linea-arrows-keyboard-down" => "linea-arrows-keyboard-down"), 

            array("linea-arrows-keyboard-left" => "linea-arrows-keyboard-left"), 

            array("linea-arrows-keyboard-return" => "linea-arrows-keyboard-return"), 

            array("linea-arrows-keyboard-right" => "linea-arrows-keyboard-right"), 

            array("linea-arrows-keyboard-shift" => "linea-arrows-keyboard-shift"), 

            array("linea-arrows-keyboard-tab" => "linea-arrows-keyboard-tab"), 

            array("linea-arrows-keyboard-up" => "linea-arrows-keyboard-up"), 

            array("linea-arrows-left" => "linea-arrows-left"), 

            array("linea-arrows-left-double-32" => "linea-arrows-left-double-32"), 

            array("linea-arrows-minus" => "linea-arrows-minus"), 

            array("linea-arrows-move" => "linea-arrows-move"), 

            array("linea-arrows-move2" => "linea-arrows-move2"), 

            array("linea-arrows-move-bottom" => "linea-arrows-move-bottom"), 

            array("linea-arrows-move-left" => "linea-arrows-move-left"), 

            array("linea-arrows-move-right" => "linea-arrows-move-right"), 

            array("linea-arrows-move-top" => "linea-arrows-move-top"), 

            array("linea-arrows-plus" => "linea-arrows-plus"), 

            array("linea-arrows-question" => "linea-arrows-question"), 

            array("linea-arrows-remove" => "linea-arrows-remove"), 

            array("linea-arrows-right" => "linea-arrows-right"), 

            array("linea-arrows-right-double" => "linea-arrows-right-double"), 

            array("linea-arrows-rotate" => "linea-arrows-rotate"), 

            array("linea-arrows-rotate-anti" => "linea-arrows-rotate-anti"), 

            array("linea-arrows-rotate-anti-dashed" => "linea-arrows-rotate-anti-dashed"), 

            array("linea-arrows-rotate-dashed" => "linea-arrows-rotate-dashed"), 

            array("linea-arrows-shrink" => "linea-arrows-shrink"), 

            array("linea-arrows-shrink-diagonal1" => "linea-arrows-shrink-diagonal1"), 

            array("linea-arrows-shrink-diagonal2" => "linea-arrows-shrink-diagonal2"), 

            array("linea-arrows-shrink-horizonal2" => "linea-arrows-shrink-horizonal2"), 

            array("linea-arrows-shrink-horizontal1" => "linea-arrows-shrink-horizontal1"), 

            array("linea-arrows-shrink-vertical1" => "linea-arrows-shrink-vertical1"), 

            array("linea-arrows-shrink-vertical2" => "linea-arrows-shrink-vertical2"), 

            array("linea-arrows-sign-down" => "linea-arrows-sign-down"), 

            array("linea-arrows-sign-left" => "linea-arrows-sign-left"), 

            array("linea-arrows-sign-right" => "linea-arrows-sign-right"), 

            array("linea-arrows-sign-up" => "linea-arrows-sign-up"), 

            array("linea-arrows-slide-down1" => "linea-arrows-slide-down1"), 

            array("linea-arrows-slide-down2" => "linea-arrows-slide-down2"), 

            array("linea-arrows-slide-left1" => "linea-arrows-slide-left1"), 

            array("linea-arrows-slide-left2" => "linea-arrows-slide-left2"), 

            array("linea-arrows-slide-right1" => "linea-arrows-slide-right1"), 

            array("linea-arrows-slide-right2" => "linea-arrows-slide-right2"), 

            array("linea-arrows-slide-up1" => "linea-arrows-slide-up1"), 

            array("linea-arrows-slide-up2" => "linea-arrows-slide-up2"), 

            array("linea-arrows-slim-down" => "linea-arrows-slim-down"), 

            array("linea-arrows-slim-down-dashed" => "linea-arrows-slim-down-dashed"), 

            array("linea-arrows-slim-left" => "linea-arrows-slim-left"), 

            array("linea-arrows-slim-left-dashed" => "linea-arrows-slim-left-dashed"), 

            array("linea-arrows-slim-right" => "linea-arrows-slim-right"), 

            array("linea-arrows-slim-right-dashed" => "linea-arrows-slim-right-dashed"), 

            array("linea-arrows-slim-up" => "linea-arrows-slim-up"), 

            array("linea-arrows-slim-up-dashed" => "linea-arrows-slim-up-dashed"), 

            array("linea-arrows-square-check" => "linea-arrows-square-check"), 

            array("linea-arrows-square-down" => "linea-arrows-square-down"), 

            array("linea-arrows-square-downleft" => "linea-arrows-square-downleft"), 

            array("linea-arrows-square-downright" => "linea-arrows-square-downright"), 

            array("linea-arrows-square-left" => "linea-arrows-square-left"), 

            array("linea-arrows-square-minus" => "linea-arrows-square-minus"), 

            array("linea-arrows-square-plus" => "linea-arrows-square-plus"), 

            array("linea-arrows-square-remove" => "linea-arrows-square-remove"), 

            array("linea-arrows-square-right" => "linea-arrows-square-right"), 

            array("linea-arrows-square-up" => "linea-arrows-square-up"), 

            array("linea-arrows-square-upleft" => "linea-arrows-square-upleft"), 

            array("linea-arrows-square-upright" => "linea-arrows-square-upright"), 

            array("linea-arrows-squares" => "linea-arrows-squares"), 

            array("linea-arrows-stretch-diagonal1" => "linea-arrows-stretch-diagonal1"), 

            array("linea-arrows-stretch-diagonal2" => "linea-arrows-stretch-diagonal2"), 

            array("linea-arrows-stretch-diagonal3" => "linea-arrows-stretch-diagonal3"), 

            array("linea-arrows-stretch-diagonal4" => "linea-arrows-stretch-diagonal4"), 

            array("linea-arrows-stretch-horizontal1" => "linea-arrows-stretch-horizontal1"), 

            array("linea-arrows-stretch-horizontal2" => "linea-arrows-stretch-horizontal2"), 

            array("linea-arrows-stretch-vertical1" => "linea-arrows-stretch-vertical1"), 

            array("linea-arrows-stretch-vertical2" => "linea-arrows-stretch-vertical2"), 

            array("linea-arrows-switch-horizontal" => "linea-arrows-switch-horizontal"), 

            array("linea-arrows-switch-vertical" => "linea-arrows-switch-vertical"), 

            array("linea-arrows-up" => "linea-arrows-up"), 

            array("linea-arrows-up-double-33" => "linea-arrows-up-double-33"), 

            array("linea-arrows-upleft" => "linea-arrows-upleft"), 

            array("linea-arrows-upright" => "linea-arrows-upright"), 

            array("linea-arrows-vertical" => "linea-arrows-vertical"),
            array("linea-ecommerce-bag "=> "linea-ecommerce-bag "), 

            array("linea-ecommerce-bag-check "=> "linea-ecommerce-bag-check "), 

            array("linea-ecommerce-bag-cloud "=> "linea-ecommerce-bag-cloud "), 

            array("linea-ecommerce-bag-download "=> "linea-ecommerce-bag-download "), 

            array("linea-ecommerce-bag-minus "=> "linea-ecommerce-bag-minus "), 

            array("linea-ecommerce-bag-plus "=> "linea-ecommerce-bag-plus "), 

            array("linea-ecommerce-bag-refresh "=> "linea-ecommerce-bag-refresh "), 

            array("linea-ecommerce-bag-remove "=> "linea-ecommerce-bag-remove "), 

            array("linea-ecommerce-bag-search "=> "linea-ecommerce-bag-search "), 

            array("linea-ecommerce-bag-upload "=> "linea-ecommerce-bag-upload "), 

            array("linea-ecommerce-banknote "=> "linea-ecommerce-banknote "), 

            array("linea-ecommerce-banknotes "=> "linea-ecommerce-banknotes "), 

            array("linea-ecommerce-basket "=> "linea-ecommerce-basket "), 

            array("linea-ecommerce-basket-check "=> "linea-ecommerce-basket-check "), 

            array("linea-ecommerce-basket-cloud "=> "linea-ecommerce-basket-cloud "), 

            array("linea-ecommerce-basket-download "=> "linea-ecommerce-basket-download "), 

            array("linea-ecommerce-basket-minus "=> "linea-ecommerce-basket-minus "), 

            array("linea-ecommerce-basket-plus "=> "linea-ecommerce-basket-plus "), 

            array("linea-ecommerce-basket-refresh "=> "linea-ecommerce-basket-refresh "), 

            array("linea-ecommerce-basket-remove "=> "linea-ecommerce-basket-remove "), 

            array("linea-ecommerce-basket-search "=> "linea-ecommerce-basket-search "), 

            array("linea-ecommerce-basket-upload "=> "linea-ecommerce-basket-upload "), 

            array("linea-ecommerce-bath "=> "linea-ecommerce-bath "), 

            array("linea-ecommerce-cart "=> "linea-ecommerce-cart "), 

            array("linea-ecommerce-cart-check "=> "linea-ecommerce-cart-check "), 

            array("linea-ecommerce-cart-cloud "=> "linea-ecommerce-cart-cloud "), 

            array("linea-ecommerce-cart-content "=> "linea-ecommerce-cart-content "), 

            array("linea-ecommerce-cart-download "=> "linea-ecommerce-cart-download "), 

            array("linea-ecommerce-cart-minus "=> "linea-ecommerce-cart-minus "), 

            array("linea-ecommerce-cart-plus "=> "linea-ecommerce-cart-plus "), 

            array("linea-ecommerce-cart-refresh "=> "linea-ecommerce-cart-refresh "), 

            array("linea-ecommerce-cart-remove "=> "linea-ecommerce-cart-remove "), 

            array("linea-ecommerce-cart-search "=> "linea-ecommerce-cart-search "), 

            array("linea-ecommerce-cart-upload "=> "linea-ecommerce-cart-upload "), 

            array("linea-ecommerce-cent "=> "linea-ecommerce-cent "), 

            array("linea-ecommerce-colon "=> "linea-ecommerce-colon "), 

            array("linea-ecommerce-creditcard "=> "linea-ecommerce-creditcard "), 

            array("linea-ecommerce-diamond "=> "linea-ecommerce-diamond "), 

            array("linea-ecommerce-dollar "=> "linea-ecommerce-dollar "), 

            array("linea-ecommerce-euro "=> "linea-ecommerce-euro "), 

            array("linea-ecommerce-franc "=> "linea-ecommerce-franc "), 

            array("linea-ecommerce-gift "=> "linea-ecommerce-gift "), 

            array("linea-ecommerce-graph1 "=> "linea-ecommerce-graph1 "), 

            array("linea-ecommerce-graph2 "=> "linea-ecommerce-graph2 "), 

            array("linea-ecommerce-graph3 "=> "linea-ecommerce-graph3 "), 

            array("linea-ecommerce-graph-decrease "=> "linea-ecommerce-graph-decrease "), 

            array("linea-ecommerce-graph-increase "=> "linea-ecommerce-graph-increase "), 

            array("linea-ecommerce-guarani "=> "linea-ecommerce-guarani "), 

            array("linea-ecommerce-kips "=> "linea-ecommerce-kips "), 

            array("linea-ecommerce-lira "=> "linea-ecommerce-lira "), 

            array("linea-ecommerce-megaphone "=> "linea-ecommerce-megaphone "), 

            array("linea-ecommerce-money "=> "linea-ecommerce-money "), 

            array("linea-ecommerce-naira "=> "linea-ecommerce-naira "), 

            array("linea-ecommerce-pesos "=> "linea-ecommerce-pesos "), 

            array("linea-ecommerce-pound "=> "linea-ecommerce-pound "), 

            array("linea-ecommerce-receipt "=> "linea-ecommerce-receipt "), 

            array("linea-ecommerce-receipt-bath "=> "linea-ecommerce-receipt-bath "), 

            array("linea-ecommerce-receipt-cent "=> "linea-ecommerce-receipt-cent "), 

            array("linea-ecommerce-receipt-dollar "=> "linea-ecommerce-receipt-dollar "),

            array("linea-ecommerce-receipt-euro "=> "linea-ecommerce-receipt-euro "), 

            array("linea-ecommerce-receipt-franc "=> "linea-ecommerce-receipt-franc "), 

            array("linea-ecommerce-receipt-guarani "=> "linea-ecommerce-receipt-guarani "), 

            array("linea-ecommerce-receipt-kips "=> "linea-ecommerce-receipt-kips "), 

            array("linea-ecommerce-receipt-lira "=> "linea-ecommerce-receipt-lira "),

            array("linea-ecommerce-receipt-naira "=> "linea-ecommerce-receipt-naira "), 

            array("linea-ecommerce-receipt-pesos "=> "linea-ecommerce-receipt-pesos "), 

            array("linea-ecommerce-receipt-pound "=> "linea-ecommerce-receipt-pound "), 

            array("linea-ecommerce-receipt-rublo "=> "linea-ecommerce-receipt-rublo "), 

            array("linea-ecommerce-receipt-rupee "=> "linea-ecommerce-receipt-rupee "), 

            array("linea-ecommerce-receipt-tugrik "=> "linea-ecommerce-receipt-tugrik "), 

            array("linea-ecommerce-receipt-won "=> "linea-ecommerce-receipt-won "), 

            array("linea-ecommerce-receipt-yen "=> "linea-ecommerce-receipt-yen "), 

            array("linea-ecommerce-receipt-yen2 "=> "linea-ecommerce-receipt-yen2 "), 

            array("linea-ecommerce-recept-colon "=> "linea-ecommerce-recept-colon "), 

            array("linea-ecommerce-rublo "=> "linea-ecommerce-rublo "), 

            array("linea-ecommerce-rupee "=> "linea-ecommerce-rupee "), 

            array("linea-ecommerce-safe "=> "linea-ecommerce-safe "), 

            array("linea-ecommerce-sale "=> "linea-ecommerce-sale "), 

            array("linea-ecommerce-sales "=> "linea-ecommerce-sales "), 

            array("linea-ecommerce-ticket "=> "linea-ecommerce-ticket "), 

            array("linea-ecommerce-tugriks "=> "linea-ecommerce-tugriks "), 

            array("linea-ecommerce-wallet "=> "linea-ecommerce-wallet "), 

            array("linea-ecommerce-won "=> "linea-ecommerce-won "), 

            array("linea-ecommerce-yen "=> "linea-ecommerce-yen "), 

            array("linea-ecommerce-yen2 "=> "linea-ecommerce-yen2 ")
     ),       

);


  return $icons;


}


/*--------------------- Pagination Function ---------------------------------- */
function amos_paginationnew() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged =  get_query_var('page') ? get_query_var('page') : 1;

    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="pagination"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link("Previous Page") );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="current"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li></li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="current"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li></li>' . "\n";
 
        $class = $paged == $max ? ' class="current"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="next_link">%s</li>' . "\n", get_next_posts_link("Next Page") );
 
    echo '</ul></div>' . "\n";
 
}


function amos_pagination($pages = '', $range = 2){
    
    $showitems = ($range * 2)+1;  

     global $paged;
     if(!empty($paged)){
        if(isset($GLOBALS['paged']) && !empty($GLOBALS['paged']))
         $paged = $GLOBALS['paged'];
      }
     
      else{
        $paged = 1;
      }
         
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {  
                 $next_link = '';
                 if($paged + 1 == $i)
                  $next_link = 'next_link';
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive ".$next_link." \">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*--------------------- End Pagination Function ---------------------------------- */

/* -------------------- Pagination Display --------------------------------------- */
function amos_pagination_display(){
  global $amos_redata, $amos_current_view;
  $show = '';
  $infinite = '';
  $show_p='';

  if( ($amos_current_view == 'blog' && $amos_redata['blog_pagination'] == 'no_pagination') || ($amos_current_view == 'portfolio' && $amos_redata['portfolio_pagination'] == 'no_pagination') )
    $show = 'hide_this';

  if(($amos_current_view == 'blog' && $amos_redata['blog_pagination'] == 'infinite_scroll' ) || ($amos_current_view == 'portfolio' && $amos_redata['portfolio_pagination'] == 'infinite_scroll') )
    $infinite = 'infinite_scroll_pag';


  echo '<div class="p_pagination '.$show.' '.$infinite.'">';
  if( ($amos_current_view == 'blog' && $amos_redata['blog_pagination'] == 'load_more' ) || ($amos_current_view == 'portfolio' && $amos_redata['portfolio_pagination'] == 'load_more') )
    echo '<a href="#" class="btn-bt '.$amos_redata['overall_button_style'][0].' load_more_button">'.__('Load More', 'amos').'</a>';
  
  if( ($amos_current_view == 'blog' && $amos_redata['blog_pagination'] != 'with_pagination') || ($amos_current_view == 'portfolio' && $amos_redata['portfolio_pagination'] != 'with_pagination') )
  $show_p = 'hide_this';



  echo '<div class="with_pagination '.$show_p.'">'; 
  amos_pagination();
  echo '</div>';
  echo '</div>';

}

/* -------------------- End Pagination Display ----------------------------------- */

/* Simple output */
if(!function_exists('amos_output')){

  function amos_output($args){
    return $args;
  }

}

/*--------------------- Default Menu Items ------------------------------------- */
/* When no menu has selected */

if(!function_exists('amos_default_menu')){
  
    function amos_default_menu($args){
        
      $current = "";
      if (is_front_page())
        $current = "class='current-menu-item'";
      
      echo "<ul class='menu'>";

        echo "<li $current><a href='".esc_url(home_url('/'))."'>".__('Home' , 'amos')."</a></li>";
        wp_list_pages('title_li=&sort_column=menu_order&number=2&depth=0');

      echo "</ul>";

    }
}

/*--------------------- End Default Menu Items --------------------------------- */
if(!function_exists('amos_post_navtigations')){
  
    function amos_post_navtigations(){

      echo '<div class="post_navigation">';
  if(is_object(get_previous_post())): ?>                      
   <div class="previous_post" style="background-image: url(
     <?php if(has_post_thumbnail(get_previous_post()->ID)): ?>
       <?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(get_previous_post()->ID), 'amos_col2', 'url')) ?>
          <?php endif; ?>
          )"> 
          <div class="overlay"></div>
        <a class="prev" href="<?php echo esc_url(get_permalink(get_previous_post()->ID)); ?>">
            <div class="prev_container">
             <div class="icon-wrapper"><i class="lnr-arrow-left"></i></div>
             <h6><?php echo esc_attr(get_previous_post()->post_title); ?></h6>
            </div>
        </a>
          </div> 
          <?php endif; ?>
                       
  <?php if(is_object(get_next_post())): ?>                  
      <div class="next_post" style="background-image: url(
            <?php if(has_post_thumbnail(get_next_post()->ID)): ?>
          <?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(get_next_post()->ID), 'amos_col2', 'url')) ?>

          <?php endif; ?>
          )">                             
          <div class="overlay"></div>                    
         <a class="next" href="<?php echo get_permalink(get_next_post()->ID); ?>">
           <div class="next_container">
             <h6><?php echo esc_attr(get_next_post()->post_title); ?></h6>
              <div class="icon-wrapper"><i class="lnr-arrow-right"></i></div>
           </div>
         </a>
       </div>
  <?php endif; ?> 
          
<?php echo '</div>';
}
 }

/*--------------------- Check for custom sidebars in options ------------------- */

function amos_check_custom_sidebar($type){
    global $amos_redata, $amos_current_view;

    $id_array = '';

    if($type == 'page' && isset($amos_redata['pages_sidebar']) && !empty($amos_redata['pages_sidebar']))
    {
        $id_array = $amos_redata['pages_sidebar'];
    }
    else if($type == 'cat' && isset($amos_redata['categories_sidebar']) && !empty($amos_redata['categories_sidebar']))
    {
        $id_array = $amos_redata['categories_sidebar'];
    }
       
    if(is_array($id_array))
    {

        if(is_page($id_array))
        {   
            return get_the_title();
        }
        else if(is_category($id_array))
        {
            return single_cat_title( "", false );
        }
    }

}

/*--------------------- End Check for custom sidebars in options ---------------- */




/* -------------------- Get Logo Image ------------------------------------------ */

if(!function_exists('amos_logo'))
{

    function amos_logo($default = "")
    {
        global $amos_redata;
        
        $output = '';
        if(!empty($amos_redata['logo']['url']) || !empty($amos_redata['logo_light']['url']) )
        {

            if(!empty($amos_redata['logo']['url']))
              $logo = "<img class='dark' src=".esc_url($amos_redata['logo']['url'])." />";
            if(!empty($amos_redata['logo_light']['url']))
              $logo_light = "<img class='light' src=".esc_url($amos_redata['logo_light']['url'])." />";
            else $logo_light = '';
            
            $logo = "<a href='".esc_url(home_url('/'))."'>".$logo.$logo_light."</a>";
        }
        else
        { 
            $logo = get_bloginfo('name');
            if($default != '') $logo = "<img src=".esc_url($default)."  title=".esc_attr($logo)."/>";
            $logo = "<a href='".esc_url(home_url('/'))."'>".$logo."</a>";
        }
    
        return $logo;
    }
}

/* -------------------- End Get Logo Image ------------------------------------------ */

/* -------------------- Get vertical Logo Image ------------------------------------------ */

if(!function_exists('amos_vertical_logo'))
{

    function amos_vertical_logo($default = "")
    {
        global $amos_redata;
        
        $output = '';
        if(!empty($amos_redata['vertical_logo']['url'])  )
        {

            if(!empty($amos_redata['vertical_logo']['url']))
              $logo = "<img class='' src=".esc_url($amos_redata['vertical_logo']['url'])."  />";
            
            
            $logo = "<a href='".esc_url(home_url('/'))."'>".$logo."</a>";
        }
        else
        { 
            $logo = get_bloginfo('name');
            if($default != '') $logo = "<img src=".esc_url($default)."  title=".esc_attr($logo)."/>";
            $logo = "<a href='".esc_url(home_url('/'))."'>".$logo."</a>";
        }
    
        return $logo;
    }
}

/* -------------------- End Get Logo Image ------------------------------------------ */






/* -------------------- Get Page Parents -------------------------------------------- */

function amos_page_parents() {
    global $post, $wp_query, $wpdb;
    
    if((int) amos_get_post_id() != 0){
      $post = $wp_query->post;

      $parent_array = array();
      $current_page = $post->ID;
      $parent = 1;
      while($parent) {
      $sql = $wpdb->prepare("SELECT ID, post_parent FROM $wpdb->posts WHERE ID = %d; ", array($current_page) );
      $page_query = $wpdb->get_row($sql);
      $parent = $current_page = $page_query->post_parent;
      if($parent)
          $parent_array[] = $page_query->post_parent;
      }

      return $parent_array;
    }
    
}

/* -------------------- End Get Page Parents -------------------------------------------- */



/* -------------------- Set VC config file ---------------------------------------------- */

if(function_exists('vc_set_as_theme')) 
  vc_set_as_theme();

if (class_exists('WPBakeryVisualComposerAbstract')) {
  function amos_active_vc(){
    require_once  get_template_directory().'/includes/core/amos_elements.php';
  }
  add_action('init','amos_active_vc', 5 );
}

/* -------------------- End Set VC config file ------------------------------------------ */



/* ------------------- Add Body Classes ----------------------------------*/

add_filter('body_class', 'amos_header_class');
function amos_header_class($classes = ''){
  global $amos_redata;
  $header_class = $amos_redata['menu_presets']; 
  $menu_class = $amos_redata['menu_style'];
  $classes[] = $header_class;
  $classes[] = $menu_class;

  
if($amos_redata['menu_presets'] == 'h9'){
  $classes[] = 'hidden_header';
  if($amos_redata['h_vertical_position'] == 'right')
    $pos= 'right_header';
  else $pos= 'left_header';
  $classes[] = $pos;
}
  
  if($amos_redata['comingsoon_page'] != '')
    if($amos_redata['comingsoon_page'] == get_the_ID() ):
      $classes[] = 'comingsoon_page ';
    endif;

  return $classes; 
}
add_filter('body_class', 'amos_page_header_fixed_class');
function amos_page_header_fixed_class($classes = ''){
  global $amos_redata;
  $header_class = ' ';
  if(isset($amos_redata['fixed_header_page'])){
     $header_class = $amos_redata['fixed_header_page']; 
  }

if(($header_class == 1 || ($amos_redata['blog_post_style'] == 'creative' && is_singular('post'))) && !is_singular( 'portfolio_item'))
  $classes[] = 'fixed_header_page';
if ($amos_redata['blog_post_style'] == 'creative' && is_single() && !is_singular())
  $classes[] =' auto_color_check';  

  return $classes; 
}

add_filter('body_class', 'amos_outter_padding');
function amos_outter_padding($classes = ''){
    global $amos_redata;

    if(isset($amos_redata['outter_padding']) && $amos_redata['outter_padding'])
      $classes[] = 'outter_padding';
    return $classes;
}

add_filter('body_class', 'amos_slider_class');
function amos_slider_class($classes = ''){

  $slider = new amos_slideshow(amos_get_post_id());
  if($slider && $slider->slide_number > 0 && $slider->slide_type != '' && $slider->slide_type != 'none'){
    if($slider->options['slideshow_layout'] == 'boxed')
      $classes[] = 'fixed_slider';
    else
      $classes[] = 'fullwidth_slider_page';   
  }
  return $classes;
}

add_filter('body_class', 'amos_sticky_logo');
function amos_sticky_logo($classes = ''){
  global $amos_redata;
  if($amos_redata['sticky_logo']){
      $classes[] = 'logo_only_sticky';
  }
  return $classes;
}


add_filter('body_class', 'amos_page_header_class');
function amos_page_header_class($classes = ''){

    if(function_exists('redux_post_meta')){
      $page_header_bool =redux_post_meta('amos_redata',(int) amos_get_post_id(), 'page_header_bool');
      $page_header_style = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'page_header_style');
    }else{
      $page_header_bool = 0;
      $page_header_style = 'none';

    }
    

    if( (int) amos_get_post_id() != 0){ 
    
     
      if(($page_header_bool) || is_404() || is_search() || is_archive() )
          $classes[] = 'page_header_yes';

      if( $page_header_bool && $page_header_style == 'centered')
          $classes[] = 'page_header_centered';  
        if( $page_header_bool && $page_header_style == 'left')
          $classes[] = 'page_header_left';  
    }
    return $classes;

}


add_filter('body_class', 'amos_nicescroll_class');
function amos_nicescroll_class($classes = ''){
    global $amos_redata;
    if($amos_redata['nicescroll'])
        $classes[] = 'nicescroll';
    return $classes;

}

add_filter('body_class', 'amos_fullpage_onepage');
function amos_fullpage_onepage($classes = ''){
    global $amos_redata;
    if($amos_redata['blog_style'] == 'fullscreen' && (amos_get_post_id() == $amos_redata['blogpage'] || amos_get_post_id() == '3311'))
      $classes[] =' fullpage_onepage'; 
    return $classes;

}

add_filter('body_class', 'amos_page_header_color');
function amos_page_header_color($classes = ''){

    if(!function_exists('redux_post_meta'))
        $page_header_menu_color = 'light';
    else
        $page_header_menu_color = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'page_header_menu_color');

    if( (int) amos_get_post_id() != 0 ){ 

      if($page_header_menu_color == 'auto')
        $classes[] =' auto_color_check';  
    }
    return $classes;
}

add_filter('body_class', 'amos_one_page_active');
function amos_one_page_active($classes = ''){
    if( (int) amos_get_post_id() != 0 && function_exists('redux_post_meta') ){ 
      if(redux_post_meta('amos_redata',(int) amos_get_post_id(), 'one_page_active'))
        $classes[] = 'one_page';  
    }
    return $classes;
}

add_filter('body_class', 'amos_portfolio_splited');
function amos_portfolio_splited($classes = ''){
    if( (int) amos_get_post_id() != 0 && function_exists('redux_post_meta') ){ 
      if(redux_post_meta('amos_redata',(int) amos_get_post_id(), 'portfolio_mode') == 'split')
        $classes[] = 'splited_screen_portfolio';  
    }
    return $classes;
}

add_filter('body_class', 'amos_sticky_active');
function amos_sticky_active($classes = ''){
    global $amos_redata;

    if($amos_redata['sticky'])
      $classes[] = 'sticky_active';
    return $classes;
}

add_filter('body_class', 'amos_shadow');
function amos_shadow($classes = ''){
    global $amos_redata;

    if(isset($amos_redata['header_shadow']) && $amos_redata['header_shadow'] != 'no_shadow')
      $classes[] = 'header_shadow_'.$amos_redata['header_shadow'];
    return $classes;
}

add_filter('body_class', 'amos_fullwidthheader');
function amos_fullwidthheader($classes = ''){
    global $amos_redata;

    if(isset($amos_redata['header_container_full']) && $amos_redata['header_container_full'])
      $classes[] = 'fullwidth_header';
    return $classes;
}

add_filter('body_class', 'amos_fullwidthfooter');
function amos_fullwidthfooter($classes = ''){
    global $amos_redata;

    if(isset($amos_redata['footer_container_full']) && $amos_redata['footer_container_full'])
      $classes[] = 'fullwidth_footer';
    return $classes;
}

add_filter('body_class', 'amos_header_transparent');
function amos_header_transparent($classes = ''){
    global $amos_redata;
    
    if(isset($amos_redata['header_transparency']) && $amos_redata['header_transparency'])
      $classes[] = 'header_transparency';
    return $classes; 
}
/* transparent left/right header*/
add_filter('body_class', 'amos_header_transparent_padding');
function amos_header_transparent_padding($classes = ''){
    global $amos_redata;
    
    if($amos_redata['menu_presets'] == 'h8' && $amos_redata['h8_transparent_padding'])
      $classes[] = 'transparent_padding';
    return $classes; 
}

/* snap Drawer */
add_filter('body_class', 'amos_snapdrawer');
function amos_snapdrawer($classes = ''){
    global $amos_redata;

    if($amos_redata['responsive_menu_dropdown'] && $amos_redata['responsive_menu_style']=='sidemenu')
        $classes[] = 'sidemenu';
    return $classes;
}

add_filter('body_class', 'amos_header7_fixed_content');
function amos_header7_fixed_content($classes= ''){
   global $amos_redata;
   if($amos_redata['menu_presets'] == 'h8' && $amos_redata['h8_transparent_padding'] == 1 && (($amos_redata['slider_type'] != 'none' && $amos_redata['slider_layout'] == 'fullwidth') ||  ($amos_redata['page_header_bool'] == 1 ) )){
    $classes[] ='fixed_content_margin';

   }
   return $classes;
}




add_filter('body_class', 'amos_header_remove_slider_mobile');
function amos_header_remove_slider_mobile($classes = ''){
  global $amos_redata;
  if((int) amos_get_post_id() != 0 && function_exists('redux_post_meta'))
      $slider_onmobile_remove = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'slider_onmobile_remove');
  else
      $slider_onmobile_remove = 0;

  if($slider_onmobile_remove)
    $classes[] = 'remove_slider_onmobile';
  return $classes;

}

/* ------------------- End Add Body Classes ----------------------------------*/

/* ------------------- Page transition effect ----------------------------------*/

function amos_header_transitions($type){
  global $amos_redata;
  
  $transition['class'] = '';
  $transition['attr'] = '';

  if($amos_redata['amos_page_transition']):
    $transition['attr'] = 'data-animsition-in-class="'.esc_attr($amos_redata['page_transition_in']).'" data-animsition-in-duration="'.esc_attr($amos_redata['page_transition_in_duration']).'" data-animsition-out-class="'.esc_attr($amos_redata['page_transition_out']).'" data-animsition-out-duration="'.esc_attr($amos_redata['page_transition_out_duration']).'"';
    $transition['class'] = 'animsition';
  endif;

  if($type == 'class')
    return $transition['class'];

  if($type == 'attr')
    return $transition['attr'];
}


/* ------------------- MasonryWidthCustom ----------------------------------- */

function amos_getRandomWeightedElement(array $weightedValues) {
    $rand = mt_rand(1, (int) array_sum($weightedValues));

    foreach ($weightedValues as $key => $value) {
      $rand -= $value;
      if ($rand <= 0) {
        return $key;
      }
    }
}

/* ------------------- End Masonry WidthCustom ------------------------------ */


/* ------------------- Color Lighter Darker --------------------------------- */

function amos_adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Format the hex color string
    if(is_array($hex) ) $hex = $hex['color'];
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;
}

/* ------------------- End Color Lighter Darker ----------------------------- */

/* ------------------- Get top ancestor_id ------------------------------------ */

if(!function_exists('amos_get_post_top_ancestor_id')){

    function amos_get_post_top_ancestor_id(){
        global $post;
        
        if($post->post_parent){
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            return $ancestors[0];
        }
        
        return $post->ID;
    }
}


/*
Register Fonts
*/
function amos_fonts_url() {
    $font_url = '';
    
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'amos' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Montserrat|Bowlby One|Quattrocento Sans:400,400italic,700italic,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}
/*
Enqueue scripts and styles.
*/
function amos_scripts() {
    wp_enqueue_style( 'amos-fonts', amos_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'amos_scripts' );

/* ------------------- Amos Animations Array -----------------------------*/

function amos_animations(){
    return array(
                    'none'  => 'None',
                    'flash' => 'flash',
                    'bounce' => 'bounce',
                    'shake' => 'shake',
                    'tada' => 'tada',
                    'wobble' => 'wobble',
                    'pulse' => 'pulse',
                    'flip' => 'flip',
                    'flipInX' => 'flipInX',
                    'flipOutX' => 'flipOutX',
                    'flipInY' => 'flipInY',
                    'flipOutY' => 'flipOutY',
                    'fadeIn' => 'fadeIn',
                    'fadeInUp' => 'fadeInUp',
                    'fadeInDown' => 'fadeInDown',
                    'fadeInLeft' => 'fadeInLeft',
                    'fadeInRight' => 'fadeInRight',
                    'fadeInUpBig' => 'fadeInUpBig',
                    'fadeInDownBig' => 'fadeInDownBig',
                    'fadeInLeftBig' => 'fadeInLeftBig',
                    'fadeInRightBig' => 'fadeInRightBig',
                    'fadeOut' => 'fadeOut',
                    'fadeOutUp' => 'fadeOutUp',
                    'fadeOutDown' => 'fadeOutDown',
                    'fadeOutLeft' => 'fadeOutLeft',
                    'fadeOutRight' => 'fadeOutRight',
                    'fadeOutUpBig' => 'fadeOutUpBig',
                    'fadeOutDownBig' => 'fadeOutDownBig',
                    'fadeOutLeftBig' => 'fadeOutLeftBig',
                    'fadeOutRightBig' => 'fadeOutRightBig',
                    'slideInDown' => 'slideInDown',
                    'slideInLeft' => 'slideInLeft',
                    'slideInRight' => 'slideInRight',
                    'slideOutUp' => 'slideOutUp',
                    'slideOutLeft' => 'slideOutLeft',
                    'slideOutRight' => 'slideOutRight',
                    'bounceIn' => 'bounceIn',
                    'bounceInDown' => 'bounceInDown',
                    'bounceInUp' => 'bounceInUp',
                    'bounceInLeft' => 'bounceInLeft',
                    'bounceInRight' => 'bounceInRight',
                    'bounceOut' => 'bounceOut',
                    'bounceOutDown' => 'bounceOutDown',
                    'bounceOutUp' => 'bounceOutUp',
                    'bounceOutLeft' => 'bounceOutLeft',
                    'bounceOutRight' => 'bounceOutRight',
                    'rotateIn' => 'rotateIn',
                    'rotateInDownLeft' => 'rotateInDownLeft',
                    'rotateInDownRight' => 'rotateInDownRight',
                    'rotateInUpLeft' => 'rotateInUpLeft',
                    'rotateInUpRight' => 'rotateInUpRight',
                    'rotateOut' => 'rotateOut',
                    'rotateOutDownLeft' => 'rotateOutDownLeft',
                    'rotateOutDownRight' => 'rotateOutDownRight',
                    'rotateOutUpLeft' => 'rotateOutUpLeft',
                    'rotateOutUpRight' => 'rotateOutUpRight',
                    'lightSpeedIn' => 'lightSpeedIn',
                    'lightSpeedOut' => 'lightSpeedOut',
                    'hinge' => 'hinge',
                    'rollIn' => 'rollIn',
                    'rollOut' => 'rollOut');
    
}


function amos_getPortfolioFields(){
  $amos_redata = get_option( 'amos_redata' );
  $description_fields = '';
  if(!empty($amos_redata['single_portfolio_custom_params']) ): 
      for($i = 0; $i < count($amos_redata['single_portfolio_custom_params']); $i++):
          $description_fields .= ($i+1).". ".$amos_redata['single_portfolio_custom_params'][$i]."<br />  ";
      endfor;
  endif;

  return $description_fields;
}



set_time_limit(0);



function amos_default_redata(){

  global $amos_redata;

if(!class_exists('ElleFramework')){
  $amos_redata = array (
  'last_tab' => '',
  'responsive_bool' => '1',
  'nicescroll' => '0',
  'amos_page_transition' => '0',
  'page_transition_in' => 'fade-in',
  'page_transition_in_duration' => '1000',
  'page_transition_out' => 'fade-out',
  'page_transition_out_duration' => '1000',
  'frontpage' => '',
  'blogpage' => '',
  'comingsoon_page' => '',
  '404_error_message' => 'Sorry but the page you are looking for has not been found. Try checking the URL for errors, then bit the refresh button on your browser',
  'bg_image_404' => 
  array (
    'background-color' => '#f5f5f5',
    'background-repeat' => '',
    'background-size' => '',
    'background-attachment' => '',
    'background-position' => '',
    'background-image' => '',
    'media' => 
    array (
      'id' => '',
      'height' => '',
      'width' => '',
      'thumbnail' => '',
    ),
  ),
  'logo' => 
  array (
    'url' => get_template_directory_uri().'/img/logo.png',
    'id' => '1714',
    'height' => '20',
    'width' => '100',
    'thumbnail' => get_template_directory_uri().'/img/logo.png',
    'title' => 'amos_logo',
    'caption' => '',
    'alt' => '',
    'description' => '',
  ),
  'logo_light' => 
  array (
    'url' => get_template_directory_uri().'/img/logo_light.png',
    'id' => '1713',
    'height' => '20',
    'width' => '100',
    'thumbnail' => get_template_directory_uri().'/img/logo_light.png',
    'title' => 'amos_light',
    'caption' => '',
    'alt' => '',
    'description' => '',
  ),
  'vertical_logo' => 
  array (
    'url' => get_template_directory_uri().'/img/logo.png',
    'id' => '',
    'height' => '',
    'width' => '',
    'thumbnail' => '',
    'title' => '',
    'caption' => '',
    'alt' => '',
    'description' => '',
  ),
  'logo_height' => 
  array (
    'height' => '15px',
    'units' => 'px',
  ),
  'menu_presets' => 'h1',
  'header_tools' => 
  array (
    'enabled' => 
    array (
      'placebo' => 'placebo',
      'search' => 'Search',
      'cart' => 'Cart',
    ),
    'disabled' => 
    array (
      'placebo' => 'placebo',
    ),
  ),
  'header_tools_two' => 
  array (
    'left' => 
    array (
      'placebo' => 'placebo',
    ),
    'right' => 
    array (
      'placebo' => 'placebo',
      'search' => 'Search',
      'extra_nav' => 'Extra side navigation',
      'cart' => 'Cart',
    ),
    'disabled' => 
    array (
      'placebo' => 'placebo',
      
      'button' => 'Button',
    ),
  ),
  'header_tools_extend' => 
  array (
    'enabled' => 
    array (
      'placebo' => 'placebo',
      'extra_nav' => 'Extra side navigation',
      'cart' => 'Cart',
      'button' => 'Button',
      'hamburger_menu' => 'Hamburger Menu',
      'search' => 'Search',
    ),
    'disabled' => 
    array (
      'placebo' => 'placebo',
    ),
  ),
  'header_tools_two_extend' => 
  array (
    'left' => 
    array (
      'placebo' => 'placebo',
      'hamburger_menu' => 'Hamburger Menu',
      'cart' => 'Cart',
      'search' => 'Search',
    ),
    'right' => 
    array (
      'placebo' => 'placebo',
      'extra_nav' => 'Extra side navigation',
      'button' => 'Button',
    ),
    'disabled' => 
    array (
      'placebo' => 'placebo',
    ),
  ),
  'header_tools_position' => 'right',
  'h4_border' => 
  array (
    'border-top' => '1px',
    'border-right' => '1px',
    'border-bottom' => '1px',
    'border-left' => '1px',
    'border-style' => 'solid',
    'border-color' => '#eee',
  ),
  'h_vertical_position' => 'right',
  'h_vertical_width' => 
  array (
    'width' => '300px',
    'units' => 'px',
  ),
  'h_vertical_padding' => 
  array (
    'padding-top' => '120px',
    'padding-right' => '20px',
    'padding-bottom' => '100px',
    'padding-left' => '24px',
  ),
  'h_vertical_margin' => 
  array (
    'margin-top' => '100px',
  ),
  'h_vertical_content_align' => 'center',
  'h_vertical_border' => '1',
  'h8_border_top' => '0',
  'h8_transparent_padding' => '0',
  'header_overlay_color' => 
  array (
    'color' => '#c6d0d8',
    'alpha' => '0.84',
    'rgba' => 'rgba(198,208,216,0.84)',
  ),
  'header_height' => 
  array (
    'height' => '100px',
    'units' => 'px',
  ),
  'header_background' => 
  array (
    'color' => '#ffffff',
    'alpha' => '0.01',
    'rgba' => 'rgba(255,255,255,0.01)',
  ),
  'header_transparency' => '1',
  'header_first_row_height' => 
  array (
    'height' => '90px',
    'units' => 'px',
  ),
  'header_second_row_height' => 
  array (
    'height' => '80px',
    'units' => 'px',
  ),
  'header_navigation' => 
  array (
    'color' => '#000000',
    'alpha' => '1.00',
    'rgba' => 'rgba(0,0,0,1)',
  ),
  'headernavsix_font_hover' => 
  array (
    'color' => '#f7f7f7',
    'alpha' => '1.00',
    'rgba' => 'rgba(247,247,247,1)',
  ),
  'header_second_transparent' => '0',
  'header_container_full' => '0',
  'header_border_bottom_content' => '0',
  'header_shadow' => 'no_shadow',
  'header_button' => 'Login',
  'header_button_link' => '#',
  'search_widgets' => '1',
  'search_background' => 
  array (
    'color' => '#000000',
    'alpha' => '1.00',
    'rgba' => 'rgba(0,0,0,1)',
  ),
  'search_font_color' => 
  array (
    'color' => '#f7f7f7',
    'alpha' => '1.00',
    'rgba' => 'rgba(247,247,247,1)',
  ),
  'responsive_menu_dropdown' => '1',
  'menu_presets_responsive' => 'lateral',
  'header_tools_responsive' => 
  array (
    'left' => 
    array (
      'placebo' => 'placebo',
      'menu_responsive' => 'Hamburger menu',
      'search' => 'Search',
    ),
    'right' => 
    array (
      'placebo' => 'placebo',
      'button' => 'Button',
      'cart' => 'Cart',
    ),
    'disabled' => 
    array (
      'placebo' => 'placebo',
    ),
  ),
  'menu_responsive_position' => 'left',
  'responsive_menu_style' => 'normal',
  'menu_style' => 'menu_2',
  'menu_7_color_1' => 
  array (
    'color' => '#003fe8',
    'alpha' => '1',
    'rgba' => 'rgba(0,63,232,1)',
  ),
  'menu_7_color_2' => 
  array (
    'color' => '#bf07fc',
    'alpha' => '1',
    'rgba' => 'rgba(191,7,252,1)',
  ),
  'menu_5_border' => 
  array (
    'border-top' => '1px',
    'border-right' => '1px',
    'border-bottom' => '1px',
    'border-left' => '1px',
    'border-style' => 'solid',
    'border-color' => '#eee',
  ),
  'menu_font_style' => 
  array (
    'font-family' => 'Montserrat',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '600',
    'font-style' => '',
    'text-align' => 'center',
    'text-transform' => 'capitalize',
    'font-size' => '15px',
    'line-height' => '26px',
    'letter-spacing' => '0px',
    'color' => '#012b43',
  ),
  'menu_padding' => 
  array (
    'padding-right' => '15px',
    'padding-left' => '15px',
  ),
  'menu_margin' => 
  array (
    'margin-right' => '0',
    'margin-left' => '0',
  ),
  'dropdown_width' => 
  array (
    'width' => '220px',
    'units' => 'px',
  ),
  'background_dropdown' => 
  array (
    'color' => '#ffffff',
    'alpha' => '1',
    'rgba' => 'rgba(255,255,255,1)',
  ),
  'dropdown_border_color' => '#f7f7f7',
  'dropdown_font' => 
  array (
    'text-transform' => 'capitalize',
    'font-size' => '14px',
    'letter-spacing' => '0px',
    'color' => '#3d3d3d',
  ),
  'megamenu_title' => 
  array (
    'font-weight' => '400',
    'font-style' => '',
    'text-transform' => 'capitalize',
    'font-size' => '14px',
    'letter-spacing' => '1px',
    'color' => '#474747',
  ),
  'cart_dropdown_button' => 'dark',
  'top_navigation' => '0',
  'top_navigation_transparency' => '1',
  'topnav_bg' => 'transparent',
  'topnav_border_top' => 
  array (
    'border-top' => '2px',
    'border-right' => '2px',
    'border-bottom' => '2px',
    'border-left' => '2px',
    'border-style' => 'solid',
    'border-color' => '#dd3333',
  ),
  'topnav_border_bottom' => 
  array (
    'border-top' => '1px',
    'border-right' => '1px',
    'border-bottom' => '1px',
    'border-left' => '1px',
    'border-style' => 'solid',
    'border-color' => '#8e8e8e',
  ),
  'topnav_border_bottom_container' => 
  array (
    'border-top' => '1px',
    'border-right' => '1px',
    'border-bottom' => '1px',
    'border-left' => '1px',
    'border-style' => 'solid',
    'border-color' => '#bcbcbc',
  ),
  'topnav_font_style' => 
  array (
    'font-family' => 'Karla',
    'font-options' => '',
    'google' => '1',
    'font-backup' => '',
    'font-weight' => '',
    'font-style' => '',
    'subsets' => '',
    'font-size' => '13px',
    'color' => '#161616',
  ),
  'topnav_height' => 
  array (
    'height' => '40px',
    'units' => 'px',
  ),
  'page_header_bool' => 1,
  'page_header_height' => 
  array (
    'height' => '100px',
    'units' => 'px',
  ),
  'page_header_style' => 'normal',
  'page_header_f_color' => '#333333',
  'page_header_background' => 
  array (
    'background-color' => '#f5f5f5',
    'background-repeat' => '',
    'background-size' => '',
    'background-attachment' => '',
    'background-position' => '',
    'background-image' => '',
    'media' => 
    array (
      'id' => '',
      'height' => '',
      'width' => '',
      'thumbnail' => '',
    ),
  ),
  'page_header_border' => 
  array (
    'border-top' => '',
    'border-right' => '',
    'border-bottom' => '0px',
    'border-left' => '',
    'border-style' => 'solid',
    'border-color' => '',
  ),
  'sticky' => '0',
  'sticky_header_height' => 
  array (
    'height' => '60px',
    'units' => 'px',
  ),
  'sticky_header_background' => 
  array (
    'color' => '#fff',
    'alpha' => '0.80',
    'rgba' => 'rgba(255,255,255,0.8)',
  ),
  'sticky_logo' => '0',
  'primary_color' => '#8e00fe',
  'body_font_color' => '#9e9e9e',
  'link_font_color' => '#383838',
  'link_font_color_hover' => '#8e00fe',
  'headings_font_color' => '#012b43',
  'base_border_color' => '#e7e7e7',
  'highlighted_background_main' => '#f5f5f5',
  'body_background' => 
  array (
    'background-color' => '',
    'background-repeat' => '',
    'background-size' => '',
    'background-attachment' => '',
    'background-position' => '',
    'background-image' => '',
    'media' => 
    array (
      'id' => '',
      'height' => '',
      'width' => '',
      'thumbnail' => '',
    ),
  ),
  'page_content_background_overall' => 'transparent',
  'page_header_normal_typography' => 
  array (
    'font-weight' => '400',
    'font-style' => '',
    'text-transform' => 'capitalize',
    'font-size' => '24px',
  ),
  'page_header_normal_typography_subtitle_title' => 
  array (
    'font-weight' => '400',
    'font-style' => '',
    'text-transform' => 'capitalize',
    'font-size' => '24px',
  ),
  'page_header_normal_typography_subtitle_subtitle' => 
  array (
    'font-weight' => '400',
    'font-style' => '',
    'text-transform' => 'none',
    'font-size' => '15px',
  ),
  'page_header_centered_typography_nosub_title' => 
  array (
    'font-weight' => '500',
    'font-style' => 'normal',
    'text-transform' => 'none',
    'font-size' => '60px',
    'line-height' => '70px',
  ),
  'page_header_centered_typography_subtitle_title' => 
  array (
    'font-weight' => '500',
    'font-style' => '',
    'text-transform' => 'none',
    'font-size' => '60px',
    'line-height' => '70px',
    'letter-spacing' => '0px',
  ),
  'page_header_centered_typography_subtitle_subtitle' => 
  array (
    'font-family' => 'Courgette',
    'font-options' => '',
    'google' => '1',
    'subsets' => '',
    'text-transform' => 'none',
    'font-size' => '22px',
    'line-height' => '30px',
  ),
  'page_header_design_style' => 'normal',
  'page_header_padd_bg_title' => 
  array (
    'color' => '#000',
    'alpha' => '0.70',
    'rgba' => 'rgba(0,0,0,0.7)',
  ),
  'page_header_padd_bg_subtitle' => 
  array (
    'color' => '#fff',
    'alpha' => '0.70',
    'rgba' => 'rgba(255,255,255,0.7)',
  ),
  'page_header_padd_bg_subtitle_font' => '#222222',
  'fppter_headings_typography' => 
  array (
    'font-weight' => '',
    'font-style' => '',
    'text-transform' => 'uppercase',
    'font-size' => '15px',
    'letter-spacing' => '2px',
    'color' => '#f2f2f2',
  ),
  'footer_body_typography' => 
  array (
    'font-size' => '15px',
    'line-height' => '22px',
    'color' => '#bdbdbd',
  ),
  'footer_links_color' => '#bbbbbb',
  'footer_background_color' => 
  array (
    'background-color' => '#262626',
    'background-repeat' => '',
    'background-size' => '',
    'background-attachment' => '',
    'background-position' => '',
    'background-image' => '',
    'media' => 
    array (
      'id' => '',
      'height' => '',
      'width' => '',
      'thumbnail' => '',
    ),
  ),
  'copyright_background_color' => '#151515',
  'footer_border_top' => 
  array (
    'border-top' => '0px',
    'border-right' => '',
    'border-bottom' => '',
    'border-left' => '',
    'border-style' => 'solid',
    'border-color' => '',
  ),
  'footer_social_icons_bg' => '#333333',
  'footer_social_icons_font_color' => '#ffffff',
  'blog_title_typography' => 
  array (
    'font-family' => 'Montserrat',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '600',
    'font-style' => '',
    'subsets' => '',
    'text-transform' => 'capitalize',
    'font-size' => '28px',
    'line-height' => '34px',
    'color' => '#012b43',
  ),
  'blog_info_typography' => 
  array (
    'font-size' => '12px',
    'line-height' => '22px',
    'color' => '#585858',
  ),
  'blog_info_typography_icon' => 
  array (
    'font-size' => '16px',
  ),
  'timeline_box_shadow' => '1',
  'timeline_bg_color' => '#ffffff',
  'fullscreen_blog_box_bg' => 
  array (
    'color' => '#ffffff',
    'alpha' => '0.00',
    'rgba' => 'rgba(255,255,255,0)',
  ),
  'sidebar_widget_title' => 
  array (
    'font-weight' => '700',
    'font-style' => '',
    'text-transform' => 'uppercase',
    'font-size' => '15px',
    'line-height' => '20px',
    'letter-spacing' => '1px',
    'color' => '#012b43',
  ),
  'sidebar_widget_title_margin' => 
  array (
    'margin-bottom' => '24px',
  ),
  'sidebar_widget_margin' => 
  array (
    'margin-bottom' => '35px',
  ),
  'sidebar_tagcloud_bg' => '#ffffff',
  'sidebar_tagcloud_border' => 
  array (
    'border-top' => '1px',
    'border-right' => '1px',
    'border-bottom' => '1px',
    'border-left' => '1px',
    'border-style' => 'solid',
    'border-color' => '#e5e5e5',
  ),
  'sidebar_tagcloud_color' => '#444444',
  'amos_slider_wrapper_bg' => '#222222',
  'filter_align' => 'center',
  'portfolio_filter_basic_typography' => 
  array (
    'font-weight' => '400',
    'font-style' => '',
    'text-transform' => 'uppercase',
    'font-size' => '15px',
    'letter-spacing' => '0px',
    'color' => '#262626',
  ),
  'portfolio_filter_basic_typography_active' => '#222222',
  'portfolio_filter_full_bg' => '#222222',
  'portfolio_filter_full_link_color' => 
  array (
    'color' => '#ffffff',
    'alpha' => '0.80',
    'rgba' => 'rgba(255,255,255,0.8)',
  ),
  'portfolio_filter_full_link_color_hover' => 
  array (
    'color' => '#ffffff',
    'alpha' => '1.00',
    'rgba' => 'rgba(255,255,255,1)',
  ),
  'portfolio_overlay_style' => 'custom_gradient',
  'portfolio_overlay_bg' => 
  array (
    'color' => '#5198ff',
    'alpha' => '0.82',
    'rgba' => 'rgba(81,152,255,0.82)',
  ),
  'portfolio_overlay_bg_grad1' => 
  array (
    'color' => '#1673ff',
    'alpha' => '0.82',
    'rgba' => 'rgba(22,115,255,0.82)',
  ),
  'portfolio_overlay_bg_grad2' => 
  array (
    'color' => '#6c45c6',
    'alpha' => '0.82',
    'rgba' => 'rgba(108,69,198,0.82)',
  ),
  'portfolio_overlay_title' => 
  array (
    'font-weight' => '600',
    'font-style' => '',
    'text-transform' => 'capitalize',
    'letter-spacing' => '0px',
    'color' => '#fff',
  ),
  'portfolio_overlay_subtitle' => 
  array (
    'font-weight' => '400',
    'font-style' => '',
    'text-transform' => 'none',
    'font-size' => '14px',
    'color' => '#fff',
  ),
  'portfolio_grayscale_bg' => '#212121',
  'portfolio_grayscale_title' => 
  array (
    'font-weight' => '500',
    'font-style' => '',
    'color' => '#fff',
  ),
  'portfolio_grayscale_subtitle' => '#eaeaea',
  'portfolio_basic_overlay_bg' => 
  array (
    'color' => '#fff',
    'alpha' => '1.0',
    'rgba' => 'rgba(255,255,255,1)',
  ),
  'portfolio_parallax_bg' => 
  array (
    'color' => '#fff',
    'alpha' => '1.0',
    'rgba' => 'rgba(255,255,255,1)',
  ),
  'portfolio_basic_overlay_icon_color' => '#000000',
  'portfolio_basic_title' => 
  array (
    'font-weight' => '500',
    'font-style' => '',
    'text-align' => 'left',
    'text-transform' => 'capitalize',
    'letter-spacing' => '0px',
    'color' => '#222',
  ),
  'portfolio_basic_subtitle' => 
  array (
    'font-weight' => '400',
    'font-style' => '',
    'text-align' => 'left',
    'color' => '#565656',
  ),
  'toggle_title_typography' => 
  array (
    'font-weight' => '',
    'font-style' => '',
    'text-transform' => 'none',
    'font-size' => '13px',
    'letter-spacing' => '1px',
    'color' => '#555',
  ),
  'tooggle_bg_color' => 
  array (
    'background-color' => '',
    'background-repeat' => '',
    'background-size' => '',
    'background-attachment' => '',
    'background-position' => '',
    'background-image' => '',
    'media' => 
    array (
      'id' => '',
      'height' => '',
      'width' => '',
      'thumbnail' => '',
    ),
  ),
  'toggle_active_color' => '#5198ff',
  'tabs_background_color' => 
  array (
    'background-color' => '',
    'background-repeat' => '',
    'background-size' => '',
    'background-attachment' => '',
    'background-position' => '',
    'background-image' => '',
    'media' => 
    array (
      'id' => '',
      'height' => '',
      'width' => '',
      'thumbnail' => '',
    ),
  ),
  'tabs_font_color' => '#ffffff',
  'block_title_text_above' => 
  array (
    'font-family' => 'Open Sans',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '600',
    'font-style' => '',
    'subsets' => '',
    'text-align' => 'center',
    'text-transform' => 'uppercase',
    'font-size' => '14px',
    'line-height' => '28px',
    'letter-spacing' => '2px',
    'color' => '#879298',
  ),
  'block_title_column_title' => 
  array (
    'font-family' => 'Montserrat',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '700',
    'font-style' => '',
    'subsets' => '',
    'text-align' => 'left',
    'text-transform' => 'none',
    'line-height' => '52px',
    'letter-spacing' => '0px',
    'color' => '#012b43',
  ),
  'block_title_column_subtitle' => 
  array (
    'font-family' => 'Open Sans',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '400',
    'font-style' => '',
    'subsets' => '',
    'text-align' => 'left',
    'text-transform' => 'none',
    'font-size' => '15px',
    'line-height' => '28px',
    'color' => '#879298',
  ),
  'block_title_section_title' => 
  array (
    'font-family' => 'Montserrat',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '700',
    'font-style' => '',
    'subsets' => '',
    'text-transform' => 'capitalize',
    'line-height' => '52px',
    'letter-spacing' => '0px',
    'color' => '#012b43',
  ),
  'block_title_section_desc' => 
  array (
    'font-family' => 'Open Sans',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '400',
    'font-style' => '',
    'subsets' => '',
    'text-transform' => '',
    'font-size' => '15px',
    'line-height' => '28px',
    'letter-spacing' => '0px',
    'color' => '#879298',
  ),
  'animated_counter_typ' => 
  array (
    'font-family' => 'Montserrat',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '700',
    'font-style' => '',
    'subsets' => '',
    'font-size' => '38px',
    'line-height' => '48px',
    'letter-spacing' => '0px',
    'color' => '#8e00fe',
  ),
  'testimonial_text' => 
  array (
    'font-weight' => '400',
    'font-style' => '',
    'font-size' => '17px',
    'line-height' => '30px',
    'color' => '#444',
  ),
  'textbar_title_typography' => 
  array (
    'font-weight' => '',
    'font-style' => '',
    'text-transform' => 'none',
    'font-size' => '22px',
    'letter-spacing' => '0px',
    'color' => '#222',
  ),
  'contact_border' => '#ececec',
  'overall_button_style' => 
  array (
    0 => 'default',
  ),
  'button_typography' => 
  array (
    'font-family' => 'Montserrat',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '400',
    'font-style' => '',
    'subsets' => '',
    'text-transform' => 'uppercase',
    'font-size' => '12px',
    'line-height' => '13px',
    'letter-spacing' => '2px',
    'color' => '#ffffff',
  ),
  'button_gradient_color1' => 
  array (
    'color' => '#000000',
    'alpha' => '1.0',
    'rgba' => 'rgba(0,0,0,1)',
  ),
  'button_gradient_color2' => 
  array (
    'color' => '#000000',
    'alpha' => '1.0',
    'rgba' => 'rgba(0,0,0,1)',
  ),
  'button_background_color' => 
  array (
    'color' => '#8e00fe',
    'alpha' => '1',
    'rgba' => 'rgba(142,0,254,1)',
  ),
  'button_border_color' => 
  array (
    'color' => '#8e00fe',
    'alpha' => '1',
    'rgba' => 'rgba(142,0,254,1)',
  ),
  'button_hover_font_color' => '#ffffff',
  'button_hover_background' => 
  array (
    'color' => '#640aaa',
    'alpha' => '1',
    'rgba' => 'rgba(100,10,170,1)',
  ),
  'button_hover_border' => 
  array (
    'color' => '#640aaa',
    'alpha' => '1',
    'rgba' => 'rgba(100,10,170,1)',
  ),
  'button_light_font_color' => '#5198ff',
  'button_light_gradient_color1' => 
  array (
    'color' => '#000000',
    'alpha' => '1.0',
    'rgba' => 'rgba(0,0,0,1)',
  ),
  'button_light_gradient_color2' => 
  array (
    'color' => '#000000',
    'alpha' => '1.0',
    'rgba' => 'rgba(0,0,0,1)',
  ),
  'button_light_background' => 
  array (
    'color' => '#fff',
    'alpha' => '1.0',
    'rgba' => 'rgba(255,255,255,1)',
  ),
  'button_light_border' => 
  array (
    'color' => '#fff',
    'alpha' => '1.0',
    'rgba' => 'rgba(255,255,255,1)',
  ),
  'button_light_hover_font_color' => '#ffffff',
  'button_light__hover_background' => 
  array (
    'color' => '#fff',
    'alpha' => '0.00',
    'rgba' => 'rgba(255,255,255,0)',
  ),
  'button_light_hover_border' => 
  array (
    'color' => '#fff',
    'alpha' => '1.00',
    'rgba' => 'rgba(255,255,255,1)',
  ),
  'shop_single_title' => 
  array (
    'font-weight' => '300',
    'font-style' => '',
    'text-transform' => 'capitalize',
    'letter-spacing' => '1',
  ),
  'shop_product_overlay' => 
  array (
    'color' => '#fffffff',
    'alpha' => '0.80',
    'rgba' => 'rgba(255,255,255,0.8)',
  ),
  'body_typography' => 
  array (
    'font-family' => 'Open Sans',
    'font-options' => '',
    'google' => '1',
    'font-backup' => '',
    'font-weight' => '400',
    'font-style' => '',
    'subsets' => '',
    'font-size' => '15px',
    'line-height' => '28px',
    'letter-spacing' => '0px',
    'color' => '#879298',
  ),
  'headings_font_type' => 
  array (
    'font-family' => 'Montserrat',
    'font-options' => '',
    'google' => '1',
    'font-weight' => '700',
    'font-style' => '',
    'letter-spacing' => '0px',
  ),
  'heading_1_font' => 
  array (
    'font-size' => '24px',
    'line-height' => '52px',
  ),
  'heading_2_font' => 
  array (
    'font-size' => '21px',
    'line-height' => '28px',
  ),
  'heading_3_font' => 
  array (
    'font-size' => '18px',
    'line-height' => '26px',
  ),
  'heading_4_font' => 
  array (
    'font-size' => '16px',
    'line-height' => '24px',
  ),
  'heading_5_font' => 
  array (
    'font-size' => '14px',
    'line-height' => '22px',
  ),
  'heading_6_font' => 
  array (
    'font-size' => '12px',
    'line-height' => '20px',
  ),
  'footer_columns' => '4',
  'footer_container_full' => '0',
  'copyright_text' => '© 2018 Amos - Multi-Purpose theme from Elle Themes, built with <a href="#">WordPress</a>',
  'show_footer' => '1',
  'reveal_footer' => '0',
  'center_footer' => '0',
  'show_copyright' => '1',
  'blog_style' => 'normal',
  'blog_grid_col' => '4',
  'bloglayout' => 'fullwidth',
  'blog_post_style' => 'normal',
  'singlebloglayout' => 'sidebar_right',
  'related_posts' => '0',
  'post_like' => '0',
  'social_shares' => '0',
  'blog_pagination' => 'with_pagination',
  'blog_info_author' => '1',
  'blog_info_date' => '1',
  'blog_info_comments' => '1',
  'blog_info_tags' => '1',
  'portfolio_slug' => 'amos_portfolio',
  'single_portfolio_custom_params' => 
  array (
    0 => '',
  ),
  'portfolio_post_like' => '0',
  'site_layout' => 'fullwidth',
  'page_overall_layout' => 'fullwidth',
  'page_container_width' => 
  array (
    'width' => '1200px',
    'units' => 'px',
  ),
  'page_container_width_percent' => 
  array (
    'width' => '87%',
    'units' => '%',
  ),
  'boxed_container_width' => 
  array (
    'width' => '1100px',
    'units' => 'px',
  ),
  'boxed_container_width_percent' => 
  array (
    'width' => '87%',
    'units' => '%',
  ),
  'boxed_container_margin' => 
  array (
    'margin-top' => '30px',
    'margin-bottom' => '30px',
  ),
  'boxed_shadow' => '1',
  'boxed_border' => 
  array (
    'border-top' => '',
    'border-right' => '',
    'border-bottom' => '',
    'border-left' => '',
    'border-style' => 'solid',
    'border-color' => '#e7e7e7',
  ),
  'extra_navigation' => '0',
  'extra_navigation_position' => 'right',
  'row_margin_bottom' => 
  array (
    'margin-bottom' => '70px',
  ),
  'content_padding' => 
  array (
    'padding-top' => '70px',
    'padding-bottom' => '70px',
  ),
  'outter_padding' => '0',
  'outter_padding_color' => 
  array (
    'color' => '#000000',
    'alpha' => '0.95',
    'rgba' => 'rgba(0,0,0,0.95)',
  ),
  'clients_dark' => 
  array (
    0 => 
    array (
      'title' => '',
      'description' => '',
      'url' => '',
      'sort' => '0',
      'attachment_id' => '',
      'thumb' => '',
      'image' => '',
      'height' => '',
      'width' => '',
    ),
  ),
  'clients_light' => 
  array (
    0 => 
    array (
      'title' => '',
      'description' => '',
      'url' => '',
      'sort' => '0',
      'attachment_id' => '',
      'thumb' => '',
      'image' => '',
      'height' => '',
      'width' => '',
    ),
  ),
  'facebook' => '#',
  'twitter' => '#',
  'flickr' => '',
  'foursquare' => '',
  'google' => '#',
  'dribbble' => '#',
  'linkedin' => '',
  'youtube' => '',
  'instagram' => '',
  'pinterest' => '',
  'email' => '',
  'codeless_import_export' => 'default',
  'single_custom_link_switch' => 0,
  'single_custom_link' => '',
  'single_portfolio_style' => 'container',
  'single_portfolio_content_position_floating' => 'right',
  'single_portfolio_content_position_container' => 'right',
  'single_portfolio_media' => 'featured',
  'single_portfolio_video' => '',
  'single_portfolio_gallery' => '',
  'single_portfolio_active_comments' => 0,
  'single_portfolio_custom_fields' => '',
  'portfolio_categories' => '',
  'portfolio_mode' => 'grid',
  'portfolio_slider_content_position' => 'center',
  'portfolio_slider_content_color' => 'light',
  'portfolio_slider_overlay' => 0,
  'portfolio_slider_overlay_color' => 
  array (
    'color' => '#222',
    'alpha' => 0.8000000000000000444089209850062616169452667236328125,
  ),
  'portfolio_columns' => '3',
  'portfolio_style' => 'overlayed',
  'portfolio_layout' => 'in_container',
  'portfolio_space' => 'normal',
  'portfolio_content' => 'top',
  'portfolio_pagination' => 'with_pagination',
  'portfolio_filters' => 'normal',
  'overwrite_layout' => 0,
  'layout' => 'fullwidth',
  'left_sidebar_dual' => '',
  'right_sidebar_dual' => '',
  'page_header_overwrite' => 0,
  'page_header_fullscreen' => 0,
  'subtitle_bool' => 0,
  'subtitle' => 'A sample page description',
  'slider_type' => 'none',
  'gallery' => '',
  'gallery_effect' => 'amos',
  'revslider' => 'none',
  'layerslider' => 'none',
  'amos_slider' => '',
  'amos_slider_speed' => '10000',
  'amos_slider_height' => '',
  'amos_news_featured_1' => '',
  'amos_news_featured_2' => '',
  'slider_layout' => 'boxed',
  'slider_fixed' => 0,
  'slider_parallax' => 0,
  'slider_shapes' => 'normal',
  'slider_onmobile_remove' => 0,
  'page_content_background' => '',
  'fixed_header_page' => '0',
  'page_header_menu_color' => 'light',
  'one_page_active' => '0',
  'fullscreen_sections_active' => '0',
  'use_featured_image_as_photo' => 1,
  'staff_position' => '',
  'facebook_link' => '#',
  'twitter_link' => '#',
  'google_link' => '#',
  'pinterest_link' => '',
  'linkedin_link' => '',
  'instagram_link' => '',
  'mail_link' => '',
  'fullscreen_post_style' => 0,
  'fullscreen_post_effect' => 'fadeInLeft',
  'fullscreen_post_delay' => '200',
  'fullscreen_post_position' => 'left',
  'future_date_events' => '',
  'media_post_link' => '',
  'slide_background_type' => 'image',
  'slide_background_image' => '',
  'slide_mp4_video' => '',
  'slide_webm_video' => '',
  'slide_ogg_video' => '',
  'slide_mobile_video' => '',
  'slide_bg_overlay' => 
  array (
    'color' => '',
    'alpha' => '1.0',
  ),
  'slide_title' => '',
  'slide_title_style' => 
  array (
    'color' => '#222',
    'font-style' => '700',
    'text-align' => 'center',
    'font-family' => 'Open Sans',
    'google' => true,
    'font-size' => '33px',
    'line-height' => '40',
    'letter-spacing' => '1.8px',
  ),
  'slide_title_bg' => 
  array (
    'color' => '#000000',
    'alpha' => '0',
  ),
  'slide_title_padding' => 
  array (
    'padding-left' => '0px',
    'padding-right' => '0px',
    'padding-top' => '0px',
    'padding-bottom' => '0px',
  ),
  'slide_title_animation' => 'fadeInDown',
  'slide_description' => '',
  'slide_description_style' => 
  array (
    'color' => '#666',
    'font-style' => '400',
    'text-align' => 'center',
    'font-family' => 'Open Sans',
    'google' => true,
    'font-size' => '20px',
    'line-height' => '32',
  ),
  'slide_description_animation' => 'fadeInDown',
  'slide_image_switch' => 0,
  'slide_image_top' => 
  array (
    'url' => '',
  ),
  'slide_image_alignment' => 'center',
  'slide_image_dimension' => 
  array (
    'Width' => '200',
    'Height' => '100',
  ),
  'slide_button1' => '',
  'slide_button1_link' => '',
  'slide_button1_style' => 'bordered',
  'slide_button2' => '',
  'slide_button2_link' => '',
  'slide_button2_style' => 'bordered',
  'slide_buttons_colors' => 'light',
  'slide_content_position' => 'in_middle',
  'slide_content_position_absolute' => 
  array (
    'top' => '',
    'bottom' => '',
    'left' => '',
    'right' => '',
  ),
  'slide_content_width' => '700px',
  'remove_container' => 0,
  'slider_menu_nav_colors' => 'light',
);
  }
}





?>