<div class="regcontainer" id="editor">
    <?=implode("", $text)?>
</div>
<script>
    // The inline editor should be enabled on an element with "contenteditable" attribute set to "true".
    // Otherwise CKEditor will start in read-only mode.
    var editarea = document.getElementById('editor');
    editarea.setAttribute('contenteditable', true);
    CKEDITOR.inline('editor');
</script>