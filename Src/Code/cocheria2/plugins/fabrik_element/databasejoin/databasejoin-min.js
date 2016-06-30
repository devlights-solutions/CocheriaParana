var FbDatabasejoin=new Class({Extends:FbElement,options:{id:0,formid:0,key:"",label:"",windowwidth:360,displayType:"dropdown",popupform:0,listid:0,listRef:"",joinId:0,isJoin:false},initialize:function(b,a){this.activePopUp=false;this.activeSelect=false;this.plugin="databasejoin";this.parent(b,a);this.init();this.start()},watchAdd:function(){if(c=this.getContainer()){var a=c.getElement(".toggle-addoption");a.removeEvent("click",function(b){this.start(b)}.bind(this));a.addEvent("click",function(b){this.start(b)}.bind(this))}},start:function(h){if(!this.options.editable){return}var g=function(){this.close()};visible=false;if(h){h.stop();g=function(a){a.fitToContent()};visible=true;this.activePopUp=true}destroy=true;if(this.options.popupform===0||this.options.allowadd===false){return}c=this.getContainer();if(typeOf(this.element)==="null"||typeOf(c)==="null"){return}var d=c.getElement(".toggle-addoption");var f=typeOf(d)==="null"?h.target.get("href"):d.get("href");var i=this.element.id+"-popupwin";this.windowopts={id:i,title:Joomla.JText._("PLG_ELEMENT_DBJOIN_ADD"),contentType:"xhr",loadMethod:"xhr",contentURL:f,height:320,minimizable:false,collapsible:true,visible:visible,onContentLoaded:g,destroy:destroy};var b=this.options.windowwidth;if(b!==""){this.windowopts.width=b;this.windowopts.onContentLoaded=g}this.win=Fabrik.getWindow(this.windowopts)},getBlurEvent:function(){if(this.options.displayType==="auto-complete"){return"change"}return this.parent()},addOption:function(o,g,m){m=typeof(m)!=="undefined"?m:true;var d,h,p,n,f=[],q,k;if(o===""){}switch(this.options.displayType){case"dropdown":case"multilist":var e=typeOf(this.options.value)==="array"?this.options.value:Array.from(this.options.value);h=e.contains(o)?"selected":"";d=new Element("option",{value:o,selected:h}).set("text",g);document.id(this.element.id).adopt(d);break;case"auto-complete":if(m){k=this.element.getParent(".fabrikElement").getElement("input[name*=-auto-complete]");this.element.value=o;k.value=Encoder.htmlDecode(g)}break;case"checkbox":p=(o===this.options.value)?true:false;f=this.element.getElements("> .fabrik_subelement");d=this.getCheckboxTmplNode().clone();var j=d.getElement("input");j.name=j.name.replace(/\[\d+\]$/,"["+f.length+"]");d.getElement("span").set("text",g);d.getElement("input").set("value",o);n=f.length===0?this.element:f.getLast();q=f.length===0?"bottom":"after";d.inject(n,q);d.getElement("input").checked=p;var a=this.element.getElements(".fabrikHide > .fabrik_subelement");var b=this.getCheckboxIDTmplNode().clone();b.getElement("span").set("text",g);b.getElement("input").set("value",0);n=a.length===0?this.element.getElement(".fabrikHide"):a.getLast();b.inject(n,q);j=b.getElement("input");j.name=j.name.replace(/\[\d+\]$/,"["+a.length+"]");b.getElement("input").checked=p;break;case"radio":default:p=(o===this.options.value)?true:false;d=new Element("div",{"class":"fabrik_subelement"}).adopt(new Element("label").adopt([new Element("input",{"class":"fabrikinput",type:"radio",checked:true,name:this.options.element+"[]",value:o}),new Element("span").set("text",g)]));f=this.element.getElements("> .fabrik_subelement");n=f.length===0?this.element:f.getLast();q=f.length===0?"bottom":"after";d.inject(n,q);break}},getCheckboxIDTmplNode:function(){if(!this.chxTmplIDNode&&this.options.displayType==="checkbox"){var a=this.element.getElements(".fabrikHide > .fabrik_subelement");if(a.length===0){this.chxTmplIDNode=this.element.getElement(".chxTmplIDNode").getChildren()[0].clone();this.element.getElement(".chxTmplIDNode").destroy()}else{this.chxTmplIDNode=a.getLast().clone()}}return this.chxTmplIDNode},getCheckboxTmplNode:function(){if(!this.chxTmplNode&&this.options.displayType==="checkbox"){var a=this.element.getElements("> .fabrik_subelement");if(a.length===0){this.chxTmplNode=this.element.getElement(".chxTmplNode").getChildren()[0].clone();this.element.getElement(".chxTmplNode").destroy()}else{this.chxTmplNode=a.getLast().clone()}}return this.chxTmplNode},updateFromServer:function(a){var b={option:"com_fabrik",format:"raw",task:"plugin.pluginAjax",plugin:"databasejoin",method:"ajax_getOptions",element_id:this.options.id,formid:this.options.formid};if(this.options.displayType==="auto-complete"&&a===""){return}if(a){b[this.strElement+"_raw"]=a;b[this.options.fullName+"_raw"]=a}new Request.JSON({url:"",method:"post",data:b,onSuccess:function(d){var e,f=this.getOptionValues();if(this.options.displayType==="auto-complete"&&a===""&&f.length===0){return}d.each(function(g){if(!f.contains(g.value)&&typeOf(g.value)!=="null"){e=this.options.value===g.value;this.addOption(g.value,g.text,e);this.element.fireEvent("change",new Event.Mock(this.element,"change"));this.element.fireEvent("blur",new Event.Mock(this.element,"blur"))}}.bind(this));this.activePopUp=false}.bind(this)}).post()},getOptionValues:function(){var b;var a=[];switch(this.options.displayType){case"dropdown":case"multilist":b=this.element.getElements("option");break;case"checkbox":b=this.element.getElements(".fabrik_subelement input[type=checkbox]");break;case"radio":default:b=this.element.getElements(".fabrik_subelement input[type=radio]");break}b.each(function(d){a.push(d.get("value"))});return a.unique()},appendInfo:function(h){var f=h.rowid;var g=this.options.formid;var e=this.options.key;var b=this.options.label;var a=Fabrik.liveSite+"index.php?option=com_fabrik&view=form&format=raw";var d={formid:this.options.popupform,rowid:f};var i=new Request.JSON({url:a,data:d,onSuccess:function(m){var k=m.data[this.options.key];var j=m.data[this.options.label];switch(this.options.displayType){case"dropdown":case"multilist":var n=this.element.getElements("option").filter(function(p,l){if(p.get("value")===k){this.options.displayType==="dropdown"?this.element.selectedIndex=l:p.selected=true;return true}}.bind(this));if(n.length===0){this.addOption(k,j)}break;case"auto-complete":this.addOption(k,j);break;case"checkbox":this.addOption(k,j);break;case"radio":default:n=this.element.getElements(".fabrik_subelement").filter(function(p,l){if(p.get("value")===k){p.checked=true;return true}}.bind(this));if(n.length===0){this.addOption(k,j)}break}if(typeOf(this.element)==="null"){return}this.element.fireEvent("change",new Event.Mock(this.element,"change"));this.element.fireEvent("blur",new Event.Mock(this.element,"blur"))}.bind(this)}).send()},watchSelect:function(){if(c=this.getContainer()){var a=c.getElement(".toggle-selectoption");if(typeOf(a)!=="null"){a.addEvent("click",function(b){this.selectRecord(b)}.bind(this));Fabrik.addEvent("fabrik.list.row.selected",function(d){if(this.options.listid.toInt()===d.listid.toInt()&&this.activeSelect){this.update(d.rowid);var b=this.element.id+"-popupwin-select";if(Fabrik.Windows[b]){Fabrik.Windows[b].close()}}}.bind(this));this.unactiveFn=function(){this.activeSelect=false}.bind(this);window.addEvent("fabrik.dbjoin.unactivate",this.unactiveFn);this.selectThenAdd()}}},selectThenAdd:function(){Fabrik.addEvent("fabrik.block.added",function(b,a){if(a==="list_"+this.options.listid+this.options.listRef){b.form.addEvent("click:relay(.addbutton)",function(d,e){d.preventDefault();var f=this.selectRecordWindowId();Fabrik.Windows[f].close();this.start(d,true)}.bind(this))}}.bind(this))},destroy:function(){window.removeEvent("fabrik.dbjoin.unactivate",this.unactiveFn)},selectRecord:function(d){window.fireEvent("fabrik.dbjoin.unactivate");this.activeSelect=true;d.stop();var f=this.selectRecordWindowId();var b=this.getContainer().getElement("a.toggle-selectoption").href;b+="&triggerElement="+this.element.id;b+="&resetfilters=1";b+="&c="+this.options.listRef;this.windowopts={id:f,title:Joomla.JText._("PLG_ELEMENT_DBJOIN_SELECT"),contentType:"xhr",loadMethod:"xhr",evalScripts:true,contentURL:b,width:this.options.windowwidth,height:320,minimizable:false,collapsible:true,onContentLoaded:function(e){e.fitToContent()}};var a=Fabrik.getWindow(this.windowopts)},selectRecordWindowId:function(){return this.element.id+"-popupwin-select"},update:function(b){this.getElement();if(typeOf(this.element)==="null"){return}if(!this.options.editable){this.element.set("html","");if(b===""){return}b=JSON.decode(b);var a=this.form.getFormData();if(typeOf(a)==="object"){a=$H(a)}b.each(function(d){if(typeOf(a.get(d))!=="null"){this.element.innerHTML+=a.get(d)+"<br />"}else{this.element.innerHTML+=d+"<br />"}}.bind(this));return}this.setValue(b)},setValue:function(d){var b=false;if(typeOf(this.element.options)!=="null"){for(var a=0;a<this.element.options.length;a++){if(this.element.options[a].value===d){this.element.options[a].selected=true;b=true;break}}}if(!b){if(this.options.displayType==="auto-complete"){this.element.value=d;this.updateFromServer(d)}else{if(this.options.displayType==="dropdown"){if(this.options.show_please_select){this.element.options[0].selected=true}}else{this.element.getElements("input").each(function(e){if(e.get("value")===d){e.checked=true}})}}}this.options.value=d},showDesc:function(d){var b=d.target.selectedIndex;var f=this.getContainer().getElement(".dbjoin-description");var a=f.getElement(".description-"+b);f.getElements(".notice").each(function(g){if(g===a){var e=new Fx.Tween(a,{property:"opacity",duration:400,transition:Fx.Transitions.linear});e.set(0);g.setStyle("display","");e.start(0,1)}else{g.setStyle("display","none")}})},getValue:function(){var a=null;this.getElement();if(!this.options.editable){return this.options.value}if(typeOf(this.element)==="null"){return""}switch(this.options.displayType){case"dropdown":default:if(typeOf(this.element.get("value"))==="null"){return""}return this.element.get("value");case"multilist":var b=[];this.element.getElements("option").each(function(d){if(d.selected){b.push(d.value)}});return b;case"auto-complete":return this.element.value;case"radio":a="";this._getSubElements().each(function(d){if(d.checked){a=d.get("value");return a}return null});return a;case"checkbox":a=[];this.getChxLabelSubElements().each(function(d){if(d.checked){a.push(d.get("value"))}});return a}},getChxLabelSubElements:function(){var a=this._getSubElements();return a.filter(function(b){if(!b.name.contains("___id")){return true}})},getFormElementsKey:function(a){this.baseElementId=a;if(this.options.displayType==="checkbox"||this.options.displayType==="multilist"){return this.options.listName+"___"+this.options.elementShortName}else{return this.parent(a)}},getValues:function(){var a=[];var b=(this.options.displayType!=="dropdown")?"input":"option";document.id(this.element.id).getElements(b).each(function(d){a.push(d.value)});return a},cloned:function(b){this.activePopUp=false;this.parent(b);this.init();this.watchSelect();if(this.options.displayType==="auto-complete"){var a=this.getAutoCompleteLabelField();a.id=this.element.id+"-auto-complete";a.name=this.element.name.replace("[]","")+"-auto-complete";document.id(a.id).value="";new FbAutocomplete(this.element.id,this.options.autoCompleteOpts)}},init:function(){if(typeOf(this.element)==="null"){return}if(this.options.editable){this.getCheckboxTmplNode();this.getCheckboxIDTmplNode()}if(this.options.allowadd===true&&this.options.editable!==false){this.watchAdd();Fabrik.addEvent("fabrik.form.submitted",function(b,a){if(this.options.popupform===b.id){if(this.activePopUp){this.options.value=a.rowid}if(this.options.displayType==="auto-complete"){var d=new Request.JSON({url:Fabrik.liveSite+"index.php?option=com_fabrik&view=form&format=raw",data:{formid:this.options.popupform,rowid:a.rowid},onSuccess:function(e){this.update(e.data[this.options.key])}.bind(this)}).send()}else{this.updateFromServer()}}}.bind(this))}if(this.options.editable){this.watchSelect();if(this.options.showDesc===true){this.element.addEvent("change",function(a){this.showDesc(a)}.bind(this))}this.watchJoinCheckboxes()}},watchJoinCheckboxes:function(){if(this.options.displayType==="checkbox"){var a="input[name*="+this.options.joinTable+"___"+this.options.elementShortName+"]";var b="input[name*="+this.options.joinTable+"___id]";this.element.addEvent("click:relay("+a+")",function(d){this.element.getElements(a).each(function(f,e){if(f===d.target){this.element.getElements(b)[e].checked=d.target.checked}}.bind(this))}.bind(this))}},getAutoCompleteLabelField:function(){var b=this.element.getParent(".fabrikElement");var a=b.getElement("input[name*=-auto-complete]");if(typeOf(a)==="null"){a=b.getElement("input[id*=-auto-complete]")}return a},addNewEventAux:function(action,js){switch(this.options.displayType){case"dropdown":default:if(this.element){this.element.addEvent(action,function(e){e.stop();(typeOf(js)==="function")?js.delay(0,this,this):eval(js)}.bind(this))}break;case"checkbox":case"radio":this._getSubElements();this.subElements.each(function(el){el.addEvent(action,function(e){(typeOf(js)==="function")?js.delay(0,this,this):eval(js)}.bind(this))}.bind(this));break;case"auto-complete":var f=this.getAutoCompleteLabelField();if(typeOf(f)!=="null"){f.addEvent(action,function(e){e.stop();(typeOf(js)==="function")?js.delay(700,this,this):eval(js)}.bind(this))}break}},decreaseName:function(b){if(this.options.displayType==="auto-complete"){var a=this.getAutoCompleteLabelField();if(typeOf(a)!=="null"){a.name=this._decreaseName(a.name,b,"-auto-complete");a.id=this._decreaseId(a.id,b,"-auto-complete")}}return this.parent(b)}});