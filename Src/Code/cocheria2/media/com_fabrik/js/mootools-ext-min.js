function CloneObject(c,a,d){if(typeOf(c)!=="object"){return c}var b=$H(c);b.each(function(f,e){if(typeOf(f)==="object"&&a===true&&!d.contains(e)){this[e]=new CloneObject(f,a,d)}else{this[e]=f}}.bind(this));return this}String.implement({toObject:function(){var a={};this.split("&").each(function(d){var c=d.split("=");a[c[0]]=c[1]});return a}});Element.implement({findClassUp:function(b){if(this.hasClass(b)){return this}var a=document.id(this);while(a&&!a.hasClass(b)){if(typeOf(a.getParent())!=="element"){return false}a=a.getParent()}return a},up:function(a){a=a?a:0;var c=this;for(var b=0;b<=a;b++){c=c.getParent()}return c},within:function(b){var a=this;while(a.parentNode!==null){if(a===b){return true}a=a.parentNode}return false},cloneWithIds:function(a){return this.clone(a,true)},down:function(b,a){var c=this.getChildren();if(arguments.length===0){return c[0]}return c[a]},findUp:function(a){if(this.get("tag")===a){return this}var b=this;while(b&&b.get("tag")!==a){b=b.getParent()}return b},mouseInside:function(b,g){var f=this.getCoordinates();var e=f.left;var d=f.left+f.width;var a=f.top;var c=f.bottom;if(b>=e&&b<=d){if(g>=a&&g<=c){return true}}return false},getValue:function(){return this.get("value")}});function fconsole(a){if(typeof(window.console)!=="undefined"){console.log(a)}};