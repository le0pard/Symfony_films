Effect.Scroll = Class.create();
Object.extend(Object.extend(Effect.Scroll.prototype, Effect.Base.prototype), {
  initialize: function(element) {
    this.element = $(element);
    var options = Object.extend({
      x:    0,
      y:    0,
      mode: 'absolute',
      afterFinishInternal: function(effect){
    	
      },
      beforeSetup:  function(){
      }	  
    } , arguments[1] || {}  );
    this.start(options);
  },
  setup: function() {
    if (this.options.continuous && !this.element._ext ) {
      this.element.cleanWhitespace();
      this.element._ext=true;
      this.element.appendChild(this.element.firstChild);
    }

    this.originalLeft=this.element.scrollLeft;
    this.originalTop=this.element.scrollTop;

    if(this.options.mode == 'absolute') {
      this.options.x -= this.originalLeft;
      this.options.y -= this.originalTop;
    } else {

    }
  },
  update: function(position) {   
    this.element.scrollLeft = this.options.x * position + this.originalLeft;
    this.element.scrollTop  = this.options.y * position + this.originalTop;
  }  
});

Element.addMethods({
	scrollToByX: function(element, child){
		Position.prepare();
		container_x = Position.cumulativeOffset($(element))[0];
		element_x = Position.cumulativeOffset($(child))[0];
		new Effect.Scroll(element, {x:(element_x-container_x), y:0});
		return false;
	}
});