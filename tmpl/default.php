<?php
/**
 *  package: Joomla Opening Hours module - FREE Version
 *  copyright: Copyright (c) 2020. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

$document = Factory::getDocument();
$document->addStylesheet('modules/mod_openinghours/tmpl/style.css');

// Get days for this week
$timezone = $params->get('Timezone');
$now = new DateTime(NULL, new DateTimeZone($timezone));
$today = $now->format('l');
$todayformat = $now ->format($params->get('Dateformat'));
$weekday = $now->format('w');
$localtime = $now->format('H:i');

$msg1='CLOSED';
$msg2='CLOSED';

// Construct this week
    if($params->get('Weekstart') == 3) :
	{
	$week  = array( 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' );
	if ($weekday==6) :
		$weekday = -6+$weekday;
	else :
		$weekday = -$weekday-1;
	endif;
	}
	elseif($params->get('Weekstart') == 1) :
	{
	$week  = array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' );
	$weekday = 0-$weekday;
	}
		elseif(($params->get('Weekstart') == 2) && ($params->get('Monfri') == 1)) :
	{
	$week  = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' );
	if ($weekday==0) :
		$weekday = -6+$weekday;
	else :
		$weekday = 1-$weekday;
	endif;
	}
	elseif($params->get('Weekstart') == 2) :
	{
	$week  = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' );
	if ($weekday==0) :
		$weekday = -6+$weekday;
	else :
		$weekday = 1-$weekday;
	endif;
	}		
	endif;
	
	    $todaytime1  = $params->get( $today.'times1' ) ;
		$todaytime2  = $params->get( $today.'times2' ) ;
?>	
<div style="width:<?php echo $params->get('Width'); ?>; margin: auto;">
<?php 
// Display notes on top	
	if($params->get('Viewnotes')==1) { ?> 
	<div class="openinghours-notes"<?php echo $params->get('Notes'); ?></div>
<?php }; ?>

<div itemscope itemtype="http://schema.org/LocalBusiness" class="openinghours" font-family: <?php echo $params->get('Font'); ?>; font-size: <?php echo $params->get('Fontsize'); ?>;">

<?php
// For each Day	
    foreach ( $week as $day )
    {
        $text  = strtoupper( $day );
		$microdate = substr($day, 0, 2);
        $time1  = $day . 'times1' ;		
		$time2  = $day . 'times2' ;
		$microtime1 = str_replace(" ", "", $params->get( $time1 )); 
		$microtime2 = str_replace(" ", "", $params->get( $time2 ));

// Add format for Regular openinghours
		if (strpos($microtime1,'-') !== false) {
			$regformat1 = explode("-", $microtime1, 2);
			$regopen1=$regformat1[0];
			$regopen1 = date_create_from_format('H:i', $regopen1);
			$regopen1 = $regopen1->format($params->get('Timeformat'));
			$regclose1=$regformat1[1];
			$regclose1 = date_create_from_format('H:i', $regclose1);
			$regclose1 = $regclose1->format($params->get('Timeformat')); 
			$regtime1 = $regopen1.' - '.$regclose1;
		} else {
			$regtime1 = $params->get( $time1 );
		} 
		if (strpos($microtime2,'-') !== false) {
			$regformat2 = explode("-", $microtime2, 2);
			$regopen2 = $regformat2[0];
			$regopen2 = date_create_from_format('H:i', $regopen2);
			$regopen2 = $regopen2->format($params->get('Timeformat')); 
			$regclose2 = $regformat2[1];
			$regclose2 = date_create_from_format('H:i', $regclose2);
			$regclose2 = $regclose2->format($params->get('Timeformat')); 
			$regtime2 = $regopen2.' - '.$regclose2;
		} else {
			$regtime2 = $params->get( $time2 );
		} 		

?>

<?php
	$onlytoday = ( $day != $today ) ? 'style="display:none"' : '';
	$Highlightcolor = $params->get('Highlightcolor'); 
	$Highlightbold = $params->get('Highlightbold'); 
	$Highlightitalic = $params->get('Highlightitalic');
    $timeclass = ( $day == $today ) ? 'style="font-weight:bold; color:#3990BD;"' : '';
 
// Highlight today
	if ($params->get('Highlight')==0):?>
	<div class="openinghours-eachday">
	<?php else : ?>
    <div class="openinghours-eachday" <?php echo Text::_( $timeclass ); ?>>
    <?php endif; ?>
	 
    <div class="openinghours-day" style="width:48%; text-align:<?php echo $params->get('Dayalign'); ?>;"><?php echo Text::_( $text ); ?></div>

<?php 
	// No microdata
	if($params->get('Usemicro') == 0) : { ?>
	<div class="openinghours-time" style="width:48%; text-align:<?php echo $params->get('Timealign'); ?>;"><?php echo $regtime1; ?></div>
                                 
<?php 
	// Use Microdata
	}	elseif($params->get('Usemicro') == 1) : { ?>
	<div class="openinghours-time" style="width:48%; text-align:<?php echo $params->get('Timealign'); ?>;"> 
	<?php if (strpos($microtime1,'-') !== false) { ?><meta itemprop="openingHours" content="<?php echo $microdate ; ?> <?php echo $microtime1 ; ?>"><?php } ?>
	<?php echo $regtime1; ?></div>
	<?php } endif;  ?>  
    </div>
<?php    
	$weekday = $weekday+1;
    }
?>
</div>
    
<?php if($params->get('Debug') == 1) : { ?>
	<?php echo 'Localtime:'.$localtime; ?><br/>
	<?php echo 'Timezone:'.$timezone; ?><br/>
    <?php } endif; ?>

	<div style="font-size:9px; padding: 5px 10px 5px 0; text-align:center"><a href="http://www.joomill-extensions.com/" rel="nofollow" target="_blank">Opening Hours module by: Joomill</a></div>
</div>