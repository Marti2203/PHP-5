	<p class="text-center"> {{ $title }}</p>

{{Form::open(array('action' => $action,'method'=>'get')) }}
    <div class="input-group">
      <span class="input-group-btn">
        <button  type="submit" class="btn btn-default" type="button">Find!</button>
      </span>
      <input type="text" name="name" class="form-control" placeholder="Search for {{ $type }}">
    </div><!-- /input-group -->
{{Form::close()}}
