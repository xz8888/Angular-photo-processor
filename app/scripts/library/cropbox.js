/**
 * Created by ezgoing on 14/9/2014. Modified by Sean 9/10/2014
 */

var CropBox = function(options){
    var el = document.querySelector(options.imageBox),
    obj =
    {
        state : {},
        ratio : 1,
        options : options,
        imageBox : el,
        thumbBox : el.querySelector(options.thumbBox),
        spinner : el.querySelector(options.spinner),
        image : new Image(),
        getImage: function ()
        {
            var width = this.thumbBox.clientWidth,
                height = this.thumbBox.clientHeight,
                canvas = document.createElement("canvas"),
                dim = el.style.backgroundPosition.split(' '),
                size = el.style.backgroundSize.split(' '),
                dx = parseInt(dim[0]) - el.clientWidth/2 + width/2,
                dy = parseInt(dim[1]) - el.clientHeight/2 + height/2,
                dw = parseInt(size[0]);
            dh = parseInt(size[1]);
            sh = parseInt(this.image.height);
            sw = parseInt(this.image.width);

            canvas.width = width;
            canvas.height = height;
            var context = canvas.getContext("2d");
            context.drawImage(this.image, 0, 0, sw, sh, dx, dy, dw, dh);
            var imageData = canvas.toDataURL('image/png');
            return imageData;
        },

        getCropPosition:function(){
            var width = this.thumbBox.clientWidth,
                height = this.thumbBox.clientHeight,
                canvas = document.createElement("canvas"),
                dim = el.style.backgroundPosition.split(' '),
                size = el.style.backgroundSize.split(' '),
                dx = parseInt(dim[0]) - el.clientWidth/2 + width/2,
                dy = parseInt(dim[1]) - el.clientHeight/2 + height/2,
                dw = parseInt(size[0]);
            dh = parseInt(size[1]);
            sh = parseInt(this.image.height);
            sw = parseInt(this.image.width);
            
            return {'sw': sw, 'sh': sh, 'dx': dx, 'dy': dy, 'dw': dw, 'dh': dh, 'ratio': this.ratio}
        },

        getBlobFile: function()
        {
            var imageData = this.getAvatar();
            var b64 = imageData.replace('data:image/png;base64,','');
            var binary = atob(b64);
            var array = [];
            for (var i = 0; i < binary.length; i++) {
                array.push(binary.charCodeAt(i));
            }
            return  new Blob([new Uint8Array(array)], {type: 'image/png'});
        },
        zoomIn: function ()
        {
            this.ratio*=1.1;
            setBackgroundSize();
        },
        zoomOut: function ()
        {
            this.ratio*=0.9;
            setBackgroundSize();
        },
        setImage: function(newImage){
            this.image.src = newImage;
        }
    },
    attachEvent = function(node, event, cb)
    {
        if (node.attachEvent)
            node.attachEvent('on'+event, cb);
        else if (node.addEventListener)
            node.addEventListener(event, cb);
    },
    detachEvent = function(node, event, cb)
    {
        if(node.detachEvent) {
            node.detachEvent('on'+event, cb);
        }
        else if(node.removeEventListener) {
            node.removeEventListener(event, render);
        }
    }
    stopEvent = function (e) {
        if(window.event) e.cancelBubble = true;
        else e.stopImmediatePropagation();
    },
    setBackground = function()
    {
        var w =  parseInt(obj.image.width)*obj.ratio;
        var h =  parseInt(obj.image.height)*obj.ratio;

        var pw = (el.clientWidth - w) / 2;
        var ph = (el.clientHeight - h) / 2;

        el.setAttribute('style',
                'background-image: url("' + obj.image.src + '"); ' +
                'background-size: ' + w +'px ' + h + 'px; ' +
                'background-position: ' + pw + 'px ' + ph + 'px; ' +
                'background-repeat: no-repeat');
    },
    setBackgroundSize = function(){
        
        var w =  parseInt(obj.image.width)*obj.ratio;
        var h =  parseInt(obj.image.height)*obj.ratio;

        var dim = el.style.backgroundPosition.split(' ');
        var pw = parseInt(dim[0]);
        var ph = parseInt(dim[1]);

        el.setAttribute('style',
                'background-image: url("' + obj.image.src + '"); ' +
                'background-size: ' + w +'px ' + h + 'px; ' +
                'background-position: ' + pw + 'px ' + ph + 'px; ' +
                'background-repeat: no-repeat');
    },


    imgMouseDown = function(e)
    {
        console.log('are you there');
        stopEvent(e);

        obj.state.dragable = true;
        obj.state.mouseX = e.type === 'touchstart' ? e.changedTouches[0].clientX : e.clientX;
        obj.state.mouseY = e.type === 'touchstart' ? e.changedTouches[0].clientY : e.clientY;
    },
    imgMouseMove = function(e)
    {

        stopEvent(e);

        if (obj.state.dragable)
        {
            var x = ((e.type === 'touchmove') ? e.changedTouches[0].clientX : e.clientX) - obj.state.mouseX;
            var y = ((e.type === 'touchmove') ? e.changedTouches[0].clientY : e.clientY) - obj.state.mouseY;

            var bg = el.style.backgroundPosition.split(' ');

            var bgX = x + parseInt(bg[0]);
            var bgY = y + parseInt(bg[1]);
   
            el.style.backgroundPosition = bgX +'px ' + bgY + 'px';

            obj.state.mouseX = e.type === 'touchmove' ? e.changedTouches[0].clientX : e.clientX;
            obj.state.mouseY = e.type === 'touchmove' ? e.changedTouches[0].clientY : e.clientY;
        }
    },
    imgMouseUp = function(e)
    {
        stopEvent(e);
        obj.state.dragable = false;
    },
    zoomImage = function(e)
    {
        var evt=window.event || e;
        var delta=evt.detail? evt.detail*(-120) : evt.wheelDelta;
        delta > -120 ? obj.ratio*=1.1 : obj.ratio*=0.9;
        setBackground();
    }

    obj.spinner.style.display = 'block';
    obj.image.onload = function() {

        obj.spinner.style.display = 'none';
        setBackground();

        attachEvent(el, 'mousedown', imgMouseDown);
        attachEvent(el, 'touchstart', imgMouseDown);
        attachEvent(el, 'mousemove', imgMouseMove);
        attachEvent(el, 'touchmove', imgMouseMove);
        attachEvent(document.body, 'touchend', imgMouseUp);
        attachEvent(document.body, 'mouseup', imgMouseUp);
        var mousewheel = (/Firefox/i.test(navigator.userAgent))? 'DOMMouseScroll' : 'mousewheel';
        attachEvent(el, mousewheel, zoomImage);
    };

    obj.image.src = options.imgSrc;

    attachEvent(el, 'DOMNodeRemoved', function(){detachEvent(document.body, 'DOMNodeRemoved', imgMouseUp)});

    return obj;
};