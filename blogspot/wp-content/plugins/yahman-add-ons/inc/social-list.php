<?php
defined( 'ABSPATH' ) || exit;
/**
 * Social List
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_social_name_list() {

	return array(
		'none'             => array(
			'name' => '-',
			'base' => '',
			'share' => '',
			'color' => '',
			'svg' => '',
		),
		'amazon'           => array(
			'name' => esc_html__('Amazon', 'yahman-add-ons'),
			'base' => '',
			'share' => '',
			'color' => '#f90',
			'svg' => 'd="M.045 18.02c.072-.116.187-.124.348-.022 3.636 2.11 7.594 3.166 11.87 3.166 2.852 0 5.668-.533 8.447-1.595l.315-.14c.138-.06.234-.1.293-.13.226-.088.39-.046.525.13.12.174.09.336-.12.48-.256.19-.6.41-1.006.654-1.244.743-2.64 1.316-4.185 1.726-1.53.406-3.045.61-4.516.61-2.265 0-4.41-.396-6.435-1.187-2.02-.794-3.82-1.91-5.43-3.35-.1-.074-.15-.15-.15-.22 0-.047.02-.09.05-.13zm6.565-6.218c0-1.005.247-1.863.743-2.577.495-.71 1.17-1.25 2.04-1.615.796-.335 1.756-.575 2.912-.72.39-.046 1.033-.103 1.92-.174v-.37c0-.93-.105-1.558-.3-1.875-.302-.43-.78-.65-1.44-.65h-.182c-.48.046-.896.196-1.246.46-.35.27-.575.63-.675 1.096-.06.3-.206.465-.435.51l-2.52-.315c-.248-.06-.372-.18-.372-.39 0-.046.007-.09.022-.15.247-1.29.855-2.25 1.82-2.88.976-.616 2.1-.975 3.39-1.05h.54c1.65 0 2.957.434 3.888 1.29.135.15.27.3.405.48.12.165.224.314.283.45.075.134.15.33.195.57.06.254.105.42.135.51.03.104.062.3.076.615.01.313.02.493.02.553v5.28c0 .376.06.72.165 1.036.105.313.21.54.315.674l.51.674c.09.136.136.256.136.36 0 .12-.06.226-.18.314-1.2 1.05-1.86 1.62-1.963 1.71-.165.135-.375.15-.63.045-.195-.166-.375-.332-.526-.496l-.31-.347c-.06-.074-.166-.21-.317-.42l-.3-.435c-.81.886-1.603 1.44-2.4 1.665-.494.15-1.093.227-1.83.227-1.11 0-2.04-.343-2.76-1.034-.72-.69-1.08-1.665-1.08-2.94l-.05-.076zm3.753-.438c0 .566.14 1.02.425 1.364.285.34.675.512 1.155.512.045 0 .106-.007.195-.02.09-.016.134-.023.166-.023.614-.16 1.08-.553 1.424-1.178.165-.28.285-.58.36-.91.09-.32.12-.59.135-.8.015-.195.015-.54.015-1.005v-.54c-.84 0-1.484.06-1.92.18-1.275.36-1.92 1.17-1.92 2.43l-.035-.02zm9.162 7.027c.03-.06.075-.11.132-.17.362-.243.714-.41 1.05-.5.55-.133 1.09-.222 1.612-.24.14-.012.28 0 .41.03.65.06 1.05.168 1.172.33.063.09.09.228.09.39v.15c0 .51-.14 1.11-.415 1.8-.278.69-.664 1.248-1.156 1.68-.073.06-.14.09-.197.09-.03 0-.06 0-.09-.012-.09-.044-.107-.12-.064-.24.54-1.26.806-2.143.806-2.64 0-.15-.03-.27-.087-.344-.145-.166-.55-.257-1.224-.257-.243 0-.533.016-.87.046-.363.045-.7.09-1 .135-.09 0-.148-.014-.18-.044-.03-.03-.036-.047-.02-.077 0-.017.006-.03.02-.063v-.06z"',
		),
		'buffer'             => array(
			'name' => esc_html__('buffer', 'yahman-add-ons'),
			'base' => '',
			'share' => 'https://bufferapp.com/add?text=',
			'color' => '#323b43',
			'svg' => 'd="M23.784 18.24c.287.142.287.267 0 .374l-11.357 5.223c-.287.145-.57.145-.854 0L.213 18.614c-.284-.107-.284-.232 0-.375l2.722-1.23c.284-.14.57-.14.852 0l7.787 3.573c.285.14.57.14.854 0l7.787-3.574c.283-.14.568-.14.852 0l2.717 1.23zm0-6.454c.287.143.287.285 0 .426L12.427 17.44c-.287.104-.57.104-.854 0L.213 12.21c-.284-.143-.284-.284 0-.426l2.722-1.227c.284-.144.57-.144.852 0l7.787 3.57c.285.144.57.144.854 0l7.787-3.57c.283-.144.568-.144.852 0l2.717 1.226zM.214 5.76c-.285-.143-.285-.267 0-.375L11.574.16c.283-.14.57-.14.852 0l11.358 5.23c.287.107.287.232 0 .375l-11.357 5.223c-.287.143-.57.143-.854 0L.213 5.76z"',
		),
		'codepen'          => array(
			'name' => esc_html__('CodePen', 'yahman-add-ons'),
			'base' => esc_url('https://codepen.io/'),
			'share' => '',
			'color' => '#000000',
			'svg' => 'd="M24 8.182l-.018-.087-.017-.05c-.01-.024-.018-.05-.03-.075-.003-.018-.015-.034-.02-.05l-.035-.067-.03-.05-.044-.06-.046-.045-.06-.045-.046-.03-.06-.044-.044-.04-.015-.02L12.58.19c-.347-.232-.796-.232-1.142 0L.453 7.502l-.015.015-.044.035-.06.05-.038.04-.05.056-.037.045-.05.06c-.02.017-.03.03-.03.046l-.05.06-.02.06c-.02.01-.02.04-.03.07l-.01.05C0 8.12 0 8.15 0 8.18v7.497c0 .044.003.09.01.135l.01.046c.005.03.01.06.02.086l.015.05c.01.027.016.053.027.075l.022.05c0 .01.015.04.03.06l.03.04c.015.01.03.04.045.06l.03.04.04.04c.01.013.01.03.03.03l.06.042.04.03.01.014 10.97 7.33c.164.12.375.163.57.163s.39-.06.57-.18l10.99-7.28.014-.01.046-.037.06-.043.048-.036.052-.058.033-.045.04-.06.03-.05.03-.07.016-.052.03-.077.015-.045.03-.08v-7.5c0-.05 0-.095-.016-.14l-.014-.045.044.003zm-11.99 6.28l-3.65-2.44 3.65-2.442 3.65 2.44-3.65 2.44zm-1.034-6.674l-4.473 2.99L2.89 8.362l8.086-5.39V7.79zm-6.33 4.233l-2.582 1.73V10.3l2.582 1.726zm1.857 1.25l4.473 2.99v4.82L2.89 15.69l3.618-2.417v-.004zm6.537 2.99l4.474-2.98 3.613 2.42-8.087 5.39v-4.82zm6.33-4.23l2.583-1.72v3.456l-2.583-1.73zm-1.855-1.24L13.042 7.8V2.97l8.085 5.39-3.612 2.415v.003z"',
		),
		'digg'               => array(
			'name' => esc_html__('digg', 'yahman-add-ons'),
			'base' => '',
			'share' => 'https://digg.com/submit?url=',
			'color' => '#000000',
			'svg' => 'd="M17.76 8.16v8.16h3.84v.96h-3.84v1.92H24V8.16h-6.24zm-7.2 0v8.16h3.84v.96h-3.84v1.92h6.24V8.16h-6.24zM3.84 4.8v3.36H0v8.16h6.24V4.8h-2.4zM9.6 8.16H7.2v8.16h2.4V8.16zm12 6.24h-1.44v-4.32h1.44v4.32zm-17.76 0H2.4v-4.32h1.44v4.32zm10.56 0h-1.44v-4.32h1.44v4.32zM9.6 4.8H7.2v2.4h2.4V4.8z"',
		),
		'evernote'           => array(
			'name' => esc_html__('Evernote', 'yahman-add-ons'),
			'base' => '',
			'share' => 'https://www.evernote.com/clip.action?url=',
			'color' => '#00A82D',
			'svg' => 'd="M7.692 5.445c0 .239-.02.637-.256.895-.257.24-.652.259-.888.259H4.022c-.73 0-1.165 0-1.46.04-.159.02-.356.1-.455.14-.04.019-.04 0-.02-.02L7.85.848c.02-.02.04-.02.02.02-.04.099-.118.298-.138.457-.04.298-.04.736-.04 1.472v2.647zm5.348 17.869c-.67-.438-1.026-1.015-1.164-1.373a2.924 2.924 0 0 1-.217-1.095 3.007 3.007 0 0 1 3-3.004c.493 0 .888.398.888.895a.88.88 0 0 1-.454.776c-.099.06-.237.1-.336.12-.098.02-.473.06-.65.218-.198.16-.356.418-.356.697 0 .298.118.577.316.776.355.358.829.557 1.342.557a2.436 2.436 0 0 0 2.427-2.447c0-1.214-.809-2.289-1.875-2.766-.158-.08-.414-.14-.651-.2a8.04 8.04 0 0 0-.592-.099c-.829-.1-2.901-.756-3.04-2.606 0 0-.611 2.785-1.835 3.541-.118.06-.276.12-.454.16-.177.04-.374.06-.434.06-1.993.119-4.105-.518-5.565-2.03 0 0-.987-.816-1.5-3.104-.118-.558-.355-1.553-.493-2.488-.06-.338-.08-.597-.099-.836 0-.975.592-1.631 1.342-1.73h4.026c.69 0 1.086-.18 1.342-.419.336-.318.415-.776.415-1.313v-4.08-.118C8.52.669 9.173.052 10.139.052h.474c.197 0 .434.02.651.04.158.02.296.06.533.12 1.204.298 1.46 1.532 1.46 1.532s2.27.398 3.415.597c1.085.199 3.77.378 4.282 3.104 1.204 6.487.474 12.775.415 12.775-.849 6.129-5.901 5.83-5.901 5.83a4.1 4.1 0 0 1-2.428-.736zm4.54-13.034c-.652-.06-1.204.2-1.402.697-.04.1-.079.219-.059.278.02.06.06.08.099.1.237.12.631.179 1.204.239.572.06.967.1 1.223.06.04 0 .08-.02.119-.08.04-.06.02-.18.02-.279-.06-.537-.553-.935-1.204-1.015z"',
		),
		'facebook'         => array(
			'name' => esc_html__('Facebook', 'yahman-add-ons'),
			'base' => esc_url('https://www.facebook.com/'),
			'share' => 'https://www.facebook.com/sharer/sharer.php?u=',
			'color' => '#4172B8',
			'svg' => 'd="M23.9981 11.9991C23.9981 5.37216 18.626 0 11.9991 0C5.37216 0 0 5.37216 0 11.9991C0 17.9882 4.38789 22.9522 10.1242 23.8524V15.4676H7.07758V11.9991H10.1242V9.35553C10.1242 6.34826 11.9156 4.68714 14.6564 4.68714C15.9692 4.68714 17.3424 4.92149 17.3424 4.92149V7.87439H15.8294C14.3388 7.87439 13.8739 8.79933 13.8739 9.74824V11.9991H17.2018L16.6698 15.4676H13.8739V23.8524C19.6103 22.9522 23.9981 17.9882 23.9981 11.9991Z"',
		),
		'feedly'           => array(
			'name' => esc_html__('Feedly', 'yahman-add-ons'),
			'base' => esc_url('https://feedly.com/i/subscription/feed/'.get_bloginfo('rss2_url')),
			'share' => '',
			'color' => '#2BB24C',
			'svg' => 'd="M7.396 21.932L.62 15.108c-.825-.824-.825-2.609 0-3.39l9.709-9.752c.781-.78 2.521-.78 3.297 0l9.756 9.753c.826.825.826 2.611 0 3.391l-6.779 6.824c-.411.41-1.053.686-1.695.686H9c-.596-.001-1.19-.276-1.604-.688zm6.184-2.656c.137-.138.137-.413 0-.55l-1.328-1.328c-.138-.15-.412-.15-.549 0l-1.329 1.319c-.138.134-.138.405 0 .54l1.054 1.005h1.099l1.065-1.02-.012.034zm0-5.633c.092-.09.092-.32 0-.412l-1.42-1.409c-.09-.091-.32-.091-.412 0l-4.121 4.124c-.139.15-.139.465 0 .601l.959.96h1.102l3.893-3.855v-.009zm0-5.587c.092-.091.137-.366 0-.458l-1.375-1.374c-.09-.104-.365-.104-.502 0l-6.914 6.915c-.094.09-.14.359-.049.449l1.1 1.05h1.053l6.687-6.582z"',
		),
		'flickr'           => array(
			'name' => esc_html__('Flickr', 'yahman-add-ons'),
			'base' => esc_url('https://www.flickr.com/photos/'),
			'share' => '',
            'color' => '#333',//'#0063DC'
            'svg' => 'd="M0 12c0 3.074 2.494 5.564 5.565 5.564 3.075 0 5.569-2.49 5.569-5.564S8.641 6.436 5.565 6.436C2.495 6.436 0 8.926 0 12zm12.866 0c0 3.074 2.493 5.564 5.567 5.564C21.496 17.564 24 15.074 24 12s-2.492-5.564-5.564-5.564c-3.075 0-5.57 2.49-5.57 5.564z"',
            'svg_L' => 'd="M0,12c0,3.1,2.5,5.6,5.6,5.6c3.1,0,5.6-2.5,5.6-5.6S8.6,6.4,5.6,6.4C2.5,6.4,0,8.9,0,12z"',
            'svg_R' => 'd="M12.9,12c0,3.1,2.5,5.6,5.6,5.6c3.1,0,5.6-2.5,5.6-5.6s-2.5-5.6-5.6-5.6C15.4,6.4,12.9,8.9,12.9,12z"',
        ),
		'github'           => array(
			'name' => esc_html__('GitHub', 'yahman-add-ons'),
			'base' => esc_url('https://github.com/'),
			'share' => '',
			'color' => '#181717',
			'svg' => 'd="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"',
		),
        /*'googleplus'       => array(
            'name' => esc_html__('Google+', 'yahman-add-ons'),
            'base' => esc_url('https://plus.google.com/'),
            'share' => 'https://plus.google.com/share?url=',
        ),*/
        'hatenabookmark'   => array(
        	'name' => esc_html__('Hatena Bookmark', 'yahman-add-ons'),
        	'base' => esc_url('https://b.hatena.ne.jp/'),
        	'share' => 'https://b.hatena.ne.jp/add?mode=confirm&url=',
        	'color' => '#00A4DE',
        	'svg' => 'd="M20.47 0C22.42 0 24 1.58 24 3.53v16.94c0 1.95-1.58 3.53-3.53 3.53H3.53C1.58 24 0 22.42 0 20.47V3.53C0 1.58 1.58 0 3.53 0h16.94zm-3.705 14.47c-.78 0-1.41.63-1.41 1.41s.63 1.414 1.41 1.414 1.41-.645 1.41-1.425-.63-1.41-1.41-1.41zM8.61 17.247c1.2 0 2.056-.042 2.58-.12.526-.084.976-.222 1.32-.412.45-.232.78-.564 1.02-.99s.36-.915.36-1.48c0-.78-.21-1.403-.63-1.87-.42-.48-.99-.734-1.74-.794.66-.18 1.156-.45 1.456-.81.315-.344.465-.824.465-1.424 0-.48-.103-.885-.3-1.26-.21-.36-.493-.645-.883-.87-.345-.195-.735-.315-1.215-.405-.464-.074-1.29-.12-2.474-.12H5.654v10.486H8.61zm.736-4.185c.705 0 1.185.088 1.44.262.27.18.39.495.39.93 0 .405-.135.69-.42.855-.27.18-.765.254-1.44.254H8.31v-2.297h1.05zm8.656.706v-7.06h-2.46v7.06H18zM8.925 9.08c.71 0 1.185.08 1.432.24.245.16.367.435.367.83 0 .38-.13.646-.39.804-.265.154-.747.232-1.452.232h-.57V9.08h.615z"',
        ),
        'instagram'        => array(
        	'name' => esc_html__('Instagram', 'yahman-add-ons'),
        	'base' => esc_url('https://www.instagram.com/'),
        	'share' => '',
            'color' => '#E4405F',//'#E4405F',
            'svg' => 'd="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"',
        ),
        'line'             => array(
        	'name' => esc_html__('Line', 'yahman-add-ons'),
        	'base' => esc_url('http://line.naver.jp/ti/p/'),
        	'share' => 'https://line.me/R/msg/text/?',
        	'color' => '#00C300',
        	'svg' => 'd="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"',
        ),
        'linkedin'         => array(
        	'name' => esc_html__('LinkedIn', 'yahman-add-ons'),
        	'base' => esc_url('https://www.linkedin.com/in/'),
        	'share' => 'https://www.linkedin.com/shareArticle?mini=true&url=',
        	'color' => '#0077B5',
        	'svg' => 'd="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"',
        ),
        'mail'               => array(
        	'name' => esc_html__('Email', 'yahman-add-ons'),
        	'base' => '',
        	'share' => 'mailto:?subject=',
        	'color' => '#000000',
        	'svg' => 'd="M22.3,19.3V9c-0.3,0.3-0.6,0.6-0.9,0.9c-1.9,1.5-3.8,3-5.7,4.5c-1,0.8-2.3,1.9-3.6,1.9h0c-1.4,0-2.6-1-3.6-1.9 c-1.9-1.6-3.8-3.1-5.7-4.5C2.3,9.6,2,9.3,1.7,9v10.3c0,0.2,0.2,0.4,0.4,0.4h19.7C22.1,19.7,22.3,19.5,22.3,19.3z M22.3,5.2 c0-0.3,0.1-0.9-0.4-0.9H2.1c-0.2,0-0.4,0.2-0.4,0.4c0,1.5,0.8,2.9,2,3.8c1.8,1.4,3.6,2.8,5.4,4.2c0.7,0.6,2,1.8,2.9,1.8h0 c0.9,0,2.2-1.2,2.9-1.8c1.8-1.4,3.6-2.8,5.4-4.2C21.2,7.8,22.3,6.3,22.3,5.2z M24,4.7v14.6c0,1.2-1,2.1-2.1,2.1H2.1 c-1.2,0-2.1-1-2.1-2.1V4.7c0-1.2,1-2.1,2.1-2.1h19.7C23,2.6,24,3.5,24,4.7z"',
        ),
        'messenger'          => array(
        	'name' => esc_html__('Messenger', 'yahman-add-ons'),
        	'base' => '',
        	'share' => 'fb-messenger://share/?link=',
        	'color' => '#00B2FF',
        	'svg' => 'd="M0 11.64C0 4.95 5.24 0 12 0s12 4.95 12 11.64-5.24 11.64-12 11.64c-1.21 0-2.38-.16-3.47-.46a.96.96 0 0 0-.64.05L5.5 23.92a.96.96 0 0 1-1.35-.85l-.07-2.14a.97.97 0 0 0-.32-.68A11.39 11.39 0 0 1 0 11.64zm8.32-2.19l-3.52 5.6c-.35.53.32 1.14.82.75l3.79-2.87c.26-.2.6-.2.87 0l2.8 2.1c.84.63 2.04.4 2.6-.48l3.52-5.6c.35-.53-.32-1.13-.82-.75l-3.79 2.87c-.25.2-.6.2-.86 0l-2.8-2.1a1.8 1.8 0 0 0-2.61.48z"',
        ),
        'meetup'           => array(
        	'name' => esc_html__('Meetup', 'yahman-add-ons'),
        	'base' => esc_url('https://www.meetup.com/'),
        	'share' => '',
        	'color' => '#ED1C40',
        	'svg' => 'd="M23.978 20.238c-.304-1.931-3.874-.444-4.096-2.559-.313-2.998 4.15-9.459 3.797-11.972-.313-2.255-1.841-2.73-3.165-2.756-1.284-.02-1.623.182-2.058.435-.253.146-.612.435-1.112-.041-.334-.318-.557-.536-.905-.819-.182-.142-.466-.324-.945-.395-.476-.071-1.098 0-1.492.167-.395.172-.702.466-1.026.749-.323.283-1.147 1.198-1.911.859-.335-.145-1.458-.706-2.272-1.055-1.563-.677-3.822.42-4.636 1.866C2.944 6.866.557 15.32.193 16.432c-.809 2.502 1.032 4.54 3.509 4.424 1.052-.051 1.75-.43 2.412-1.638.384-.693 3.979-10.087 4.248-10.543.197-.323.844-.753 1.39-.475.551.283.662.869.581 1.421-.136.895-2.669 6.629-2.771 7.275-.162 1.103.359 1.714 1.507 1.774.784.041 1.567-.237 2.184-1.41.349-.652 4.349-8.666 4.702-9.202.39-.586.703-.779 1.103-.758.309.015.799.096.678 1.016-.122.905-3.343 6.78-3.676 8.221-.456 1.927.602 3.874 2.341 4.728 1.112.546 5.97 1.476 5.577-1.027z"',
        ),
        'note'           => array(
        	'name' => esc_html__('note', 'yahman-add-ons'),
        	'base' => esc_url('https://note.com/'),
        	'share' => 'https://note.com/intent/post?url=',
        	'color' => '#41C9B4',
        	'svg' => 'd="M4.4,21h15.1V3.1h-11c-0.1,0-0.2,0.1-0.3,0.1C7.1,4.6,5.8,6,4.5,7.4C4.5,7.5,4.4,7.6,4.4,7.8L4.4,21z M21.1,0.1 c0.8,0,1.5,0.7,1.5,1.5v21c0,0.8-0.7,1.5-1.5,1.5H2.9c-0.8,0-1.5-0.7-1.5-1.5c0-0.2,0-14.8,0-15.3c0-0.6,0.2-1.1,0.6-1.5l4.6-5 C7,0.3,7.4,0.1,8,0.1L21.1,0.1L21.1,0.1z M7.5,10.6c-0.7,0-1.2-0.6-1.2-1.2c0-0.7,0.6-1.2,1.2-1.2h2.1V6.1c0-0.7,0.6-1.2,1.2-1.2 c0.7,0,1.2,0.6,1.2,1.2v3.3c0,0.7-0.6,1.2-1.2,1.2L7.5,10.6L7.5,10.6z"',
        ),
        'pinterest'        => array(
        	'name' => esc_html__('Pinterest', 'yahman-add-ons'),
        	'base' => esc_url('https://www.pinterest.com/'),
        	'share' => '',
        	'color' => '#BD081C',
        	'svg' => 'd="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z"',
        ),
        'pocket'             => array(
        	'name' => esc_html__('Pocket', 'yahman-add-ons'),
        	'base' => '',
        	'share' => 'https://getpocket.com/edit?url=',
        	'color' => '#EF3F56',
        	'svg' => 'd="M18.813 10.259l-5.646 5.419c-.32.305-.73.458-1.141.458-.41 0-.821-.153-1.141-.458l-5.646-5.419c-.657-.628-.677-1.671-.049-2.326.63-.657 1.671-.679 2.325-.05l4.511 4.322 4.517-4.322c.66-.631 1.697-.607 2.326.049.631.645.615 1.695-.045 2.326l-.011.001zm5.083-7.546c-.299-.858-1.125-1.436-2.041-1.436H2.179c-.9 0-1.717.564-2.037 1.405-.094.25-.142.511-.142.774v7.245l.084 1.441c.348 3.277 2.047 6.142 4.682 8.139.045.036.094.07.143.105l.03.023c1.411 1.03 2.989 1.728 4.694 2.072.786.158 1.591.24 2.389.24.739 0 1.481-.067 2.209-.204.088-.029.176-.045.264-.06.023 0 .049-.015.074-.029 1.633-.36 3.148-1.036 4.508-2.025l.029-.031.135-.105c2.627-1.995 4.324-4.862 4.686-8.148L24 10.678V3.445c0-.251-.031-.5-.121-.742l.017.01z"',
        ),
        'print'               => array(
        	'name' => esc_html__('Print', 'yahman-add-ons'),
        	'base' => '',
        	'share' => 'javascript:void(0)',
        	'color' => '#000000',
        	'svg' => 'd="M5.5,21.2h12.9v-3.7H5.5V21.2z M5.5,12h12.9V6.5h-2.3c-0.8,0-1.4-0.6-1.4-1.4V2.8H5.5V12z M22.2,12.9c0-0.5-0.4-0.9-0.9-0.9 c-0.5,0-0.9,0.4-0.9,0.9c0,0.5,0.4,0.9,0.9,0.9C21.7,13.8,22.2,13.4,22.2,12.9z M24,12.9v6c0,0.2-0.2,0.5-0.5,0.5h-3.2v2.3 c0,0.8-0.6,1.4-1.4,1.4H5.1c-0.8,0-1.4-0.6-1.4-1.4v-2.3H0.5c-0.2,0-0.5-0.2-0.5-0.5v-6c0-1.5,1.3-2.8,2.8-2.8h0.9V2.3 c0-0.8,0.6-1.4,1.4-1.4h9.7c0.8,0,1.8,0.4,2.4,1l2.2,2.2c0.5,0.5,1,1.6,1,2.4v3.7h0.9C22.7,10.2,24,11.4,24,12.9z"',
        	'javascript' => 'onclick="window.print();return false;"',
        ),
        'reddit'             => array(
        	'name' => esc_html__('Reddit', 'yahman-add-ons'),
        	'base' => '',
        	'share' => 'https://reddit.com/submit?url=',
        	'color' => '#FF4500',
        	'svg' => 'd="M2.204 14.049c-.06.276-.091.56-.091.847 0 3.443 4.402 6.249 9.814 6.249 5.41 0 9.812-2.804 9.812-6.249 0-.274-.029-.546-.082-.809l-.015-.032c-.021-.055-.029-.11-.029-.165-.302-1.175-1.117-2.241-2.296-3.103-.045-.016-.088-.039-.126-.07-.026-.02-.045-.042-.067-.064-1.792-1.234-4.356-2.008-7.196-2.008-2.815 0-5.354.759-7.146 1.971-.014.018-.029.033-.049.049-.039.033-.084.06-.13.075-1.206.862-2.042 1.937-2.354 3.123 0 .058-.014.114-.037.171l-.008.015zm9.773 5.441c-1.794 0-3.057-.389-3.863-1.197-.173-.174-.173-.457 0-.632.176-.165.46-.165.635 0 .63.629 1.685.943 3.228.943 1.542 0 2.591-.3 3.219-.929.165-.164.45-.164.629 0 .165.18.165.465 0 .645-.809.808-2.065 1.198-3.862 1.198l.014-.028zm-3.606-7.573c-.914 0-1.677.765-1.677 1.677 0 .91.763 1.65 1.677 1.65s1.651-.74 1.651-1.65c0-.912-.739-1.677-1.651-1.677zm7.233 0c-.914 0-1.678.765-1.678 1.677 0 .91.764 1.65 1.678 1.65s1.651-.74 1.651-1.65c0-.912-.739-1.677-1.651-1.677zm4.548-1.595c1.037.833 1.8 1.821 2.189 2.904.45-.336.719-.864.719-1.449 0-1.002-.815-1.816-1.818-1.816-.399 0-.778.129-1.09.363v-.002zM2.711 9.963c-1.003 0-1.817.816-1.817 1.818 0 .543.239 1.048.644 1.389.401-1.079 1.172-2.053 2.213-2.876-.302-.21-.663-.329-1.039-.329v-.002zm9.217 12.079c-5.906 0-10.709-3.205-10.709-7.142 0-.275.023-.544.068-.809C.494 13.598 0 12.729 0 11.777c0-1.496 1.227-2.713 2.725-2.713.674 0 1.303.246 1.797.682 1.856-1.191 4.357-1.941 7.112-1.992l1.812-5.524.404.095s.016 0 .016.002l4.223.993c.344-.798 1.138-1.36 2.065-1.36 1.229 0 2.231 1.004 2.231 2.234 0 1.232-1.003 2.234-2.231 2.234s-2.23-1.004-2.23-2.23l-3.851-.912-1.467 4.477c2.65.105 5.047.854 6.844 2.021.494-.464 1.144-.719 1.833-.719 1.498 0 2.718 1.213 2.718 2.711 0 .987-.54 1.886-1.378 2.365.029.255.059.494.059.749-.015 3.938-4.806 7.143-10.72 7.143l-.034.009zm8.179-19.187c-.74 0-1.34.599-1.34 1.338 0 .738.6 1.34 1.34 1.34.732 0 1.33-.6 1.33-1.334 0-.733-.598-1.332-1.347-1.332l.017-.012z"',
        ),
        'rdf'              => array(
        	'name' => esc_html__('RDF &frasl; RSS 1.0', 'yahman-add-ons'),
        	'base' => esc_url(get_bloginfo('rdf_url')),
        	'share' => '',
        	'color' => '#FFA500',
        	'svg' => 'd="M19.199 24C19.199 13.467 10.533 4.8 0 4.8V0c13.165 0 24 10.835 24 24h-4.801zM3.291 17.415c1.814 0 3.293 1.479 3.293 3.295 0 1.813-1.485 3.29-3.301 3.29C1.47 24 0 22.526 0 20.71s1.475-3.294 3.291-3.295zM15.909 24h-4.665c0-6.169-5.075-11.245-11.244-11.245V8.09c8.727 0 15.909 7.184 15.909 15.91z"',
        ),
        'rss'              => array(
        	'name' => esc_html__('RSS 0.92', 'yahman-add-ons'),
        	'base' => esc_url(get_bloginfo('rss_url')),
        	'share' => '',
        	'color' => '#FFA500',
        	'svg' => 'd="M19.199 24C19.199 13.467 10.533 4.8 0 4.8V0c13.165 0 24 10.835 24 24h-4.801zM3.291 17.415c1.814 0 3.293 1.479 3.293 3.295 0 1.813-1.485 3.29-3.301 3.29C1.47 24 0 22.526 0 20.71s1.475-3.294 3.291-3.295zM15.909 24h-4.665c0-6.169-5.075-11.245-11.244-11.245V8.09c8.727 0 15.909 7.184 15.909 15.91z"',
        ),
        'rss2'             => array(
        	'name' => esc_html__('RSS 2.0', 'yahman-add-ons'),
        	'base' => esc_url(get_bloginfo('rss2_url')),
        	'share' => '',
        	'color' => '#FFA500',
        	'svg' => 'd="M19.199 24C19.199 13.467 10.533 4.8 0 4.8V0c13.165 0 24 10.835 24 24h-4.801zM3.291 17.415c1.814 0 3.293 1.479 3.293 3.295 0 1.813-1.485 3.29-3.301 3.29C1.47 24 0 22.526 0 20.71s1.475-3.294 3.291-3.295zM15.909 24h-4.665c0-6.169-5.075-11.245-11.244-11.245V8.09c8.727 0 15.909 7.184 15.909 15.91z"',
        ),
        'atom'             => array(
        	'name' => esc_html__('Atom', 'yahman-add-ons'),
        	'base' => esc_url(get_bloginfo('atom_url')),
        	'share' => '',
        	'color' => '#FFA500',
        	'svg' => 'd="M19.199 24C19.199 13.467 10.533 4.8 0 4.8V0c13.165 0 24 10.835 24 24h-4.801zM3.291 17.415c1.814 0 3.293 1.479 3.293 3.295 0 1.813-1.485 3.29-3.301 3.29C1.47 24 0 22.526 0 20.71s1.475-3.294 3.291-3.295zM15.909 24h-4.665c0-6.169-5.075-11.245-11.244-11.245V8.09c8.727 0 15.909 7.184 15.909 15.91z"',
        ),
        'soundcloud'       => array(
        	'name' => esc_html__('SoundCloud', 'yahman-add-ons'),
        	'base' => esc_url('https://soundcloud.com/'),
        	'share' => '',
        	'color' => '#FF3300',
        	'svg' => 'd="M1.175 12.225c-.051 0-.094.046-.101.1l-.233 2.154.233 2.105c.007.058.05.098.101.098.05 0 .09-.04.099-.098l.255-2.105-.27-2.154c0-.057-.045-.1-.09-.1m-.899.828c-.06 0-.091.037-.104.094L0 14.479l.165 1.308c0 .055.045.094.09.094s.089-.045.104-.104l.21-1.319-.21-1.334c0-.061-.044-.09-.09-.09m1.83-1.229c-.061 0-.12.045-.12.104l-.21 2.563.225 2.458c0 .06.045.12.119.12.061 0 .105-.061.121-.12l.254-2.474-.254-2.548c-.016-.06-.061-.12-.121-.12m.945-.089c-.075 0-.135.06-.15.135l-.193 2.64.21 2.544c.016.077.075.138.149.138.075 0 .135-.061.15-.15l.24-2.532-.24-2.623c0-.075-.06-.135-.135-.135l-.031-.017zm1.155.36c-.005-.09-.075-.149-.159-.149-.09 0-.158.06-.164.149l-.217 2.43.2 2.563c0 .09.075.157.159.157.074 0 .148-.068.148-.158l.227-2.563-.227-2.444.033.015zm.809-1.709c-.101 0-.18.09-.18.181l-.21 3.957.187 2.563c0 .09.08.164.18.164.094 0 .174-.09.18-.18l.209-2.563-.209-3.972c-.008-.104-.088-.18-.18-.18m.959-.914c-.105 0-.195.09-.203.194l-.18 4.872.165 2.548c0 .12.09.209.195.209.104 0 .194-.089.21-.209l.193-2.548-.192-4.856c-.016-.12-.105-.21-.21-.21m.989-.449c-.121 0-.211.089-.225.209l-.165 5.275.165 2.52c.014.119.104.225.225.225.119 0 .225-.105.225-.225l.195-2.52-.196-5.275c0-.12-.105-.225-.225-.225m1.245.045c0-.135-.105-.24-.24-.24-.119 0-.24.105-.24.24l-.149 5.441.149 2.503c.016.135.121.24.256.24s.24-.105.24-.24l.164-2.503-.164-5.456-.016.015zm.749-.134c-.135 0-.255.119-.255.254l-.15 5.322.15 2.473c0 .15.12.255.255.255s.255-.12.255-.27l.15-2.474-.165-5.307c0-.148-.12-.27-.271-.27m1.005.166c-.164 0-.284.135-.284.285l-.103 5.143.135 2.474c0 .149.119.277.284.277.149 0 .271-.12.284-.285l.121-2.443-.135-5.112c-.012-.164-.135-.285-.285-.285m1.184-.945c-.045-.029-.105-.044-.165-.044s-.119.015-.165.044c-.09.054-.149.15-.149.255v.061l-.104 6.048.115 2.449v.008c.008.06.03.135.074.18.058.061.142.104.234.104.08 0 .158-.044.209-.09.058-.06.091-.135.091-.225l.015-.24.117-2.203-.135-6.086c0-.104-.061-.193-.135-.239l-.002-.022zm1.006-.547c-.045-.045-.09-.061-.15-.061-.074 0-.149.016-.209.061-.075.061-.119.15-.119.24v.029l-.137 6.609.076 1.215.061 1.185c0 .164.148.314.328.314.181 0 .33-.15.33-.329l.15-2.414-.15-6.637c0-.12-.074-.221-.165-.277m8.934 3.777c-.405 0-.795.086-1.139.232-.24-2.654-2.46-4.736-5.188-4.736-.659 0-1.305.135-1.889.359-.225.09-.27.18-.285.359v9.368c.016.18.15.33.33.345h8.185C22.681 17.218 24 15.914 24 14.28s-1.319-2.952-2.938-2.952"',
        ),
        'tumblr'           => array(
        	'name' => esc_html__('Tumblr', 'yahman-add-ons'),
        	'base' => '',
        	'share' => 'https://www.tumblr.com/share/link?url=',
        	'color' => '#36465D',
        	'svg' => 'd="M14.563 24c-5.093 0-7.031-3.756-7.031-6.411V9.747H5.116V6.648c3.63-1.313 4.512-4.596 4.71-6.469C9.84.051 9.941 0 9.999 0h3.517v6.114h4.801v3.633h-4.82v7.47c.016 1.001.375 2.371 2.207 2.371h.09c.631-.02 1.486-.205 1.936-.419l1.156 3.425c-.436.636-2.4 1.374-4.156 1.404h-.178l.011.002z"',
        ),
        'twitter'          => array(
        	'name' => esc_html__('Twitter', 'yahman-add-ons'),
        	'base' => esc_url('https://twitter.com/'),
        	'share' => 'https://twitter.com/share?url=',
        	'color' => '#1DA1F2',
        	'svg' => 'd="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"',
        ),
        'vimeo'            => array(
        	'name' => esc_html__('Vimeo', 'yahman-add-ons'),
        	'base' => esc_url('https://vimeo.com/'),
        	'share' => '',
        	'color' => '#1AB7EA',
        	'svg' => 'd="M23.977 6.416c-.105 2.338-1.739 5.543-4.894 9.609-3.268 4.247-6.026 6.37-8.29 6.37-1.409 0-2.578-1.294-3.553-3.881L5.322 11.4C4.603 8.816 3.834 7.522 3.01 7.522c-.179 0-.806.378-1.881 1.132L0 7.197c1.185-1.044 2.351-2.084 3.501-3.128C5.08 2.701 6.266 1.984 7.055 1.91c1.867-.18 3.016 1.1 3.447 3.838.465 2.953.789 4.789.971 5.507.539 2.45 1.131 3.674 1.776 3.674.502 0 1.256-.796 2.265-2.385 1.004-1.589 1.54-2.797 1.612-3.628.144-1.371-.395-2.061-1.614-2.061-.574 0-1.167.121-1.777.391 1.186-3.868 3.434-5.757 6.762-5.637 2.473.06 3.628 1.664 3.493 4.797l-.013.01z"',
        ),
        'whatsapp'           => array(
        	'name' => esc_html__('WhatsApp', 'yahman-add-ons'),
        	'base' => '',
        	'share' => 'https://api.whatsapp.com/send?text=',
        	'color' => '#25D366',
        	'svg' => 'd="M17.498 14.382c-.301-.15-1.767-.867-2.04-.966-.273-.101-.473-.15-.673.15-.197.295-.771.964-.944 1.162-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.174-.3-.019-.465.13-.615.136-.135.301-.345.451-.523.146-.181.194-.301.297-.496.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.172-.015-.371-.015-.571-.015-.2 0-.523.074-.797.359-.273.3-1.045 1.02-1.045 2.475s1.07 2.865 1.219 3.075c.149.195 2.105 3.195 5.1 4.485.714.3 1.27.48 1.704.629.714.227 1.365.195 1.88.121.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345m-5.446 7.443h-.016c-1.77 0-3.524-.48-5.055-1.38l-.36-.214-3.75.975 1.005-3.645-.239-.375c-.99-1.576-1.516-3.391-1.516-5.26 0-5.445 4.455-9.885 9.942-9.885 2.654 0 5.145 1.035 7.021 2.91 1.875 1.859 2.909 4.35 2.909 6.99-.004 5.444-4.46 9.885-9.935 9.885M20.52 3.449C18.24 1.245 15.24 0 12.045 0 5.463 0 .104 5.334.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652c1.746.943 3.71 1.444 5.71 1.447h.006c6.585 0 11.946-5.336 11.949-11.896 0-3.176-1.24-6.165-3.495-8.411"',
        ),
        'youtube'          => array(
        	'name' => esc_html__('Youtube', 'yahman-add-ons'),
        	'base' => esc_url('https://www.youtube.com/'),
        	'share' => '',
        	'color' => '#FF0000',
        	'svg' => 'd="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"',
        ),
    );

}

