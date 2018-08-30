@extends('layouts.master')
@section('page_title','Events')

@section('content')

<div class="row">
{{ Form::open(['route' => 'events.store', 'method' => 'post', 'role' => 'form']) }}
            <div id="responsive-modal" class="modal fade" tabindex="-1" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>REGISTRO DE NUEVO EVENTO</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('title', 'TITULO DE EVENTO') }}
                                {{ Form::text('title', old('title'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('date_start', 'FECHA INICIO') }}
                                {{ Form::text('date_start', old('date_start'), ['class' => 'form-control', 'readonly' => 'true']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('time_start', 'HORA INICIO') }}
                                {{ Form::text('time_start', old('time_start'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('date_end', 'FECHA HORA FIN') }}
                                {{ Form::text('date_end', old('date_end'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('color', 'COLOR') }}
                                <div class="input-group colorpicker">
                                    {{ Form::text('color', old('color'), ['class' => 'form-control']) }}
                                    <span class="input-group-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dafault" data-dismiss="modal">CANCELAR</button>
                            {!! Form::submit('GUARDAR', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            <div id='calendar'></div>

            <div id="modal-event" class="modal fade" tabindex="-1" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>DETALLES DE EVENTO</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('_title', 'TITULO DE EVENTO') }}
                                {{ Form::text('_title', old('_title'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('_date_start', 'FECHA INICIO') }}
                                {{ Form::text('_date_start', old('_date_start'), ['class' => 'form-control', 'readonly']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('_time_start', 'HORA INICIO') }}
                                {{ Form::text('_time_start', old('_time_start'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('_date_end', 'FECHA HORA FIN') }}
                                {{ Form::text('_date_end', old('_date_end'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('_color', 'COLOR') }}
                                <div class="input-group colorpicker">
                                    {{ Form::text('_color', old('_color'), ['class' => 'form-control']) }}
                                    <span class="input-group-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a id="delete" data-href="{{ url('events') }}" data-id="" class="btn btn-danger">ELIMINAR</a>
                            <button type="button" class="btn btn-dafault" data-dismiss="modal">CANCELAR</button>
                            <a href="#" data-href="{{ url('events') }}" class="btn btn-success btn-update" data-id="">ACTUALIZAR</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>
@endsection