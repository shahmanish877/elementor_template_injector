<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://haywood.de/
 * @since      1.0.0
 *
 * @package    Hywd_Template_Injector
 * @subpackage Hywd_Template_Injector/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hywd_Template_Injector
 * @subpackage Hywd_Template_Injector/admin
 * @author     HAYWOOD Digital Tools <#>
 */

use ElementorPro\Modules\QueryControl\Module as QueryControlModule;
use Elementor\Core\Base\Document;
use ElementorPro\Plugin;

class Hywd_Template_Injector_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hywd_Template_Injector_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hywd_Template_Injector_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hywd-template-injector-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hywd_Template_Injector_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hywd_Template_Injector_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hywd-template-injector-admin.js', array( 'jquery' ), $this->version, false );

	}

}



// add_action( 'elementor/element/heading/section_title/after_section_end', 'add_template_section', 10, 2 );
// add_action( 'elementor/element/image/section_image/after_section_end', 'add_template_section', 10, 2 );
// add_action( 'elementor/element/text-editor/section_style/after_section_end', 'add_template_section', 10, 2 );
// add_action( 'elementor/element/button/section_button/after_section_end', 'add_template_section', 10, 2 );
// add_action( 'elementor/element/video/section_image_overlay/after_section_end', 'add_template_section', 10, 2 );
// add_action( 'elementor/element/divider/section_divider/after_section_end', 'add_template_section', 10, 2 );
// add_action( 'elementor/element/spacer/section_spacer/after_section_end', 'add_template_section', 10, 2 );

add_action( 'elementor/element/section/section_layout/after_section_end', 'add_template_section', 10, 2 );
add_action( 'elementor/element/common/_section_style/after_section_end', 'add_template_section', 10, 2 );

add_action( 'elementor/frontend/widget/after_render', 'render_template_section');
add_action( 'elementor/frontend/section/after_render', 'render_template_section');


function custom_elementor_library_search() {
    $customPageslist = get_posts(
        array(
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        )
    );
    $customPagesArrayt = array();
        if (!empty($customPageslist)) {
            foreach ($customPageslist as $page) {
            	$customPagesArrayt[$page->ID] = $page->post_title;
            }
        }
    return $customPagesArrayt;
}


function add_template_section($element, $args){
	/** @var \Elementor\Element_Base $element */
	$dir =  plugin_dir_url( dirname( __FILE__ ) )  . 'public/img/Favicon-H-16.png';
	$element->start_controls_section(
		'custom_section',
		[
			'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			'label' => __( '
				<div class="custom-template-injector-tab" style="display: flex; justify-content: space-between; 
    align-items: center;"> 
					<p>Template Injector</p>
					<img src="'.$dir.'">
				</div>
				', 'plugin-name' ),
		]
	);
		
	$document_types = Plugin::elementor()->documents->get_document_types( [
		'show_in_library' => true,
	] );
	
	// $element->add_control(
	// 	'template_id_extension',
	// 	[
	// 		'label' => __( 'Choose Template', 'elementor-pro' ),
	// 		'type' => QueryControlModule::QUERY_CONTROL_ID,
	// 		'label_block' => true,
	// 		'autocomplete' => [
	// 			'object' => QueryControlModule::QUERY_OBJECT_LIBRARY_TEMPLATE,
	// 			'query' => [
	// 				'meta_query' => [
	// 					[
	// 						'key' => Document::TYPE_META_KEY,
	// 						'value' => array_keys( $document_types ),
	// 						'compare' => 'IN',
	// 					],
	// 				],
	// 			],
	// 		],
	// 	]
	// );

	$element->add_control(
		'template_injector_status',
		[
			'label' => __( 'Enable Template Injector', 'plugin-domain' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => __( 'Enable', 'plugin-domain' ),
			'label_off' => __( 'Disable', 'plugin-domain' ),
			'return_value' => 'true',
			'default' => 'false',
		]
	);

	$element->add_control(
		'template_id_extension',
		[
			'label' => __( 'Choose Template', 'plugin-domain' ),
			'type'    => \Elementor\Controls_Manager::SELECT2,
			'options' => custom_elementor_library_search(),
			'conditions' => [
				'terms' => [
					[
						'name' => 'template_injector_status',
						'operator' => '==',
						'value' => [
							'true',
						],
					],
				],
			],
		]
	);

     

	$element->add_control(
		'id_to_append',
		[
			'label' => __( 'Target Selector', 'plugin-domain' ),
			'description' => __('<p>Insert either an id by using #id or a class with .class. </p>
<br>
<p>In case you want to use a multi selector please use the ">" symbol instead of the space. For example, instead of using .class1 .class2 .class3 .class4 .class5 use .class1>.class2>.class3>.class4>.class5</p>
<br>
<p>If you want to select only a combination of some of the selectors in a multi selector you can use ">*". For example, you can reduce the upper example to .class1>*.class3 or even .class1>*.class3>*.class5 </p>
<br>
<p>The template will only be applied to a target selector on the current page. If you did choose a non-unique selector the template will be attached to all instances of that selector only inside the current page.</p>'),
			'type' => \Elementor\Controls_Manager::TEXT,
			'placeholder' => __( '.parent >* .child', 'plugin-domain' ),
			'conditions' => [
				'terms' => [
					[
						'name' => 'template_injector_status',
						'operator' => '==',
						'value' => [
							'true',
						],
					],
				],
			],
		]
	);



	$element->add_control(
			'append_position',
			[
				'label' => __( 'Template Position', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'after'  => __( 'After', 'plugin-domain' ),
					'before' => __( 'Before', 'plugin-domain' ),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'template_injector_status',
							'operator' => '==',
							'value' => [
								'true',
							],
						],
					],
				],
			]
		);

	$element->add_control(
			'for_popup_only',
			[
				'label' => __( 'Inject this template into a popup', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'your-plugin' ),
				'label_off' => __( 'Off', 'your-plugin' ),
				'return_value' => 'yes',
				'conditions' => [
					'terms' => [
						[
							'name' => 'template_injector_status',
							'operator' => '==',
							'value' => [
								'true',
							],
						],
					],
				],
			]
		);

	$element->add_responsive_control(
			'template_margin',
			[
				'label' => __( 'Margin', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.custom_template_injector' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'template_injector_status',
							'operator' => '==',
							'value' => [
								'true',
							],
						],
					],
				],
			]
		);

	$element->add_responsive_control(
			'template_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.custom_template_injector' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'template_injector_status',
							'operator' => '==',
							'value' => [
								'true',
							],
						],
					],
				],
			]
		);


	$element->end_controls_section();

}

