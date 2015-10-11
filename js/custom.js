/**
 * @file
 * custom.js
 *
 * Provides general custom js for this theme
 */

var Drupal = Drupal || {};
var messages={
       en:['Location information denied by user.','Location information is unavailable.','Location information timed out.','An unknown error occured.','Route not found !!!','Directions failed:','Geolocation not supported.'],
       sr:['Informacije o lokaciji nisu dostupne jer korisnik ne dozvoljava slanje informacija','Podaci o lokaciji nisu distupni','Informacije o lokaciji ne mogu biti ucitane','Doslo je do nepoznate greske','Ruta nije pronadjena ili ne postoji','Pravac nije definisan:','Geolociranje nije podrzano']
        
    };
var myLatLng = {lat:44.814328, lng: 20.484089};
var image = {
    url: 'sites/all/themes/bootstrap_visokaict/images/logo_visoka_ict_skola_mala.png',
    // This marker is 20 pixels wide by 32 pixels high.
    size: new google.maps.Size(25, 39),
    // The origin for this image is (0, 0).
    origin: new google.maps.Point(0, 0),
    // The anchor for this image is the base of the flagpole at (0, 32).
    anchor: new google.maps.Point(0, 32)
  };
var mapInit=false; //is map initialized or not


function initialize_map(){
    var mapCanvas = document.getElementById('googleICTMap');
    var mapOptions = {
          center: myLatLng,
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
    var map1 = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({
    position: myLatLng,
    map: map1,
    icon: image
  });
    mapInit=true;
};




(function($, Drupal){
  "use strict";

function closeSearch() {
            var $form = $('.navbar-collapse form[role="search"].active');
    		$form.find('input').val('');
			$form.removeClass('active');
}
    
Drupal.theme.prototype.locationMap=function(){
      
 if($('#googleICTMap').length>0){
    $('#accordion').on('shown.bs.collapse',function (e) {
        var id=e.target.id;
        if(id=="googleMapa" && mapInit==false){
           initialize_map();
        }
    }); 
     
    
 }
}
Drupal.theme.prototype.searchForm=function(){

       $('body, .navbar-collapse form[role="search"] button[type="reset"]').on('click keyup', function(event) {
			//console.log(event.currentTarget);
			if (event.which == 27 && $('.navbar-collapse form[role="search"]').hasClass('active') ||
				$(event.currentTarget).attr('type') == 'reset') {
				closeSearch();
			}
		});

		

		// Show Search if form is not active // event.preventDefault() is important, this prevents the form from submitting
		$(document).on('click', '.navbar-collapse form[role="search"]:not(.active) button[type="submit"]', function(event) {
			event.preventDefault();
			var $form = $(this).closest('form'),
				$input = $form.find('input');
			$form.addClass('active');
			$input.focus();

		});
		// ONLY FOR DEMO // Please use $('form').submit(function(event)) to track from submission
		// if your form is ajax remember to call `closeSearch()` to close the search container
		$(document).on('submit', '.navbar-collapse form[role="search"].active button[type="submit"]', function(event) {
			//event.preventDefault();
			var $form = $(this).closest('form'),
				$input = $form.find('input');
			//$('#showSearchTerm').text($input.val());
            closeSearch();
            //$form.trigger('submit');
		});
}

Drupal.theme.prototype.obavestenjaBlock=function(){
    $('a[data-toggle="tab"]','#block-views-view-obavestenja-block').on('shown.bs.tab', function (e) {
     var url=$(this).data('url');
     var rss=$(this).data('rss');    
     var btnMore=$('.btn-more','#block-views-view-obavestenja-block');
     var iconRss=$('.icoRss','#block-views-view-obavestenja-block');
     btnMore.attr('href',url);
     iconRss.attr('href',rss);
       
    });
}

Drupal.theme.prototype.breadcrumbEdit=function(){
    if($('.breadcrumb').length>0){
       $('.breadcrumb li:not(.first)').each(function(i,el){
          if($(el).children('a').length>0 && $(el).children('a').attr('href')=='/' ){
            var tmpElement=$(el).children('a');
            var tmpText=tmpElement.contents().unwrap();
            $(el).text(tmpText.text());
          }
       });
    }

}

$(document).ready(function(){
   Drupal.theme('locationMap');
   Drupal.theme('searchForm');    
   Drupal.theme('obavestenjaBlock');
    Drupal.theme('breadcrumbEdit');
});

})(jQuery, Drupal);
