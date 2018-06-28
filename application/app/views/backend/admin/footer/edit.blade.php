@extends('backend.template.template')

@section('style')
<style type="text/css" media="screen">
.modal-dialog {
	width: 1100px;
}
</style>
@stop

@section('content')
<div class="page-content">
	<h3 class="page-title">
		Footer Information <small>management</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<span aria-hidden="true" class="icon-home"></span>
				<a href="{{URL::to('admin/')}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="{{URL::to('admin/footer_cms')}}">Footer Information</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				Edit
			</li>
		</ul>
	</div>

	<div class="row">
		<div class="col-md-12">

		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet box blue-madison">
		<div class="portlet-title">
			<div class="caption">
				<span aria-hidden="true" class="icon-compass"></span> Footer Information Management
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body form">

		@if ( $footer_cms->name == 'first_column' )
		<!-- BEGIN FORM-->
		{{ Form::model($footer_cms, array('method' => 'PUT', 'route'=> array('admin.footer_cms.update', $footer_cms->id),  'class'=>'form-horizontal')) }}
		<div class="form-body">

			<h3 class="form-section">Footer<small> informations</small></h3>

			<input type="hidden" name="id" value="{{ $footer_cms->id }}">

				@if ($errors->has('title') || $errors->has('text'))
					<div class="alert alert-danger">
						You have some form errors. Please check below.
					</div>
				@endif			
				<div class="form-group  @if ($errors->has('title')) has-error @endif">
					<label class="control-label col-md-3">Title<span class="required">* </span></label>
					<div class="col-md-7">
						{{ Form::text('title', $footer_cms->title, array('class'=>'form-control')) }}
						@foreach($errors->get('title') as $error)
							<span class="help-block"> {{ $error }}</span>
						@endforeach
					</div>
				</div> 
				<div class="form-group  @if ($errors->has('text')) has-error @endif">
					<label class="control-label col-md-3">Text<span class="required">* </span></label>
					<div class="col-md-7">
						{{ Form::textarea('text', $footer_cms->text, array('class'=>'ckeditor form-control first_text','id'=>'editor1')) }}
						@foreach($errors->get('text') as $error)
							<span class="help-block"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
		</div>

		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Update</button>
					<button type="button" class="btn green-meadow first_preview"><span aria-hidden="true" class="icon-eye"></span> Preview</button>
					<button type="button" class="btn grey-cascade" id="back">Cancel</button>
				</div>
			</div>
		</div>					
		{{ Form::close() }}
		<!-- END FORM-->
		@endif

		@if ( $footer_cms->name == 'third_column' )
		<!-- BEGIN FORM-->
		{{ Form::model($footer_cms, array('method' => 'PUT', 'route'=> array('admin.footer_cms.update', $footer_cms->id),  'class'=>'form-horizontal')) }}
		<div class="form-body">

			<h3 class="form-section">Footer<small> informations</small></h3>

			<input type="hidden" name="id" value="{{ $footer_cms->id }}">

				@if ($errors->has('url'))
					<div class="alert alert-danger">
						You have some form errors. Please check below.
					</div>
				@endif			
				<div class="form-group  @if ($errors->has('url')) has-error @endif">
					<label class="control-label col-md-3">Facebook URL<span class="required">* </span></label>
					<div class="col-md-7">
						{{ Form::text('url', $footer_cms->title, array('class'=>'form-control')) }}
						@foreach($errors->get('url') as $error)
							<span class="help-block"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Update</button>
					<button type="button" class="btn green-meadow third_preview"><span aria-hidden="true" class="icon-eye"></span> Preview</button>
					<button type="button" class="btn grey-cascade" id="back">Cancel</button>
				</div>
			</div>
		</div>					
		{{ Form::close() }}
		@endif


		@if ( $footer_cms->name == 'fourth_column' )
		{{ Form::model($footer_cms, array('method' => 'PUT', 'route'=> array('admin.footer_cms.update', $footer_cms->id),  'class'=>'form-horizontal')) }}
		<div class="form-body">

			<h3 class="form-section">Footer<small> informations</small></h3>

			<input type="hidden" name="id" value="{{ $footer_cms->id }}">

				@if ($errors->has('fourth_title') || $errors->has('address') || $errors->has('phone') || $errors->has('email'))
					<div class="alert alert-danger">
						You have some form errors. Please check below.
					</div>
				@endif
				<div class="form-group  @if ($errors->has('fourth_title')) has-error @endif">
					<label class="control-label col-md-3">Title<span class="required">* </span></label>
					<div class="col-md-7">
						{{ Form::text('fourth_title', $footer_cms->title, array('class'=>'form-control')) }}
						@foreach($errors->get('fourth_title') as $error)
							<span class="help-block"> {{ $error }}</span>
						@endforeach
					</div>
				</div>	
				<div class="form-group  @if ($errors->has('phone')) has-error @endif">
					<label class="control-label col-md-3">Phone<span class="required">* </span></label>
					<div class="col-md-7">
						{{ Form::text('phone', $footer_cms->phone, array('class'=>'form-control')) }}
						@foreach($errors->get('phone') as $error)
							<span class="help-block"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
				<div class="form-group  @if ($errors->has('email')) has-error @endif">
					<label class="control-label col-md-3">Email<span class="required">* </span></label>
					<div class="col-md-7">
						{{ Form::text('email', $footer_cms->email, array('class'=>'form-control')) }}
						@foreach($errors->get('email') as $error)
							<span class="help-block"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Fax</label>
					<div class="col-md-7">
						{{ Form::text('fax', $footer_cms->fax, array('class'=>'form-control')) }}
					</div>
				</div>
				<div class="form-group  @if ($errors->has('address')) has-error @endif">
					<label class="control-label col-md-3">Address<span class="required">* </span></label>
					<div class="col-md-7">
						{{ Form::textarea('address', $footer_cms->text, array('class'=>'ckeditor form-control','id'=>'address')) }}
						@foreach($errors->get('address') as $error)
							<span class="help-block"> {{ $error }}</span>
						@endforeach
					</div>
				</div>
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn blue-madison"><i class="fa fa-save"></i> Update</button>
					<button type="button" class="btn green-meadow fourth_preview"><span aria-hidden="true" class="icon-eye"></span> Preview</button>
					<button type="button" class="btn grey-cascade" id="back">Cancel</button>
				</div>
			</div>
		</div>					
		{{ Form::close() }}
		@endif


		</div>
		</div>
		<!-- END PAGE CONTENT-->

		</div>
		
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$('.first_preview').click(function(){
	var title = $("input[name=title]").val();
	var text = CKEDITOR.instances['editor1'].getData();
	bootbox.dialog({
  		title: "Footer Preview",
  		message: "<div class='row'><div class='col-md-3'><h3>"+title+"</h3><p>"+text+"</p></div><div class='col-md-3'><h3>xxxxx</h3><ul><li>xxxxxxxx xxxxxxxx xxxxxx</li><li>xxxx xxxxxxx xxxxxxx</li><li>xxxx xxxxxxxxx  xxxxxxxx</li><li>xxxxxxx xxxxx xxxx</li></ul></div><div class='col-md-3'><h3>xxxxx</h3><p>xxxxx xxx xxx xxxxx<br/>xxxx xxxxx xxxx xxx</p></div><div class='col-md-3'><h3>xxxxx</h3><p>xxxx xxxx xxxxxx xxxxxxx xxx<br/>xxxxxxxx xx xxx</p><p>Phone : xxx xxx xxxxxx</p><p>Email : xxxxx xxxxx xxxx</p><p>Fax : xxxx xxxxx xxxx</p></div></div>"
	});
});

