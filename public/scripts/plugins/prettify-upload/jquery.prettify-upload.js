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
    var pluginName = 'prettifyUpload',
        defaults = {
            buttonClass:'btn info',
            iconClass:'picture',
            text:'select a file',
            
        };
    var wrapper = $('<div />', {'class': 'input-file-wrapper'}).css({
        cursor:'pointer',
        width:'120px',
        height:'35px',
        display:'inline-block',
        overflow:'hidden',
        position:'relative',
        marginBottom:'10px',
    });
    
    var button = $('<button />');
    
    // The actual plugin constructor
    function PrettifyUpload( element, options ) {
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

    PrettifyUpload.prototype.init = function () {
        
        $(this.element).css({
            cursor: 'pointer',
            fontSize: '50px',
            opacity: 0,
            filter:'alpha(opacity: 0)',
            position: 'relative',
            top: '-28px',
            width: '120px',
        });
        
        button
            .addClass(this.options.buttonClass)
            .html($('<i />').addClass(this.options.iconClass))
            .append(this.options.text);
        
        $(this.element).wrap(wrapper);    
        
        $(this.element).parents('.input-file-wrapper').prepend(button);
        
        //$('body').delegate('input[type=file]', 'change', function() {
        $('input[type=file]').bind('change', function() {
            var self = $(this);
            self.parents('.input-file-wrapper')
                .after($('<p />')
                    .html(self[0].files[0].name)
                    .append($('<a />', {href:'javascript:void(0)', 'class': 'btn danger input-file-remove'})
                        .html('<i class="trash"></i>remove')
                        .css('margin-left', '10px')
                        .bind('click', function() {
                            $(this).parent().remove();
                            
                            //self[0].files = [];
                        })
                    )                    
                );            
        });
        
        $('body').delegate('.input-file-remove', 'click', function() {
            
        })
        
    };

    // A really lightweight plugin wrapper around the constructor, 
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new PrettifyUpload( this, options ));
            }
        });
    }
    
    $(function() {
        $('input[type=file]').prettifyUpload();
    })

})( jQuery, window, document );