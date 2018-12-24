<?php
/*
 * MyBB: User Newsbars
 *
 * File: usernewsbars.php
 * 
 * Authors: Vintagedaddyo
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.0
 * 
 */

if (!defined("IN_MYBB")) {
    die("You cannot access this file directly. Please make sure IN_MYBB is defined.");
}

$plugins->add_hook('global_start', 'usernewsbars_global_start');

function usernewsbars_info()
{
    global $lang;

    // Load Language

    $lang->load("usernewsbars");

    $lang->usernewsbars_desc = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' . '<input type="hidden" name="cmd" value="_s-xclick">' . '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' . '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' . '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' . '</form>' . $lang->usernewsbars_desc;
    return Array(
        'name' => $lang->usernewsbars_name,
        'description' => $lang->usernewsbars_desc,
        'website' => $lang->usernewsbars_web,
        'author' => $lang->usernewsbars_auth,
        'authorsite' => $lang->usernewsbars_authsite,
        'version' => $lang->usernewsbars_ver,
        'compatibility' => $lang->usernewsbars_compat
    );
}

function usernewsbars_activate()
{
    global $settings, $mybb, $db, $lang;

    // Load Language

    $lang->load("usernewsbars");

    $usernewsbars_group = array(
        'gid' => '0',
        'name' => 'usernewsbars',
        'title' => $lang->usernewsbars_title_setting_group,
        'description' => $lang->usernewsbars_description_setting_group,
        'disporder' => "1",
        'isdefault' => "0"
    );
    
    $db->insert_query('settinggroups', $usernewsbars_group);
    
    $gid = $db->insert_id();
    
    $usernewsbars_setting_1 = array(
        'sid' => '0',
        'name' => 'usernewsbars_enable_global',
        'title' => $lang->usernewsbars_title_setting_1,
        'description' => $lang->usernewsbars_description_setting_1,
        'optionscode' => 'yesno',
        'value' => '1',
        'disporder' => '1',
        'gid' => intval($gid)
    );
    
    $usernewsbars_setting_2 = array(
        'sid' => '0',
        'name' => 'usernewsbars_input_1',
        'title' => $lang->usernewsbars_title_setting_2,
        'description' => $lang->usernewsbars_description_setting_2,
        'optionscode' => 'textarea',
        'value' => '<strong>Latest MyBB Release:</strong> <a href="http://blog.mybb.com/2018/09/11/mybb-1-8-19-released-security-maintenance-release/">MyBB 1.8.19 Released — Security & Maintenance Release</a> <span class="date">(September 11, 2018)</span>',
        'disporder' => '2',
        'gid' => intval($gid)
    );

    $usernewsbars_setting_3 = array(
        'sid' => '0',
        'name' => 'usernewsbars_css_input_1',
        'title' => $lang->usernewsbars_title_setting_3,
        'description' => $lang->usernewsbars_description_setting_3,
        'optionscode' => 'textarea',
        'value' => '
.user-alert {
    background: #FFF6BF; 
    border-top: 1px solid #FFD324; 
    border-left: 1px solid #FFD324; 
    border-right: 1px solid #FFD324; 
    border-bottom: 1px solid #FFD324; 
    text-align: center; 
    margin: 10px auto; 
    padding: 5px 20px; 
    border-radius: 6px; 
    color: #404040;
}
.user-alert .date { 
    color: #666; 
    font-size: 0.8em; 
    margin-left: 6px;
}
.user-alert a { 
    color: #007fd0;
}
.user-alert a:visited { 
    color: #007fd0;
}
.user-alert a:hover { 
   color: #ff7500;
}',
        'disporder' => '3',
        'gid' => intval($gid)
    );
    
    $usernewsbars_setting_4 = array(
        'sid' => '0',
        'name' => 'usernewsbars_enable_input_1',
        'title' => $lang->usernewsbars_title_setting_4,
        'description' => $lang->usernewsbars_description_setting_4,
        'optionscode' => 'yesno',
        'value' => '1',
        'disporder' => '4',
        'gid' => intval($gid)
    );
    
    $usernewsbars_setting_5 = array(
        'sid' => '0',
        'name' => 'usernewsbars_input_2',
        'title' => $lang->usernewsbars_title_setting_5,
        'description' => $lang->usernewsbars_description_setting_5,
        'optionscode' => 'textarea',
        'value' => '<strong>Latest news from the MyBB Blog:</strong> <a href="http://blog.mybb.com/2018/08/29/blueprinting-automatic-updates-for-php-applications/">Blueprinting Automatic Updates for PHP Applications</a> <span class="date">(August 29, 2018</span>',
        'disporder' => '5',
        'gid' => intval($gid)
    );

    $usernewsbars_setting_6 = array(
        'sid' => '0',
        'name' => 'usernewsbars_css_input_2',
        'title' => $lang->usernewsbars_title_setting_6,
        'description' => $lang->usernewsbars_description_setting_6,
        'optionscode' => 'textarea',
        'value' => '
.user-notice1 {
    background: #D6ECA6;
    border-top: 1px solid #8DC93E;
    border-left: 1px solid #8DC93E;
    border-right: 1px solid #8DC93E;
    border-bottom: 1px solid #8DC93E;
    text-align: center;
    margin: 10px auto;
    padding: 5px 20px;
    border-radius: 6px;
    color: #404040;   
}
.user-notice1 .date {
    color: #666;
    font-size: 0.8em;
    margin-left: 6px;
}
.user-notice1 a {
   color: #007fd0;
}
.user-notice1 a:visited {
   color: #007fd0;
}
.user-notice1 a:hover {
   color: #ff7500;
}',
        'disporder' => '6',
        'gid' => intval($gid)
    );
    
    $usernewsbars_setting_7 = array(
        'sid' => '0',
        'name' => 'usernewsbars_enable_input_2',
        'title' => $lang->usernewsbars_title_setting_7,
        'description' => $lang->usernewsbars_description_setting_7,
        'optionscode' => 'yesno',
        'value' => '1',
        'disporder' => '7',
        'gid' => intval($gid)
    );
    
    $usernewsbars_setting_8 = array(
        'sid' => '0',
        'name' => 'usernewsbars_input_3',
        'title' => $lang->usernewsbars_title_setting_8,
        'description' => $lang->usernewsbars_description_setting_8,
        'optionscode' => 'textarea',
        'value' => '<strong>Are you on the </strong><a href="http://community.mybb.com/member.php?action=register">MyBB Community Forums</a><strong>&nbsp;?</strong> - Sign up for notification of new MyBB releases and updates.',
        'disporder' => '8',
        'gid' => intval($gid)
    );

    $usernewsbars_setting_9 = array(
        'sid' => '0',
        'name' => 'usernewsbars_css_input_3',
        'title' => $lang->usernewsbars_title_setting_9,
        'description' => $lang->usernewsbars_description_setting_9,
        'optionscode' => 'textarea',
        'value' => '
.user-notice2 {
    background: #ADCBE7;
    border-top: 1px solid #0F5C8E;
    border-left: 1px solid #0F5C8E;
    border-right: 1px solid #0F5C8E;
    border-bottom: 1px solid #0F5C8E;
    text-align: center;
    margin: 10px auto;
    padding: 5px 20px;
    border-radius: 6px;
    color: #404040;   
}
.user-notice2 .date {
    color: #666;
    font-size: 0.8em;
    margin-left: 6px;
}
.user-notice2 a {
    color: #007fd0;
}
.user-notice2 a:visited {
    color: #007fd0;
}
.user-notice2 a:hover {
    color: #ff7500;
}',
        'disporder' => '9',
        'gid' => intval($gid)
    );

    
    $usernewsbars_setting_10 = array(
        'sid' => '0',
        'name' => 'usernewsbars_enable_input_3',
        'title' => $lang->usernewsbars_title_setting_10,
        'description' => $lang->usernewsbars_description_setting_10,
        'optionscode' => 'yesno',
        'value' => '1',
        'disporder' => '10',
        'gid' => intval($gid)
    );
    
    $db->insert_query('settings', $usernewsbars_setting_1);
    $db->insert_query('settings', $usernewsbars_setting_2);    
    $db->insert_query('settings', $usernewsbars_setting_3);
    $db->insert_query('settings', $usernewsbars_setting_4);
    $db->insert_query('settings', $usernewsbars_setting_5);
    $db->insert_query('settings', $usernewsbars_setting_6);
    $db->insert_query('settings', $usernewsbars_setting_7);
    $db->insert_query('settings', $usernewsbars_setting_8);
    $db->insert_query('settings', $usernewsbars_setting_9);
    $db->insert_query('settings', $usernewsbars_setting_10);        
    
    rebuild_settings();
    
    $insertarray = array(
        "title" => "usernewsbars_1",
        "template" => "<style>{\$mybb->settings[\'usernewsbars_css_input_1\']}</style>
        <div id=\"user-alert\"><p class=\"user-alert\">{\$mybb->settings[\'usernewsbars_input_1\']}</p></div>",
        "sid" => -1,
        "dateline" => TIME_NOW
    );
    
    $db->insert_query("templates", $insertarray);
    
    $insertarray = array(
        "title" => "usernewsbars_2",
        "template" => "<style>{\$mybb->settings[\'usernewsbars_css_input_2\']}</style>
        <div id=\"user-notice1\"><p class=\"user-notice1\">{\$mybb->settings[\'usernewsbars_input_2\']}</p></div>",
        "sid" => -1,
        "dateline" => TIME_NOW
    );
    
    $db->insert_query("templates", $insertarray);
    
    $insertarray = array(
        "title" => "usernewsbars_3",
        "template" => "<style>{\$mybb->settings[\'usernewsbars_css_input_3\']}</style>
        <div id=\"user-notice2\"><p class=\"user-notice2\">{\$mybb->settings[\'usernewsbars_input_3\']}</p></div>",
        "sid" => -1,
        "dateline" => TIME_NOW
    );
    
    $db->insert_query("templates", $insertarray);
    
    include MYBB_ROOT . "/inc/adminfunctions_templates.php";
    
    // activate on global
    
    find_replace_templatesets("header_welcomeblock_member", "#" . preg_quote("<br class=\"clear\" />") . "#i", "<br class=\"clear\" />\r\n</div><div class=\"wrapper\" style=\"width:84%;\">
        {\$usernewsbars_1}
        {\$usernewsbars_2}
        {\$usernewsbars_3}");
}

function usernewsbars_deactivate()
{
    global $db;
    
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_enable_global')");
    
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_enable_input_1')");
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_enable_input_2')");
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_enable_input_3')");
     
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_css_input_1')");
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_css_input_2')");
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_css_input_3')");

    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_input_1')");
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_input_2')");
    $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('usernewsbars_input_3')");
    
    $db->query("DELETE FROM " . TABLE_PREFIX . "settinggroups WHERE name='usernewsbars'");
    
    $db->delete_query("templates", "title = 'usernewsbars_1'");
    $db->delete_query("templates", "title = 'usernewsbars_2'");
    $db->delete_query("templates", "title = 'usernewsbars_3'");
    
    rebuild_settings();
    
    include MYBB_ROOT . "/inc/adminfunctions_templates.php";
    
    // deactivate on global
    
    find_replace_templatesets("header_welcomeblock_member", "#" . preg_quote("\r\n</div><div class=\"wrapper\" style=\"width:84%;\">
        {\$usernewsbars_1}
        {\$usernewsbars_2}
        {\$usernewsbars_3}") . "#i", "", 0);
}   

function usernewsbars_global_start()
{
    global $db, $mybb, $templates, $usernewsbars_1, $usernewsbars_2, $usernewsbars_3;
    
    if ($mybb->settings['usernewsbars_enable_global'] == 1) {
        
        if ($mybb->settings['usernewsbars_enable_input_1'] == 1) {
            
            eval("\$usernewsbars_1 = \"" . $templates->get("usernewsbars_1") . "\";");
        }
        
        if ($mybb->settings['usernewsbars_enable_input_2'] == 1) {
            eval("\$usernewsbars_2 = \"" . $templates->get("usernewsbars_2") . "\";");
        }
        
        if ($mybb->settings['usernewsbars_enable_input_3'] == 1) {
            eval("\$usernewsbars_3 = \"" . $templates->get("usernewsbars_3") . "\";");
        }
    }
}
?> 