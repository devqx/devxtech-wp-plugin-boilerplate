"use strict";
jQuery(document).ready(function(){

    jQuery("#payment_info,#payment").hide();

    jQuery("#bank_payment").click(function(){
        jQuery("#payment_info").slideToggle(1100);
        jQuery("#payment").hide();
    })
    jQuery("#debit_card").click(function(){
        jQuery("#payment_info").hide(1100);
        jQuery("#payment").show();
    })
})