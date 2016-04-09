<script type="text/javascript" src="/js/mtadmin-common.js"></script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $task->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Task'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Category'), ['controller' => 'Category', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Category', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Answer'), ['controller' => 'Answer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answer', 'action' => 'add']) ?></li>
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
    <?php if ($task->uri == null || $task->uri == ''): ?>
      Tehtävävideota ei vielä ole lähetetty.
    <?php else: ?>
      Tehtävävideo on jo lähetetty. Videon URI on: <?php print $task->uri; ?>
    <?php endif; ?>
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
      <input type="file" id="task-video-file-chooser" />
      <button type="button" id="task-video-upload-button">Lähetä video</button>
      <div id="task-video-upload-results"></div>
      <script type="text/javascript">
        var taskVideoBucket = new AWS.S3({params: {Bucket: taskBucketName}});
        var taskVideoFileChooser = document.getElementById('task-video-file-chooser');
        var taskVideoUploadButton = document.getElementById('task-video-upload-button');
        var taskVideoUploadResults = document.getElementById('task-video-upload-resulsts');
        taskVideoUploadButton.addEventListener('click', function() {
          var videoFile = taskVideoFileChooser.files[0];

          if (videoFile) {
            taskVideoUploadResults.innerHTML = '';

            // Is the file of the right type?
            if (!checkFileType(videoFile, new Array('video/mp4', 'video/webm', 'video/x-matroska'))) {
                taskVideoUploadResults.innerHTML = "Virhe: Videotiedosto on väärää tyyppiä.";
                return;
            }

            var videoUploadFilename = generateTaskVideoFilename(taskId, videoFile.name);
            var videoParams = {Key: videoUploadFilename, ContentType: videoFile.type, Body: videoFile};
            taskVideoBucket.upload(videoParams, function (err, data) {
              if (err) {
                  taskVideoUploadResults.innerHTML = 'Videon lähettämisessä tapahtui virhe: ' + err;
              } else {
                taskVideoUploadResults.innerHTML = 'Video lähetettiin onnistuneesti.';
                // Make an AJAX call to video_upload_completed/id.
                taskVideoUploadCompleted(taskId);
              }
            });
          } else {
            taskVideoUploadResults.innerHTML = 'Valitse ensin lähetettävä video.';
          }
        }, false);
      </script>
    </div>

    <div id="task-icon">
      <?php if ($task->icon_uri == null || $task->icon_uri == ''): ?>
        Tehtävän kuvaketta ei vielä ole lähetetty.
      <?php else: ?>
        Tehtävän kuvake on jo lähetetty. Kuvakkeen URI on: <?php print $task->icon_uri; ?>
      <?php endif; ?>
    </div>

    <div id="task-icon-upload">
      <input type="file" id="task-icon-file-chooser" />
      <button type="button" id="task-icon-upload-button">Lähetä kuvake</button>
      <div id="task-icon-upload-results"></div>
      <script type="text/javascript">
        var taskIconBucket = new AWS.S3({params: {Bucket: graphicsBucketName}});
        var taskIconFileChooser = document.getElementById('task-icon-file-chooser');
        var taskIconUploadButton = document.getElementById('task-icon-upload-button');
        var taskIconUploadResults = document.getElementById('task-icon-upload-results');
        taskIconUploadButton.addEventListener('click', function() {
          var iconFile = taskIconFileChooser.files[0];

          if (iconFile) {
            taskIconUploadResults.innerHTML = '';

            // Is the file of the right type?
            if (!checkFileType(iconFile, new Array('image/png'))) {
                taskIconUploadResults.innerHTML = "Virhe: Kuvatiedosto on väärää tyyppiä.";
                return;
            }

            var iconUploadFilename = generateTaskVideoFilename(taskId, iconFile.name);
            var iconParams = {Key: iconUploadFilename, ContentType: iconFile.type, Body: iconFile};
            taskIconBucket.upload(iconParams, function (err, data) {
              if (err) {
                  taskIconUploadResults.innerHTML = 'Kuvakkeen lähettämisessä tapahtui virhe: ' + err;
              } else {
                taskIconUploadResults.innerHTML = 'Kuvake lähetettiin onnistuneesti.';
                // Make an AJAX call to video_upload_completed/id.
                taskIconUploadCompleted(taskId);
              }
            });
          } else {
            taskIconUploadResults.innerHTML = 'Valitse ensin lähetettävä kuvake.';
          }
        }, false);
      </script>
    </div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
