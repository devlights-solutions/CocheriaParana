var FabrikModalRepeat=new Class({initialize:function(a,c,b){this.names=c;this.field=b;this.content=false;this.setup=false;this.elid=a;this.win={};this.el={};this.field={};if(!this.ready()){this.timer=this.testReady.periodical(500,this)}else{this.setUp()}},ready:function(){return typeOf(document.id(this.elid))==="null"?false:true},testReady:function(){if(!this.ready()){return}if(this.timer){clearInterval(this.timer)}this.setUp()},setUp:function(){this.button=document.id(this.elid+"_button");if(this.mask){this.mask.destroy()}this.mask=new Mask(document.body,{style:{"background-color":"#000",opacity:0.4,"z-index":9998}});document.addEvent("click:relay(*[data-modal="+this.elid+"])",function(d,b){var a;var g=b.getNext("input").id;this.field[g]=b.getNext("input");var f=b.getParent("li");this.origContainer=f;a=f.getElement("table");if(typeOf(a)!=="null"){this.el[g]=a}this.openWindow(g)}.bind(this))},openWindow:function(b){var a=false;if(!this.win[b]){a=true;this.makeTarget(b)}this.el[b].inject(this.win[b],"top");this.el[b].show();if(!this.win[b]||a){this.makeWin(b)}this.win[b].show();this.win[b].position();this.resizeWin(true,b);this.win[b].position();this.mask.show()},makeTarget:function(a){this.win[a]=new Element("div",{"data-modal-content":a,styles:{padding:"5px","background-color":"#fff",display:"none","z-index":9999}}).inject(document.body)},makeWin:function(b){var c=new Element("button.btn.button").set("text","close");c.addEvent("click",function(d){d.stop();this.store(b);this.el[b].hide();this.el[b].inject(this.origContainer);this.close()}.bind(this));var a=new Element("div.controls",{styles:{"text-align":"right"}}).adopt(c);this.win[b].adopt(a);this.win[b].position();this.content=this.el[b];this.build(b);this.watchButtons(this.win[b],b)},resizeWin:function(a,b){console.log(b);Object.each(this.win,function(f,e){var d=this.el[e].getDimensions(true);var c=f.getDimensions(true);var g=a?c.y:d.y+30;f.setStyles({width:d.x+"px",height:(g)+"px"})}.bind(this))},close:function(){Object.each(this.win,function(b,a){b.hide()});this.mask.hide()},_getRadioValues:function(b){var a=[];this.getTrs(b).each(function(d){var c=(sel=d.getElement("input[type=radio]:checked"))?sel.get("value"):c="";a.push(c)});return a},_setRadioValues:function(a,b){this.getTrs(b).each(function(d,c){if(r=d.getElement("input[type=radio][value="+a[c]+"]")){r.checked="checked"}})},watchButtons:function(b,a){b.addEvent("click:relay(a.add)",function(f){if(tr=this.findTr(f)){var d=this._getRadioValues(a);var c=tr.getParent("table").getElement("tbody");this.tmpl.clone(true,true).inject(c);this.stripe(a);this._setRadioValues(d,a);this.resizeWin(false,a)}b.position();f.stop()}.bind(this));b.addEvent("click:relay(a.remove)",function(d){var c=this.content.getElements("tbody tr");if(c.length<=1){}if(tr=this.findTr(d)){tr.dispose()}this.resizeWin(false,a);b.position();d.stop()}.bind(this))},getTrs:function(a){return this.win[a].getElement("tbody").getElements("tr")},stripe:function(b){trs=this.getTrs(b);for(var a=0;a<trs.length;a++){trs[a].removeClass("row1").removeClass("row0");trs[a].addClass("row"+a%2);var c=trs[a].getElements("input[type=radio]");c.each(function(d){d.name=d.name.replace(/\[([0-9])\]/,"["+a+"]")})}},build:function(j){if(!this.win[j]){this.makeWin(j)}var c=JSON.decode(this.field[j].get("value"));if(typeOf(c)==="null"){c={}}var h=this.win[j].getElement("tbody").getElement("tr");var e=Object.keys(c);var g=e.length===0||c[e[0]].length===0?true:false;var f=g?1:c[e[0]].length;for(var d=1;d<f;d++){h.clone().inject(h,"after")}this.stripe(j);var b=this.getTrs(j);for(d=0;d<f;d++){e.each(function(a){b[d].getElements("*[name*="+a+"]").each(function(i){if(i.get("type")==="radio"){if(i.value===c[a][d]){i.checked=true}}else{i.value=c[a][d]}})})}this.tmpl=h;if(g){h.dispose()}},findTr:function(b){var a=b.target.getParents().filter(function(c){return c.get("tag")==="tr"});return(a.length===0)?false:a[0]},store:function(e){var g=this.content;g=this.el[e];var d={};for(var b=0;b<this.names.length;b++){var f=this.names[b];var a=g.getElements("*[name*="+f+"]");d[f]=[];a.each(function(c){if(c.get("type")==="radio"){if(c.get("checked")===true){d[f].push(c.get("value"))}}else{d[f].push(c.get("value"))}}.bind(this))}this.field[e].value=JSON.encode(d);return true}});