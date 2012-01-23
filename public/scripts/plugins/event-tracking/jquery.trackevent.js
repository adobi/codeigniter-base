// the semi-colon before function invocation is a safety net against concatenated 
// scripts and/or other plugins which may not be closed properly.
;(function ( $, window, document, undefined ) {
    
    "use strict";
    
    // undefined is used here as the undefined global variable in ECMAScript 3 is
    // mutable (ie. it can be changed by someone else). undefined isn't really being
    // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
    // can no longer be modified.

    // window and document are passed through as local variables rather than globals
    // as this (slightly) quickens the resolution process and can be more efficiently
    // minified (especially when both are regularly referenced in your plugin).

    // Create the defaults once
    var pluginName = 'trackevent',
        defaults = {
            selector: '[data-ga=tracking]',
            analytics: {},
        };

    // The actual plugin constructor
    function EventTracking( element, options ) {
        this.element = element;

        // jQuery has an extend method which merges the contents of two or 
        // more objects, storing the result in the first object. The first object
        // is generally empty as we don't want to alter the default options for
        // future instances of the plugin
        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    EventTracking.prototype.init = function () {
        
        //if (undefined === window._gaq) return false;
        
        var that = this;
        
        $('body').delegate(that.options.selector, 'click', function(e) {
            
            var self = $(this);
            
            var category = self.data('ga-category'),
                action = self.data('ga-action'),
                label = self.data('ga-label'),
                value = parseInt(self.data('ga-value'),10),
                nonInteraction = self.data('ga-noninteraction');
            
            console.log(category, action, label, value, nonInteraction);
            
            if (category && action && label && value) {
                var params = ['_trackEvent', category, action, label, value];
                if (nonInteraction == '1') {
                    
                    params.push(true);
                } 
                
                //console.log(params);
                
                if (window._gaq) {
                    window._gaq.push(params);
                } else if(that.options.analytics) {
                
                    that.options.analytics.push(params);
                }
            }
            
            return true;         
        });
    };

    // A really lightweight plugin wrapper around the constructor, 
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new EventTracking( this, options ));
            }
        });
    }
    
    $[pluginName] = function (options) {
        new EventTracking( this, options );
    }
    
    $(function() {
        /*$('[data-ga=tracking]').trackevent({
            analytics: []
        });*/
        
        $.trackevent({
            analytics:[]
        });
        
    })

})( jQuery, window, document );