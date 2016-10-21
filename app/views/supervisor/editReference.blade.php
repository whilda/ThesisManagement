@extends('supervisor/layout')

@section('pageTitle')
	Edit Reference
@stop

@section('library.nav') selected="selected" @stop
@section('library.menu') active @stop

@section('addResource')
	<script>
		$(document.edit.keywordName).typeahead({
			source: function(query, process){
				return $.ajax({  
					type: 'GET',  
					url: '<?php echo URL::to('/'); ?>/field/get/'+query,
					contentType: 'application/json',
					success: function(data){
						var output=JSON.parse(data);
						var keyword=[];
						for(var i=0;i<output.length;i++)
							keyword[i]=output[i]._id;
						return process(keyword);
					},  
					timeout:60000  
				});
			},
			items: 4,
			updater: function(item){
				var keywords=document.edit.elements["keyword[]"];
				var newKey=true;
				if(keywords!=undefined){
					if(keywords.length==undefined){
						if(keywords.value==item)
							newKey=false;
					}
					else{
						for(var i=0;i<keywords.length;i++){
							if(keywords[i].value==item)
								newKey=false;
						}
					}
				}
				if(newKey==true){
					var appended="<div>";
					appended+="<div class=\"input-prepend\">";
					appended+="<input type=\"hidden\" name=\"keywords[]\" value=\""+item+"\">";
					appended+="<span class=\"add-on\">"+item+"</span>";
					appended+="</div>";
					appended+="<div class=\"input-append\">";
					appended+="<span class=\"add-on\"><a href=\"javascript:void(0)\" onclick=\"delKey(this)\"><i class=\"icon-remove\"></i></a></span>";
					appended+="</div>";
					appended+="</div>";
					$("#saveKey").append(appended);
				}
			}
		});
		function saveThesis(button){
			$(button).prop("disabled",true);
			var author=document.edit.author.value;
            var title=document.edit.title.value;
            var year=document.edit.year.value;
            var abstr=document.edit.abstr.value;
            var keywords=document.edit.elements["keywords[]"];
            var keyList=[];
            var error="";
            if(author==""){
                error+="<li>Author tidak boleh kosong</li>";
            }
            if(title==""){
                error+="<li>Title tidak boleh kosong</li>";
            }
            if(year==""){
                error+="<li>Year tidak boleh kosong</li>";
            }else if(year<1950||year>{{ date('Y') }}){
                error+="<li>Year tidak valid</li>";
            }
            if(keywords==undefined){
                error+="<li>Keywords tidak boleh kosong</li>";
            }
            if(error==""){
                if(keywords!=undefined){
                    if(keywords.length==undefined){
                        keyList.push(keywords.value);
                    }
                    else{
                        for(var i=0;i<keywords.length;i++){
                            keyList.push(keywords[i].value);
                        }
                    }
                }
                model={
                    "author":author,
                    "title":title,
                    "year":year,
                    "abstr":abstr,
                    "keywords":keyList
                };
				$.ajax({  
					type: 'POST',  
					url: '<?php echo URL::to('/'); ?>/supervisor/reference/edit/{{ $data['_id'] }}/save',  
					data: JSON.stringify(model),  
					dataType: 'text',  
					contentType: 'application/json',
					success: function(data){
						$(button).prop("disabled",false);
						if(data==1){
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-success");
							$("#notifMsg").html("Save success");
							$("#notifMsg").slideDown();
						}else{
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-error");
							$("#notifMsg").html("Save failed");
							$("#notifMsg").slideDown();
						}
					},  
					error: function(req, status, ex) {
						$(button).prop("disabled",false);
						$("#notifMsg").hide();
						$("#notifMsg").attr("class", "alert alert-error");
						$("#notifMsg").html("Save failed");
						$("#notifMsg").slideDown();
					},  
					timeout:60000  
				});
			}else{
				$(button).prop("disabled",false);
				$("#notifMsg").hide();
				$("#notifMsg").attr("class", "alert alert-error");
				$("#notifMsg").html("<ul>"+error+"</ul>");
				$("#notifMsg").slideDown();
			}
		}
		function notifMsg(){
			$("#notifMsg").slideUp();
		}
		function delKey(element){
			if(element.tagName=="A")
				element.parentNode.parentNode.parentNode.parentNode.removeChild(element.parentNode.parentNode.parentNode);
		}
	</script>
@stop

@section('content')
    <h2>Edit Referensi</h2>
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
  <form class="form-horizontal" name="edit">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="name">Author</label>
          <div class="controls">
            <input type="text" name="author" id="author" class="input-xlarge" value="{{ $data['author'] }}">
          </div>
        </div>
        <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="name">Title</label>
          <div class="controls">
            <input type="text" name="title" id="title" class="input-xlarge" value="{{ $data['title'] }}">
          </div>
        </div>
        <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="name">Year</label>
          <div class="controls">
            <input type="number" name="year" id="year" class="input-xlarge" min="1950" max="{{ date('Y') }}" maxlength="4" value="{{ $data['year'] }}">
          </div>
        </div>
        <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="description">Abstract</label>
          <div class="controls">
            <textarea name="abstr" id="abstr" class="input-xlarge">{{ $data['abstract'] }}</textarea>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="keywordName">Keywords</label>
          <div class="controls">
            <input type="text" name="keywordName" id="keywordName" class="input-xlarge" placeholder="Search Key" autocomplete="off">
          </div>
        </div>
		<div class="control-group clearfix">

          <!-- Text input-->
          <div class="control-label">Selected Keywords</div>
          <div class="controls" id="saveKey">
			@foreach($data['keywords'] as $keyword)
			<div>
				<div class="input-prepend">
					<input type="hidden" name="keywords[]" value="{{{ $keyword }}}"><span class="add-on">{{{ $keyword }}}</span>
				</div><div class="input-append">
					<span class="add-on">
					<a href="javascript:void(0)" onclick="delKey(this)"><i class="icon-remove"></i></a>
					</span>
				</div>
			</div>
		  @endforeach
          </div>
        </div>
        <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="name">Ditambahkan Oleh</label>
          <div class="controls">
            <input type="text" class="input-xlarge" value="{{ $data['added_by'] }}" disabled>
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="button" class="btn btn-success" value="Simpan" onclick="saveThesis(this)"/>
			<input type="button" class="btn btn-info" value="Kembali" onclick="window.history.go(-1)"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop