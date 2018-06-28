<?php

class CategoryController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"category");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$categories = Category::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.category.index',compact('categories','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.category.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:categories,category_name'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/category/create')
				->withErrors($validator)
				->withInput();
		}

		$category = new Category;
		$category->category_name = Input::get('name');
		$category->save();

		Session::flash('success', 'Category is successfully created.');
		return Redirect::to('admin/category');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$category = Category::findOrFail($id);
		return View::make('backend.admin.category.detail', compact('category'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!User::hasPermTo(MODULE,'edit'))return Redirect::to('admin/error/show/403');
		$category = Category::find($id);
		return View::make('backend.admin.category.edit', compact('category'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'name'	=> 'required|unique:categories,category_name,'.$id
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {
			$category = Category::find($id);
			$category->category_name = Input::get('name');
			$category->save();

			Session::flash('success', 'Category is successfully updated.');
			return Redirect::to('admin/category');
		} else {
			return Redirect::to('admin/category/'.$id.'/edit')->withErrors($validator)->withInput();
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');

		$category = Category::findorFail($id);

		$get = Category::join('subcategories', 'subcategories.category_id', '=', 'categories.id')->select('*')->where('categories.id',$id)->get();

		if(count($get) == 0){
			$category->delete();
			Session::flash('success','Category is successfully deleted.');
		} else {
			Session::flash('error','Could not delete the category , the category may be in used.');
		}

		return Redirect::to('admin/category');
	}
	
	public function get_subcategory()
	{
		$id = Input::get('id');
		$val = '';

		if ( $id != 'NULL')
		{
			$subcategories = Category::find($id)->subcategories;

			foreach($subcategories as $subcategory)
	        		{
	            		$val .= '<option value="'. $subcategory['id'] .'">'. $subcategory['subcategory_name'] .'</option>';
	        		}
	        		echo $val; 
	        	} else {
	        		echo '<option value="NULL">-</option>';
	        	}
	}
	
	public function report_pdf()
	{
		$categories = Category::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($categories) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.category.report_pdf',compact('categories','date_format'));
			return $pdf->stream();
		} else {
			Session::flash('fail', 'There is no category.');
			return Redirect::to('admin/category');
		}
	}
	
	public function report_excel()
	{
		$categories = Category::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($categories) != 0 )
		{
			$i = 1;
			foreach ( $categories as $category )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $category->category_name;
            			$temp['create'] = date($date_format, strtotime($category->created_at));
            			$result[] = $temp;
            		}

			$filename = "category_report.csv";

			$header = array(
				'No.','Category Name', 'Created Date'
			);

			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('fail', 'There is no category.');
			return Redirect::to('admin/category');
		}
	}


}