function yahman_addons_social_shape_list() {

	return array(
		'icon_square' => esc_html__( 'square', 'yahman-add-ons' ),
		'icon_circle' => esc_html__( 'circle', 'yahman-add-ons' ),
		'icon_rectangle' => esc_html__( 'rectangle', 'yahman-add-ons' ),
		'icon_character' => esc_html__( 'only icon', 'yahman-add-ons' ),
		'icon_hollow_square' => esc_html__( 'hollow square', 'yahman-add-ons' ),
		'icon_hollow_circle' => esc_html__( 'hollow circle', 'yahman-add-ons' ),
		'icon_hollow_rectangle' => esc_html__( 'hollow rectangle', 'yahman-add-ons' ),
	);

}

function yahman_addons_social_size_list() {

	return array(
		'icon_small' => esc_html__( 'small', 'yahman-add-ons' ),
		'icon_medium' => esc_html__( 'medium', 'yahman-add-ons' ),
		'icon_large' => esc_html__( 'large', 'yahman-add-ons' ),
		'icon_xlarge' => esc_html__( 'extra large', 'yahman-add-ons' ),
	);

}

function yahman_addons_social_align_list() {

	return array(
		'center' => esc_html__( 'Center', 'yahman-add-ons' ),
		'left' => esc_html__( 'Left', 'yahman-add-ons' ),
		'right' => esc_html__( 'Right', 'yahman-add-ons' ),
		'space_between' => esc_html__( 'Space between', 'yahman-add-ons' ),
	);

}