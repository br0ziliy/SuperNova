<?php
// fleet.php
// @version 2.1 - Rebuilt to use Slider element from jUI. Also shows preliminary information about fleet: speed, consumption etc
// @version 2.0 - Serious optimizations: remove redundant fields etc Also makes compliant with PCG
// @version 1.0
// @copyright 2008 by Chlorel for XNova

if(SN_IN_FLEET !== true)
{
  $debug->error("Attempt to call FLEET page mode {$mode} directly - not from fleet.php", 'Forbidden', 403);
}

lng_include('overview');

if(!$planetrow)
{
  message($lang['fl_noplanetrow'], $lang['fl_error']);
}

$template = gettemplate('fleet0', true);

foreach(sn_get_groups('fleet') as $n => $unit_id)
{
  // $n_name = get_unit_param($unit_id, P_NAME);
  $unit_level = mrc_get_level($user, $planetrow, $unit_id, false, true);
  if($unit_level > 0)
  {
    $ship_data = get_ship_data($unit_id, $user);
    $template->assign_block_vars('ships', array(
      'ID'          => $unit_id,
      'NAME'        => $lang['tech'][$unit_id],
      'AMOUNT'      => $unit_level,
      'AMOUNT_TEXT' => pretty_number($unit_level),
      'CONSUMPTION' => $ship_data['consumption'],
      'SPEED'       => $ship_data['speed'],
      'SPEED_TEXT'  => pretty_number($ship_data['speed']),
      'CAPACITY'    => $ship_data['capacity'],
    ));
  }
}

$template->assign_vars(array(
  'TIME_NOW'           => SN_TIME_NOW,

  'FLYING_FLEETS'      => $FlyingFleets,
  'MAX_FLEETS'         => $MaxFleets,
  'FLYING_EXPEDITIONS' => $FlyingExpeditions,
  'MAX_EXPEDITIONS'    => $MaxExpeditions,
  'FREE_EXPEDITIONS'   => $MaxExpeditions - $FlyingExpeditions,

  'COLONIES_CURRENT' => get_player_current_colonies($user),
  'COLONIES_MAX' => get_player_max_colonies($user),
  'IS_COLONIZATION' => $target_mission == MT_COLONIZE,

  'target_mission'     => $target_mission,
  'MISSION_NAME'		  => $lang['type_mission'][$target_mission],
  'TYPE_NAME'		     => $lang['fl_planettype'][$planet_type],

  'ShipList'           => $ShipList,

  'speed_factor'       => flt_server_flight_speed_multiplier(),

  'PLANET_RESOURCES'   => pretty_number($planetrow['metal'] + $planetrow['crystal'] + $planetrow['deuterium']),
  'PLANET_DEUTERIUM'   => pretty_number($planetrow['deuterium']),
));

$template->assign_recursive($template_result);
display($template, $lang['fl_title']);
