<?php

	class General_setting extends Eloquent {
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'general_setting';

		public $timestamps = false;
		
		public static function update_cpf_setting()
		{
			$id = Input::get('pk');
			$data = array(
				Input::get('name') => Input::get('value')
			);
			DB::table('cpf_setting')->where('id','=',$id)->update($data);
			return "Successfully updated the cpf setting.";	
		}
		
	}

?>