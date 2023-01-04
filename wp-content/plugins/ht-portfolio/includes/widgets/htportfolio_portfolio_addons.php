<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class HTPortfolio_Elementor_Widget_Portfolio extends Widget_Base {


    public function get_name() {
        return 'htportfolio-portfolio-addons';
    }
    
    public function get_title() {
        return __( 'HT Portfolio : Portfolio', 'htportfolio' );
    }

    public function get_icon() {
        return 'eicon-gallery-justified';
    }

    public function get_categories() {
        return [ 'htportfolio' ];
    }

    protected function register_controls() {
        // Content section
        $this->start_controls_section(
            'item_filltter_content_section',
            [
                'label' => __( 'Filtter Content', 'htportfolio' ),
            ]
        );
            $this->add_control(
                'item_layout_style',
                [
                    'label' => esc_html__( 'Select Style', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options' => [
                        'style1' => esc_html__( 'Style One', 'htportfolio' ),
                        'style2' => esc_html__( 'Style Two', 'htportfolio' ),
                    ],
                ]
            );  
            $this->add_control(
                'filttering_title',
                [
                    'label' => __( 'Filtter Options', 'htportfolio' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            $this->add_control(
                'filter_show_hide',
                [
                    'label' => esc_html__( 'Filter Menu Show/Hide', 'htportfolio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );                    
            $this->add_control(
                'htportfolio_item_categories',
                [
                    'label' => esc_html__( 'Select Item Category', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => ht_portfolios_categories(),
                ]
            );
            $this->add_control(
                'all_btn_show_hide',
                [
                    'label' => esc_html__( 'All Menu Show/Hide', 'htportfolio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'all_btn_text',
                [
                    'label' => __( 'All Button Text', 'htportfolio' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'All',
                    'title' => __( 'Enter All Button Text', 'htportfolio' ),
                    'condition' => [
                        'all_btn_show_hide' => 'yes',
                    ]
                ]
            );

    $this->end_controls_section();
    // End Content section   
    // Item Content section
    $this->start_controls_section(
        'item_option',
        [
            'label' => __( 'Display Option', 'htportfolio' ),
        ]
    );   
            $this->add_control(
              'htportfolio_all_item',
              [
                 'label'   => __( 'Show All Item Number', 'htportfolio' ),
                 'type'    => Controls_Manager::NUMBER,
                 'default' => 6,
                 'min'     => 2,
                 'max'     => 1000,
                 'step'    => 1,
              ]
            );
            $this->add_control(
                'htportfolio_item_column',
                [
                    'label' => esc_html__( 'Show Columns', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1' => esc_html__( '1', 'htportfolio' ),
                        '2' => esc_html__( '2', 'htportfolio' ),
                        '3' => esc_html__( '3', 'htportfolio' ),
                        '4' => esc_html__( '4', 'htportfolio' ),
                        '5' => esc_html__( '5', 'htportfolio' ),
                        '6' => esc_html__( '6', 'htportfolio' ),
                    ],
                ]
            ); 
            $this->add_control(
                'htportfolio_item_column_md',
                [
                    'label' => esc_html__( 'Number Of Columns Displayed (Tab)', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1' => esc_html__( '1', 'htportfolio' ),
                        '2' => esc_html__( '2', 'htportfolio' ),
                        '3' => esc_html__( '3', 'htportfolio' ),
                        '4' => esc_html__( '4', 'htportfolio' ),
                    ],
                ]
            );
            $this->add_control(
                'htportfolio_item_column_sm',
                [
                    'label' => esc_html__( 'Number Of Columns Displayed (Large Mobile)', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '2',
                    'options' => [
                        '1' => esc_html__( '1', 'htportfolio' ),
                        '2' => esc_html__( '2', 'htportfolio' ),
                        '3' => esc_html__( '3', 'htportfolio' ),
                        '4' => esc_html__( '4', 'htportfolio' ),
                    ],
                ]
            );
           $this->add_control(
                'htportfolio_item_order',
                [
                    'label' => esc_html__( 'Order By', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'ASC',
                    'options' => [
                        'ASC' => esc_html__( 'Ascending', 'htportfolio' ),
                        'DESC' => esc_html__( 'Descending', 'htportfolio' ),
                    ],
                ]
            );
            $this->add_responsive_control(
              'htportfolio_item_gutter',
              [
                 'label'   => __( 'Item Gutter', 'htportfolio' ),
                 'type'    => Controls_Manager::NUMBER,
                 'default' => 20,
                 'min'     => 0,
                 'max'     => 100,
                 'step'    => 1,
              ]
            );
             $this->add_control(
                'show_hide_portfolio_title',
                [
                    'label' => esc_html__( 'Portfolio Title Show/Hide', 'htportfolio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            ); 
            $this->add_control(
                'show_hide_portfolio_category',
                [
                    'label' => esc_html__( 'Portfolio Category Show/Hide', 'htportfolio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );           
    $this->end_controls_section();
    // End Content section   
    // Item Content section
    $this->start_controls_section(
        'item_option_link',
        [
            'label' => __( 'Link Button Options', 'htportfolio' ),
        ]
    );             

            $this->add_control(
                'icon_show_hide',
                [
                    'label' => esc_html__( 'Link/Popup Show/Hide', 'htportfolio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'display_option_type',
                [
                    'label' => esc_html__( 'Select Option', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'popup' => esc_html__( 'Popup', 'htportfolio' ),
                        'link' => esc_html__( 'Link', 'htportfolio' ),
                    ],
                    'condition' => [
                        'icon_show_hide' => 'yes',
                    ]  
                ]
            );            
            $this->add_control(
                'link_icon_type',
                [
                    'label' => esc_html__( 'Image popup Icon', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'icon' => esc_html__( 'Icon', 'htportfolio' ),
                        'image' => esc_html__( 'Image', 'htportfolio' ),
                        'link_text' => esc_html__( 'Text', 'htportfolio' ),
                    ],
                    'condition' => [
                        'icon_show_hide' => 'yes',
                    ]  
                ]
            );
            $this->add_control(
                'link_btn_text',
                [
                    'label' => __( 'Link Button Text', 'htportfolio' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'View Details',
                    'title' => __( 'Enter All Button Text', 'htportfolio' ),
                    'condition' => [
                        'icon_show_hide' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'link_icon_iamge',
                [
                    'label' => __( 'Icon image', 'htportfolio' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'icon_show_hide' => 'yes',
                        'link_icon_type' => 'image',
                    ]
                ]
            );
            $this->add_control(
                'link_icon_font',
                [
                    'label' => __( 'Icon', 'htportfolio' ),
                    'type' => Controls_Manager::ICONS,
                    'default' =>[
                        'value' => 'eicon-image-bold',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'icon_show_hide' => 'yes',
                        'link_icon_type' => 'icon',
                    ]
                ]
            );
            $this->add_control(
                'item_video_option',
                [
                    'label' => __( 'Video Popup Options', 'htportfolio' ),
                    'type' => Controls_Manager::HEADING,
                    'condition' => [
                        'icon_show_hide' => 'yes',
                    ]
                ]
            );
           $this->add_control(
                'video_icon_type',
                [
                    'label' => esc_html__( 'Video popup Icon', 'htportfolio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'icon' => esc_html__( 'Icon', 'htportfolio' ),
                        'image' => esc_html__( 'Image', 'htportfolio' ),
                        'vd_text' => esc_html__( 'Text', 'htportfolio' ),
                    ],
                    'condition' => [
                        'icon_show_hide' => 'yes',
                    ]                    
                ]
            );
            $this->add_control(
                'video_icon_iamge',
                [
                    'label' => __( 'Icon image', 'htportfolio' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'icon_show_hide' => 'yes',
                        'video_icon_type' => 'image',
                    ]
                ]
            );
            $this->add_control(
                'video_icon_font',
                [
                    'label' => __( 'Icon', 'htportfolio' ),
                    'type' => Controls_Manager::ICONS,
                    'default' =>[
                        'value'=>'eicon-video-playlist',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'icon_show_hide' => 'yes',
                        'video_icon_type' => 'icon',
                    ]
                ]
            );
            $this->add_control(
                'video_btn_text',
                [
                    'label' => __( 'Video Button Text', 'htportfolio' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'View Details',
                    'title' => __( 'Enter All Button Text', 'htportfolio' ),
                    'condition' => [
                        'icon_show_hide' => 'yes',
                    ]
                ]
            );            

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'item_style',
            [
                'label' => __( 'Filter Menu Style', 'htportfolio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs(
                'style_tabs'
            );

                // Normal style tab
                $this->start_controls_tab(
                    'style_normal_tab',
                    [
                        'label' => __( 'Normal', 'htportfolio' ),
                    ]
                );
                    $this->add_control(
                        'filter_box_style',
                        [
                            'label' => __( 'Filter Box  Style', 'htportfolio' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $this->add_control(
                        'filter_box_bg_color',
                        [
                            'label' => __( 'Filter Box BG COlor', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'rgba(0,0,0,0)',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list' => 'background: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'filter_box_border',
                            'label' => __( 'Box Border', 'htportfolio' ),
                            'selector' => '{{WRAPPER}} .htportfolio-filter-menu-list',
                        ]
                    ); 
                    $this->add_control(
                        'filter_box_radius',
                        [
                            'label' => __( 'Border Radius', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],

                        ]
                    );
                    $this->add_responsive_control(
                        'filter_box_padding',
                        [
                            'label' => __( 'Padding', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],

                        ]
                    );
                    $this->add_responsive_control(
                        'filter_box_margin',
                        [
                            'label' => __( 'Margin', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],

                        ]
                    );
                    $this->add_responsive_control(
                        'filter_box_alignment',
                        [
                            'label' => __( 'Alignment', 'htportfolio' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'htportfolio' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'htportfolio' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'htportfolio' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'default' => 'center',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                    // Filtter Button Style
                    $this->add_control(
                        'filter_style',
                        [
                            'label' => __( 'Filter Button Style', 'htportfolio' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );
                    $this->add_control(
                        'fillter_buttion_color',
                        [
                            'label' => __( 'Button Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#666',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list button' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'fillter_buttion_bg_color',
                        [
                            'label' => __( 'Button BG Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'rgba(0,0,0,0)',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list button' => 'background: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'buttion_border',
                            'label' => __( 'Button Border', 'htportfolio' ),
                            'selector' => '{{WRAPPER}} .htportfolio-filter-menu-list button',
                        ]
                    ); 
                    $this->add_control(
                        'button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],

                        ]
                    );
                    $this->add_responsive_control(
                        'button_border_padding',
                        [
                            'label' => __( 'Button Padding', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],

                        ]
                    );
                    $this->add_responsive_control(
                        'button_border_margin',
                        [
                            'label' => __( 'Button Margin', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],

                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'icon_typography_fillter',
                            'selector' => '{{WRAPPER}} .htportfolio-filter-menu-list button',
                        ]
                    );
                $this->end_controls_tab();

                //Filtter Hover Style tab
                $this->start_controls_tab(
                    'filter_menu_hover_tab',
                    [
                        'label' => __( 'Hover', 'htportfolio' ),
                    ]
                );
                    $this->add_control(
                        'filter_style_hover',
                        [
                            'label' => __( 'Filter Button Hover/Acitive Style', 'htportfolio' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );
                    $this->add_control(
                        'fillter_buttion_hover_color',
                        [
                            'label' => __( 'Button Hover Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#e03927',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list button:hover, {{WRAPPER}} .htportfolio-filter-menu-list button.is-checked ' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'fillter_buttion_hover_bg_color',
                        [
                            'label' => __( 'Button Hover BG Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'rgba(0,0,0,0)',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-filter-menu-list button:hover,{{WRAPPER}} .htportfolio-filter-menu-list button.is-checked' => 'background: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'buttion_border_hover',
                            'label' => __( 'Button Border', 'htportfolio' ),
                            'selector' => '{{WRAPPER}} .htportfolio-filter-menu-list button',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'buttion_border_act_hover',
                            'label' => __( 'Button Border Active', 'htportfolio' ),
                            'selector' => '{{WRAPPER}} .htportfolio-filter-menu-list button.is-checked',
                        ]
                    );
                    $this->end_controls_tab();
                $this->end_controls_tabs();
        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'item_box_filtter_style',
            [
                'label' => __( 'Item Box Style', 'htportfolio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs(
                'style_tabs_item_box'
            );

                // Normal style tab
                $this->start_controls_tab(
                    'item_boxt_normal_tabs',
                    [
                        'label' => __( 'Normal', 'htportfolio' ),
                    ]
                );
                $this->add_control(
                    'item_box_bg_style',
                    [
                        'label' => __( 'Item Box BG Style', 'htportfolio' ),
                        'type' => Controls_Manager::HEADING,
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'item_box_bg_color',
                        'label' => __( 'Box Bg Color', 'htportfolio' ),
                        'types' => [ 'classic', 'gradient' ],
                        'default' =>'rgba(0,0,0,0)',
                        'selector' => '{{WRAPPER}} .htportfolio-ft_item_image::before',
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'item_box_border',
                        'label' => __( 'Box Border', 'htportfolio' ),
                        'selector' => '{{WRAPPER}} .htportfolio-ft_item_image',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'item_box_shadow',
                        'label' => __( 'Box Shadow', 'htportfolio' ),
                        'selector' => '{{WRAPPER}} .htportfolio-ft_item_image',
                    ]
                );
                $this->end_controls_tab();

                // Hover Box tab
                $this->start_controls_tab(
                    'item_box_bg_color_hover',
                    [
                        'label' => __( 'Hover', 'htportfolio' ),
                    ]
                );
                $this->add_control(
                    'item_box_style_hover',
                    [
                        'label' => __( 'Item Box Hover Style', 'htportfolio' ),
                        'type' => Controls_Manager::HEADING,
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'item_box_background_hvr',
                        'label' => __( 'Box Bg Hover Color', 'htportfolio' ),
                        'types' => [ 'classic', 'gradient' ],
                        'default' =>'rgba(0,0,0,0.4)',
                        'selector' => '{{WRAPPER}} .htportfolio-grid-item:hover .htportfolio-ft_item_image::before',
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'item_box_background_hvr_two',
                        'label' => __( 'Box Bg Hover Color Two', 'htportfolio' ),
                        'types' => [ 'classic', 'gradient' ],
                        'default' =>'rgba(0,0,0,0.4)',
                        'selector' => '{{WRAPPER}} .htportfolio-grid-item:hover .portfolio-fimage::before',
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'item_box_border_hvr',
                        'label' => __( 'Box Border Hover', 'htportfolio' ),
                        'selector' => '{{WRAPPER}} .htportfolio-grid-item:hover .htportfolio-ft_item_image',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'item_box_shadow_hvr',
                        'label' => __( 'Box Shadow', 'htportfolio' ),
                        'selector' => '{{WRAPPER}} .htportfolio-grid-item:hover .htportfolio-ft_item_image',
                    ]
                );
                $this->end_controls_tab();
                $this->end_controls_tabs();
            $this->end_controls_section();

        // Box tab section
        $this->start_controls_section(
            'item_box_link_style',
            [
                'label' => __( 'Link Icon Style', 'htportfolio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs(
                'style_link_icon_item'
            );

            // Normal style tab
            $this->start_controls_tab(
                'item_link_normal_tabs',
                [
                    'label' => __( 'Normal', 'htportfolio' ),
                ]
            );
                    $this->add_control(
                        'item_icon_style_heading',
                        [
                            'label' => __( 'Item Link Style', 'htportfolio' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );                    
                    $this->add_control(
                        'item_link_color',
                        [
                            'label' => __( 'Link Icon Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#fff',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'item_link_bg_color',
                        [
                            'label' => __( 'Link Icon BG Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'rgba(0,0,0,0)',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link' => 'background: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border_icone',
                            'label' => __( 'Icon Border', 'htportfolio' ),
                            'selector' => '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link',
                        ]
                    ); 
                    $this->add_control(
                        'icon_border_radius',
                        [
                            'label' => __( 'Border Radius', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],

                        ]
                    );
                    $this->add_responsive_control(
                        'icon_width',
                        [
                            'label' => __( 'Icon Width', 'htportfolio' ),
                            'type' => Controls_Manager::NUMBER,
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link' => 'width: {{VALUE}}px;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_height',
                        [
                            'label' => __( 'Icon Height', 'htportfolio' ),
                            'type' => Controls_Manager::NUMBER,
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link' => 'height: {{VALUE}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'icon_typography',
                            'selector' => '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link',
                        ]
                    );
                    $this->add_responsive_control(
                        'link_button_margin',
                        [
                            'label' => __( 'Margin', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],

                        ]
                    );
            $this->end_controls_tab();

            // Link Hover style tab
            $this->start_controls_tab(
                'item_link_tabs_hover',
                [
                    'label' => __( 'Hover', 'htportfolio' ),
                ]
            );
                    $this->add_control(
                        'item_icon_style',
                        [
                            'label' => __( 'Item Link Hover Style', 'htportfolio' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );                    
                    $this->add_control(
                        'item_link_hover_color',
                        [
                            'label' => __( 'Link Icon Hover Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#fff',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'item_link_bg_hover_color',
                        [
                            'label' => __( 'Link Icon Hover BG Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'rgba(0,0,0,0)',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link:hover' => 'background: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border_icone_hover',
                            'label' => __( 'Icon Border', 'htportfolio' ),
                            'selector' => '{{WRAPPER}} .htportfolio-ft_item_image a.icon_link:hover',
                        ]
                    );      
                $this->end_controls_tab();       
            $this->end_controls_tabs();
    $this->end_controls_section();

        // Box Content Tab section
        $this->start_controls_section(
            'item_box_content_style',
            [
                'label' => __( 'Content Style', 'htportfolio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs(
                'style_content_item'
            );

            //Content Normal style tab
            $this->start_controls_tab(
                'item_content_normal_tabs',
                [
                    'label' => __( 'Normal', 'htportfolio' ),
                ]
            );
                    $this->add_control(
                        'category_style',
                        [
                            'label' => __( 'Item Title Style', 'htportfolio' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );                    
                    $this->add_control(
                        'title_link_color',
                        [
                            'label' => __( 'Title Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#fff',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper h5 a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio_filter_content h5 a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'title_link_bg_color',
                        [
                            'label' => __( 'Title Bg Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'rgba(0,0,0,0)',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper h5 a' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio_filter_content h5 a' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography',
                            'selector' => '{{WRAPPER}} .htportfolio-cat-wrapper h5,.portfolio-two .htportfolio_filter_content h5',
                        ]
                    );
                    $this->add_responsive_control(
                        'title_margin',
                        [
                            'label' => __( 'Title Margin', 'htportfolio' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio_filter_content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'title_padding',
                        [
                            'label' => __( 'Title Padding', 'htportfolio' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper h5 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio_filter_content h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'content_box_category_style',
                        [
                            'label' => __( 'Item Category Style', 'htportfolio' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    ); 
                    $this->add_control(
                        'category_link_color',
                        [
                            'label' => __( 'Category Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'#fff',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper h6' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio_filter_content h6 a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'category_typography',
                            'selector' => '{{WRAPPER}} .htportfolio-cat-wrapper h6,.portfolio-two .htportfolio_filter_content h6',
                        ]
                    );
                    $this->add_responsive_control(
                        'category_margin',
                        [
                            'label' => __( 'Category Margin', 'htportfolio' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio_filter_content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'category_padding',
                        [
                            'label' => __( 'Category Padding', 'htportfolio' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio_filter_content h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'content_box_style',
                        [
                            'label' => __( 'Content Box Style', 'htportfolio' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    ); 
                    $this->add_control(
                        'content_box_bg_color',
                        [
                            'label' => __( 'Content Bg Color', 'htportfolio' ),
                            'type' => Controls_Manager::COLOR,
                            'default' =>'rgba(0,0,0,0)',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio-cate-wrapper' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'content_box_alignment',
                        [
                            'label' => __( 'Content Box Alignment', 'htportfolio' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'htportfolio' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'htportfolio' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'htportfolio' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'default' => 'center',
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper' => 'text-align: {{VALUE}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio-cate-wrapper' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'content_box_margin',
                        [
                            'label' => __( 'Content Box Margin', 'htportfolio' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio-cate-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'content_box_padding',
                        [
                            'label' => __( 'Content Box Padding', 'htportfolio' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htportfolio-cat-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .portfolio-two .htportfolio-cate-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

            $this->end_controls_tab();
            // Content Hover style tab
            $this->start_controls_tab(
                'item_content_normal_tabs_hover',
                [
                    'label' => __( 'Hover', 'htportfolio' ),
                ]
            );
                $this->add_control(
                    'title_link_color_hover',
                    [
                        'label' => __( 'Title Hover Color', 'htportfolio' ),
                        'type' => Controls_Manager::COLOR,
                        'default' =>'#fff',
                        'selectors' => [
                            '{{WRAPPER}} .htportfolio-cat-wrapper h5:hover a' => 'color: {{VALUE}};',
                        ],
                    ]
                );
            $this->end_controls_tab();
            $this->end_controls_tabs();
    $this->end_controls_section();
    }
    protected function render( $instance = [] ) {

        $settings           = $this->get_settings_for_display();
        $filter_show_hide        = $this->get_settings_for_display('filter_show_hide');
        $display_option_type      = $this->get_settings_for_display('display_option_type');
        $all_btn_show_hide        = $this->get_settings_for_display('all_btn_show_hide');
        $htportfolio_all_item        = $this->get_settings_for_display('htportfolio_all_item');
        $htportfolio_item_column        = $this->get_settings_for_display('htportfolio_item_column');
        $htportfolio_item_column_md        = $this->get_settings_for_display('htportfolio_item_column_md');
        $htportfolio_item_column_sm        = $this->get_settings_for_display('htportfolio_item_column_sm');
        $htportfolio_item_order        = $this->get_settings_for_display('htportfolio_item_order');
        $htportfolio_item_gutter        = $this->get_settings_for_display('htportfolio_item_gutter');
        $icon_show_hide      = $this->get_settings_for_display('icon_show_hide');
        $show_hide_portfolio_title      = $this->get_settings_for_display('show_hide_portfolio_title');
        $show_hide_portfolio_category      = $this->get_settings_for_display('show_hide_portfolio_category');
        $link_btn_text        = $this->get_settings_for_display('link_btn_text');
        $video_btn_text        = $this->get_settings_for_display('video_btn_text');
        $link_icon_type        = $this->get_settings_for_display('link_icon_type');
        $link_icon_iamge  =   $settings['link_icon_iamge'];
        $item_layout_style = $settings['item_layout_style'];
        $video_icon_type        = $this->get_settings_for_display('video_icon_type');
        $video_icon_iamge  =   $settings['video_icon_iamge'];
        $sectionid =  $this-> get_id();
        $sectionid ='wid'.$sectionid;

        if($htportfolio_item_gutter > 0){
        $htportfolio_item_gutter = $htportfolio_item_gutter/2;
        }else{
            $htportfolio_item_gutter = 0;
        }

        if( $htportfolio_item_column !='' ){
            $htportfolio_item_column = 100/$htportfolio_item_column;
        }

        if( $htportfolio_item_column_md !='' ){
            $htportfolio_item_column_md = 100/$htportfolio_item_column_md;
        }

        if( $htportfolio_item_column_sm !='' ){
            $htportfolio_item_column_sm = 100/$htportfolio_item_column_sm;
        }

        $args = array(
            'post_type'             => 'ht_portfolios',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $htportfolio_all_item,
        );
        $get_item_categories = $settings['htportfolio_item_categories'];
        $all_btn_text = $settings['all_btn_text'];

        $portfolio_cats = str_replace(' ', '', $get_item_categories);

        if ( "0" != $get_item_categories) {
            if( is_array($portfolio_cats) && count($portfolio_cats) > 0 ){
                $field_name = is_numeric($portfolio_cats[0])?'term_id':'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'ht_portfolios_cat',
                        'terms' => $portfolio_cats,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

        ?>
            <div class="filter-area <?php echo $sectionid;?>">
                <?php if($filter_show_hide=='yes'){ ?>
                    <div class="htportfolio-filter-menu-list <?php echo $sectionid;?>">
                        <?php  if($all_btn_show_hide=='yes'){ ?>
                            <button class="is-checked " data-filter="*"><?php  echo  esc_html($all_btn_text); ?></button>
                        <?php } ?>
                        <?php  if($get_item_categories) { 

                        foreach( $get_item_categories as $selected_categorys_array_single ): ?>
                        <?php $catagories_name = str_replace('-', ' ', $selected_categorys_array_single);?>
                        <button data-filter=".<?php echo $selected_categorys_array_single; ?>"><?php echo $catagories_name; ?></button>
                        <?php endforeach; } ?>
                    </div>
                <?php } ?>
                <?php if( $item_layout_style == 'style1' ){?>
                <div class="ft_item-style <?php echo $sectionid;?>">
                    <div class="all_item_wrapper grid-active <?php echo $sectionid;?>">
                        <?php 
                            $args = new \WP_Query(array(
                                'post_type'  => 'ht_portfolios',
                                'posts_per_page' =>$htportfolio_all_item,
                                'ht_portfolios_cat' => $get_item_categories,
                                'order' => $htportfolio_item_order,
                            ));
                            while($args->have_posts()):$args->the_post();
                            $terms = get_the_terms(get_the_id(),'ht_portfolios_cat');
                            $popup_video = get_post_meta( get_the_ID(),'_htportfolio_por_video', true ); 
                         $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()),'full',true); 

                        ?>
                        <div class="htportfolio-filter_item_box htportfolio-grid-item <?php if( $terms ){  foreach($terms as $term ){ echo $term->slug .' ';} } ?>">
                            <?php if(has_post_thumbnail() ){?>  
                            <div class="htportfolio-ft_item_image">

                               <?php if($icon_show_hide != 'yes' || $show_hide_portfolio_title != 'yes' || $show_hide_portfolio_category != 'yes'){ ?>
                                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail();?> </a> <?php }else{ the_post_thumbnail(); }?>

                                <?php if( $show_hide_portfolio_title == 'yes' || 
                                    $show_hide_portfolio_category == 'yes' || $icon_show_hide == 'yes'  ){?>

                                  <div class="htportfolio-cat-wrapper">
                                <?php if( $show_hide_portfolio_title == 'yes' || $show_hide_portfolio_category == 'yes'|| $icon_show_hide == 'yes' ){ ?>
                                        <div class="htportfolio_filter_content">
                                            <?php if( $show_hide_portfolio_title == 'yes'){?>
                                            <h5>
                                            <a href="<?php the_permalink(); ?>"><?php the_title();
                                             ?></a>
                                            </h5>
                                            <?php } ?>
                                            <?php if( $terms && $show_hide_portfolio_category == 'yes'){
                                            foreach( $terms as $single_slugs ){?>
                                                <h6>
                                                   <?php echo $single_slugs->name ;?>
                                                </h6>
                                            <?php }} 
                                            ?>
                                        </div>

                                <?php } 

                                 if($icon_show_hide == 'yes'){   
                                    if( $popup_video !=''){
                                 ?>
                                 <a class="icon_link various fancybox.iframe?" href="<?php echo esc_url( $popup_video ) ; ?>">
                                    <?php
                                        if( $video_icon_type == 'image' ){
                                           ?>
                                            <img src="<?php echo $video_icon_iamge['url']; ?>" alt="" />
                                            <?php
                                        }elseif( $video_icon_type == 'icon' ){
                                            \Elementor\Icons_Manager::render_icon( $settings['video_icon_font'], [ 'aria-hidden' => 'true' ] );
                                        }else{
                                            echo $video_btn_text;
                                        }
                                    ?>
                                </a>
                                <?php ?>
                                <?php  } else{ ?>

                                <?php if( $display_option_type == 'popup' ){ ?>
                                <a class="icon_link"  data-fancybox="htportfolio_pro_popup"  href="<?php echo esc_url( $full_image[0] ) ; ?>">
                                <?php } else{?> <a  class="icon_link" href="<?php the_permalink(); ?>"><?php } ?>
                                    <?php 
                                        if( $link_icon_type == 'image' ){
                                           ?>
                                            <img src="<?php echo $link_icon_iamge['url']; ?>" alt="" />
                                            <?php
                                        }elseif($link_icon_type == 'icon'){
                                            \Elementor\Icons_Manager::render_icon( $settings['link_icon_font'], [ 'aria-hidden' => 'true' ] );
                                        }else{

                                            echo $link_btn_text;
                                        }
                                        ?>
                                </a>
                                <?php ?>
                                <?php } }?>
                                </div>
                                 <?php }?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php endwhile; 
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <?php } ?>
                <?php if( $item_layout_style == 'style2' ){?>
                    <div class="ft_item-style portfolio-two">
                        <div class="all_item_wrapper grid-active <?php echo $sectionid;?>">
                        <?php 
                            $args = new \WP_Query(array(
                                'post_type'  => 'ht_portfolios',
                                'posts_per_page' =>$htportfolio_all_item,
                                'ht_portfolios_cat' => $get_item_categories,
                                'order' => $htportfolio_item_order,
                            ));
                            while($args->have_posts()):$args->the_post();
                            $terms = get_the_terms(get_the_id(),'ht_portfolios_cat');
                            $popup_video = get_post_meta( get_the_ID(),'_htportfolio_por_video', true ); 
                         $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()),'full',true); 

                        ?>
                        <div class="htportfolio-filter_item_box htportfolio-grid-item <?php if( $terms ){  foreach($terms as $term ){ echo $term->slug .' ';} } ?>">
                            <?php if(has_post_thumbnail() ){?>  
                            <div class="htportfolio-ft_item_image">
                                <div class="portfolio-fimage">
                               <?php if($icon_show_hide != 'yes' || $show_hide_portfolio_title != 'yes' || $show_hide_portfolio_category != 'yes'){ ?>
                                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail();?> </a> <?php }else{ the_post_thumbnail(); }?>
                                </div>
                                <?php if( $show_hide_portfolio_title == 'yes' || 
                                    $show_hide_portfolio_category == 'yes' || $icon_show_hide == 'yes'  ){?>

                                <div class="htportfolio-cate-wrapper">
                                <?php if( $show_hide_portfolio_title == 'yes' || $show_hide_portfolio_category == 'yes'|| $icon_show_hide == 'yes' ){ ?>
                                        <div class="htportfolio_filter_content">
                                            <?php if( $show_hide_portfolio_title == 'yes'){?>
                                            <h5>
                                            <a href="<?php the_permalink(); ?>"><?php the_title();
                                             ?></a>
                                            </h5>
                                            <?php } ?>
                                            <?php if( $terms && $show_hide_portfolio_category == 'yes'){
                                            foreach( $terms as $single_slugs ){?>
                                                <h6>
                                                   <?php echo $single_slugs->name ;?>
                                                </h6>
                                            <?php }} 
                                            ?>
                                        </div>
                                <div class="icon-box-style">
                                <?php } 

                                 if($icon_show_hide == 'yes'){   
                                    if( $popup_video !=''){
                                 ?>
                                 <a class="icon_link various fancybox.iframe?" href="<?php echo esc_url( $popup_video ) ; ?>">
                                    <?php
                                        if( $video_icon_type == 'image' ){
                                           ?>
                                            <img src="<?php echo $video_icon_iamge['url']; ?>" alt="" />
                                            <?php
                                        }elseif( $video_icon_type == 'icon' ){
                                            \Elementor\Icons_Manager::render_icon( $settings['video_icon_font'], [ 'aria-hidden' => 'true' ] );
                                        }else{
                                            echo $video_btn_text;
                                        }
                                    ?>
                                </a>
                                <?php ?>
                                <?php  } else{ ?>

                                <?php if( $display_option_type == 'popup' ){ ?>
                                <a class="icon_link"  data-fancybox="htportfolio_pro_popup"  href="<?php echo esc_url( $full_image[0] ) ; ?>">
                                <?php } else{?> <a  class="icon_link" href="<?php the_permalink(); ?>"><?php } ?>
                                    <?php 
                                        if( $link_icon_type == 'image' ){
                                           ?>
                                            <img src="<?php echo $link_icon_iamge['url']; ?>" alt="" />
                                            <?php
                                        }elseif($link_icon_type == 'icon'){
                                            \Elementor\Icons_Manager::render_icon( $settings['link_icon_font'], [ 'aria-hidden' => 'true' ] );
                                        }else{

                                            echo $link_btn_text;
                                        }
                                        ?>
                                </a>
                                <?php ?>
                                <?php } }?>
                            </div>
                                </div>
                                 <?php }?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php endwhile; 
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <?php } ?>
            </div>

    <style>
    <?php if($htportfolio_item_gutter >=0){ ?>
      .<?php echo $sectionid;?>.all_item_wrapper{
            margin: -<?php echo $htportfolio_item_gutter ?>px;
        }
         .<?php echo $sectionid;?> .htportfolio-filter_item_box{
            padding:<?php echo $htportfolio_item_gutter ?>px;
        }
        <?php } ?>
         .<?php echo $sectionid;?> .htportfolio-filter_item_box{
            width:<?php echo $htportfolio_item_column ?>%;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .<?php echo $sectionid;?> .htportfolio-filter_item_box{
                width:<?php echo $htportfolio_item_column_md ?>%;
            }
        }
        @media (max-width: 767px) {
            .<?php echo $sectionid;?> .htportfolio-filter_item_box{
                width:<?php echo $htportfolio_item_column_sm ?>%;
            }
        }
        @media (max-width: 575px) {
           .<?php echo $sectionid;?> .htportfolio-filter_item_box{
                width: 100%;
            }
        }    
    </style>

        <script type="text/javascript">
        
            jQuery(document).ready(function($) {

                // images have loaded
                $('.ft_item-style.<?php echo $sectionid;?>').imagesLoaded( function() {

                  // Isotop Active
                  $('.htportfolio-filter-menu-list.<?php echo $sectionid;?>').on( 'click', 'button', function() {
                    var filterValue = $(this).attr('data-filter');
                    $grid.isotope({ filter: filterValue });
                  });

                  // Isotop Full Grid
                  var $grid = $('.grid-active.<?php echo $sectionid;?>').isotope({
                    itemSelector: '.htportfolio-grid-item',
                    percentPosition: true,
                    masonry: {
                    columnWidth: 1
                    }
                  });
                  // Isotop Menu Active
                  $('.htportfolio-filter-menu-list button').on('click', function(event) {
                        $(this).siblings('.is-checked').removeClass('is-checked');
                        $(this).addClass('is-checked');
                        event.preventDefault();
                    });
                  // Image Popup Fancy Active
                  $(".htportfolio_pro_popup").fancybox();

                    $(".various").fancybox({
                        maxWidth    : 800,
                        maxHeight   : 600,
                        fitToView   : false,
                        width       : '70%',
                        height      : '70%',
                        autoSize    : false,
                        closeClick  : false,
                        openEffect  : 'none',
                        closeEffect : 'none'
                    });
                });
                
            });

        </script>
        <?php

    }

}

htportfolio_widget_register_manager( new HTPortfolio_Elementor_Widget_Portfolio() );