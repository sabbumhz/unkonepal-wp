<?php

    $args = array(
        'role'    => 'knitter',
        'orderby' => 'display_name',
        'order'   => 'ASC'
    );
    $users = get_users( $args );
    global $wp;
    $current_url =  home_url( $wp->request );
    echo '<ul>';
    foreach ( $users as $user ) {?>
        <li><a href="<?php echo $current_url. '?userid='. $user->id?>"><?php echo esc_html( $user->display_name )?></a></li>
        <li><?php echo '[' . esc_html( $user->user_email ) . ']'?></li>
        <li><?php echo $user->profile_image?wp_get_attachment_image($user->profile_image):"No image"; ?></li>
    <?php }
    echo '</ul>';

?>