YAHOO.widget.Uploader.SWFURL="/js/yui/uploader/assets/uploader.swf";var YUIUploader={uploader:null,fileList:null,rowCounter:0,uploadsCount:0,dataTableContainer:null,dataArr:[],initialize:function(b,a){YUIUploader.uploader=new YAHOO.widget.Uploader(b);YUIUploader.uploader.addListener("contentReady",YUIUploader.handleContentReady);YUIUploader.uploader.addListener("fileSelect",YUIUploader.onFileSelect);YUIUploader.uploader.addListener("uploadStart",YUIUploader.onUploadStart);YUIUploader.uploader.addListener("uploadProgress",YUIUploader.onUploadProgress);YUIUploader.uploader.addListener("uploadCancel",YUIUploader.onUploadCancel);YUIUploader.uploader.addListener("uploadComplete",YUIUploader.onUploadComplete);YUIUploader.uploader.addListener("uploadCompleteData",YUIUploader.onUploadResponse);YUIUploader.uploader.addListener("uploadError",YUIUploader.onUploadError);YUIUploader.uploader.addListener("rollOver",YUIUploader.handleRollOver);YUIUploader.uploader.addListener("rollOut",YUIUploader.handleRollOut);YUIUploader.uploader.addListener("click",YUIUploader.handleClick);YUIUploader.dataTableContainer=a;},handleClick:function(){},handleRollOver:function(){$("selectLink").addClassName("selected_button");},handleRollOut:function(){$("selectLink").removeClassName("selected_button");},handleContentReady:function(){YUIUploader.uploader.setAllowLogging(false);YUIUploader.uploader.setAllowMultipleFiles(true);var a=new Array({description:"Images",extensions:"*.jpg;*.png;*.gif;*.jpeg"});YUIUploader.uploader.setFileFilters(a);},onUploadStart:function(a){},onUploadProgress:function(b){rowNum=b["id"];prog=Math.round(100*(b["bytesLoaded"]/b["bytesTotal"]));progbar="<div style='height:5px;width:100px;background-color:#CCC;'><div style='height:5px;background-color:#F00;width:"+prog+"px;'></div></div>";var a=$("uploadRow_"+rowNum).select(".yui-dt-col-progress");if(a){a.each(function(c){c.update(progbar);});}var a=$("uploadRow_"+rowNum).select(".yui-dt-col-trash");if(a){a.each(function(c){c.update("Загрузка...");});}},onUploadComplete:function(b){rowNum=b["id"];prog=Math.round(100*(b["bytesLoaded"]/b["bytesTotal"]));progbar="<div style='height:5px;width:100px;background-color:#CCC;'><div style='height:5px;background-color:#F00;width:100px;'></div></div>";var a=$("uploadRow_"+rowNum).select(".yui-dt-col-progress");if(a){a.each(function(c){c.update(progbar);});}var a=$("uploadRow_"+rowNum).select(".yui-dt-col-trash");if(a){a.each(function(c){c.update("Готово");});}YUIUploader.uploadsCount++;if(YUIUploader.uploadsCount>=YUIUploader.rowCounter){location.href=film_add_step2_path($F("js_add_film_id"));}},onUploadError:function(a){},onUploadCancel:function(a){},onUploadResponse:function(a){},upload:function(){if(YUIUploader.fileList!=null){YUIUploader.uploader.setSimUploadLimit(1);YUIUploader.uploader.uploadAll(film_add_swf_step2_path($F("js_add_film_id"))+"?"+session_name+"="+session_val,"POST",{"gallery[film_id]":$F("js_add_film_id")},"gallery[thumb_img]");}},setSize:function(a){var b=" байт";if(a>1024){a=Math.round((a*100)/1024)/100;b=" Kбайт";}if(a>1024){a=Math.round((a*100)/1024)/100;b=" Mбайт";}return a+b;},onFileSelect:function(a){if("fileList" in a&&a.fileList!=null){YUIUploader.rowCounter=0;YUIUploader.dataArr=[];YUIUploader.fileList=a.fileList;YUIUploader.createDataTable();$("uploadFilesLink").show();$("selectLink").update("Добавить еще скриншотов");$("selectLink").addClassName("add_more");YUIUploader.handleRollOut();}},createDataTable:function(){if(YUIUploader.fileList!=null){var e=document.createElement("table");e.id="main_table";var a=null;var g=null;var f=e.appendChild(document.createElement("thead"));a=f.appendChild(document.createElement("tr"));g=a.appendChild(document.createElement("th"));g.innerHTML="Файл";g.className="yui-dt-first";g=a.appendChild(document.createElement("th"));g.innerHTML="Разм.";g.className="";g=a.appendChild(document.createElement("th"));g.innerHTML="Прогресс";g.className="";g=a.appendChild(document.createElement("th"));g.innerHTML="Удалить?";g.className="yui-dt-last";for(var b in YUIUploader.fileList){var d=YUIUploader.fileList[b];var c=e.insertBefore(document.createElement("tbody"),e.childNodes[0]);c.id="uploadTRow_"+d.id;a=c.appendChild(document.createElement("tr"));a.id="uploadRow_"+d.id;a.className="yui-dt-first yui-dt-last";g=a.appendChild(document.createElement("td"));g.innerHTML=d["name"];g.className="yui-dt-col-name";g=a.appendChild(document.createElement("td"));d["size"]=YUIUploader.setSize(d["size"]);g.innerHTML=d["size"];g.className="yui-dt-col-size";g=a.appendChild(document.createElement("td"));d["progress"]="<div style='height:5px;width:100px;background-color:#CCC;'></div>";g.innerHTML=d["progress"];g.className="yui-dt-col-progress";g=a.appendChild(document.createElement("td"));d["trash"]='<a href="#" title="Delete" onclick="javascript:YUIUploader.deleteFileFromUpload(\''+d.id+'\'); return false;"><img src="/images/trash.gif" alt="Delete" /></a>';g.innerHTML=d["trash"];g.className="yui-dt-col-trash";
YUIUploader.dataArr.unshift(d);YUIUploader.rowCounter++;}$(YUIUploader.dataTableContainer).update("");$(YUIUploader.dataTableContainer).appendChild(e);}},deleteFileFromUpload:function(a){if(a){for(var b in YUIUploader.dataArr){if(YUIUploader.dataArr[b]["id"]==a){YUIUploader.uploader.removeFile(a);delete YUIUploader.dataArr[b]["id"];YUIUploader.rowCounter--;if(document.getElementById("uploadTRow_"+a)){var c=document.getElementById("uploadTRow_"+a);c.parentNode.removeChild(c);}if(YUIUploader.rowCounter<=0){$(YUIUploader.dataTableContainer).innerHTML="";$("uploadFilesLink").hide();$("selectLink").update("Выбрать скриншоты");$("selectLink").removeClassName("add_more");}}}}}};YAHOO.util.Event.onDOMReady(function(){if($("uploaderOverlay")&&$("dataTableContainer")&&$("js_add_film_id")){var b=YAHOO.util.Dom.getRegion("selectLink");var a=YAHOO.util.Dom.get("uploaderOverlay");YAHOO.util.Dom.setStyle(a,"width",b.right-b.left+"px");YAHOO.util.Dom.setStyle(a,"height",b.bottom-b.top+"px");YUIUploader.initialize("uploaderOverlay","dataTableContainer");$("upload_gallery_form").hide();}});