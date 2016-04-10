<script type="text/javascript" src="/js/mtadmin-common.js"></script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading">Toiminnot</li>
        <li><?= $this->Form->postLink('Poista tämä tehtävä',
                ['action' => 'delete', $task->id],
                ['confirm' => __('Haluatko varmasti poistaa tehtävän # {0}?', $task->id)]
            )
        ?></li>
        <li><?= $this->Html->link('Listaa tehtävät', ['action' => 'index']) ?></li>
        <li><?= $this->Html->link('Listaa kategoriat', ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link('Uusi kategoria', ['controller' => 'Category', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link('Listaa vastaukset', ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link('Uusi vastaus', ['controller' => 'Answer', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="task form large-9 medium-8 columns content">
    <?= $this->Form->create($task) ?>
    <fieldset>
        <legend><?= __('Edit Task') ?></legend>
        <?php
            echo $this->Form->input('category_id', ['options' => $category]);
            // echo $this->Form->input('uploaded');
            echo $this->Form->input('enabled');
            echo $this->Form->input('name');
            echo $this->Form->input('info');
            // echo $this->Form->input('uri');
            // echo $this->Form->input('icon_uri');
        ?>
    </fieldset>

    <div id="task-video-player">
    </div>

    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.2.47.min.js"></script>
    <script type="text/javascript">
      var taskId = <?php print $task->id; ?>;
      var taskBucketName = '<?php print $taskBucketName; ?>';
      var graphicsBucketName = '<?php print $graphicsBucketName; ?>';
      var awsAccessKey = '<?php print $awsAccessKey; ?>';
      var awsSecretAccessKey = '<?php print $awsSecretAccessKey; ?>';
      // See the Configuring section to configure credentials in the SDK
      AWS.config.update({
        accessKeyId: awsAccessKey,
        secretAccessKey: awsSecretAccessKey
      });
      AWS.config.sslEnabled = true;
      // Configure your region
      AWS.config.region = 'eu-central-1';
    </script>

    <div id="task-video-upload">
      <div id="task-video-upload-results">
        <?php if ($task->uri == null || $task->uri == ''): ?>
          Tehtävävideota ei vielä ole lähetetty.
        <?php else: ?>
          Tehtävävideo on jo lähetetty. Videon URI on: <?php print $task->uri; ?>
        <?php endif; ?>
      </div>
      <input type="file" id="task-video-file-chooser" />
      <button type="button" id="task-video-upload-button">Lähetä video</button>
      <script type="text/javascript">
        var taskVideoBucket = new AWS.S3({params: {Bucket: taskBucketName}});
        var taskVideoFileChooser = document.getElementById('task-video-file-chooser');
        var taskVideoUploadButton = document.getElementById('task-video-upload-button');
        var taskVideoUploadResults = document.getElementById('task-video-upload-results');
        taskVideoUploadButton.addEventListener('click', function() {
          var videoFile = taskVideoFileChooser.files[0];

          if (videoFile) {
            // Is the file of the right type?
            if (!checkFileType(videoFile, new Array('video/mp4', 'video/webm', 'video/x-matroska'))) {
                taskVideoUploadResults.innerHTML = "Virhe: Videotiedosto on väärää tyyppiä.";
                return;
            }

            var videoUploadFilename = generateTaskVideoFilename(taskId, videoFile);
            var videoParams = {Key: videoUploadFilename, ContentType: videoFile.type, Body: videoFile};
            taskVideoUploadResults.innerHTML = 'Videota lähetetään. Odota hetki...';
            taskVideoBucket.upload(videoParams, function (err, data) {
              if (err) {
                  taskVideoUploadResults.innerHTML = 'Videon lähettämisessä tapahtui virhe: ' + err;
              } else {
                taskVideoUploadResults.innerHTML = 'Video lähetettiin onnistuneesti.';
                // Make an AJAX call to video_upload_completed/id.
                // taskVideoUploadCompleted(taskId);
              }
            });
          } else {
            taskVideoUploadResults.innerHTML = 'Valitse ensin lähetettävä video.';
          }
        }, false);
      </script>
    </div>

    <div id="task-icon">
      <div id="task-icon-upload-results">
        <?php if ($task->icon_uri == null || $task->icon_uri == ''): ?>
          Tehtävän kuvaketta ei vielä ole lähetetty.
        <?php else: ?>
          Tehtävän kuvake on jo lähetetty. Kuvakkeen URI on: <?php print $task->icon_uri; ?>
        <?php endif; ?>
      </div>
    <div id="task-icon-upload">
      <input type="file" id="task-icon-file-chooser" />
      <button type="button" id="task-icon-upload-button">Lähetä kuvake</button>
      <script type="text/javascript">
        var taskIconBucket = new AWS.S3({params: {Bucket: graphicsBucketName}});
        var taskIconFileChooser = document.getElementById('task-icon-file-chooser');
        var taskIconUploadButton = document.getElementById('task-icon-upload-button');
        var taskIconUploadResults = document.getElementById('task-icon-upload-results');
        taskIconUploadButton.addEventListener('click', function() {
          var iconFile = taskIconFileChooser.files[0];

          if (iconFile) {
            // Is the file of the right type?
            if (!checkFileType(iconFile, new Array('image/png'))) {
                taskIconUploadResults.innerHTML = "Virhe: Kuvatiedosto on väärää tyyppiä.";
                return;
            }

            var iconUploadFilename = generateTaskIconFilename(taskId, iconFile);
            var iconParams = {Key: iconUploadFilename, ContentType: iconFile.type, Body: iconFile};
            taskIconUploadResults.innerHTML = 'Kuvaketta lähetetään. Odota hetki...';
            taskIconBucket.upload(iconParams, function (err, data) {
              if (err) {
                  taskIconUploadResults.innerHTML = 'Kuvakkeen lähettämisessä tapahtui virhe: ' + err;
              } else {
                taskIconUploadResults.innerHTML = 'Kuvake lähetettiin onnistuneesti.';
                // Make an AJAX call to video_upload_completed/id.
                // taskIconUploadCompleted(taskId);
              }
            });
          } else {
            taskIconUploadResults.innerHTML = 'Valitse ensin lähetettävä kuvake.';
          }
        }, false);
      </script>
    </div>
    </div>
    <?= $this->Form->button('Tallenna muutokset') ?>
    <?= $this->Form->end() ?>
</div>
