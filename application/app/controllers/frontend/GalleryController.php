<?php
namespace Frontend;

use BaseController;
use View; use Response; use Request; use Input; use Redirect; use URL; use Session; use App;
use Gallery; use General_setting; use Facebook_gallery; use DB;

class GalleryController extends BaseController {

	public function index()
	{
		$gallery = DB::table('gallery')->paginate(1);
		$get_fbgallery = General_setting::where('type','=','facebook_gallery')->first();
		$get_gallery = General_setting::where('type','=','gallery')->first();
		$fb_id = Facebook_gallery::find(1);
		return View::make('frontend.gallery.index', compact('gallery','get_fbgallery','get_gallery','fb_id'));
	}
	
}
