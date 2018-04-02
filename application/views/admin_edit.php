<div style="margin-left: 5%; margin-right: 5%;">
  <textarea id="editor">
    <?=$text?>
  </textarea>
</div>
<script>
    var editor = document.getElementById('editor');
    CKEDITOR.replace('editor', {
        language: 'zh-cn',
        customConfig: '/assets/js/ckeditor_config.js'
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
