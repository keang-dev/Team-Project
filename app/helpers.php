<?php 

function reserveDate($date){
    $data = date('Y-m-d', strtotime($data));
    $data = date('d', strtotime($data));
    $d = explode('-', $date);
    return $d['2'].'-'.$d['1'].'-'.$d['0'];
}
function get_day_kh($date){
    $days = [
        "0" => "០០",
        "01" => "០១",
        "02" => "០២",
        "03" => "០៣",
        "04" => "០៤",
        "05" => "០៥",
        "06" => "០៦",
        "07" => "០៧",
        "08" => "០៨",
        "09" => "០៩",
        "10" => "១០",
        "11" => "១១",
        "12" => "១២",
        "13" => "១៣",
        "14" => "១៤",
        "15" => "១៥",
        "16" => "១៦",
        "17" => "១៧",
        "18" => "១៨",
        "19" => "១៩",
        "20" => "២០",
        "21" => "២១",
        "22" => "២២",
        "23" => "២៣",
        "24" => "២៤",
        "25" => "២៥",
        "26" => "២៦",
        "27" => "២៧",
        "28" => "២៨",
        "29" => "២៩",
        "30" => "៣០",
        "31" => "៣១",
    ];
    // ចាប់ពីថ្ងៃទី ១៤ ដល់ ៣០ ខែតុលា ២០២២
    $dates = explode('-', $date);
    return $days[$dates[2]];
}


// argument format  'Y-m-d'
function get_month_kh($date){
    $months = [
        '0' => '០', 
        '01' =>'មករា', 
        '02' =>'កុម្ភៈ', 
        '03' =>'មីនា', 
        '04' => 'មេសា', 
        '05' =>'ឧសភា', 
        '06' =>'មិថុនា', 
        '07' =>'កក្កដា', 
        '08' =>'សីហា', 
        '09' =>'កញ្ញា', 
        '10' =>'តុលា', 
        '11' =>'វិច្ឆិកា', 
        '12' =>'ធ្នូ'
    ];
    $dates = explode('-', $date);
    return $months[$dates[1]];    
}

// argument format  'Y-m-d'
function get_year_kh($date){
    $dates = explode('-', $date);
    $year = array_map('intval', str_split($dates[0]));
    $numbers = [
        "0" => "០",
        "1" => "១",
        "2" => "២",
        "3" => "៣",
        "4" => "៤",
        "5" => "៥",
        "6" => "៦",
        "7" => "៧",
        "8" => "៨",
        "9" => "៩",
    ];

    return $numbers[$year[0]] . $numbers[$year[1]] . $numbers[$year[2]] . $numbers[$year[3]];
}
// argument format  'Y-m-d'
function get_full_date_kh($date){
    $day = get_day_kh($date);
    $month = get_month_kh($date);
    $year = get_year_kh($date);
    return $day.' '. $month .' '. $year;
}

function translateDate($lang = 'en'){
    $date = date('Y-m-d');
    if($lang == 'kh'){
        return get_full_date_kh($date);
    }
    return $date;
}

function tran($en, $kh, $lang = 'en'){
    if($lang == 'kh'){
        return $kh;
    }
    return $en;
}

// check permission 
function btn_delete($tbl, $permission, $action, $id, $deleteFunction = ''){
    $btn_delete = '';
    $user_role_id = auth()->user()->role_id;
    // param permission, action
    $feature_id = DB::table('permission_features')
        ->join('permissions', 'permissions.id', 'permission_id')
        ->where('permissions.key', $permission)
        ->where('permission_features.aleas', $action)
        ->select('permission_features.id')
        ->first()->id;
    $role_permission = DB::table('role_permissions')
        ->join('permissions', 'permissions.id', 'permission_id')
        ->where('permissions.key', $permission)
        ->where('role_permissions.role_id', $user_role_id)
        ->first();
    if($role_permission->permisions && in_array($feature_id, json_decode($role_permission->permisions))){
        if($deleteFunction){
            $btn_delete = '<a class="btn btn-danger btn-sm" tbl="'.$tbl.'" key="id" onclick="'.$deleteFunction.'"><i class="fa fa-trash"></i></a>' ;
        }else{
            $btn_delete = '<a class="btn btn-danger btn-sm" tbl="'.$tbl.'" key="id" onclick="deleteRecord('.$id.', this)"><i class="fa fa-trash"></i></a>' ;
        }
       
    }

    return $btn_delete;
}

function btn_edit($tbl, $permission, $action, $id, $editFunction = ''){
    $btn_edit = '';
    $user_role_id = auth()->user()->role_id;
    // param permission, action
    $feature_id = DB::table('permission_features')
        ->join('permissions', 'permissions.id', 'permission_features.permission_id')
        ->where('permission_features.aleas', $action)
        ->where('permissions.key', $permission)
        ->select('permission_features.id')
        ->first()->id;
    $role_permission = DB::table('role_permissions')
        ->join('permissions', 'permissions.id', 'permission_id')
        ->where('permissions.key', $permission)
        ->where('role_permissions.role_id', $user_role_id)
        ->first();
    if($role_permission->permisions && in_array($feature_id, json_decode($role_permission->permisions))){
        if($editFunction){
            $btn_edit = '<a class="btn btn-info btn-sm" onclick="'.$editFunction.'"><i class="fa fa-edit"></i></a>' ;
        }else{
            $btn_edit = '<a class="btn btn-info btn-sm" onclick="edit('.$id.',  this)"><i class="fa fa-edit"></i></a>' ;

        }
    }

    return $btn_edit;
}