$('.third_preview').click(function(){
	var url = $("input[name=url]").val();
	bootbox.dialog({
  		title: "Footer Preview",
  		message: "<div class='row'><div class='col-md-3'><h3>xxxxx xxxx</h3><p>xxxxxxxxxxx xxxxxxxxx<br/>xxxxxxxxxxxx xxxxxxxxxxx x<br/>xxxxxxxxxxx xxxxxxxxxx xxxxxx<br/>xxxxxxx xxxxxxxxxxxxxx xxx<br/>xxxxxxxxx xxxxxxxxxx xxxx</p></div><div class='col-md-3'><h3>xxxxx</h3><ul><li>xxxxxxxx xxxxxxxx xxxxxx</li><li>xxxx xxxxxxx xxxxxxx</li><li>xxxx xxxxxxxxx  xxxxxxxx</li><li>xxxxxxx xxxxx xxxx</li></ul></div><div class='col-md-3'><div class='fb-page' data-href='"+url+"' data-width='240' data-hide-cover='false' data-show-facepile='true' data-show-posts='false'></div></div><div class='col-md-3'><h3>xxxxx</h3><p>xxxx xxxx xxxxxx xxxxxxx xxx<br/>xxxxxxxx xx xxx</p><p>Phone : xxx xxx xxxxxx</p><p>Email : xxxxx xxxxx xxxx</p><p>Fax : xxxx xxxxx xxxx</p></div></div>"
	});
});

$('.fourth_preview').click(function(){
	var title = $("input[name=fourth_title]").val();
	var address = CKEDITOR.instances['address'].getData();
	var phone = $("input[name=phone]").val();
	var email = $("input[name=email]").val();
	var fax = $("input[name=fax]").val();

	bootbox.dialog({
  		title: "Footer Preview",
  		message: "<div class='row'><div class='col-md-3'><h3>xxxxx xxxx</h3><p>xxxxxxxxxxx xxxxxxxxx<br/>xxxxxxxxxxxx xxxxxxxxxxx x<br/>xxxxxxxxxxx xxxxxxxxxx xxxxxx<br/>xxxxxxx xxxxxxxxxxxxxx xxx<br/>xxxxxxxxx xxxxxxxxxx xxxx</p></div><div class='col-md-3'><h3>xxxxx</h3><ul><li>xxxxxxxx xxxxxxxx xxxxxx</li><li>xxxx xxxxxxx xxxxxxx</li><li>xxxx xxxxxxxxx  xxxxxxxx</li><li>xxxxxxx xxxxx xxxx</li></ul></div><div class='col-md-3'><h3>xxxxx</h3><p>xxxxx xxx xxx xxxxx<br/>xxxx xxxxx xxxx xxx</p></div><div class='col-md-3'><h3>"+title+"</h3><p>"+address+"</p><p>Phone : "+phone+"</p><p>Email : "+email+"</p><p>Fax : "+fax+"</p></div></div>"
	});
});
</script>
@stop