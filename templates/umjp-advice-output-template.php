<?php
global $umjp_master;
$advice = $umjp_master->advice->get_advice();
wp_enqueue_script('umjp_font_awesome', umjp_js . "fontawesome-all.min.js");
?>

<h3 id="umjp_scheduleText"><i class="fas fa-heartbeat umjp-heartIcon"></i> Training Schedule This Week:</h3>

<?php 
// The not interval advice UI begins here ///////////////
if (!array_key_exists('intervalTime', $advice[0])) {
?>
<div class="umjp_MasterNonInterval">
<?php
    for ($i = 0; $i < count($advice) ; $i++) {
?>
        <div class="umjp_adviceContainer">
            <div id="umjp_trainingTitle" class="umjp_adviceChild">Training <?php echo ($i + 1) ?>:</div>
            <div class="umjp_adviceChild"><?php echo number_format(round($advice[$i]['distance'], 1), 1); ?>  Km</div>
            <div class="umjp_adviceChild"><?php echo round($advice[$i]['duration']); ?> Min</div>
            <div class="umjp_adviceChild"><?php echo number_format(round(($advice[$i]['distance'] / ($advice[$i]['duration'] / 60)), 1), 1); ?>  Km/H</div>
        </div>
<?php
    }
?>
</div>
<?php
}

// The interval advice UI begins here /////////////////////////////////////////////////////////////////////
if (array_key_exists('intervalTime', $advice[0])) {

    // Long training duration can harm the UI, in the rare case of a run longer than 90 min these styles have to overwrite the other styles
    if( $advice[0]['duration'] > 90) {
        wp_enqueue_style( 'umjp-advice-output-adjusted.css' , umjp_CSS . 'umjp-advice-output-adjusted.css' );
    }
 
    for ($i = 0; $i < count($advice) ; $i++) {
     
?>
    <div class="umjp_adviceIntervalContainer">
    <div class="umjp_intervalInfo">
        <div class="umjp_intervalText">Training <?php echo ($i + 1) ?>:</div>
        <div class="umjp_intervalText"><?php echo number_format(round($advice[$i]['distance'], 1), 1); ?> Km</div>
        <div class="umjp_intervalText"><?php echo round($advice[$i]['duration']); ?> Min</div>
    </div>

    <div class="umjp_intervalContent">

        <div class="umjp_legendaInterval">
            <div class="umjp_legendText">
            Km/h: <div class="umjp-fillDiv"></div>
            Min: 
            </div>
        </div>
        <?php
            for ($j= 0; $j < count($advice[$i]['intervalTime']); $j++) {

                $speed = round(($advice[$i]['distance'] / ($advice[$i]['duration'] / 60)),1 );
                $intervalLow  = round($speed * (1 - $advice[$i]['intervalIntensity'][$j]), 1);
                $intervalHigh = round($speed * (1 + $advice[$i]['intervalIntensity'][$j]), 1);

                if ($j == 0) {
                    ?>
                    <div class="umjp_intervalBars" style="height:<?php echo $intervalHigh * 17; ?>px; width:<?php echo $advice[$i]['intervalTime'][$j] *24 ?>px;">
                        <div class="umjp_barContent">
                            <span class="umjp_KmH"><?php echo $speed ?></span> <div class="umjp-fillDiv"></div>
                            <span class="umjp_Min"><?php echo ($advice[$i]['intervalTime'][$j] * 2)  ?> </span>
                        </div>
                    </div>
                    
                    <?php
                    continue;

                }

                if (($j + 2) > count($advice[$i]['intervalTime'])) {
                    ?>
                    <div class="umjp_intervalBars" style="height:<?php echo $intervalHigh * 17; ?>px; width:<?php echo $advice[$i]['intervalTime'][$j] *24  ?>px;" id="umjp_IntervalContrast">
                        <div class="umjp_barContent">
                            <span class="umjp_KmH"><?php echo $speed ?> </span> <div class="umjp-fillDiv"></div>
                            <span class="umjp_Min"><?php echo round(($advice[$i]['intervalTime'][$j] * 2))  ?></span>
                        </div>
                    </div>                    
                    <?php
                    continue;
                }
                
                ?>
                <div class="umjp_intervalBars" style="height:<?php echo $intervalHigh * 17; ?>px; width:<?php echo $advice[$i]['intervalTime'][$j] *12 ?>px;" id="umjp_IntervalContrast">
                    <div class="umjp_barContent">
                        <span class="umjp_KmH"><?php echo $intervalHigh ?> </span> <div class="umjp-fillDiv"></div>
                        <span class="umjp_Min"><?php echo  $advice[$i]['intervalTime'][$j]   ?></span>
                    </div>
                </div>
                <div class="umjp_intervalBars" style="height:<?php echo $intervalLow * 17; ?>px;  width:<?php echo $advice[$i]['intervalTime'][$j] *12 ?>px;">
                    <div class="umjp_barContent">
                        <span class="umjp_KmH"><?php echo $intervalLow ?></span> <div class="umjp-fillDiv"></div>
                        <span class="umjp_Min"><?php echo $advice[$i]['intervalTime'][$j]   ?></span>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    </div>
<?php
    }
} 









