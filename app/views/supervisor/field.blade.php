@extends('supervisor/layout')

@section('pageTitle')
	Field List
@stop

@section('addResource')
	<script>
		function chSelection(){
			var allCheck=document.field.all;
			var fieldName=document.field.elements["fieldName[]"];
			var i;
			if(allCheck.checked){
				for(i=0;i<fieldName.length;i++){
					fieldName[i].checked=true;
				}
			}else{
				for(i=0;i<fieldName.length;i++){
					fieldName[i].checked=false;
				}
			}
		}
	</script>
@stop

@section('field.nav') selected="selected" @stop
@section('field.menu') active @stop

@section('content')
    <h2>Field List</h2>
	<div class="well widget">
        <form class="form-inline" style="margin-bottom: 0px;" name="insert" method="post" action="{{ URL::to('/') }}/supervisor/field/add">
			<h2>Insert Field</h2>
            <input class="input-xxlarge" placeholder="Name" type="text" name="name"><br/>
			<textarea class="input-xxlarge" placeholder="Description" name="description"></textarea><br/>
            <button class="btn" type="submit" onclick="document.insert.submit()"><i class="icon-save"></i>Save</button>
        </form>
    </div>
	<div class="well widget">
        <form class="form-inline" style="margin-bottom: 0px;" name="search">
            <input class="input-xlarge" placeholder="Search Field..." type="text" name="search">
            <button class="btn" type="button"><i class="icon-search"></i> Go</button>
        </form>
    </div>
	<form class="form-horizontal" name="field">
    <table class="table table-first-column-check">
      <thead>
        <tr>
          <th><input type="checkbox" name="all" onchange="chSelection()"></th>
          <th>Name</th>
          <th>Description</th>
        </tr>
      </thead>
       <tbody>
	    <tr>
          <td><input type="checkbox" name="fieldName[]" value=""></td>
          <td>Mark</td>
          <td>Tompson</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="fieldName[]" value=""></td>
          <td>Ashley</td>
          <td>Jacobs</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="fieldName[]" value=""></td>
          <td>Audrey</td>
          <td>Ann asdkjlasd klasjdask dlsakjdlkas askldjkasl slakjdlksa lkasjd lkasjd lkasjd lkasjd ljasdkjaskld kaljsdklasjdkljsalkd klsajdlkasjdlkjaslkd kalsjdlaksjdkl kaljsdljasd kljasldjlkasd</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="fieldName[]" value=""></td>
          <td>John</td>
          <td>Robinson</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="fieldName[]" value=""></td>
          <td>Mark</td>
          <td>Tompson</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="fieldName[]" value=""></td>
          <td>Ashley</td>
          <td>Jacobs</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="fieldName[]" value=""></td>
          <td>Audrey</td>
          <td>Ann asdkjlasd klasjdask dlsakjdlkas askldjkasl slakjdlksa lkasjd lkasjd lkasjd lkasjd ljasdkjaskld kaljsdklasjdkljsalkd klsajdlkasjdlkjaslkd kalsjdlaksjdkl kaljsdljasd kljasldjlkasd</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="fieldName[]" value=""></td>
          <td>John</td>
          <td>Robinson</td>
        </tr>
       </tbody>
    </table>
	<div class="pagination">
	<center>
	  <ul>
		<li class="disabled"><a href="#">Prev</a></li>
		<li class="active disabled"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">Next</a></li>
	  </ul>
	</center>
	</div>
	<input type="submit" class="btn" value="Hapus">
  </form>
@stop