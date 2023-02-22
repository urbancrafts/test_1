(function() {
  var orig = $.fn.popover,
    proto = $.extend({}, $.fn.popover.Constructor.prototype);
  $.fn.popover = function(options) {
    return this.each(function() {
      orig.call($(this), options);
      if (typeof options.hide == 'function') {
        $(this).data('bs.popover').hide = function() {
          options.hide.call(this.$tip, this);
          proto.hide.call(this);
        };
      }
    });
  }
})()
;
(function($, window, document, underfined) {
  var pluginName = 'hotSpot',
    defaults = {
      items: []
    };

  function addItem(item, $e) {
    var spot = $('<div>', {
      class: 'point',
      'data-toggle': "popover"
    }), placement = 'right';
    if (item.coordinates.x > 50) {
      placement = 'left';
    }
    spot.css({
      position: 'absolute',
      'left': item.coordinates.x + '%',
      'top': item.coordinates.y + '%'
    }).appendTo($e).popover({
      html: true,
      content: item.content,
      animation: false,
      placement: placement,
      hide: function() {
        $(this).animate({marginTop: -100}, function() {
          $(this).css({marginTop: ''});
        });
      }
    });
    if (item.id_spot) {
      spot.attr('data-point-id', item.id_spot);
      $('<a>', {
        href: '#',
        class: 'delete-point',
        html: '<i class="process-icon-cancel"></i>'
      }).appendTo(spot);
    }
  }

  function HotSpot(elem, options, selector) {
    this.elem = elem;
    this.$img = $('>img', elem);
    this.selector = selector;
    this.options = $.extend({}, defaults, options || {});
    this.options.items = defaults.items.concat(options.items);
    this.pagesNum = 0;
    this.loading = false;
    this._defaults = defaults;
    this._name = pluginName;
    return this.init();
  }

  HotSpot.prototype.init = function() {
    var i,
      e = this.elem,
      $e = $(e),
      $i = this.$img,
      o = this.options;
    for (i = 0; i < o.items.length; i++) {
      addItem(o.items[i], $e);
    }
  };
  $.fn[pluginName] = function(options) {
    var selector = this.selector;
    return this.each(function() {
      if (!$.data(this, 'plugin_' + pluginName)) {
        $.data(this, 'plugin_' + pluginName, new HotSpot(this, options, selector));
      }
    });
  }
})(jQuery, window, document);
