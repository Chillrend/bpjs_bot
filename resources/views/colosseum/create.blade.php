@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Create Colosseum Archive Entry') }}</div>
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('colosseum/store') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('rival') ? ' has-error' : '' }}">
                            <label for="rival" class="col-md-4 control-label">Rival</label>

                            <div class="col-md-6">
                                <input id="rival" type="text" class="form-control" name="rival" value="{{ old('rival') }}">
                                <small class="form-text text-muted">Our formidable(?) opponent</small>

                                @if ($errors->has('rival'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rival') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group{{ $errors->has('outcome') ? ' has-error' : '' }}">
                        <label for="outcome" class="col-md-4 control-label">Outcome</label>

                        <div class="col-md-6">
                            <select id="rival" type="text" class="form-control" name="outcome">
                                <option value="Victory" selected>Victory</option>
                                <option value="Defeat">Defeat</option>
                            </select>
                            <small class="form-text text-muted">Are you winning son?</small>

                            @if ($errors->has('outcome'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('outcome') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lifeforce_our') ? ' has-error' : '' }}">
                        <label for="lifeforce_our" class="col-md-4 control-label">Our lifeforce</label>

                        <div class="col-md-6">
                            <input id="lifeforce_our" type="number" class="form-control" name="lifeforce_our" value="{{ old('lifeforce_our') }}">
                            <small class="form-text text-muted">Gained lifeforce</small>

                            @if ($errors->has('lifeforce_our'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('lifeforce_our') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lifeforce_theirs') ? ' has-error' : '' }}">
                        <label for="lifeforce_theirs" class="col-md-4 control-label">Their lifeforce</label>

                        <div class="col-md-6">
                            <input id="lifeforce_theirs" type="number" class="form-control" name="lifeforce_theirs" value="{{ old('lifeforce_theirs') }}">
                            <small class="form-text text-muted">Their gained lifeforce</small>

                            @if ($errors->has('lifeforce_theirs'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('lifeforce_theirs') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('colosseum_date') ? ' has-error' : '' }}">
                        <label for="colosseum_date" class="col-md-4 control-label">Colosseum Date</label>

                        <div class="col-md-6">
                            <input id="colosseum_date" type="date" class="form-control" name="colosseum_date" value="{{ old('colosseum_date') }}">
                            <small class="form-text text-muted">The date of the battle</small>

                            @if ($errors->has('colosseum_date'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('colosseum_date') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('colosseum_type') ? ' has-error' : '' }}">
                        <label for="colosseum_type" class="col-md-4 control-label">Colosseum Type</label>

                        <div class="col-md-6">
                            <select id="colosseum_type" type="text" class="form-control" name="colosseum_type">
                                <option value="Colosseum" selected>Standard Colosseum</option>
                                <option value="Gran Colosseum">Gran Colosseum</option>
                                <option value="Blood Colosseum">Blood Colosseum</option>
                            </select>
                            <small class="form-text text-muted">Are you winning son?</small>

                            @if ($errors->has('colosseum_type'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('colosseum_type') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Create event
                                </button>
                            </div>
                        </div>
                    </form>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
