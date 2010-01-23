if(typeof(Prototype)=="undefined"){throw"Control.TextArea requires Prototype to be loaded.";}if(typeof(Object.Event)=="undefined"){throw"Control.TextArea requires Object.Event to be loaded.";}Control.TextArea=Class.create({initialize:function(a){this.onChangeTimeout=false;this.element=$(a);$(this.element).observe("keyup",this.doOnChange.bindAsEventListener(this));$(this.element).observe("paste",this.doOnChange.bindAsEventListener(this));$(this.element).observe("input",this.doOnChange.bindAsEventListener(this));if(!!document.selection){$(this.element).observe("mouseup",this.saveRange.bindAsEventListener(this));$(this.element).observe("keyup",this.saveRange.bindAsEventListener(this));}},doOnChange:function(a){if(this.onChangeTimeout){window.clearTimeout(this.onChangeTimeout);}this.onChangeTimeout=window.setTimeout(function(){this.notify("change",this.getValue());}.bind(this),Control.TextArea.onChangeTimeoutLength);},saveRange:function(){this.range=document.selection.createRange();},getValue:function(){return this.element.value;},getSelection:function(){if(!!document.selection){return document.selection.createRange().text;}else{if(!!this.element.setSelectionRange){return this.element.value.substring(this.element.selectionStart,this.element.selectionEnd);}else{return false;}}},replaceSelection:function(c){var b=this.element.scrollTop;if(!!document.selection){this.element.focus();var a=(this.range)?this.range:document.selection.createRange();a.text=c;a.select();}else{if(!!this.element.setSelectionRange){var d=this.element.selectionStart;this.element.value=this.element.value.substring(0,d)+c+this.element.value.substring(this.element.selectionEnd);this.element.setSelectionRange(d+c.length,d+c.length);}}this.doOnChange();this.element.focus();this.element.scrollTop=b;},wrapSelection:function(b,c){var a=this.getSelection();if(a.indexOf(b)===0&&a.lastIndexOf(c)===(a.length-c.length)){this.replaceSelection(a.substring(b.length,a.length-c.length));}else{this.replaceSelection(b+a+c);}},insertBeforeSelection:function(a){this.replaceSelection(a+this.getSelection());},insertAfterSelection:function(a){this.replaceSelection(this.getSelection()+a);},collectFromEachSelectedLine:function(c,a,b){this.replaceSelection((a||"")+$A(this.getSelection().split("\n")).collect(c).join("\n")+(b||""));},insertBeforeEachSelectedLine:function(c,a,b){this.collectFromEachSelectedLine(function(d){},a,b);}});Object.extend(Control.TextArea,{onChangeTimeoutLength:500});Object.Event.extend(Control.TextArea);Control.TextArea.ToolBar=Class.create({initialize:function(a,b){this.textarea=a;if(b){this.container=$(b);}else{this.container=$(document.createElement("ul"));this.textarea.element.parentNode.insertBefore(this.container,this.textarea.element);}},attachButton:function(a,b){a.onclick=function(){return false;};$(a).observe("click",b.bindAsEventListener(this.textarea));},addButton:function(d,g,e){var b=document.createElement("li");var c=document.createElement("a");c.href="#";this.attachButton(c,g);b.appendChild(c);Object.extend(c,e||{});if(d){var f=document.createElement("span");f.innerHTML=d;c.appendChild(f);}this.container.appendChild(b);}});