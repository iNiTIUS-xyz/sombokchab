<?php

namespace Modules\DeliveryMan\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Xgenious\XgApiClient\Facades\XgApiClient;
use Throwable;

class AdminDeliveryManUpdatePluginController extends Controller
{
    public function updatePlugin()
    {
        return view("deliveryman::admin.update_plugin.update_plugin");
    }
    public function delivery_man_license_settings_update(Request $request)
    {
        $request->validate([
            'delivery_man_license_key' => 'required|string|max:191',
            'envato_username' => 'required|string|max:191',
        ]);

        $result = XgApiClient::activeLicense($request->delivery_man_license_key,$request->envato_username);
        $type = "danger";
        $msg = __("could not able to verify your license key, please try after sometime, if you still face this issue, contact support");
        if (!empty($result["success"]) && $result["success"]){
            update_static_option('delivery_man_license_key', $request->site_license_key);
            update_static_option('delivery_man_license_status', $result['success'] ? 'verified' : "");
            update_static_option('delivery_man_license_msg', $result['message']);
            $type = $result['success'] ? 'success' : "danger";
            $msg = $result['message'];
        }

        return redirect()->back()->with(['msg' => $msg, 'type' => $type]);
    }
    public function update_version_check(){

        $result = XgApiClient::checkForUpdate(get_static_option("delivery_man_license_key"),get_static_option("delivery_man_plugin_version",'1.0.0'));

        if (isset($result["success"]) && $result["success"]){


            $productUid = $result['data']['product_uid'] ?? null;
            $clientVersion = $result['data']['client_version'] ?? null;
            $latestVersion = $result['data']['latest_version'] ?? null;
            $productName = $result['data']['product'] ?? null;
            $releaseDate =  $result['data']['release_date'] ?? null;
            $changelog =  $result['data']['changelog'] ?? null;
            $phpVersionReq =  $result['data']['php_version'] ?? null;
            $mysqlVersionReq =  $result['data']['mysql_version'] ?? null;
            $extensions =  $result['data']['extension'] ?? null;
            $isTenant =  $result['data']['is_tenant'] ?? null;
            $daysDiff = $releaseDate;
            $msg = $result['data']['message'] ?? null;

            $output = "";
            $phpVCompare = version_compare(number_format((float) PHP_VERSION, 1), $phpVersionReq == 8 ? '8.0' : $phpVersionReq, '>=');
            $mysqlServerVersion = DB::select('select version()')[0]->{'version()'};
            $mysqlVCompare = version_compare(number_format((float) $mysqlServerVersion, 1), $mysqlVersionReq, '<=');
            $extensionReq = true;
            if ($extensions) {
                foreach (explode(',', str_replace(' ','', strtolower($extensions))) as $extension) {
                    if(!empty($extension)) continue;
                    $extensionReq = XgApiClient::extensionCheck($extension);
                }
            }
            if(($phpVCompare === false || $mysqlVCompare === false) && $extensionReq === false){
                $output .='<div class="text-danger">'.__('Your server does not have required software version installed.  Required: Php'). $phpVersionReq == 8 ? '8.0' : $phpVersionReq .', Mysql'.  $mysqlVersionReq . '/ Extensions:' .$extensions . 'etc </div>';
                return response()->json(["msg" => $result["message"],"type" => "success","markup" => $output ]);
            }

            if (!empty($latestVersion)){
                $output .= '<div class="text-success">'.$msg.'</div>';
                $output .= '<div class="card text-center" ><div class="card-header bg-transparent text-warning" >'.__("Please backup your database & script files before upgrading.").'</div>';
                $output .= '<div class="card-body" ><h5 class="card-title" >'.__("new Version").' ('.$latestVersion.') '.__("is Available for").' '.$productName.'!</h5 >';
                $updateActionUrl = route('admin.general.update.download.settings', [$productUid, $isTenant]);
                $output .= '<a href = "#"  class="btn btn-warning" id="update_download_and_run_update" data-version="'.$latestVersion.'" data-action="'.$updateActionUrl.'"> <i class="las la-spinner la-spin d-none"></i>'.__("Download & Update").' </a>';
                $output .= '<small class="text-warning d-block">'.__('it can take upto 5-10min to complete update download and initiate upgrade').'</small></div>';
                $changesLongByLine = explode("\n",$changelog);
                $output .= '<p class="changes-log">';
                $output .= '<strong>'.__("Released:")." ".$daysDiff." "."</strong><br>";
                $output .= "-------------------------------------------<br>";
                foreach($changesLongByLine as $cg){
                    $output .= $cg."<br>";
                }
                $output .= '</p>';

                $output .='</div>';
            }

            return response()->json(["msg" => $result["message"],"type" => "success","markup" => $output ]);
        }

        return response()->json(["msg" => $result["message"],"type" => "danger","markup" => "<p class='text-danger'>".$result["message"]."</p>" ]);

    }
}
