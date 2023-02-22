jQuery( document ).ready(function() {
  jQuery( function() {
    var dateToday = new Date();
    var dates = jQuery("#start-date, #end-date").datepicker({
      defaultDate: "+2d",
      changeMonth: true,
      numberOfMonths: 1,
      minDate: dateToday,
      onSelect: function(selectedDate) {
          var option = this.id == "start-date" ? "minDate" : "maxDate",
          instance = jQuery(this).data("datepicker"),
          date = jQuery.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
          dates.not(this).datepicker("option", option, date);
      }
    });
  });
});