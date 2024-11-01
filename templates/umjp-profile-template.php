<?php
global $umjp_master;
wp_enqueue_script('umjp_font_awesome', umjp_js . "umjp-fontawesome-all.min.js");

?>
<!-- Statistics: -->
<div class="umjp-block">
  <input class="umjp-accordion-input" type="radio" name="profile" id="umjp-profileA" checked />   
  <label class="umjp_profileLabel" for="umjp-profileA"><span class="umjp-accordion-span">
  <i class="fas fa-chart-line"></i> <?php _e('Statistics','ultimate-member-UMJP') ?></span></label>
    <div class="umjp-info  umjp-info1">

      <div class="umjp-profileflexbox">
        <div class="umjp-Pfill"></div>
        <div class="umjp-profileTitle"><?php _e('Total:','ultimate-member-UMJP') ?></div>
        <div class="umjp-profileTitle"><?php _e('This month:','ultimate-member-UMJP') ?></div>
      </div>

      <div class="umjp-profileflexContent">
        <div class="umjp-Pfill"></div>
        <div class="umjp-flexContent">        
        <?php _e('Points:','ultimate-member-UMJP') ?></div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getTotalPoints()); ?></div>
        <div class="umjp-flexContent">       
        <?php _e('Points:','ultimate-member-UMJP') ?></div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getMonthPoint()); ?></div>
      </div>
      <div class="umjp-profileflexContent umjp-middleProfile">
        <div class="umjp-Pfill"></div>
        <div class="umjp-flexContent"><?php _e('Runs:','ultimate-member-UMJP') ?></div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getTotalRuns()); ?></div>
        <div class="umjp-flexContent"><?php _e('Runs:','ultimate-member-UMJP') ?></div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getMonthRuns()); ?></div>
      </div>
      <div class="umjp-profileflexContent">
        <div class="umjp-Pfill"></div>
        <div class="umjp-flexContent">Km:</div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getTotalKm()); ?></div>
        <div class="umjp-flexContent">Km:</div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getMonthKm()); ?></div>
      </div>
      <div class="umjp-profileflexContent umjp-middleProfile">
        <div class="umjp-Pfill"></div>
        <div class="umjp-flexContent"><?php _e('Hours:','ultimate-member-UMJP') ?> </div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getTotalHours()); ?></div>
        <div class="umjp-flexContent"><?php _e('Hours:','ultimate-member-UMJP') ?> </div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getMonthHours()); ?></div>
      </div>

      <!-- Second Table statistics -->
      <div class="umjp-tableFill"></div>

      <div class="umjp-profileflexbox">
        <div class="umjp-Pfill"></div>
        <div class="umjp-profileTitle"><?php _e('This year:','ultimate-member-UMJP') ?></div>
        <div class="umjp-profileTitle"><?php _e('Last month:','ultimate-member-UMJP') ?></div>
      </div>

      <div class="umjp-profileflexContent ">
        <div class="umjp-Pfill"></div>
        <div class="umjp-flexContent"><?php _e('Runs:','ultimate-member-UMJP') ?> </div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getYearRuns()); ?></div>
        <div class="umjp-flexContent"><?php _e('Runs:','ultimate-member-UMJP') ?> </div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getLastMonthRuns()); ?></div>
      </div>
      <div class="umjp-profileflexContent umjp-middleProfile">
        <div class="umjp-Pfill"></div>
        <div class="umjp-flexContent">Km:</div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getYearKm()); ?></div>
        <div class="umjp-flexContent">Km:</div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getLastMonthKm()); ?></div>
      </div>
      <div class="umjp-profileflexContent">
        <div class="umjp-Pfill"></div>
        <div class="umjp-flexContent"><?php _e('Hours:','ultimate-member-UMJP') ?> </div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getYearHours()); ?></div>
        <div class="umjp-flexContent"><?php _e('Hours:','ultimate-member-UMJP') ?> </div>
        <div class="umjp-flexnumbers"><?php echo esc_html($umjp_master->profile->getLastMonthHours()); ?></div>
      </div>


  </div>
