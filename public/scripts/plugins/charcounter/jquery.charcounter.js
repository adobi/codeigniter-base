;(function ( $, window, document, undefined ) {

    var pluginName = 'charcounter',
        defaults = {
            limit: 140,
            warning: 15,
            warningColor: '#600',
            exceededColor: '#e00',
            defaultColor: '#aaa',
            notAllowOverflow: true,
        };

    function Charcounter( element, options ) 
    {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Charcounter.prototype.init = function () 
    {
        var self = $(this.element),
            width = self.outerWidth(),
            that = this;
           
        if (self.data('limit')) that.options.limit = self.data('limit');
        
        if (self.data('warning')) that.options.limit = self.data('warning');

        self.parent().append($('<p />')
            .css({
                'width': width,
                'text-align': 'right',
                'margin-top': '10px',
                'color': this.options.defaultColor,
                'font-size': '1.6em',
            })
            .html($('<span />', {'class': 'char-counter', 'html': this.options.limit}))
        );
        
        self.on('charcounter.recount keyup change focus blur', function(e) {
            
            if (that.options.notAllowOverflow) {
                
                if (!that.handle($(this).val())) {
                    //console.log($(this).val().substring(0, that.options.limit));
                    $(this).val($(this).val().substring(0, that.options.limit));
                }
            } else {
                that.handle($(this).val());
            }
        });
        
        that.handle(self.val());
    };
    
    Charcounter.prototype.handle = function(value)
    {
        var self = $(this.element), 
            span = self.parent().find('.char-counter'),
            size = value.length,
            val = this.options.limit - size,
            flag;
        
        
        
        if (val <= this.options.limit) {
            span.css('color', this.options.defaultColor);
            
            flag = true;
        }
        
        if (val < this.options.warning) {
            span.css('color', this.options.warningColor);
            
            flag = true;
        }
        
        if (val <= 0) {
            span.css('color', this.options.exceededColor);
            
            flag = false;
            val = 0;
        }
        span.html(val);
        return flag;
    };
    
    $.fn[pluginName] = function ( options ) 
    {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Charcounter( this, options ));
            }
        });
    }
    
    $(function() 
    {
        $('[data-countable=1]').charcounter();
    });
    
})( jQuery, window, document );