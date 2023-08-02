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

    // $wp_customize->add_setting(
    //     'footertext_control_content',
    //     array(
    //         'default' => '',
    //         'type' => 'footertext',
    //         'capability' => 'edit_theme_options',
    //         'transport' => 'refresh',
    //     )
    // );
    // $wp_customize->add_control(
    //     new Custom_Text_Control(
    //         $wp_customize,
    //         'footertext_control',
    //         array(
    //             'label' => 'Footer Content',
    //             'section' => 'footer_content',
    //             'settings' => 'footertext_control_content'
    //         )
    //     )
    // );
}
add_action('customize_register', 'unko_customizer');