</div>
<!-- Badges: ___________________________________________________________________________ -->
<div class="umjp-block">
  <input  class="umjp-accordion-input" type="radio" name="profile" id="umjp-profileB"/>
  <label class="umjp_profileLabel" for="umjp-profileB"><span class="umjp-accordion-span">
  <i class="fas fa-trophy"></i>
      <?php _e('Achievements','ultimate-member-UMJP') ?></span></label>
  <div class="umjp-info umjp-info2">

  <table class="umjp_achievementTable">
  <tr >
    <th class="umjp-tablefirst umjp-CenterAlign umjp-topRow"><span class="umjp-titleBadge"><i class="fas fa-user fa-2x"></i></span></th>
    <th class="umjp-tableContent umjp-topRow">
    <div class="badge medium  umjp-centerContent">
      <div class="ribbon middle red"></div>
    <div class="circle gold border">
    <i class="fas fa-heartbeat umjp-badgeFA"></i>
    </div>
    </th>
    <th class="umjp-tableContent umjp-topRow">
    <div class="badge medium umjp-centerContent">
      <div class="ribbon middle blue"></div>
    <div class="circle silver border">
    <i class="fas fa-heartbeat umjp-badgeFA"></i>
    </div>
    </th>
    <th class="umjp-tableContent umjp-topRow">
      <div class="badge medium umjp-centerContent">
      <div class="ribbon middle green"></div>
    <div class="circle bronze border">
    <i class="fas fa-heartbeat umjp-badgeFA"></i>
    </div>
  </th>
  </tr>
  <tr class="umjp-middleProfile umjp-tableHeader">
    <th class="umjp-tablefirst"><div class="umjpFillTable"></div>
    <i class="um-tip-w um-faicon-info-circle" 
        title="<?php _e("Monthly achievements based on individual performance", 'um-jogging-platform'); ?>"></i>
    <?php _e("Individual:", 'um-jogging-platform'); ?></th>
    <th class="umjp-tableContent">A:</th>
    <th class="umjp-tableContent">B:</th>
    <th class="umjp-tableContent">C:</th>
  </tr>
  <tr >
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div> 
    <i class="um-tip-w um-faicon-info-circle" 
        title="<?php _e("Awarded for 2/5/8 runs monthly", 'um-jogging-platform'); ?>"></i>
        <?php _e("Quantity:", 'um-jogging-platform'); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_IQ',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_IQ',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_IQ',3)); ?></td>
  </tr>
  <tr class="umjp-middleProfile ">
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div> 
    <i class="um-tip-w um-faicon-info-circle" 
        title="<?php _e("Awarded for 10/30/75 Km monthly", 'um-jogging-platform'); ?>"></i>
        <?php _e("Distance:", 'um-jogging-platform'); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_ID',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_ID',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_ID',3)); ?></td>
  </tr >
  <tr >
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div> 
    <i class="um-tip-w um-faicon-info-circle" 
        title="<?php _e("Awarded for 2/5/8 hours run monthly", 'um-jogging-platform'); ?>"></i>
        <?php _e("Time:", 'um-jogging-platform'); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_IT',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_IT',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('umjp_IT',3)); ?></td>
  </tr>

</table>


<!-- Second table Badges: -->
<div class="umjp-tableFill"></div>

