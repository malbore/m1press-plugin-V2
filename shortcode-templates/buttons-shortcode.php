<?php

$add_class = $add_class ? $add_class : '';
$btn_align = $btn_align ? $btn_align : '';
// array with link data
$link_data = vc_build_link($btn_link);
// target
$target = $link_data['target'] ? 'target=' . $link_data['target'] : '';
// link parsed
$link = parse_url($link_data['url']);

if (isset($link['fragment'])) {
  $url = '#' . $link['fragment'];
} else {
  $url = $link['path'];
}

echo "<div class='{$add_class} {$btn_align} btn_{$btn_type}_{$btn_color}'><a class='lien_btn smoothScroll' href='{$url}' {$target}><span>{$btn_text}</span></a></div>";