function btn_reset_password($tbl, $permission, $action, $id, $resetFunction = ''){
    $btn_reset_password = '';
    $user_role_id = auth()->user()->role_id;
    // param permission, action
    $feature_id = DB::table('permission_features')
        ->join('permissions', 'permissions.id', 'permission_features.permission_id')
        ->where('permission_features.aleas', $action)
        ->where('permissions.key', $permission)
        ->select('permission_features.id')
        ->first()->id;
    $role_permission = DB::table('role_permissions')
        ->join('permissions', 'permissions.id', 'permission_id')
        ->where('permissions.key', $permission)
        ->where('role_permissions.role_id', $user_role_id)
        ->first();
    if($role_permission->permisions && in_array($feature_id, json_decode($role_permission->permisions))){
        if($resetFunction){
            $btn_reset_password = '<a class="btn btn-info btn-sm" onclick="'.$resetFunction.'"><i class="fa fa-edit"></i></a>' ;
        }else{
            $btn_reset_password = '<a class="btn btn-info btn-sm" onclick="reset_password('.$id.',  this)"><i class="fa fa-undo"></i></a>' ;

        }
    }

    return $btn_reset_password;
}
function check_permission($permission, $action){
    $user_role_id = auth()->user()->role_id;

    // param permission, action
    $feature = DB::table('permission_features')
        ->join('permissions', 'permissions.id', 'permission_features.permission_id')
        ->where('permission_features.aleas', $action)
        ->where('permissions.key', $permission)
        ->select('permission_features.id')
        ->first();
    $role_permission = DB::table('role_permissions')
        ->join('permissions', 'permissions.id', 'permission_id')
        ->where('permissions.key', $permission)
        ->where('role_permissions.role_id', $user_role_id)
        ->first();
    
    if($role_permission->permisions && in_array($feature->id, json_decode($role_permission->permisions))){
        return 1;
    }
    
    return 0;

}
function base64Encode($data){

    $data = json_encode($data);
    $data =  base64_encode($data);
    $data = $data . '$$$kpaskdpaksd1231#!^@&*SADKAJD123#$$!#!FAS';
    $data = base64_encode($data);
    $data = '$jahsdj123$!*(#!*!!#!#@@' . $data;
    $data = base64_encode($data);

    return $data;
}

function base64Decode($data){
    $data = base64_decode($data);
    $data = explode('@@', $data);
    if(count($data) != 2 || $data[0] != '$jahsdj123$!*(#!*!!#!#'){
        return 0;
    }

    $data = $data[1];
    $data = base64_decode($data);

    $data = explode('$$$', $data);

    if(count($data) != 2 || $data[1] != 'kpaskdpaksd1231#!^@&*SADKAJD123#$$!#!FAS'){
        return 0;
    }



    $data = base64_decode($data[0]);
    $data = json_decode($data);

    return $data;
}


function checkPermission($permission,$action){

    $get_permission = DB::table('permissions')->where('key',$permission)->first();
    if(!$get_permission) {
        return false;
    }

    $user_id = request()->header('user_id');
    $user = DB::table('users')->find($user_id);


    $role_permissions = DB::table('role_permissions')
                        ->where(['role_id' => $user->role_id, 'permission_id' => $get_permission->id])
                        ->first();

    if(!$role_permissions){
        return false;
    }


    $feature_ids = json_decode($role_permissions->permission_feature_id);

    $permission_feature = DB::table('permission_features')
                            ->whereIn('id',$feature_ids)
                            ->where('key',$action)
                            ->exists();
        
    return $permission_feature ? true : false;
}

// function audit($condition,$action = 'is_view', $user){
//     $is_no_auth = 0;
//     $is_login = 0;
//     $is_no_permission = 0;
//     $login_time = date('Y-m-d H:i:s');
//     $logout_time = date('Y-m-d H:i:s');
//     $last_time_used = '';
//     $url = request()->url();
//     $ip = request()->ip();

//     $data = [
//         'ip' => $ip,
//         'url' => $url,
//     ];

//     if($condition == 'is_no_auth'){
//         $data['username'] = $user->email;
//         $data['password'] = $user->password;
//         $data['user_id'] = $user->id;
//         $is_no_auth = 1;
//     }
//     else if($condition == 'is_no_permission'){
//         $is_no_permission = 1;
//     }else if($condition == 'is_login'){
//         $data['user_id'] = $user->id;
//         $data['login_time'] = $login_time;
//         $data['username'] = $user->email;
//         $data['password'] = $user->password;
//         $data['is_login'] = 1;
//     } else if($condition == 'is_logout'){
//         $data['user_id'] = $user->id;
//         $data['username'] = $user->email;
//         $data['password'] = $user->password;
//         $data['logout_time'] = $logout_time;
//     } else {
//         $last_time_used = date('Y-m-d H:i:s');
//         $data['username'] = $user->email;
//         $data['password'] = $user->password;
//         $data['user_id'] = $user->id;
//     }

//     $data['is_no_auth'] = $is_no_auth;
//     $data['is_no_permission'] = $is_no_permission;

//     $agent = new Agent;
//     $data['device'] = $agent->device();
//     $data['platform'] = $agent->platform();
//     $data['browser'] = $agent->browser();
//     $data['version'] = $agent->version($agent->platform());
//     $data['is_desktop'] = $agent->isDesktop() ? 1 : 0;
//     $data['is_phone'] = $agent->isMobile() ? 1 : 0;
//     $data['is_table'] = $agent->isTablet() ? 1 : 0;
//     $data['is_robot'] = $agent->isRobot() ? 1 : 0;
//     $data['robot_name'] = $agent->isRobot() ? $agent->robot() : '';
//     $data[$action] = 1;
//     $data['last_time_used'] = $last_time_used;

//     try {
//         $id = DB::table('audits')->insertGetId($data);
//     } catch (\Throwable $th) {
//         return false;
//     }
// }




?>