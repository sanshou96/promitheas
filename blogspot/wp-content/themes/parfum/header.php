<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Parfum
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="contentwrap">
        <div class="navwrap2 abs sticky" id="myNavwrap">
    <nav>
        <div class="navwrap" id="myNavwrap1">
               <div class="logo">
                    <a href="/prom/index.php" title="Αρχική σελίδα" target=""> 
						<img class="navimg"id="navimgid" src="/prom/blogspot/wp-content/uploads/2020/08/31-1.png" 
						alt="promitheas nikaias logo" height="120px"></a>
                </div>
                <span class="nav">
                    <div class="liwrap">
                    <div class="icon-bar" onclick="Show()">
                        <i></i>
                        <i></i>
                        <i></i>
                    </div>

                   <ul id="nav-lists">
               <li class="close"><span onclick="Hide()">×</span></li>
               <li><a href="/prom/index.php" title="Αρχική σελίδα" target="">Αρχική σελίδα</a></li>
                <li class="dropdown"><a href="about.html" class="dropbtn" title="Ο σύλλογος μας" target="">Ο Συλλογός μας </a>
                    <div class="dropdown-content">
      <a href="/prom/kungfu.php">WUSHU KUNGFU</a>
      <a href="/prom/sanda.php">SANDA</a>
      <a href="/prom/shuaijiao.php">SHUAI JIAO</a>
                    <a href="/prom/gengym.php">ΓΕΝΙΚΗ ΓΥΜΝΑΣΤΙΚΗ</a>
                    <a href="/prom/basket.php">ΜΠΑΣΚΕΤ</a>
    </div></li>
               <li> <a href="/prom/trainers.php" title="Προπονητές" target="">Προπονητές</a></li>
               <li> <a href="/prom/schedule.php" title="Πρόγραμμα" target="">Πρόγραμμα</a></li>
               <li> <a href="/prom/blogspot/" title="Άρθρα" target="">Άρθρα</a></li>
               <li> <a href="/prom/blogspot/album/" title="Πολυμέσα" target="">Πολυμέσα</a></li>
               <li> <a href="/prom/contact.php" title="Επικοινωνία" target="">Επικοινωνια</a></li>
              
            </ul>
                    </div>       
        </span>    
           
        </div>
    </nav>
            </div>
<div id="page" class="hfeed site">
	<?php do_action( 'parfum_before_header' ); ?>

	

	<?php do_action( 'parfum_after_header' ); ?>

	<div id="main">
		<div class="inner-wrap">
			<div class="content-sidebar-inner-wrap">
