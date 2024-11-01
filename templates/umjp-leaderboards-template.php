<?php

global $umjp_master;
$data = json_encode($umjp_master->leaderboards->get_Leaderboards_data(false));
wp_enqueue_script('umjp_leaderBoards_script', umjp_js . "umjp-leaderBoards.js");

?>
<script> var DBdata = <?php echo $data; ?>; </script>


<div class ="umjp-LPtoptext">
   <h3 id="umjp-LPTT"> <?php _e('Show results of:','ultimate-member-UMJP') ?></h3>
</div>

<div class="umjp-LPradiowrapper">

<div class="umjp-LPselection">
    <div class="umjp-LPradiowrap">
        <span class="umjp-centerRadio">
            <input class="umjp-LPradio" type="radio" name="switch" value="tendays" id="tendays" checked="checked"> 
            <label for="tendays">10 <?php _e('Days','ultimate-member-UMJP') ?></label>
        </span>
    </div>
    <div class="umjp-LPradiowrap">
        <span class="umjp-centerRadio">
            <input class="umjp-LPradio" type="radio" name="switch" value="This-month" id="This-month"> 
            <label for="This-month"><?php _e('This Month','ultimate-member-UMJP') ?></label>
        </span>
    </div>
</div>

<div class="umjp-LPselection">
    <div class="umjp-LPradiowrap">
        <span class="umjp-centerRadio">
            <input class="umjp-LPradio" type="radio" name="switch" value="three-months" id="three-months">
            <label for="three-months">100 <?php _e('Days','ultimate-member-UMJP') ?></label>
        </span>

    </div>
    <div class="umjp-LPradiowrap">
        <span class="umjp-centerRadio">
            <input class="umjp-LPradio" type="radio" name="switch" value="Last-year" id="Last-year"> 
            <label for="Last-year"><?php _e('This Year','ultimate-member-UMJP') ?></label> 
        </span>    
    </div>
</div>

</div>

<br>

<div class ="umjp-LPcontainer">

    <div class ="umjp-LPcontent">
        <table class="umjp-LPtable" id="umjp-amountTop">
            <tr>
                <th><?php _e('Name','ultimate-member-UMJP') ?></th>
                <th><?php _e('Nr. of Runs','ultimate-member-UMJP') ?></th> 
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
        </table>
    </div>

    <div class ="umjp-LPcontent">
        <table class="umjp-LPtable" id="umjp-totalKm">
            <tr>
                <th><?php _e('Name','ultimate-member-UMJP') ?></th>
                <th><?php _e('Total Km','ultimate-member-UMJP') ?></th> 
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>            
        </table>        
    </div>

    <div class ="umjp-LPcontent">
        <table class="umjp-LPtable" id="umjp_speed35">
            <tr>
                <th><?php _e('Name','ultimate-member-UMJP') ?></th>
                <th><i class="umjp-infoLeader um-tip-w um-faicon-info-circle" 
                    title= "<?php _e("Highest speed (Km/h) of a single run between 3 and 5Km", 'um-jogging-platform'); ?>" >
                </i><?php _e('Speed <br/> 3-5 Km','ultimate-member-UMJP') ?>
                </th> 
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
        </table>   
    </div>

    <div class ="umjp-LPcontent">
        <table class="umjp-LPtable" id="umjp_speed58">
            <tr>
                <th><?php _e('Name','ultimate-member-UMJP') ?></th>
                <th><i class="umjp-infoLeader um-tip-w um-faicon-info-circle" 
                    title= "<?php _e("Highest speed (Km/h) of a single run between 5 and 8Km", 'um-jogging-platform'); ?>" >
                    </i><?php _e('Speed <br/> 5-8 Km','ultimate-member-UMJP') ?>
                </th> 
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
        </table>   
    </div>

    <div class ="umjp-LPcontent">
        <table class="umjp-LPtable" id="umjp_speed812">
            <tr>
                <th><?php _e('Name','ultimate-member-UMJP') ?></th>
                <th><i class="umjp-infoLeader um-tip-w um-faicon-info-circle" 
                    title= "<?php _e("Highest speed (Km/h) of a single run between 8 and 12Km", 'um-jogging-platform'); ?>" >
                    </i><?php _e('Speed <br/> 8-12 Km','ultimate-member-UMJP') ?>
                </th> 
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
        </table>   
    </div>

    <div class ="umjp-LPcontent">
        <table class="umjp-LPtable" id="umjp_speed12_plus">
            <tr>
                <th><?php _e('Name','ultimate-member-UMJP') ?></th>
                <th><i class="umjp-infoLeader um-tip-w um-faicon-info-circle" 
                    title= "<?php _e("Highest speed (Km/h) of a single run longer than 12Km", 'um-jogging-platform'); ?>" >
                    </i><?php _e('Speed <br/> 12 Km+','ultimate-member-UMJP') ?>
                </th> 
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
            <tr>
                <td class="umjp-td"></td>
                <td class="umjp-td"></td>
            </tr>
        </table>   
    </div>

</div>


