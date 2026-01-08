<?php

namespace App\PageBuilder\Fields;

use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class NiceSelect extends PageBuilderField {
    use FieldInstanceHelper;

    /**
     * render field markup
     * */
    public function render() {
        $output = '';
        $output .= $this->field_before();
        $output .= $this->label();

        $multiple = isset($this->args['multiple']) && $this->args['multiple'];
        $name = $this->name();
        if ($multiple) {
            $name .= '[]';
        }

        // Ensure value is always handled correctly
        $current_value = $this->value();
        if ($multiple && !is_array($current_value)) {
            $current_value = !empty($current_value) ? (is_string($current_value) ? explode(',', $current_value) : []) : [];
        } elseif (!$multiple && is_array($current_value)) {
            $current_value = $current_value[0] ?? '';
        }

        $multiple_attr = $multiple ? 'multiple' : '';
        $class = $multiple
        ? 'form-control select2-multi' // Use Select2 for multiple
        : 'nice-select wide ' . $this->field_class();

        $output .= '<select name="' . $name . '" class="' . $class . '" ' . $multiple_attr . ' style="width:100%;">';

        if (!empty($this->args['placeholder']) && !$multiple) {
            $output .= '<option value="">' . $this->args['placeholder'] . '</option>';
        }

        foreach ($this->args['options'] as $value => $label) {
            $label = (string) $label;
            $original_label = $label;

            if (strlen($label) > 50) {
                $label = substr($label, 0, 50) . '...';
            }

            $selected = '';

            if ($multiple) {

                // 🔥 Normalize + flatten current value
                $normalized = [];

                if (is_string($current_value)) {
                    $decoded = json_decode($current_value, true);
                    $current_value = is_array($decoded)
                    ? $decoded
                    : explode(',', $current_value);
                }

                if (is_array($current_value)) {
                    array_walk_recursive($current_value, function ($item) use (&$normalized) {
                        if ($item !== null && $item !== '') {
                            $normalized[] = (string) $item;
                        }
                    });
                }

                $selected = in_array((string) $value, $normalized, true) ? 'selected' : '';
            } else {
                $selected = ((string) $current_value === (string) $value) ? 'selected' : '';
            }

            // Use title attribute to show full text on hover
            $title_attr = ($original_label !== $label) ? ' title="' . htmlspecialchars($original_label) . '"' : '';

            $output .= '<option value="' . htmlspecialchars($value) . '" ' . $selected . $title_attr . '>'
            . htmlspecialchars($label)
                . '</option>';
        }

        $output .= '</select>';

        if (!empty($this->args['info'])) {
            $output .= '<small class="text-muted d-block mt-2">' . $this->args['info'] . '</small>';
        }

        $output .= $this->field_after();

        return $output;
    }
}
