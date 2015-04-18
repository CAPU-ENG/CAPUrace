<?php
if (!function_exists('render_value')) {
    function render_value($entry, $row, $format) {
        if (!isset($row[$entry])) {
            return '--NULL--';
        }
        $current_value = $row[$entry];

        if ($format['type'] === 'foreignkey') {
            if (!isset($format['display_column'])) {
                return (string)$current_value;
            }
            $display_entry = $format['display_column'];
            if (!isset($row[$display_entry])) {
                return (string)$current_value;
            }
            return (string)$row[$display_entry];
        }

        if ($format['type'] === 'enum') {
            if (!isset($format['enum'][$current_value])) {
                return '<' . (string)$current_value . '>';
            }
            return (string)$format['enum'][$current_value];
        }

        if ($format['type'] === 'boolean') {
            return $current_value == 0 ? '否' : '是';
        }

        return (string)$current_value;
    }
}

if (!function_exists('render_input')) {
    function render_input($entry, $row, $format, $foreign_keys) {
        if ($format['type'] === 'foreignkey') {
            if (isset($row[$entry])) {
                $selected = $row[$entry];
            }
            else {
                $selected = null;
            }
            $result = '<select id="';
            $result .= $entry;
            $result .= '" name="';
            $result .= $entry;
            $result .= '">';
            foreach ($foreign_keys[$entry]['records'] as $foreign_row) {
                $result .= '<option value="';
                $result .= (string)$foreign_row['id'];
                if ($selected === $foreign_row['id']) {
                    $result .= '" selected="selected';
                }
                $result .= '">';
                if (isset($format['display_column'])) {
                    $result .= (string)$foreign_row[$format['display_column']];
                }
                else {
                    $result .= (string)$foreign_row['id'];
                }
                $result .= '</option>';
            }
            if (isset($foreign_keys[$entry]['format']['nullable']) and $foreign_keys[$entry]['format']['nullable']) {
                $result .= '<option value="NULL">没有</option>';
            }
            $result .= '</select>';
            return $result;
        }
        if ($format['type'] === 'enum') {
            if (isset($row[$entry])) {
                $selected = $row[$entry];
            }
            else {
                $selected = null;
            }
            $result = '<select id="';
            $result .= $entry;
            $result .= '" name="';
            $result .= $entry;
            $result .= '">';
            foreach ($format['enum'] as $n => $name) {
                $result .= '<option value="';
                $result .= (string)$n;
                if ($selected === (string)$n) {
                    $result .= '" selected="selected';
                }
                $result .= '">';
                $result .= (string)$name;
                $result .= '</option>';
            }
            $result .= '</select>';
            return $result;
        }
        if ($format['type'] === 'password') {
            $result = '<input type="password" value="********" id="';
            $result .= $entry;
            $result .= '" name="';
            $result .= $entry;
            $result .= '" disabled="disabled">';
            return $result;
        }
        if ($format['type'] === 'boolean') {
            if (isset($row[$entry])) {
                $value = $row[$entry];
            }
            else {
                $value = null;
            }
            $result = '<input type="radio" value="1" id="';
            $result .= $entry;
            $result .= '" name="';
            $result .= $entry;
            if ((string)$value === '1') {
                $result .= '" checked="checked" "';
            }
            $result .= '" >是<input type="radio" value="0" id="';
            $result .= $entry;
            $result .= '" name="';
            $result .= $entry;
            if ((string)$value === '0') {
                $result .= '" checked="checked" "';
            }
            $result .= '" >否';
            return $result;
        }
        $result = '<input type="text" value="';
        if (isset($row[$entry])) {
            $result .= (string)$row[$entry];
        }
        $result .= '" id="';
        $result .= $entry;
        $result .= '" name="';
        $result .= $entry;
        $result .= '">';
        return $result;
    }
}
