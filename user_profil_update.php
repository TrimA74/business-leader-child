<?php
wp_head();

$is_user_update_in=wp_get_current_user()->ID;
echo $is_user_update_in;
?>