function render_template_section( \Elementor\Element_Base $element ){

	if ( ! $element->get_settings( 'template_id_extension' ) ) {
		return;
	}

	$template_id_extension = $element->get_settings( 'template_id_extension' );
	$template_class = $element->get_settings( 'id_to_append' ).'_'.$element->get_settings( 'append_position' );
	$template_class = str_replace("#","", $template_class);
	$template_class = str_replace(".","", $template_class);
	$template_class = str_replace(">*","_", $template_class);
	$template_class = str_replace(">*>","_", $template_class);
	$template_class = str_replace(" >* ","_", $template_class);
	$template_class = str_replace(">","_", $template_class);
	$template_class = str_replace(" > ","_", $template_class);
	$template_class = str_replace(" ","_", $template_class);

	//echo "Trimmed template class = ".$template_class;

	if ( 'publish' !== get_post_status( $template_id_extension ) ) {
		return;
	}

	?>
	<div class="elementor-template-injector">
		<?php
			$template_selected = Plugin::elementor()->frontend->get_builder_content_for_display( $template_id_extension );
			echo "<div class='".$template_class." custom_template_injector'>".$template_selected."</div>";
		?>
	</div>
	<script>
			var template_class = '<?php echo $template_class; ?>';
			var section_id = '<?php echo $element->get_settings( "id_to_append" ); ?>';
			var append_position = '<?php echo $element->get_settings( "append_position" ); ?>';
			var for_popup_only = '<?php echo $element->get_settings( "for_popup_only" ); ?>';
			
			//check if DOM exists else wait till it load and then insert the template
			//setTimeout used because cart popup loads after whole pages load or maybe due to ajax call of cart

			if(jQuery(section_id).length){
				//alert("Div1 exists");
				if (for_popup_only === 'yes'){//Do stuff}
					//alert("it contains cart");
					setTimeout(insert_template,2500);
				}else{
					insert_template();
				}
			}else{
				//alert("Div1 does not exists");
				jQuery(function($) {
					if(jQuery(section_id).length){
						//alert("Div1 is finally exists");
						if (for_popup_only === 'yes'){
							//alert("it contains cart");
							setTimeout(insert_template,2500);
						}else{
							insert_template();
						}
					}else{
						console.log("Error: Target class not found - "+section_id);

					}
				});
			}

		function insert_template() {
			if(append_position==='after'){
				//console.log("append target class = "+section_id);
				jQuery('.'+template_class).appendTo(section_id);
			}
			else if(append_position==='before'){
				//console.log("prepend target class = "+section_id);
				jQuery('.'+template_class).prependTo(section_id);
			}

		}

	</script>

<?php
}
