/**
 * Author: LimpidThemes
 * Version: 1.0
 * Description: Javascript file for the RoutineManagement Dashboard Template
 * Date: 16-07-2017
 **/

/**********************************************************
		BEGIN: MENU TOGGLE
**********************************************************/
jQuery(document).ready(function($) {
    "use strict";
    jQuery("#menu-toggle").click(function(e) {
        e.preventDefault();
        jQuery("#outer-wrapper").toggleClass("toggled");
    });

});