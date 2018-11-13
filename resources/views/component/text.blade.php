{!! Form::label($name, $title) !!}
<div class="form-group">
    @php
    $class = $errors->has($name) ? 'form-line error focused' : 'form-line';
    $message = $errors->has($name) ? '<label class="error">' . $errors->first($name) . '</label>' : '';
    @endphp
    <div class="{{ $class }}">
        {!!
          Form::text(
            $name,
            $value,
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