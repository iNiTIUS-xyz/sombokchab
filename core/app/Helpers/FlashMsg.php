<?php

namespace App\Helpers;

class FlashMsg
{

    public static function create_succeed(string $item): array
    {
        return [
            'type' => 'success',
            'msg' => __(ucfirst($item) . " created successfully.")
        ];
    }

    public static function create_failed(string $item): array
    {
        return [
            'type' => 'danger',
            'msg' => __(ucfirst($item) . " creation failed.")
        ];
    }

    public static function update_succeed(string $item): array
    {
        return [
            'type' => 'success',
            'msg' => __(ucfirst($item) . " updated successfully.")
        ];
    }

    public static function update_failed(string $item): array
    {
        return [
            'type' => 'danger',
            'msg' => __(ucfirst($item) . " updating failed.")
        ];
    }

    public static function delete_succeed(string $item): array
    {
        return [
            'type' => 'danger',
            'msg' => __(ucfirst($item) . " deleted successfully.")
        ];
    }

    public static function delete_failed(string $item): array
    {
        return [
            'type' => 'danger',
            'msg' => __(ucfirst($item) . " deleting failed.")
        ];
    }

    public static function clone_succeed(string $item): array
    {
        return [
            'type' => 'success',
            'msg' => __(ucfirst($item) . " cloned successfully")
        ];
    }

    public static function clone_failed(string $item): array
    {
        return [
            'type' => 'success',
            'msg' => __(ucfirst($item) . " cloning failed.")
        ];
    }

    public static function signup_succeed($item = null): array
    {
        if ($item && $item === 'teacher') {
            return [
                'type' => 'success',
                'msg' => __("Signup Success. Pending admin approval.")
            ];
        }

        return [
            'type' => 'success',
            'msg' => __("Signup Success.")
        ];
    }

    public static function signup_failed(): array
    {
        return [
            'type' => 'danger',
            'msg' => __("Signup Failed.")
        ];
    }

    public static function teacherApproveSucceed(): array
    {
        return [
            'type' => 'success',
            'msg' => __("Teacher approve Success.")
        ];
    }

    public static function teacherApproveFailed(): array
    {
        return [
            'type' => 'danger',
            'msg' => __("Teacher approve Failed.")
        ];
    }

    public static function explain($type, $msg): array
    {
        return [
            'type' => $type ?? 'danger',
            'msg' => __($msg)
        ];
    }

    public static function item_cloned($msg = null)
    {
        return [
            'type' => 'success',
            'msg' => $msg ?? __('Item Cloned Successfully.')
        ];
    }
    public static function item_new($msg = null)
    {
        return [
            'type' => 'success',
            'msg' => $msg ?? __('Item Added Successfully.')
        ];
    }
    public static function item_update($msg = null)
    {
        return [
            'type' => 'success',
            'msg' => $msg ?? __('Item Updated Successfully.')
        ];
    }
    public static function item_delete($msg = null)
    {
        return [
            'type' => 'danger',
            'msg' => $msg ?? __('Item Deleted Successfully.')
        ];
    }
    public static function item_clone($msg = null)
    {
        return [
            'type' => 'success',
            'msg' => $msg ?? __('Item Cloned Successfully.')
        ];
    }
    public static function settings_update($msg = null)
    {
        return [
            'type' => 'success',
            'msg' => $msg ?? __('Settings Updated Successfully.')
        ];
    }
    public static function settings_new($msg = null)
    {
        return [
            'type' => 'success',
            'msg' => $msg ?? __('Settings Added Successfully.')
        ];
    }
    public static function settings_delete($msg = null)
    {
        return [
            'type' => 'danger',
            'msg' => $msg ?? __('Settings Deleted Successfully.')
        ];
    }
    public static function restore_succeed(string $item): array
    {
        return [
            'type' => 'success',
            'msg' => __(ucfirst($item) . " Restore Successfully.")
        ];
    }

    public static function restore_failed(string $item): array
    {
        return [
            'type' => 'danger',
            'msg' => __(ucfirst($item) . " Restore Failed.")
        ];
    }

}
