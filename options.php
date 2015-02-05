<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * Turkish theme panel version
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __( 'One', 'theme-textdomain' ),
		'two' => __( 'Two', 'theme-textdomain' ),
		'three' => __( 'Three', 'theme-textdomain' ),
		'four' => __( 'Four', 'theme-textdomain' ),
		'five' => __( 'Five', 'theme-textdomain' )
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'theme-textdomain' ),
		'two' => __( 'Pancake', 'theme-textdomain' ),
		'three' => __( 'Omelette', 'theme-textdomain' ),
		'four' => __( 'Crepe', 'theme-textdomain' ),
		'five' => __( 'Waffle', 'theme-textdomain' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __( 'Temel Ayarlar', 'theme-textdomain' ),
		'type' => 'heading'
	);

		$options[] = array(
		'name' => __( 'Logo Yükle', 'theme-textdomain' ),
		'desc' => __( 'This creates a full size uploader that previews the image.', 'theme-textdomain' ),
		'id' => 'example_uploader',
		'type' => 'upload'
	);
	
	$options[] = array( "name" => "Header Kodları",
					"desc" => "Headerda kullanacağınız kodları buraya yazabilirsiniz.",
					"id" => "headerkod",
					"std" => "",
					"type" => "textarea");
					
	if ( $options_categories ) {
		$options[] = array(
			'name' => __( 'Kategori Seçin', 'theme-textdomain' ),
			'desc' => __( 'Passed an array of categories with cat_ID and cat_name', 'theme-textdomain' ),
			'id' => 'katkod1',
			'type' => 'select',
			'options' => $options_categories
		);
		
				$options[] = array(
			'name' => __( 'Kategori Seçin', 'theme-textdomain' ),
			'desc' => __( 'Passed an array of categories with cat_ID and cat_name', 'theme-textdomain' ),
			'id' => 'katkod2',
			'type' => 'select',
			'options' => $options_categories
		);
	}
					
	$options[] = array( "name" => "Footer Kodları",
					"desc" => "Footerda kullanacağınız kodları buraya yazabilirsiniz.",
					"id" => "footerkod",
					"std" => "",
					"type" => "textarea");
						
$options[] = array( "name" => "Footer Açıklama",
					"desc" => "Footerda kullanacağınız telif hakkı metni ve diğer kodları buraya yazabilirsiniz.",
					"id" => "footer",
					"std" => "",
					"type" => "textarea");		
					
$options[] = array( "name" => "Meta Keywords",
					"desc" => "Site etiketlerini girin.SEO için önemlidir.(En fazla 6 tane olmalıdır.Araya virgül koyarak girin.)",
					"id" => "keyw",
					"std" => "",
					"type" => "textarea");
	
$options[] = array( "name" => "Meta Description",
					"desc" => "Site açıklamasını girin.SEO için önemlidir.(En fazla 70 karakter olmalıdır.)",
					"id" => "desc",
					"std" => "",
					"type" => "textarea");
					
$options[] = array( "name" => "Özelleştirmeler",
                    "type" => "heading");

					$options[] = array( "name" => "Manşet Seçimi",
					"desc" => "Anasayfada göstermek için farklı manşet tiplerinden istediğinizi seçebilir veya manşet sistemini kapatabilirsiniz.",
					"id" => "sliderg",
					"type" => "select",	
					"options" => array("Hayır", "Manşet 1", "Manşet 2","Manşet 3","Manşet 4"),
					"std" => "Manşet 1");

					$options[] = array( "name" => "Sayfalama Seçimi",
					"desc" => "Kullanmak istediğiniz sayfalama türünü seçin.",
					"id" => "sayfalama",
					"type" => "select",	
					"options" => array("Kriesi Sayfalama", "Bootstrap Sayfalama"),
					"std" => "Kriesi Sayfalama");
					
					$options[] = array( "name" => "Sidebar Kategori Listeleme Türü",
					"desc" => "Kullanmak istediğiniz Sidebar Kategori Listeleme türünü seçin.",
					"id" => "katliste",
					"type" => "select",	
					"options" => array("Bulut", "Liste"),
					"std" => "Bulut");	

					$options[] = array( "name" => "Logo yada yazı seçimi",
					"desc" => "Kullanmak istediğiniz header tipini logo türünü seçin.",
					"id" => "logomu",
					"type" => "select",	
					"options" => array("Logo", "Yazı"),
					"std" => "Yazı");						
					
$options[] = array( "name" => "Reklam Alanı",
                    "type" => "heading");		

					$options[] = array( "name" => "Sidebar reklam alanı göster",
					"desc" => "Eğer Eveti seçerseniz sidebar reklamı gözükür.",
					"id" => "sidebarr",
					"type" => "select",	
					"options" => array("Evet", "Hayır"),
					"std" => "");

$options[] = array( "name" => "Sidebar reklam alanı başlığı",
					"desc" => "Sidebar 300*250 adsense reklam alanı başlığı.",
					"id" => "sidebarbas",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Sidebar reklam alanı",
					"desc" => "Sidebar 300*250 adsense reklam alanı.",
					"id" => "sidebar",
					"std" => "Reklam kodlarınız buraya gelecek",
					"type" => "textarea");
					
					$options[] = array( "name" => "Yazı üstü reklam alanı göster",
					"desc" => "Eğer Eveti seçerseniz tekil yazı üstünde reklam gözükür.",
					"id" => "ustr",
					"type" => "select",	
					"options" => array("Evet", "Hayır"),
					"std" => "Hayır");
$options[] = array( "name" => "Yazı üstü reklam alanı",
					"desc" => "Yazı üstü 468*60 adsense reklam alanı.",
					"id" => "yaziustu",
					"std" => "Reklam kodlarınız buraya gelecek",
					"type" => "textarea");	
					
					$options[] = array( "name" => "Yazı altı reklam alanı göster",
					"desc" => "Eğer Eveti seçerseniz tekil yazı altında reklam gözükür.",
					"id" => "altr",
					"type" => "select",	
					"options" => array("Evet", "Hayır"),
					"std" => "Hayır");
$options[] = array( "name" => "Yazı alti reklam alanı",
					"desc" => "Yazı altinda görünecek 468*60 adsense reklam alanı.",
					"id" => "yazialti",
					"std" => "Reklam kodlarınız buraya gelecek",
					"type" => "textarea");	

		
					
/* Sosyal Ağ Ayarları */	
$options[] = array( "name" => __('Sosyal Ağlar','framework_localize'),
			"type" => "heading");
			
					$options[] = array( "name" => "Sosyal ağları göster",
					"desc" => "Eğer Eveti seçerseniz sidebarda sosyal ağlar kutucuğu gözükür.",
					"id" => "sosyalg",
					"type" => "select",	
					"options" => array("Evet", "Hayır"),
					"std" => "Hayır");
			
$options[] = array( "name" => __('Facebook Profil','framework_localize'),
			"desc" => __('','framework_localize'),
			"id" => "fb",
			"std" => "",
			"type" => "text");


			$options[] = array( "name" => __('Google Profil','framework_localize'),
			"desc" => __('','framework_localize'),
			"id" => "google",
			"std" => "",
			"type" => "text");


$options[] = array( "name" => __('Twitter Profil','framework_localize'),
			"desc" => __('','framework_localize'),
			"id" => "twt",
			"std" => "",
			"type" => "text");


$options[] = array( "name" => __('Youtube  Profil','framework_localize'),
			"desc" => __('','framework_localize'),
			"id" => "yb",
			"std" => "",
			"type" => "text");	
	return $options;
}
