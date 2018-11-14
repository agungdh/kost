@if($hasLabel)
{!! Form::label($name, $title) !!}
@endif
<div class="form-group">
    @php
    $class = $errors->has($name) ? 'form-line error focused' : 'form-line';
    $message = $errors->has($name) ? '<label class="error">' . $errors->first($name) . '</label>' : '';
    @endphp
    <div class="{{ $class }}">
        {!!
          Form::file(
            $name,
            array_merge(
              [
                'class'=> 'form-control',
                'id'=>$name,
                'placeholder' => $title,
              ],
              $attributes
            )
          )
        !!}
    </div>
    {!! $message !!}
</div>