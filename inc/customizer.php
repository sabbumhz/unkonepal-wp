<?php
# ------------------------------------------
# REGISTER FOOTER OPTIONS
# ------------------------------------------
function unko_customizer($wp_customize)
{
    class Custom_Text_Control extends WP_Customize_Control
    {
        public $type = 'footertext';
        public $extra = ''; // we add this for the extra description
        public function render_content()
        {
            ?>
            <label>
            <span><?php echo esc_html($this->extra); ?></span>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <input type="text" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            </label>
            <?php
        }
    }

    $wp_customize->add_section(
        'footer_content',
        array(
            'title'=>__('Footer Description', 'mytheme'),
            )
    );

    $wp_customize->add_section(
        'subscibe_shortcode_content',
        array(
            'title'=>__('Subscribe Shortcode', 'mytheme'),
            )
    );

    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('unkonepal_theme_options[text_footer_content]', array(
        'default'        => 'Unko Nepal',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('unkonepal_text_footer', array(
        'label'      => __('Footer Content', 'unkonepal'),
        'section'    => 'footer_content',
        'settings'   => 'unkonepal_theme_options[text_footer_content]',
    ));

    $wp_customize->add_setting('unkonepal_subscibe_options[subscibe_shortcode]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('unkonepal_subscibe_shortcode', array(
        'label'      => __('Shorcode', 'unkonepal'),
        'section'    => 'subscibe_shortcode_content',
        'settings'   => 'unkonepal_subscibe_options[subscibe_shortcode]',
    ));

}
add_action('customize_register', 'unko_customizer');
