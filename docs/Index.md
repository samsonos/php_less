# SamsonPHP LESS module documentation
This module subscribes to [SamsonPHP Resourcer](https://github.com/samsonphp/resourcer) ```ResourceRouter::EVENT_CREATED``` event
and automatically compiles ```*.less``` files into CSS.

## Mixins included
This module has next built-in mixins:

* .opacity (@_opacity) 
* .gradient ( @startColor: #eee, @endColor: white) 
* .box-shadow (@string)
* .drop-shadow (@x: 0, @y: 1px, @blur: 2px, @spread: 0, @alpha: 0.25) 
* .inner-shadow (@x: 0, @y: 1px, @blur: 2px, @spread: 0, @alpha: 0.25) 
* .box-sizing (@type: border-box) 
* .border-radius (@radius: 5px) 
* .user_select(@_value) 
* .transition (@property: all, @duration: 0.2s, @timingfunction: ease-out) 
* .transform (@property) 
* .horizontal_gradient(@startColor: #555, @endColor: #333)
* .vertical_gradient(@startColor: #555, @endColor: #333) 

### Media query mixins
* @highdensity
* @mobile      
* @tablet
* @desktop
* @desktop-xl
* @desktop-x2
