/*
 * jQuery The Final Countdown plugin v1.0.0 beta
 * http://github.com/hilios/jquery.countdown
 *
 * Copyright (c) 2011 Edson Hilios
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
(function($) {
  
  $.fn.countdown = function(toDate, callback) {
    var handlers = ['seconds', 'minutes', 'hours', 'days', 'weeks', 'daysLeft'];
    
    function delegate(scope, method) {
      return function() { return method.call(scope) }
    }
    
    return this.each(function() {
      // Convert
      if(!(toDate instanceof Date)) {
        if(String(toDate).match(/^[0-9]*$/)) {
          toDate = new Date(toDate);
        } else if( toDate.match(/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})\s([0-9]{1,2})\:([0-9]{2})\:([0-9]{2})/) ||
            toDate.match(/([0-9]{2,4})\/([0-9]{1,2})\/([0-9]{1,2})\s([0-9]{1,2})\:([0-9]{2})\:([0-9]{2})/)
            ) {
          toDate = new Date(toDate);
        } else if(toDate.match(/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/) || 
                  toDate.match(/([0-9]{2,4})\/([0-9]{1,2})\/([0-9]{1,2})/)
                  ) {
          toDate = new Date(toDate)
        } else {
          throw new Error("Doesn't seen to be a valid date object or string")
        }
      }
      
      var $this = $(this),
          values = {},
          lasting = {},
          interval = $this.data('countdownInterval'),
          currentDate = new Date(),
          secondsLeft = Math.floor((toDate.valueOf() - currentDate.valueOf()) / 1000);
      
      function triggerEvents() {
        secondsLeft--;
        if(secondsLeft < 0) {
          secondsLeft = 0;
        }
        lasting = {
          seconds : secondsLeft % 60,
          minutes : Math.floor(secondsLeft / 60) % 60,
          hours   : Math.floor(secondsLeft / 60 / 60) % 24,
          days    : Math.floor(secondsLeft / 60 / 60 / 24),
          weeks   : Math.floor(secondsLeft / 60 / 60 / 24 / 7),
          daysLeft: Math.floor(secondsLeft / 60 / 60 / 24) % 7
        }
        for(var i=0; i<handlers.length; i++) {
          var eventName = handlers[i];
          if(values[eventName] != lasting[eventName]) {
            values[eventName] = lasting[eventName];
            dispatchEvent(eventName);
          }
        }
        if(secondsLeft == 0) { 
          stop();
          dispatchEvent('finished');
        }
      }
      triggerEvents();
      
      function dispatchEvent(eventName) {
        var event = $.Event(eventName);
        event.date  = new Date(new Date().valueOf() + secondsLeft);
        event.value = values[eventName] || "0";
        event.toDate = toDate;
        event.lasting = lasting;
        switch(eventName) {
          case "seconds":
          case "minutes":
          case "hours":
            event.value = event.value < 10 ? '0'+event.value.toString() : event.value.toString();
            break;
          default:
            if(event.value) {
              event.value = event.value.toString();
            }
            break;
        }
        callback.call($this, event);
      }
      
      $this.bind('remove', function() {
        stop(); // If the selector is removed clear the interval for memory sake!
        dispatchEvent('removed');
      });
      
      function stop() {
        clearInterval(interval);
      }

      function start() {
        $this.data('countdownInterval', setInterval(delegate($this, triggerEvents), 1000));
        interval = $this.data('countdownInterval');
      }
      
      if(interval) stop();
      start();
    });
  }
  // Wrap the remove method to trigger an event when called
  var removeEvent = new $.Event('remove'),
      removeFunction = $.fn.remove;
  $.fn.remove = function() {
    $(this).trigger(removeEvent);
    removeFunction.apply(this, arguments);
  }
})(jQuery);

/*
* $ lightbox_me
* By: Buck Wilson
* Version : 2.3
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*     http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/


(function($) {

    $.fn.lightbox_me = function(options) {

        return this.each(function() {

            var
                opts = $.extend({}, $.fn.lightbox_me.defaults, options),
                $overlay = $(),
                $self = $(this),
                $iframe = $('<iframe id="foo" style="z-index: ' + (opts.zIndex + 1) + ';border: none; margin: 0; padding: 0; position: absolute; width: 100%; height: 100%; top: 0; left: 0; filter: mask();"/>'),
                ie6 = ($.browser.msie && $.browser.version < 7);

            if (opts.showOverlay) {
                //check if there's an existing overlay, if so, make subequent ones clear
               var $currentOverlays = $(".js_lb_overlay:visible");
                if ($currentOverlays.length > 0){
                    $overlay = $('<div class="lb_overlay_clear js_lb_overlay"/>');
                } else {
                    $overlay = $('<div class="' + opts.classPrefix + '_overlay js_lb_overlay"/>');
                }
            }

            /*----------------------------------------------------
               DOM Building
            ---------------------------------------------------- */
            if (ie6) {
                var src = /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank';
                $iframe.attr('src', src);
                $('body').append($iframe);
            } // iframe shim for ie6, to hide select elements
            $('body').append($self.hide()).append($overlay);


            /*----------------------------------------------------
               Overlay CSS stuffs
            ---------------------------------------------------- */

            // set css of the overlay
            if (opts.showOverlay) {
                setOverlayHeight(); // pulled this into a function because it is called on window resize.
                $overlay.css({ position: 'absolute', width: '100%', top: 0, left: 0, right: 0, bottom: 0, zIndex: (opts.zIndex + 2), display: 'none' });
        if (!$overlay.hasClass('lb_overlay_clear')){
                  $overlay.css(opts.overlayCSS);
                }
            }

            /*----------------------------------------------------
               Animate it in.
            ---------------------------------------------------- */
               //
            if (opts.showOverlay) {
                $overlay.fadeIn(opts.overlaySpeed, function() {
                    setSelfPosition();
                    $self[opts.appearEffect](opts.lightboxSpeed, function() { setOverlayHeight(); setSelfPosition(); opts.onLoad()});
                });
            } else {
                setSelfPosition();
                $self[opts.appearEffect](opts.lightboxSpeed, function() { opts.onLoad()});
            }

            /*----------------------------------------------------
               Hide parent if parent specified (parentLightbox should be jquery reference to any parent lightbox)
            ---------------------------------------------------- */
            if (opts.parentLightbox) {
                opts.parentLightbox.fadeOut(200);
            }


            /*----------------------------------------------------
               Bind Events
            ---------------------------------------------------- */

            $(window).resize(setOverlayHeight)
                     .resize(setSelfPosition)
                     .scroll(setSelfPosition);
                     
            $(window).bind('keyup.lightbox_me', observeKeyPress);
                     
            if (opts.closeClick) {
                $overlay.click(function(e) { closeLightbox(); e.preventDefault; });
            }
            $self.delegate(opts.closeSelector, "click", function(e) {
                closeLightbox(); e.preventDefault();
            });
            $self.bind('close', closeLightbox);
            $self.bind('reposition', setSelfPosition);

            

            /*--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
              -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */


            /*----------------------------------------------------
               Private Functions
            ---------------------------------------------------- */

            /* Remove or hide all elements */
            function closeLightbox() {
                var s = $self[0].style;
                if (opts.destroyOnClose) {
                    $self.add($overlay).remove();
                } else {
                    $self.add($overlay).hide();
                }

                //show the hidden parent lightbox
                if (opts.parentLightbox) {
                    opts.parentLightbox.fadeIn(200);
                }

                $iframe.remove();
                
        // clean up events.
                $self.undelegate(opts.closeSelector, "click");

                $(window).unbind('reposition', setOverlayHeight);
                $(window).unbind('reposition', setSelfPosition);
                $(window).unbind('scroll', setSelfPosition);
                $(window).unbind('keyup.lightbox_me');
                if (ie6)
                    s.removeExpression('top');
                opts.onClose();
            }


            /* Function to bind to the window to observe the escape/enter key press */
            function observeKeyPress(e) {
                if((e.keyCode == 27 || (e.DOM_VK_ESCAPE == 27 && e.which==0)) && opts.closeEsc) closeLightbox();
            }


            /* Set the height of the overlay
                    : if the document height is taller than the window, then set the overlay height to the document height.
                    : otherwise, just set overlay height: 100%
            */
            function setOverlayHeight() {
                if ($(window).height() < $(document).height()) {
                    $overlay.css({height: $(document).height() + 'px'});
                     $iframe.css({height: $(document).height() + 'px'}); 
                } else {
                    $overlay.css({height: '100%'});
                    if (ie6) {
                        $('html,body').css('height','100%');
                        $iframe.css('height', '100%');
                    } // ie6 hack for height: 100%; TODO: handle this in IE7
                }
            }


            /* Set the position of the modal'd window ($self)
                    : if $self is taller than the window, then make it absolutely positioned
                    : otherwise fixed
            */
            function setSelfPosition() {
                var s = $self[0].style;

                // reset CSS so width is re-calculated for margin-left CSS
                $self.css({left: '50%', marginLeft: ($self.outerWidth() / 2) * -1,  zIndex: (opts.zIndex + 3) });


                /* we have to get a little fancy when dealing with height, because lightbox_me
                    is just so fancy.
                 */

                // if the height of $self is bigger than the window and self isn't already position absolute
                if (($self.height() + 80  >= $(window).height()) && ($self.css('position') != 'absolute' || ie6)) {

                    // we are going to make it positioned where the user can see it, but they can still scroll
                    // so the top offset is based on the user's scroll position.
                    var topOffset = $(document).scrollTop() + 40;
                    $self.css({position: 'absolute', top: topOffset + 'px', marginTop: 0})
                    if (ie6) {
                        s.removeExpression('top');
                    }
                } else if ($self.height()+ 80  < $(window).height()) {
                    //if the height is less than the window height, then we're gonna make this thing position: fixed.
                    // in ie6 we're gonna fake it.
                    if (ie6) {
                        s.position = 'absolute';
                        if (opts.centered) {
                            s.setExpression('top', '(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"')
                            s.marginTop = 0;
                        } else {
                            var top = (opts.modalCSS && opts.modalCSS.top) ? parseInt(opts.modalCSS.top) : 0;
                            s.setExpression('top', '((blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + '+top+') + "px"')
                        }
                    } else {
                        if (opts.centered) {
                            $self.css({ position: 'fixed', top: '50%', marginTop: ($self.outerHeight() / 2) * -1})
                        } else {
                            $self.css({ position: 'fixed'}).css(opts.modalCSS);
                        }

                    }
                }
            }

        });



    };

    $.fn.lightbox_me.defaults = {

        // animation
        appearEffect: "fadeIn",
        appearEase: "",
        overlaySpeed: 250,
        lightboxSpeed: 300,

        // close
        closeSelector: ".close",
        closeClick: true,
        closeEsc: true,

        // behavior
        destroyOnClose: false,
        showOverlay: true,
        parentLightbox: false,

        // callbacks
        onLoad: function() {},
        onClose: function() {},

        // style
        classPrefix: 'lb',
        zIndex: 999,
        centered: false,
        modalCSS: {top: '40px'},
        overlayCSS: {background: 'black', opacity: .3}
    }
})(jQuery);