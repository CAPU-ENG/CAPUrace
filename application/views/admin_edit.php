<div style="margin-left: 20%; margin-right: 20%;">
  <textarea id="editor">
    <?=$text?>
  </textarea>
</div>
<script>
    // The inline editor should be enabled on an element with "contenteditable" attribute set to "true".
    // Otherwise CKEditor will start in read-only mode.
    var editor = document.getElementById('editor');
    CKEDITOR.replace('editor', {
        language: 'zh-cn',
        customConfig: '/ckeditor_config.js'
    });
    var text;
    var title = "<?=$title?>";
    var publish, data;
    $("#btn-update").click(function () {
        text = CKEDITOR.instances.editor.getData();
        data = {
            title: title,
            text: text,
            publish: 0
        };
        $.post("<?=site_url('admin/edit')?>", data, function (response) {
            alert('更新成功！');
        });
    });
    $("#btn-publish").click(function () {
        text = CKEDITOR.instances.editor.getData();
        data = {
            title: title,
            text: text,
            publish: 1
        };
        $.post("<?=site_url('admin/edit')?>", data, function (response) {
            alert('发布成功！');
        });
    });
</script>
