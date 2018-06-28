<?php

class BrandController extends BaseController {

	public function __construct()
	{
		parent::__construct();
		define('MODULE',"brand");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::hasPermTo(MODULE,'view'))return Redirect::to('admin/error/show/403');
		$brands = Brand::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		return View::make('backend.admin.brand.index',compact('brands','date_format'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!User::hasPermTo(MODULE,'create'))return Redirect::to('admin/error/show/403');
		return View::make('backend.admin.brand.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:brands,brand_name'
		);
		$validator = Validator::make(Input::all(),$rules);

		if( $validator->fails() ) {
			return Redirect::to('admin/brand/create')
				->withErrors($validator)
				->withInput();
		}

		$image_files = array();
		$image_files = parent::common_upload_picture(Input::file('userfile'),'uploads/brand_icons');

		$brand = new Brand;
		$brand->brand_name = Input::get('name');

		if($image_files) {
			for ($i=0; $i < count($image_files); $i++) {
				$brand->brand_icon = $image_files[$i]['imagename'];
			}
		}
		
		$brand->created_at = Date('Y-m-d H:i:s');
		$brand->save();

		Session::flash('success', 'Brand is successfully created.');
		return Redirect::to('admin/brand');
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
		$brand = Brand::findOrFail($id);
		return View::make('backend.admin.brand.detail', compact('brand'));
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
		$brand = Brand::find($id);
		$images = Brand::where('id','=',$id)->where('brand_icon','!=',"")->get();
		return View::make('backend.admin.brand.edit', compact('brand','images'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$brand = Brand::find($id);
		$file = Input::file('userfile');

		$rules = array(
			'name'	=> 'required|unique:brands,brand_name,'.$id
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes()) {

			if(!is_null($file[0])){
				$image_files = array();
				$image_files = parent::common_upload_picture(Input::file('userfile'), 'uploads/brand_icons');
				
				for ($i=0; $i < count($image_files); $i++) {
				    $brand->brand_icon = $image_files[$i]['imagename'];
				}
			}
			$brand->brand_name = Input::get('name');
			$brand->updated_at = Date('Y-m-d H:i:s');
			$brand->save();

			Session::flash('success', 'Brand is successfully updated.');
			return Redirect::to('admin/brand');
		} else {
			return Redirect::to('admin/brand/'.$id.'/edit')->withErrors($validator)->withInput();
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
		$brand = Brand::find($id);
		unlink('uploads/brand_icons/'.$brand->brand_icon);
		Brand::destroy($id);
		Session::flash('success', 'Brand is successfully deleted.');
		return Redirect::to('admin/brand');
	}
	
	/**
	 * Delete the image
	 *
	 */
	public function delete_image($id)
	{
		if(!User::hasPermTo(MODULE,'delete'))return Redirect::to('admin/error/show/403');
		$brand = Brand::find($id);
		unlink('uploads/brand_icons/'.$brand->brand_icon);
		Brand::where('id','=',$id)->update(array('brand_icon' => ''));
	}
	
	public function report_pdf()
	{
		$brands = Brand::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($brands) != 0 )
		{
			$pdf = App::make('dompdf');
			$pdf = PDF::loadView('backend.admin.brand.report_pdf',compact('brands','date_format'));
			return $pdf->stream();
		} else {
			Session::flash('fail', 'There is no brand.');
			return Redirect::to('admin/brand');
		}
	}
	
	public function report_excel()
	{
		$brands = Brand::orderBy('created_at','desc')->get();
		$date_format = Common::get_date();
		if ( count($brands) != 0 )
		{
			$i = 1;
			foreach ( $brands as $brand )
    			{
    				$temp['no'] = $i++;
            			$temp['name'] = $brand->brand_name;
            			$temp['create'] = date($date_format, strtotime($brand->created_at));
            			$result[] = $temp;
            		}
            		
			$filename = "brand_report.csv";
			
			$header = array(
				'No.','Brand Name', 'Created Date'
			);

			return CSV::create($result, $header)->render($filename);

		} else {
			Session::flash('fail', 'There is no brand.');
			return Redirect::to('admin/brand');
		}
	}


}