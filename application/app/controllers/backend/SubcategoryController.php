<?php

class SubcategoryController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"subcategory");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$subcategories = Subcategory::all();
		$date_format = Common::get_date();
		return View::make('backend.admin.subcategory.index',compact('subcategories','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		$categories = Category::all();
		return View::make('backend.admin.subcategory.add',compact('categories'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/subcategory/create')
				->withErrors($validator)
				->withInput();
		}
		
		$subcategory = new Subcategory;
		$subcategory->category_id = Input::get('category_name');
		$subcategory->subcategory_name = Input::get('name');
		$subcategory->save();

		Session::flash('success', 'Subcategory is successfully created.');
		return Redirect::to('admin/subcategory');
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
		$subcategory = Subcategory::findOrFail($id);
		return View::make('backend.admin.subcategory.detail', compact('subcategory'));
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
		$subcategory = Subcategory::find($id);
		$categories = Category::all();
		return View::make('backend.admin.subcategory.edit', compact('subcategory','categories'));
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
			$subcategory = Subcategory::find($id);
			$subcategory->category_id = Input::get('category_name');
			$subcategory->subcategory_name = Input::get('name');
			$subcategory->save();

			Session::flash('success', 'Subcategory is successfully updated.');
			return Redirect::to('admin/subcategory');
		} else {
			return Redirect::to('admin/subcategory/'.$id.'/edit')->withErrors($validator)->withInput();
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
		Subcategory::destroy($id);
		Session::flash('success', 'Subcategory is successfully deleted.');
		return Redirect::to('admin/subcategory');
	}

	public function report_pdf()
	{
		$subcategories = Subcategory::join('categories','subcategories.category_id','=','categories.id')
			->orderBy('subcategories.created_at','desc')
			->select('subcategories.created_at as create', 'subcategories.*', 'subcategories.updated_at as update', 'categories.category_name')
			->get();
		$date_format = Common::get_date();
		if ( count($subcategories) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.subcategory.report_pdf',compact('subcategories','date_format'));
			return $pdf->stream();
		} else {
			Session::flash('fail', 'There is no subcategory.');
			return Redirect::to('admin/subcategory');
		}
	}
	
	public function report_excel()
	{
		$subcategories = Subcategory::join('categories','subcategories.category_id','=','categories.id')
			->orderBy('subcategories.created_at','desc')
			->select('subcategories.created_at as create', 'subcategories.*', 'subcategories.updated_at as update', 'categories.category_name')
			->get();
		$date_format = Common::get_date();
		if ( count($subcategories) != 0 )
		{
			$i = 1;
			foreach ( $subcategories as $subcategory )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $subcategory->subcategory_name;
            			$temp['cate'] = $subcategory->category_name;
            			$temp['create'] = date($date_format, strtotime($subcategory->create));
            			$temp['update'] = date($date_format, strtotime($subcategory->update));
            			$result[] = $temp;
            		}

			$filename = "subcategory_report.csv";

			$header = array(
				'No.','Subcategory Name', 'Category Name', 'Created Date', 'Updated Date'
			);

			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('fail', 'There is no subcategory.');
			return Redirect::to('admin/subcategory');
		}
	}


}