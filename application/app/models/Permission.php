<?php  

class Permission extends Eloquent {

	protected $table = 'permissions';

	public function scopeGet_permission_list()
	{
		$permissions = DB::table('permissions')
		                ->orderBy('id', 'desc')
		                ->get();

		echo json_encode($permissions->to_array());
	}

	public static function getPermissionByRole($id,$field=NULL)
	{		
		if (is_null($field)) {
			return Permission::where('role_id','=',$id)->get();
		} else {
			return DB::table('permissions')->select($id)->where('role_id',$id)->get();
		}
	}

	public static function add_sub_permission()
	{
		$role = Input::get('id4role');
		$perm_array = Input::get('data');
		$permissions = Permission::getPermissionByRole($role);
		foreach($permissions as $perm) {
			if(DB::table('sub_permissions')->where('perm_id',$perm->id)->count()>0) {
				DB::table('sub_permissions')->where('perm_id',$perm->id)->delete();
			}
		}
		foreach($perm_array as $perm_data) {
			DB::table('sub_permissions')->insert(array(
					'perm_id' => $perm_data['id'],
					'description' => $perm_data['description']
				)
			);
		}
	}

	public static function isPermDuplicate()
	{
		$id = Input::get('role_id');
		$module = Input::get('module');
		$count = DB::table('permissions')->where('role_id','=',$id)->where('permission','=',$module)->count();
		if($count == 0){
			return 0;
		} else {
			return 1;
		}
	}
	
	public function scopeAdd_permission()
	{
		$id = Input::get('role_id');
		$module = Input::get('module');
		DB::table('permissions')->insert(array(
				'role_id'		=>	$id,
				'permission'	=>	$module
			)
		);
	}

}
