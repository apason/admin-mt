// Checks if the file type is in the array.
function checkFileType(file, fileTypes) {
  var arraySize = fileTypes.length;
  for (var i = 0; i < arraySize; i++) {
      if (fileTypes[i] == file.type) {
        return true;
      }
  }
  return false;
}

// Task-related helper functions

// Makes an XMLHttpRequest to
// /task/video_upload_completed/task_id/video_uri.
function taskVideoUploadCompleted(taskId, videoUri) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/task/video_upload_completed/" + taskId + "/" + videoUri, true);
  xhttp.send();
}

// Makes an XMLHttpRequest to
// /task/icon_upload_completed/task_id/icon_uri.
function taskIconUploadCompleted(taskId, iconUri) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/task/icon_upload_completed/" + taskId + "/" + iconUri, true);
  xhttp.send();
}

// Generates a filename for the video uploading.
// Name format: task_id_[id].[extension]
// Supported video formats are: mp4, webm.
function generateTaskVideoFilename(taskId, originalFile) {
  var extension = '';
  if (originalFile.type == 'video/mp4') {
    extension = ".mp4";
  }
  if (originalFile.type == 'video/webm') {
    extension = ".webm";
  }
  if (originalFile.type == 'video/x-matroska') {
    extension = ".mkv";
  }

  var filename = "task_id_" + taskId + extension;
  return filename;
}

// Generates a filename for the icon uploading.
// Name format: task_icon_id_[id].[extension]
// Supported image formats are: jpg, png.
function generateTaskIconFilename(taskId, originalFile) {
  var extension = '';
  if (originalFile.type == 'image/png') {
    extension = ".png";
  }
  if (originalFile.type == 'image/jpeg') {
    extension = ".jpg";
  }

  var filename = "task_icon_id_" + taskId + extension;
  return filename;
}

// Category-related helper functions

// Makes an XMLHttpRequest to
// /category/background_upload_completed/category_id/bg_uri.
function categoryBackgroundUploadCompleted(categoryId, bgUri) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/category/background_upload_completed/" + categoryId + "/" + bgUri, true);
  xhttp.send();
}

// Makes an XMLHttpRequest to
// /task/icon_upload_completed/task_id/icon_uri.
function categoryIconUploadCompleted(categoryId, iconUri) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/category/icon_upload_completed/" + categoryId + "/" + iconUri, true);
  xhttp.send();
}

// Generates a filename for the background uploading.
// Name format: category_bg_id_[id].[extension]
// Supported image formats are: png.
function generateCategoryBackgroundFilename(categoryId, originalFile) {
  var extension = '';
  if (originalFile.type == 'image/png') {
    extension = ".png";
  }

  var filename = "category_bg_id_" + categoryId + extension;
  return filename;
}

// Generates a filename for the icon uploading.
// Name format: category_icon_id_[id].[extension]
// Supported image formats are: png.
function generateCategoryIconFilename(categoryId, originalFile) {
  var extension = '';
  if (originalFile.type == 'image/png') {
    extension = ".png";
  }

  var filename = "category_icon_id_" + categoryId + extension;
  return filename;
}
