(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 

})( jQuery );

	 window.addEventListener('load', LoanThru_submit); 

     function LoanThru_submit() {

     var params = "LT_calc_amt=" + document.getElementById("LT_calc_amt").value + "&" + 
                  "LT_calc_term=" + document.getElementById("LT_calc_term").value + "&" + 
                  "LT_calc_rate=" + document.getElementById("LT_calc_rate").value + "&" + 
                  "LT_calc_method=" + document.getElementById("LT_calc_method").value;

     var createCORSRequest = function(method, url) {
       var xhr = new XMLHttpRequest();
       if ("withCredentials" in xhr) {
         // Most browsers.
         xhr.open(method, url+"?"+params, true);
       } else if (typeof XDomainRequest != "undefined") {
         // IE8 & IE9
         xhr = new XDomainRequest();
         xhr.open(method, url+"?"+params);
       } else {
         // CORS not supported.
         xhr = null;
       }
       return xhr;
     };

     var url = "http://www.loanthru.com/plugins/plugin_calc_v1_0.php";
     var method = "GET";
     var xhr = createCORSRequest(method, url);

     xhr.onload = function() {
       // Success code goes here.
       var LT_fields = this.responseText.split("#");
       document.getElementById("LT_calc_mth_repay").innerHTML = "Monthly Payments  $ " + LT_fields[0];
       document.getElementById("LT_calc_tot_int").innerHTML = "Total Interest  $ " + LT_fields[1];
     };

     xhr.onerror = function() {
       // Error code goes here.
       document.getElementById("LT_calc_mth_repay").innerHTML = "Monthly Payments  $ 00.00";
       document.getElementById("LT_calc_tot_int").innerHTML = "Total Interest  $ 00.00";
     };

     xhr.send(null);
     }
