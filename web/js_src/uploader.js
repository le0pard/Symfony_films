YAHOO.widget.Uploader.SWFURL = "/js/yui/uploader/assets/uploader.swf";

var YUIUploader = {
	//uploader
	uploader: null,
	// Variable for holding the filelist.
	fileList: null,
	//row counter
	rowCounter: 0,
	//counter uploads
	uploadsCount: 0,
	//table container
	dataTableContainer: null,
	dataArr: [],
	//initialize
	initialize: function(id, dataTableContainer){
		 // Instantiate the uploader and write it to its placeholder div.
		YUIUploader.uploader = new YAHOO.widget.Uploader(id);
		
		// Add event listeners to various events on the uploader.
		// Methods on the uploader should only be called once the 
		// contentReady event has fired.
		YUIUploader.uploader.addListener('contentReady', YUIUploader.handleContentReady);
		YUIUploader.uploader.addListener('fileSelect', YUIUploader.onFileSelect)
		YUIUploader.uploader.addListener('uploadStart', YUIUploader.onUploadStart);
		YUIUploader.uploader.addListener('uploadProgress', YUIUploader.onUploadProgress);
		YUIUploader.uploader.addListener('uploadCancel', YUIUploader.onUploadCancel);
		YUIUploader.uploader.addListener('uploadComplete', YUIUploader.onUploadComplete);
		YUIUploader.uploader.addListener('uploadCompleteData', YUIUploader.onUploadResponse);
		YUIUploader.uploader.addListener('uploadError', YUIUploader.onUploadError);
	    YUIUploader.uploader.addListener('rollOver', YUIUploader.handleRollOver);
	    YUIUploader.uploader.addListener('rollOut', YUIUploader.handleRollOut);
	    YUIUploader.uploader.addListener('click', YUIUploader.handleClick);

		YUIUploader.dataTableContainer = dataTableContainer;
	},
	// When the Flash layer is clicked, the "Browse" dialog is invoked.
	// The click event handler allows you to do something else if you need to.
	handleClick: function(){
		
	},
	// When the mouse rolls over the uploader, this function
	// is called in response to the rollOver event.
	// It changes the appearance of the UI element below the Flash overlay.
	handleRollOver: function () {
		$('selectLink').addClassName('selected_button');
	},
	// On rollOut event, this function is called, which changes the appearance of the
	// UI element below the Flash layer back to its original state.
	handleRollOut: function () {
		$('selectLink').removeClassName('selected_button');
	},
	// When contentReady event is fired, you can call methods on the uploader.
	handleContentReady: function () {
	    // Allows the uploader to send log messages to trace, as well as to YAHOO.log
		YUIUploader.uploader.setAllowLogging(false);
		// Allows multiple file selection in "Browse" dialog.
		YUIUploader.uploader.setAllowMultipleFiles(true);
		// New set of file filters.
		var ff = new Array({description:"Images", extensions:"*.jpg;*.png;*.gif;*.jpeg"});
		// Apply new set of file filters to the uploader.
		YUIUploader.uploader.setFileFilters(ff);
	},
	// Do something on each file's upload start.
	onUploadStart: function (event) {
	
	},
	// Do something on each file's upload progress event.
	onUploadProgress: function (event) {
		rowNum = event["id"];
		prog = Math.round(100*(event["bytesLoaded"]/event["bytesTotal"]));
		progbar = "<div style='height:5px;width:100px;background-color:#CCC;'><div style='height:5px;background-color:#F00;width:" + prog + "px;'></div></div>";
		
		var tempCell = $('uploadRow_' + rowNum).select('.yui-dt-col-progress');
		if (tempCell){
			tempCell.each(function(s) {
			  s.update(progbar);
			});
		}
		var tempCell = $('uploadRow_' + rowNum).select('.yui-dt-col-trash');
		if (tempCell){
			tempCell.each(function(s) {
			  s.update("Загрузка...");
			});
		}
	},
	// Do something when each file's upload is complete.
	onUploadComplete: function (event) {
		rowNum = event["id"];
		prog = Math.round(100*(event["bytesLoaded"]/event["bytesTotal"]));
		progbar = "<div style='height:5px;width:100px;background-color:#CCC;'><div style='height:5px;background-color:#F00;width:100px;'></div></div>";
		
		var tempCell = $('uploadRow_' + rowNum).select('.yui-dt-col-progress');
		if (tempCell){
			tempCell.each(function(s) {
			  s.update(progbar);
			});
		}
		var tempCell = $('uploadRow_' + rowNum).select('.yui-dt-col-trash');
		if (tempCell){
			tempCell.each(function(s) {
			  s.update("Готово");
			});
		}
		
		YUIUploader.uploadsCount++;
		if  (YUIUploader.uploadsCount >= YUIUploader.rowCounter){
			location.href = film_add_step2_path($F('js_add_film_id'));
		}
	},
	// Do something if a file upload throws an error.
	// (When uploadAll() is used, the Uploader will
	// attempt to continue uploading.
	onUploadError: function (event) {

	},
	// Do something if an upload is cancelled.
	onUploadCancel: function (event) {

	},
	// Do something when data is received back from the server.
	onUploadResponse: function (event) {

	},
	// Actually uploads the files. In this case,
	// uploadAll() is used for automated queueing and upload 
	// of all files on the list.
	// You can manage the queue on your own and use "upload" instead,
	// if you need to modify the properties of the request for each
	// individual file.
	upload: function () {
		if (YUIUploader.fileList != null) {
			YUIUploader.uploader.setSimUploadLimit(1);
			YUIUploader.uploader.uploadAll(film_add_swf_step2_path($F('js_add_film_id')) + "?" + session_name + "=" + session_val, "POST", 
			{'gallery[film_id]' : $F('js_add_film_id')}, "gallery[thumb_img]");
		}	
	},
	//set size
	setSize: function (size){
		var word = ' байт';
		if (size > 1024){
			size = Math.round((size * 100)/1024)/100;
			word = ' Kбайт';
		}
		if (size > 1024){
			size = Math.round((size * 100)/1024)/100;
			word = ' Mбайт';
		}
		
		return size + word;
	},
	// Fired when the user selects files in the "Browse" dialog
	// and clicks "Ok".
	onFileSelect: function (event) {
		if('fileList' in event && event.fileList != null) {
			YUIUploader.rowCounter = 0;
			YUIUploader.dataArr = [];
			
			YUIUploader.fileList = event.fileList;
			YUIUploader.createDataTable();
			
			$('uploadFilesLink').show();
			$('selectLink').update('Добавить еще скриншотов');
			$('selectLink').addClassName('add_more');
			YUIUploader.handleRollOut();
			
		}
	},
	createDataTable: function(){
		if (YUIUploader.fileList != null){
			
			var main_table = document.createElement("table");
			main_table.id = "main_table";
			var tmpRow = null;
			var tmpCell= null;
			
			
			var tmpTHead=main_table.appendChild(document.createElement("thead"));
			tmpRow=tmpTHead.appendChild(document.createElement("tr"));
			tmpCell=tmpRow.appendChild(document.createElement("th"));
			tmpCell.innerHTML = "Файл";
			tmpCell.className = "yui-dt-first";
			tmpCell=tmpRow.appendChild(document.createElement("th"));
			tmpCell.innerHTML = "Разм.";
			tmpCell.className = "";
			tmpCell=tmpRow.appendChild(document.createElement("th"));
			tmpCell.innerHTML = "Прогресс";
			tmpCell.className = "";
			tmpCell=tmpRow.appendChild(document.createElement("th"));
			tmpCell.innerHTML = "Удалить?";
			tmpCell.className = "yui-dt-last";
				
			for(var i in YUIUploader.fileList) {
				var entry = YUIUploader.fileList[i];
				
				var tmpTBody=main_table.insertBefore(document.createElement("tbody"), main_table.childNodes[0]);
				tmpTBody.id = "uploadTRow_" + entry.id;
				tmpRow=tmpTBody.appendChild(document.createElement("tr"));
				tmpRow.id = "uploadRow_" + entry.id;
				tmpRow.className = "yui-dt-first yui-dt-last";


				tmpCell=tmpRow.appendChild(document.createElement("td"));
				tmpCell.innerHTML = entry["name"];
				tmpCell.className = "yui-dt-col-name";
				
				tmpCell=tmpRow.appendChild(document.createElement("td"));
				entry["size"] = YUIUploader.setSize(entry["size"]);
				tmpCell.innerHTML = entry["size"];
				tmpCell.className = "yui-dt-col-size";
				
				tmpCell=tmpRow.appendChild(document.createElement("td"));
				entry["progress"] = "<div style='height:5px;width:100px;background-color:#CCC;'></div>";
				tmpCell.innerHTML = entry["progress"];
				tmpCell.className = "yui-dt-col-progress";
				
				tmpCell=tmpRow.appendChild(document.createElement("td"));
				entry["trash"] = '<a href="#" title="Delete" onclick="javascript:YUIUploader.deleteFileFromUpload(\'' + entry.id + '\'); return false;"><img src="/images/trash.gif" alt="Delete" /></a>';
				tmpCell.innerHTML = entry["trash"];
				tmpCell.className = "yui-dt-col-trash";

				
				YUIUploader.dataArr.unshift(entry);
				YUIUploader.rowCounter++;
			}
			
			$(YUIUploader.dataTableContainer).update('');
			$(YUIUploader.dataTableContainer).appendChild(main_table);
		}
	},
	//delete file from uploader
	deleteFileFromUpload: function(fileId){
		if (fileId){
			for (var i in YUIUploader.dataArr) {
				if (YUIUploader.dataArr[i]["id"] == fileId){
					YUIUploader.uploader.removeFile(fileId);
					delete YUIUploader.dataArr[i]["id"];
					YUIUploader.rowCounter--;
					if (document.getElementById("uploadTRow_" + fileId)){
						var el = document.getElementById("uploadTRow_" + fileId);
						el.parentNode.removeChild(el);
					}
					
					if (YUIUploader.rowCounter <= 0){
						$(YUIUploader.dataTableContainer).innerHTML = "";
						$('uploadFilesLink').hide();
						$('selectLink').update('Выбрать скриншоты');
						$('selectLink').removeClassName('add_more');
					}
				}
			}
		}
	}
}//end


YAHOO.util.Event.onDOMReady(function () {
	if ($('uploaderOverlay') && $('dataTableContainer') && $('js_add_film_id')){
		var uiLayer = YAHOO.util.Dom.getRegion('selectLink');
		var overlay = YAHOO.util.Dom.get('uploaderOverlay');
		YAHOO.util.Dom.setStyle(overlay, 'width', uiLayer.right-uiLayer.left + "px");
		YAHOO.util.Dom.setStyle(overlay, 'height', uiLayer.bottom-uiLayer.top + "px");
		YUIUploader.initialize("uploaderOverlay", "dataTableContainer");
		$('upload_gallery_form').hide();
	}
});	