Effect.Scroll=Class.create();Object.extend(Object.extend(Effect.Scroll.prototype,Effect.Base.prototype),{initialize:function(b){this.element=$(b);var a=Object.extend({x:0,y:0,mode:"absolute",afterFinishInternal:function(c){},beforeSetup:function(){}},arguments[1]||{});this.start(a);},setup:function(){if(this.options.continuous&&!this.element._ext){this.element.cleanWhitespace();this.element._ext=true;this.element.appendChild(this.element.firstChild);}this.originalLeft=this.element.scrollLeft;this.originalTop=this.element.scrollTop;if(this.options.mode=="absolute"){this.options.x-=this.originalLeft;this.options.y-=this.originalTop;}else{}},update:function(a){this.element.scrollLeft=this.options.x*a+this.originalLeft;this.element.scrollTop=this.options.y*a+this.originalTop;}});