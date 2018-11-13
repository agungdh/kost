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
          Form::select(
            $name,
            $data,
            $value,
            array_merge(
              [
                'class'=> 'form-control select2',
                'id'=>$name,
                'placeholder' => 'Pilih ' . $title,
              ],
              $attributes
            )
          )
        !!}
    </div>
    {!! $message !!}
</div>