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
// /task/video_upload_completed/id.
function taskVideoUploadCompleted(taskId) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/task/video_upload_completed/" + taskId, true);
  xhttp.send();
}

// Makes an XMLHttpRequest to
// /task/icon_upload_completed/id.
function taskIconUploadCompleted(taskId) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/task/icon_upload_completed/" + taskId, true);
  xhttp.send();
}

// Generates a filename for the video uploading.
// Name format: task_id_[id].[extension]
// Supported video formats are: mp4, webm.
function generateTaskVideoFilename(task_id, originalFile) {
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

  var filename = "task_id_" + task_id + extension;
  return filename;
}

// Generates a filename for the icon uploading.
// Name format: task_icon_id_[id].[extension]
// Supported image formats are: jpg, png.
function generateTaskIconFilename(task_id, originalFile) {
  var extension = '';
  if (originalFile.type == 'image/png') {
    extension = ".png";
  }
  if (originalFile.type == 'image/jpeg') {
    extension = ".jpg";
  }

  var filename = "task_icon_id_" + task_id + extension;
  return filename;
}