<table class="umjp_achievementTable">
  <tr>
    <th class="umjp-tablefirst umjp-CenterAlign  umjp-topRow"><span class="umjp-titleBadge"><i class="fas fa-users fa-2x"></i></span></th>
    <th class="umjp-tableContent  umjp-topRow">
    <div class="badge medium  umjp-centerContent">
    <div class="lanyard">
      <div class="ribbon left red"></div>
      <div class="ribbon right red"></div>
    </div>
    <div class="circle gold border">
    <i class="fas fa-chess-king umjp-chesspiece"></i>
    </div>
    </th>
    <th class="umjp-tableContent  umjp-topRow">
    <div class="badge medium umjp-centerContent">
    <div class="lanyard">
      <div class="ribbon left blue"></div>
      <div class="ribbon right blue"></div>
    </div>
    <div class="circle silver border">
    <i class="fas fa-chess-queen umjp-chesspiece"></i>
    </div>
    </th>
    <th class="umjp-tableContent  umjp-topRow">
      <div class="badge medium umjp-centerContent">
      <div class="lanyard">
      <div class="ribbon left green"></div>
      <div class="ribbon right green"></div>
    </div>
    <div class="circle bronze border">
    <i class="fas fa-chess-rook umjp-chesspiece"></i>
    </div>
  </th>
  </tr>
  <tr class="umjp-middleProfile" style="height:43px;">
    <th class="umjp-tablefirst"><div class="umjpFillTable"></div>
    <i class="um-tip-w um-faicon-info-circle" 
        title="<?php _e("Monthly awarded based on the leaderboards", 'um-jogging-platform'); ?>"></i>
        <?php _e("Contest:", 'um-jogging-platform'); ?></th>
    <th class="umjp-tableContent">1st:</th>
    <th class="umjp-tableContent">2nd:</th>
    <th class="umjp-tableContent">3th:</th>
  </tr>
  <tr >
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div> <?php _e("Quantity:", 'um-jogging-platform'); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('most_runs',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('most_runs',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('most_runs',3)); ?></td>
  </tr>
  <tr class="umjp-middleProfile">
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div><?php _e("Distance:", 'um-jogging-platform'); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('most_Km',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('most_Km',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('most_Km',3)); ?></td>
  </tr>
  <tr >
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div><?php _e("Speed", 'um-jogging-platform'); ?> 3-5 Km</td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest3_5',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest3_5',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest3_5',3)); ?></td>
  </tr>
  <tr class="umjp-middleProfile">
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div><?php _e("Speed", 'um-jogging-platform'); ?> 5-8 Km</td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest5_8',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest5_8',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest5_8',3)); ?></td>
  </tr>
  <tr>
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div><?php _e("Speed", 'um-jogging-platform'); ?> 8-12 Km</td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest8_12',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest8_12',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest8_12',3)); ?></td>
  </tr>
  <tr class="umjp-middleProfile">
    <td class="umjp-tablefirst"><div class="umjpFillTable"></div><?php _e("Speed", 'um-jogging-platform'); ?> 12+ Km</td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest12_plus',1)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest12_plus',2)); ?></td>
    <td class="umjp-tableContent"><?php echo esc_html($umjp_master->profileBadges->getBadges('fastest12_plus',3)); ?></td>
  </tr>

</table>

  </div>
</div>
<!-- Info block -->

<div class="umjp-block">
  <input class="umjp-accordion-input"  type="radio" name="profile" id="umjp-profileC" />
  <label class="umjp_profileLabel" for="umjp-profileC"><span class="umjp-accordion-span">
  <i class="fas fa-info-circle"></i>
  <?php _e("Info", 'um-jogging-platform'); ?></span></label>
  <div class="umjp-info  umjp-info3">
 
  <ul class="umjp_ul">
  <li class="umjp_li"><span class="umjp_infoAdjust"><?php _e("Badges are awarded individually and based on competition in the leaderboards", 'um-jogging-platform'); ?></span></li>
  <li class="umjp_li"><span class="umjp_infoAdjust"><?php _e("Ties in the leaderboards are resolved by points (highest points win)", 'um-jogging-platform'); ?></span></li>
  <li class="umjp_li"><span class="umjp_infoAdjust"><?php _e("View entered data in the progress tab, invalid records can also be deleted there", 'um-jogging-platform'); ?></span></li>
  <li class="umjp_li"><span class="umjp_infoAdjust"><?php _e("Five point are given for every run + 1 point for every Km of the run", 'um-jogging-platform'); ?></span></li>
  <li class="umjp_li"><span class="umjp_infoAdjust"><?php _e("Additional points are awarded for achieving top ranks in the leaderboards", 'um-jogging-platform'); ?></span></li>
  <li class="umjp_li"><span class="umjp_infoAdjust"><a class="umjp-leaderBoardLink" href="<?php echo get_page_link( get_page_by_title( 'leaderboards' )->ID ); ?>"><?php _e("The leaderboards can be found here", 'um-jogging-platform'); ?></a></span></li>
  </ul>

  </div>
</div>


<div class="umjp-fill"></div>