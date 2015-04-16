<?php echo "\xef\xbb\xbf";
$this->load->helper('render');
if (isset($current)) {
    foreach ($tables[$current] as $name => $content) {
        echo $name; echo ',';
    }
    echo PHP_EOL;
    foreach ($records as $row) {
        $current_table = $tables[$current];
        foreach ($current_table as $name => $format) {
            echo render_value($name, $row, $format); echo ',';
        }
        echo PHP_EOL;
    }
}
